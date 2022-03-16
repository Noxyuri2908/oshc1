<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Person;
use App\Exports\PersonExport;
use App\Imports\AgentContactImport;
use App\Imports\CustomerDatabaseManagersImport;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class AgentContactController extends Controller
{
    //
    public function index(){
        $flag='agent_contact';
        $contactAgent = new Person();
        $fielsContactAgent = [
            'user_id',
            'name',
            'position',
            'staff_id',
            'department',
            'phone',
            'birthday',
            'email',
            'skype',
            'status',
            'facebook',
            'note',
            'is_receive_comm',
            'acc_name',
            'bank',
            'currency',
            'bank_address',
            'receiver_address',
            'swift_code',
            'type_id',
            'country'
        ];
        $countries = config('country.list');
        $status = config('admin.status');
        $typeAgent = config('admin.type_agent');
        $fieldContactAgent = $fielsContactAgent;
        return view('CRM.pages.agent-contact.index',compact('flag','fieldContactAgent', 'countries', 'status', 'typeAgent'));
    }

    public function getData(Request $request)
    {

        $agentContactDatas = Person::select(
            'people.name',
            'people.position',
            'people.phone',
            'people.birthday',
            'people.email',
            'people.skype',
            'people.facebook',
            'people.note',
            'people.acc_name',
            'people.bank',
            'people.currency',
            'people.bank_address',
            'people.receiver_address',
            'people.swift_code',
            'users.id',
            'users.name as agent_name',
            'users.staff_id',
            'users.department',
            'users.status',
            'users.country',
            'users.type_id'
        )
            ->join('users', 'users.id', '=', 'people.user_id')
            ->when($request->get('agent_id'), function ($query) use ($request){
                $query->where('users.id',$request->get('agent_id'));
            })
            ->when($request->get('name'),function($query) use ($request){
                $query->where('name','LIKE','%'.$request->get('name').'%');
            })->when($request->get('type_id'),function($query) use ($request){
                $query->where('users.type_id',$request->get('type_id'));
            })->when($request->get('country'),function($query) use ($request){
                $query->where('users.country',$request->get('country'));
            })->when($request->get('status'),function($query) use ($request){
                $query->where('users.status',$request->get('status'));
            })->when($request->get('position'),function($query) use ($request){
                $query->where('position','LIKE','%'.$request->get('position').'%');
            })->when($request->get('phone'),function($query) use ($request){
                $query->where('phone','LIKE','%'.$request->get('phone').'%');
            })->when($request->get('birthday'),function($query) use ($request){
                $query->where('birthday','LIKE','%'.$request->get('birthday').'%');
            })->when($request->get('email'),function($query) use ($request){
                $query->where('email','LIKE','%'.$request->get('email').'%');
            })->when($request->get('skype'),function($query) use ($request){
                $query->where('skype','LIKE','%'.$request->get('skype').'%');
            })->when($request->get('facebook'),function($query) use ($request){
                $query->where('facebook','LIKE','%'.$request->get('facebook').'%');
            })->when($request->get('note'),function($query) use ($request){
                $query->where('note','LIKE','%'.$request->get('note').'%');
            })->when($request->get('user_id'),function($query) use ($request){
                $query->where('user_id',$request->get('user_id'));
            })
            ->when($request->get('department'),function($query) use ($request){
                $query->where('users.department',$request->get('department'));
            })
            ->when($request->get('staff_id'),function($query) use ($request){
                $query->where('users.staff_id',$request->get('staff_id'));
            })
            ->orderBy('id', 'desc')
            ->paginate(30);
        $lastPage = $agentContactDatas->lastPage();
        $totalRow = $agentContactDatas->total();
        $countries = config('country.list');
        $status = config('admin.status');
        $typeAgent = config('admin.type_agent');
        return response()->json([
            'view' => view('CRM.pages.agent-contact.data', compact(
                'agentContactDatas',
                'countries',
            'status',
            'typeAgent'
            ))->render(),
            'last_page' => $lastPage,
            'total_row_data' => $totalRow
        ]);

    }

    public function create(Request $request)
    {
        $flag = 'archive-media-link-store';
        $agent_id = $request->get('id');
        return view('CRM.pages.agent-contact.form', compact('flag','agent_id'));
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'user_id',
            'name',
            'position',
            'phone',
            'birthday',
            'email',
            'skype',
            'status',
            'facebook',
            'note',
            'is_receive_comm',
            'acc_name',
            'bank',
            'currency',
            'bank_address',
            'receiver_address',
            'swift_code'
        ]);
        if(empty($data['user_id'])){
            return response()->json(['error'=>'User is empty']);
        }
        $personContactAgent = Person::where('user_id', $data['user_id'])->whereNotNull('is_receive_comm')->get();
        if($personContactAgent->count() > 0 && $request->get('is_receive_comm') == 'on'){
            Person::where('user_id', $data['user_id'])->whereNotNull('is_receive_comm')->update(['is_receive_comm'=>null]);
        }
        Person::create($data);
        $agentContactDatas = Person::when($request->get('agent_id'),function($query) use ($request){
            $query->where('user_id',$request->get('agent_id'));
        })
            ->orderBy('id', 'desc')
            ->paginate(15);
        $lastPage = $agentContactDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.agent-contact.data', compact(
                'agentContactDatas'
            ))->render(),
            'last_page' => $lastPage,
            'type' => 'create'
        ]);
    }

    public function edit(Request $request, $id)
    {
        $flag = 'archive-media-link-edit';
        $agentContactData = Person::findOrFail($id);
        return view('CRM.pages.agent-contact.form', compact(
            'flag',
            'agentContactData'
        ));
    }

    public function update(Request $request, $id)
    {
        $data = $request->only([
            'user_id',
            'name',
            'position',
            'phone',
            'birthday',
            'email',
            'skype',
            'status',
            'facebook',
            'note',
            'is_receive_comm',
            'acc_name',
            'bank',
            'currency',
            'bank_address',
            'receiver_address',
            'swift_code'
        ]);
        if(empty($data['user_id'])){
            return response()->json(['error'=>'User is empty']);
        }
        $personContactAgent = Person::where('user_id', $data['user_id'])->whereNotNull('is_receive_comm')->get();
        if($personContactAgent->count() > 0 && $data['is_receive_comm'] == 'on'){
            Person::where('user_id', $data['user_id'])->whereNotNull('is_receive_comm')->update(['is_receive_comm'=>null]);
        }
        $agentContactData = Person::findOrFail($id);
        $agentContactData->update($data);
        $agentContactDatas = [$agentContactData];
        return response()->json([
            'view' => view('CRM.pages.agent-contact.data', compact(
                'agentContactDatas'
            ))->render(),
            'id' => $agentContactData->id,
            'type' => 'update'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $agentContactData = Person::findOrFail($id);
        $agentContactData->delete();
        return response()->json([
            'id' => $id
        ]);
    }
    public function importExcel(Request $request){
        ini_set ('max_execution_time', 3600);
        ini_set ('memory_limit', '2048M');
        if($request->has('file')){
            $file = $request->file('file');
            $excel = App::make('excel');
            $import = new AgentContactImport;
            $excel->import($import,$file);
        }
        ini_set('memory_limit', '-1');
        return back();
    }

    public function exportExcel(Request $request)
    {
        try {
            return (new PersonExport())->request($request)->download('contact-person.xlsx');

            $var_msg = "This is an exception example";
            throw new Exception($var_msg);

        }catch (\Exception $e)
        {
            echo "Message: " . $e->getMessage();
            echo "";
            echo "getCode(): " . $e->getCode();
            echo "";
            echo "__toString(): " . $e->__toString();
        }
    }
}
