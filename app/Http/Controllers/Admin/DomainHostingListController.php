<?php

namespace App\Http\Controllers\Admin;

use App\Admin\ArchiveMediaLink;
use App\Admin\DomainHostingList;
use App\Http\Requests\DomainHostingListRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DomainHostingListController extends Controller
{
    //
    public function index(Request $request){
        if(!$request->user()->can('domain-hosting-manager.index')) return abort(403);
        $flag= 'domain-hosting-lists';
        return view('CRM.pages.domain-hosting-list.index',compact('flag'));
    }
    public function getData(Request $request)
    {
        if(!$request->user()->can('domain-hosting-manager.index')) return abort(403);
        $domainHostingDatas = DomainHostingList::when($request->get('type'),function($query) use ($request){
            $query->where('type',$request->get('type'));
        })->when($request->get('name'),function($query) use ($request){
            $query->where('name','LIKE','%'.$request->get('name').'%');
        })->when($request->get('link'),function($query) use ($request){
            $query->where('link','LIKE','%'.$request->get('link').'%');
        })->when($request->get('user'),function($query) use ($request){
            $query->where('user','LIKE','%'.$request->get('user').'%');
        })->when($request->get('password'),function($query) use ($request){
            $query->where('password','LIKE','%'.$request->get('password').'%');
        })->when($request->get('provider'),function($query) use ($request){
            $query->where('provider','LIKE','%'.$request->get('provider').'%');
        })->when($request->get('person_in_charge'),function($query) use ($request){
            $query->where('person_in_charge',$request->get('person_in_charge'));
        })->when($request->get('email_in_charge'),function($query) use ($request){
            $query->where('email_in_charge','LIKE','%'.$request->get('email_in_charge').'%');
        })->when($request->get('expiry_date'),function($query) use ($request){
            $query->whereDate('expiry_date',convert_date_to_db($request->get('expiry_date')));
        })->when($request->get('fee'),function($query) use ($request){
            $query->whereDate('fee','LIKE','%'.$request->get('fee').'%');
        })
            ->orderBy('id', 'desc')
            ->paginate(15);
        $lastPage = $domainHostingDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.domain-hosting-list.data', compact(
                'domainHostingDatas'
            ))->render(),
            'last_page' => $lastPage
        ]);
    }

    public function create(Request $request)
    {
        if(!$request->user()->can('domain-hosting-manager.store')) return abort(403);
        $flag = 'domain-hosting-list-store';
        return view('CRM.pages.domain-hosting-list.form', compact('flag'));
    }

    public function store(DomainHostingListRequest $request)
    {
        if(!$request->user()->can('domain-hosting-manager.store')) return abort(403);
        $data = $request->validated();
        $arrDate = [
            'expiry_date'
        ];
        foreach($arrDate as $date){
            $data[$date] = !empty($data[$date])?convert_date_to_db($data[$date]):null;
        }
        DomainHostingList::create($data);
        $domainHostingDatas = DomainHostingList::orderBy('id', 'desc')->paginate(15);
        $lastPage = $domainHostingDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.domain-hosting-list.data', compact(
                'domainHostingDatas'
            ))->render(),
            'last_page' => $lastPage,
            'type' => 'create'
        ]);
    }

    public function edit(Request $request, $id)
    {
        if(!$request->user()->can('domain-hosting-manager.edit')) return abort(403);
        $flag = 'domain-hosting-list-edit';
        $domainHostingData = DomainHostingList::findOrFail($id);
        return view('CRM.pages.domain-hosting-list.form', compact(
            'flag',
            'domainHostingData'
        ));
    }

    public function update(DomainHostingListRequest $request, $id)
    {
        if(!$request->user()->can('domain-hosting-manager.update')) return abort(403);
        $data = $request->validated();
        $arrDate = [
            'expiry_date'
        ];
        foreach($arrDate as $date){
            $data[$date] = !empty($data[$date])?convert_date_to_db($data[$date]):null;
        }
        $domainHostingData = DomainHostingList::findOrFail($id);
        $domainHostingData->update($data);
        $domainHostingDatas = [$domainHostingData];
        return response()->json([
            'view' => view('CRM.pages.domain-hosting-list.data', compact(
                'domainHostingDatas'
            ))->render(),
            'id' => $domainHostingData->id,
            'type' => 'update'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        if(!$request->user()->can('domain-hosting-manager.delete')) return abort(403);
        $domainHostingData = DomainHostingList::findOrFail($id);
        $domainHostingData->delete();
        return response()->json([
            'id' => $id
        ]);
    }
}
