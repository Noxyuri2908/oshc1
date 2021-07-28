<?php

namespace App\Http\Controllers\Admin;

use App\Admin\ArchiveMediaContent;
use App\Admin\ArchiveMediaLink;
use App\Http\Requests\CustomerDatabaseManagerStoreRequest;
use App\Http\Requests\CustomerDatabaseManagerUpdateRequest;
use App\Imports\CustomerDatabaseManagersImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\CustomerDatabaseManager;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Excel;

class CustomerDatabaseManagerController extends Controller
{
    //
    public function index(){
        if(!auth()->user()->can('customerManager.index')){
            return abort(403);
        }
        $flag = 'customer-database-manager';
        return view('CRM.pages.customer_database_manager.index',compact('flag'));
    }
    public function getData(Request $request)
    {
        if(!auth()->user()->can('customerManager.index')){
            return abort(403);
        }
        $customerDatas = CustomerDatabaseManager::when($request->get('type_of_customer_id'),function($query) use ($request){
            $query->where('type_of_customer_id',$request->get('type_of_customer_id'));
        })->when($request->get('full_name'),function($query) use ($request){
            $query->where('full_name','LIKE','%'.$request->get('full_name').'%');
        })->when($request->get('source_id'),function($query) use ($request){
            $query->where('source_id',$request->get('source_id'));
        })->when($request->get('agent_id'),function($query) use ($request){
            $query->where('agent_id',$request->get('agent_id'));
        })->when($request->get('english_center_id'),function($query) use ($request){
            $query->where('english_center_id',$request->get('english_center_id'));
        })->when($request->get('event_id'),function($query) use ($request){
            $query->where('event_id',$request->get('event_id'));
        })->when($request->get('identification'),function($query) use ($request){
            $query->where('identification','LIKE','%'.$request->get('identification').'%');
        })->when($request->get('gender'),function($query) use ($request){
            $query->where('gender',$request->get('gender'));
        })->when($request->get('date_of_birth'),function($query) use ($request){
            $query->whereDate('date_of_birth',convert_date_to_db($request->get('date_of_birth')));
        })->when($request->get('mail'),function($query) use ($request){
            $query->where('mail','LIKE','%'.$request->get('mail').'%');
        })->when($request->get('phone_number'),function($query) use ($request){
            $query->where('phone_number','LIKE','%'.$request->get('phone_number').'%');
        })->when($request->get('social_link'),function($query) use ($request){
            $query->where('social_link','LIKE','%'.$request->get('social_link').'%');
        })->when($request->get('country_id'),function($query) use ($request){
            $query->where('country_id',$request->get('country_id'));
        })->when($request->get('city_name'),function($query) use ($request){
            $query->where('city_name','LIKE','%'.$request->get('city_name').'%');
        })->when($request->get('school_name'),function($query) use ($request){
            $query->where('school_name','LIKE','%'.$request->get('school_name').'%');
        })->when($request->get('study_tour'),function($query) use ($request){
            $query->where('study_tour',$request->get('study_tour'));
        })->when($request->get('departure_date'),function($query) use ($request){
            $query->whereDate('departure_date',convert_date_to_db($request->get('departure_date')));
        })->when($request->get('destination_to_study'),function($query) use ($request){
            $query->where('destination_to_study',$request->get('destination_to_study'));
        })->when($request->get('potentiality'),function($query) use ($request){
            $query->where('potentiality',$request->get('potentiality'));
        })->when($request->get('potential_service'),function($query) use ($request){
            $query->where('potential_service',$request->get('potential_service'));
        })->when($request->get('email_status'),function($query) use ($request){
            $query->where('email_status',$request->get('email_status'));
        })->when($request->get('note'),function($query) use ($request){
            $query->where('note','LIKE','%'.$request->get('note').'%');
        })
            ->orderBy('id', 'desc')
            ->paginate(20);
        $lastPage = $customerDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.customer_database_manager.data', compact(
                'customerDatas'
            ))->render(),
            'last_page' => $lastPage
        ]);
    }
    public function create(){
        $flag = 'customer-database-manager';
        return view('CRM.pages.customer_database_manager.form',compact('flag'));
    }
    public function store(CustomerDatabaseManagerStoreRequest $request){
        if(!auth()->user()->can('customerManager.store')){
            return abort(403);
        }
        $data = $request->validated();
        $arrDate = [
            'date_of_birth',
            'departure_date'
        ];
        foreach($arrDate as $key){
            $data[$key]=(!empty($data[$key]))?convert_date_to_db($data[$key]):null;
        }
        CustomerDatabaseManager::create($data);
        $customerDatas = CustomerDatabaseManager::orderBy('id', 'desc')->paginate(15);
        $lastPage = $customerDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.customer_database_manager.data', compact(
                'customerDatas'
            ))->render(),
            'last_page' => $lastPage,
            'type' => 'create'
        ]);
    }
    public function edit(Request $request, $id)
    {
        if(!auth()->user()->can('customerManager.edit')){
            return abort(403);
        }
        $customerData = CustomerDatabaseManager::findOrFail($id);
        return view('CRM.pages.customer_database_manager.form', compact(
            'customerData'
        ));
    }
    public function update(CustomerDatabaseManagerUpdateRequest $request, $id)
    {
        if(!auth()->user()->can('customerManager.update')){
            return abort(403);
        }
        $data = $request->validated();
        $arrDate = [
            'date_of_birth',
            'departure_date'
        ];
        foreach($arrDate as $key){
            $data[$key]=(!empty($data[$key]))?convert_date_to_db($data[$key]):null;
        }
        $customerData = CustomerDatabaseManager::findOrFail($id);
        $customerData->update($data);
        $customerDatas = [$customerData];
        return response()->json([
            'view' => view('CRM.pages.customer_database_manager.data', compact(
                'customerDatas'
            ))->render(),
            'id' => $customerData->id,
            'type' => 'update'
        ]);
    }
    public function destroy(Request $request, $id)
    {
        if(!auth()->user()->can('customerManager.delete')){
            return abort(403);
        }
        $customerData = CustomerDatabaseManager::findOrFail($id);
        $customerData->delete();
        return response()->json([
            'id' => $id
        ]);
    }
    public function importExcel(Request $request){
        $excel = App::make('excel');
        $excel->import(new CustomerDatabaseManagersImport,$request->file('file'));
        return back();
    }
}
