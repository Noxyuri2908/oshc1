<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\User;
use App\Admin\Person;
use App\Admin;
use App\Info;
use App\Admin\Apply;
use App\Admin\Support;
use App\Admin\Service;
use App\Admin\Commission;
use App\Admin\Customer;
use App\Admin\Phieuthu;

class CrmController extends Controller
{
    public function postTask(Request $request)
    {
    }

    public function dashboard()
    {
        $active_agent = User::where('status', 1)->count();
        $deactive_agent = User::where('status', 0)->count();
        $pending_applies = Apply::where('status', 0)->count();
        $running_applies = Apply::where('status', 1)->count();
        $reject_applies = Apply::where('status', 2)->count();
        $incom_applies = Apply::where('status', 3)->count();
        $flag = 'dashboard';
        return view('CRM.pages.dashboard')->with(compact('active_agent', 'deactive_agent', 'pending_applies', 'running_applies', 'reject_applies', 'incom_applies', 'flag'));
    }

    public function createContact(Request $request)
    {
        $id = $request->get('id');
        return view('CRM.elements.agents.modal-create-contact',compact('id'));
    }

    public function storeContact(Request $request)
    {
        $tmp = [[
            'id'=>$request->input('id'),
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'phone' => $request->input('phone'),
            'birthday' => $request->input('birthday'),
            'email' => $request->input('email'),
            'skype' => $request->input('skype'),
            'facebook' => $request->input('facebook'),
            'note' => $request->input('note'),
        ]];
        return view('CRM.elements.agents.table-contact', ['_edit_data' => $tmp]);
    }

    public function receipt(Request $request)
    {
        $phieuthus = Phieuthu::getList($request);
        // dd($phieuthus);
        $flag = 'receipt';
        return view('CRM.pages.receipt', compact('flag', 'phieuthus'));
    }
    public function updateContact(Request $request)
    {
        $id =  $request->input('id');
        $tmp = [
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'phone' => $request->input('phone'),
            'birthday' => $request->input('birthday'),
            'email' => $request->input('email'),
            'skype' => $request->input('skype'),
            'facebook' => $request->input('facebook'),
            'note' => $request->input('note'),
        ];
        $old_data = $request->session()->get('new_contact');
        if ($old_data != null) {
            $old_data[$id] = $tmp;
            $request->session()->put('new_contact', $old_data);
        } else {
            $old_data = [];
            $old_data[] = $tmp;
            $request->session()->put('new_contact', $old_data);
        }
        return view('CRM.elements.agents.table-contact', ['_data' => $old_data]);
    }

    public function editContact(Request $request)
    {
        $id =  $request->input('id');
        $old_data = $request->session()->get('new_contact');
        $data = null;
        if ($old_data != null) {
            $data = $old_data[$id];
            $data['id'] = $id;
        }
        return view('CRM.elements.agents.modal-create-contact', ['data' => $data]);
    }

    public function delContact(Request $request)
    {
        $id =  $request->input('id');
        $old_data = $request->session()->get('new_contact');
        if ($old_data != null) {
            unset($old_data[$id]);
            $request->session()->put('new_contact', $old_data);
        }
        return view('CRM.elements.agents.table-contact', ['data' => $old_data]);
    }

    public function searchApply(Request $request)
    {
        $flag = 'apply';
        $data = $request->all();
        $query = \DB::table('applies'); //->join('people', 'infos.contact_person', '=', 'people.id');
        // if( ($data['s_service'] != null && $data['s_name_contact'] != "") ||  ($data['s_name_contact'] != null && $data['s_birthday_contact'] != "")){
        //     $query = $query->join('people', 'infos.contact_person', '=', 'people.id');
        // }

        if ($data['s_service'] != 'All') {
            $query = $query->where('service_id', $data['s_service']);
        }
        if ($data['s_invoice_code'] != null && $data['s_invoice_code'] != "") {
            $_tmp = mb_strtolower($data['s_invoice_code'], 'UTF-8');
            $query = $query->whereRaw('lower(invoice_code) like (?)', ["%{$_tmp}%"]);
        }
        if ($data['s_start_date'] != null && $data['s_start_date'] != "") {
            $_tmp = mb_strtolower($data['s_start_date'], 'UTF-8');
            $query = $query->whereRaw('lower(start_date) like (?)', ["%{$_tmp}%"]);
        }
        if ($data['s_end_date'] != null && $data['s_end_date'] != "") {
            $_tmp = mb_strtolower($data['s_end_date'], 'UTF-8');
            $query = $query->whereRaw('lower(end_date) like (?)', ["%{$_tmp}%"]);
        }
        if ($data['s_no_of_adults'] != null && $data['s_no_of_adults'] != "") {
            $_tmp = mb_strtolower($data['s_no_of_adults'], 'UTF-8');
            $query = $query->whereRaw('lower(no_of_adults) like (?)', ["%{$_tmp}%"]);
        }
        if ($data['s_no_of_children'] != null && $data['s_no_of_children'] != "") {
            $_tmp = mb_strtolower($data['s_no_of_children'], 'UTF-8');
            $query = $query->whereRaw('lower(no_of_children) like (?)', ["%{$_tmp}%"]);
        }
        if ($data['s_price'] != null && $data['s_price'] != "") {
            $_tmp = mb_strtolower($data['s_price'], 'UTF-8');
            $query = $query->whereRaw('lower(price) like (?)', ["%{$_tmp}%"]);
        }
        if ($data['s_menthod_payment'] != 'All') {
            $query = $query->where('menthod_payment', $data['s_menthod_payment']);
        }
        if ($data['s_price_comm'] != null && $data['s_price_comm'] != "") {
            $_tmp = mb_strtolower($data['s_price_comm'], 'UTF-8');
            $query = $query->whereRaw('lower(price_comm) like (?)', ["%{$_tmp}%"]);
        }
        if ($data['s_price_gst'] != null && $data['s_price_gst'] != "") {
            $_tmp = mb_strtolower($data['s_price_gst'], 'UTF-8');
            $query = $query->whereRaw('lower(price_gst) like (?)', ["%{$_tmp}%"]);
        }
        if ($data['s_price_su'] != null && $data['s_price_su'] != "") {
            $_tmp = mb_strtolower($data['s_price_su'], 'UTF-8');
            $query = $query->whereRaw('lower(price_su) like (?)', ["%{$_tmp}%"]);
        }
        if ($data['s_total'] != null && $data['s_total'] != "") {
            $_tmp = mb_strtolower($data['s_total'], 'UTF-8');
            $query = $query->whereRaw('lower(total) like (?)', ["%{$_tmp}%"]);
        }
        if ($data['s_promotion'] != null && $data['s_promotion'] != "") {
            $_tmp = mb_strtolower($data['s_promotion'], 'UTF-8');
            $query = $query->whereRaw('lower(promotion) like (?)', ["%{$_tmp}%"]);
        }
        if ($data['s_agent'] != 'All') {
            $query = $query->where('user_id', $data['s_agent']);
        }
        if ($data['s_status'] != 'All') {
            $query = $query->where('status', $data['s_status']);
        }
        $applies = $query->select('id')->get()->pluck('id')->all();
        $applies = Apply::whereIN('id', $applies)->paginate(50);
        $agents = User::all();
        $services = Service::where('status', 1)->get();
        return view('CRM.pages.apply')->with(compact('flag', 'agents', 'services', 'applies', 'data'));
    }

    public function postAccount(Request $request)
    {
        $flag = 'agent';
        $users = User::paginate(50);
        $staffs = Admin::where('status', 1)->get();
        return view('CRM.pages.agent')->with(compact('flag', 'users', 'staffs'));
    }

    public function attachAgent(Request $request)
    {
        $staff = $request->staff_id;
        $data_attach = $request->data_attach;
        $arr_data = explode(",", $data_attach);
        foreach ($arr_data as $key => $value) {
            $user = User::find($value);
            if ($user != null) $user->update(['staff_id' => $staff]);
        }
        Session::flash('success-list-agent', 'Attach agents successful!');
        return redirect()->back();
    }

    public function supportAgent(Request $request)
    {
        $id = $request->agent_id;
        $agent = User::find($id);
        if ($agent == null) return abort(404);
        $data['ngaygoi'] = date('d-m-Y H:m:i');
        $data['agent_id'] = $id;
        $data['admin_id'] = auth()->guard('admin')->user()->id;
        $data['noidung'] = $request->content_sp;
        Support::create($data);
        Session::flash('success-list-agent', 'Save content support agent successful!');
        return redirect()->back();
    }

//    login

    public function setAgentDefault(Request $request)
    {
        $agents = User::where('is_default', 1)->update(['is_default' => null]);
        $agent = User::findOrFail($request->get('id_agent'));
        $agent->update(['is_default' => 1]);
        return back()->with('success', 1);
    }

    public function potential(Request $request)
    {
        $flag = 'potential';
        $users = \DB::table('users')
            ->leftJoin('infos', 'infos.user_id', '=', 'users.id')
            ->where('infos.status', 4)
            ->get()->pluck('user_id')->all();
        $users = User::whereIN('id', $users)->paginate(50);
        $services = Service::where('status', 1)->get();
        return view('CRM.pages.agent')->with(compact('flag', 'users', 'services'));
    }

    public function applies(Request $request)
    {
        $flag = 'apply';
        $applies = Apply::orderby('created_at', 'desc')->paginate(50);
        $services = Service::where('status', 1)->get();
        $agents = User::all();
        return view('CRM.pages.apply')->with(compact('flag', 'applies', 'services', 'agents'));
    }

    public function delete(Request $request)
    {
        $agent = User::find($request->agent_id);
        if ($agent != null) {
            $info = $agent->info;
            if ($info != null) $info->delete();
            $agent->delete();
        }
        Session::flash('success-list-agent', 'Delete successful!');
        return redirect()->route('crm.agent');
    }

    public function createAgent(Request $request)
    {
        $request->session()->forget('new_contact');
        $staffs = Admin::where('status', 1)->get();
        $status = config('admin.status');
        $services = Service::where('status', 1)->get();
        $flag = 'agent';
        return view('CRM.pages.create-agent')->with(compact('flag', 'staffs', 'status', 'services'));
    }



    public function updateAgent(Request $request, $id)
    {
//        dd($request->all());
        $obj = User::find($id);
        if ($obj == null) return abort(404);
        $flag = 'agent';
        $data_login = $request->only('name', 'email', 'password', 'status', 'staff_id');
        $data_login['created_by'] = auth()->guard('admin')->user()->id;
        if ($data_login['password'] != null && $data_login['password'] != '') $data_login['password'] = bcrypt($data_login['password']);
        else unset($data_login['password']);
        $obj->update($data_login);

        //Create contact person
        $data_contact = $request->only('c_name', 'c_email', 'c_position', 'c_phone', 'c_birthday', 'c_skype', 'c_status');
        if (!empty($data_contact) && $data_contact['c_name'] != null  && $data_contact['c_email'] != null && $data_contact['c_name'] != ''  && $data_contact['c_email'] != '') {
            foreach ($data_contact as $key => $value) {
                $new_key = str_replace("c_", "", $key);
                $data_contact[$new_key] = $value;
            }
            if ($obj->info != null) {
                $person = $obj->info->person;
                if ($person != null) {
                    $person->update($data_contact);
                } else $person = Person::create($data_contact);
            }
        }

        //Create agent info
        $data_info = $request->only('agent_code', 'country', 'city', 'office', 'tel_1', 'tel_2', 'fb', 'website', 'department', 'rating', 'status2', 'gst', 'type_payment', 'type_agent', 'type_id');
        if (!empty($data_info)) {
            $data_info['status'] = $data_info['status2'];
            $data_info['user_id'] = $id;
            if (isset($person) && $person != null) $data_info['contact_person'] = $person->id;
            $info = Info::Where('user_id', $data_info['user_id'])->first();
            $exist = $info != null ? true : false;
            if ($exist) {
                $info->update($data_info);
            } else $new_info = Info::create($data_info);
        }


        //Create agent commission
        // $data_comm = $request->only('service_id', 'type', 'comm', 'date');
        // if (isset($data_comm['service_id'])) {
        //     foreach ($data_comm['service_id'] as $key => $value) {
        //         $data['service_id'] = $value;
        //         $data['type'] = $data_comm['type'][$key];
        //         $data['comm'] = $data_comm['comm'][$key];
        //         $data['date'] = $data_comm['date'][$key];
        //         $data['user_id'] = $id;
        //         $data['status'] = 1;
        //         $tmp = Commission::where('user_id', $data['user_id'])->where('service_id', $data['service_id'])->where('type', $data['type'])->first();
        //         if ($tmp != null) $tmp->update($data);
        //         else Commission::create($data);
        //     }
        // }

        Session::flash('success-edit-agent', 'Update agent successful!');
        return redirect()->back();
    }

    public function getAgentInfo(Request $request)
    {
        $id = $request->input('id');
        $obj = User::find($id);
        return view('CRM.elements.agents.modal-agent-info', ['obj' => $obj]);
    }

    public function getAgentComm(Request $request)
    {
        $id = $request->input('id');
        $obj = User::with(['commission.service.dichvu'])->find($id);
        return view('CRM.elements.agents.modal-comm', ['obj' => $obj]);
    }

    public function getSupport(Request $request)
    {
        $id = $request->input('id');
        $obj = User::find($id);
        return view('CRM.elements.agents.modal-history-support', ['obj' => $obj]);
    }

    public function getContactInfo(Request $request)
    {
        $id = $request->input('id');
        $obj = Person::find($id);
        return view('CRM.elements.agents.modal-contact-info', ['obj' => $obj]);
    }

    public function getServiceInfo(Request $request)
    {
        $id = $request->input('id');
        $obj = Service::find($id);
        return view('CRM.elements.applies.modal-service', ['obj' => $obj]);
    }

    public function getApplyInfo(Request $request)
    {
        $id = $request->input('id');
        $obj = Apply::find($id);
        return view('CRM.elements.applies.modal-applies', ['obj' => $obj]);
    }

    public function getCustomInfo(Request $request)
    {
        $id = $request->input('id');
        $obj = Customer::find($id);
        return view('CRM.elements.applies.modal-customer', ['obj' => $obj]);
    }

    public function deleteApply(Request $request)
    {
        $apply = Apply::find($request->apply_id);
        if ($apply == null) {
            Session::flash('error-list-apply', 'Can not found data!');
            return redirect()->route('crm.apply');
        }
        $apply->delete();
        Session::flash('success-list-apply', 'Delete successful!');
        return redirect()->route('crm.apply');
    }

    public function storeApply(Request $request)
    {
        $apply = Apply::find($request->apply_id);
        if ($apply == null) {
            Session::flash('error-list-apply', 'Can not found data!');
            return redirect()->route('crm.apply');
        }
        $apply->delete();
        Session::flash('success-list-apply', 'Delete successful!');
        return redirect()->route('crm.apply');
    }
}
