<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest as UserRequest;
use App\User;
use App\Info;
use App\Admin;
use App\Admin\Person;
use App\Admin\Service;
use App\Admin\Commission;
use Illuminate\Support\Str;
use Session;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account = auth()->guard('admin')->user();
        if (!$account->can('view-agent')) return abort(403);
        if($account->role == 1 || in_array('0', $account->authorization))  $agents = User::where('status',1)->get();
        else {
            $agents = $account->list_agent;
        }
        return view('back-end.info.list', ['account'=>$account, 'data'=>$agents]);
    }

    public function addNewComm(Request $request){
        $user = $request->input('user');
        $service = $request->input('service');
        $policy = $request->input('policy');
        $comm = $request->input('comm');
        $end_date = $request->input('end_date');
        $count = $request->input('count');
        $user = User::find($user);
        if($user == null) return redirect()->route('info.index');
        $service = Service::find($service);
        if($service == null) return redirect()->route('info.index');
        $products = Service::where('status',1)->get();
        \Session::put('count', $count);
        \Session::put($count.'_service_id', $service->id);
        \Session::put($count.'_type', $policy);
        \Session::put($count.'_comm', $comm);
        \Session::put($count.'_end_date', $end_date);
        for($j = 1; $j < $count; $j++){
            $tmp = \Session::get($j.'_service_id', 0);
            if($tmp != 0){
                $comm_news[$j] = [
                    'service_id'=>\Session::get($j.'_service_id', 0),
                    'type'=>\Session::get($j.'_type', 0),
                    'comm'=>\Session::get($j.'_comm', 0),
                    'end_date'=>\Session::get($j.'_end_date', 0),
                ];
            }
        }
        $comm_news[$count] = [
            'service_id'=>$service->id,
            'type'=>$policy,
            'comm'=>$comm,
            'end_date'=>$end_date,
        ];
        return view('back-end.info.item-comm',['user'=>$user, 'products'=>$products, 'comm_news'=>$comm_news, 'count'=>$count]);
    }
    public function active($id)
    {

        $user = User::find($id);
        if($user == null ){
            Session::flash('error-info', 'Không tìm thấy dữ liệu.');
            return redirect()->back();
        }

        if($user->status != 2){
            Session::flash('error-info', 'User ở trạng thái không thể active.');
            return redirect()->back();
        }

        $info = Info::where('user_id', $user->id)->first();
        if($info == null ){
            Session::flash('error-info', 'Không tìm thấy dữ liệu.');
            return redirect()->back();
        }

        $pwd = Str::random(6);
        $user->status = 1;
        $user->password = bcrypt($pwd);
        $user->update();

        $email   = $user->email;
        $title   = "Phê duyệt đơn đăng ký trở thành agent!";
        $content = $user->email.'/'.$pwd;
        $subject = "OSHC Global Phê duyệt đơn đăng ký trở thành agent!";
        $content_mail = "Dear ".$user->name.",<br>";
        $content_mail =  $content = $user->email.'/'.$pwd;
        send_mail($email, $title, $subject, $content_mail);
        Session::flash('success-info', 'Đã phê duyệt đơn thành công !');
        return redirect()->back();
    }


    public function deactiveAgent()
    {
        $account = auth()->guard('admin')->user();
        if (!$account->can('view-agent')) return abort(403);
        if($account->role == 1 || in_array('0', $account->authorization))  $agents = User::where('status','<>',1)->get();
        else {
            $agents = $account->list_agent->where('status','<>',1)->all();
        }
        return view('back-end.info.list', ['account'=>$account, 'data'=>$agents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account = auth()->guard('admin')->user();
        if (!$account->can('create-agent')) return abort(403);
        $products = Service::where('status',1)->get();
        $staffs = Admin::where('status',1)->get();
        $status = config('admin.status');
        \Session::put('count', 0);
        return view('back-end.info.create',['products'=>$products, 'staffs'=>$staffs, 'status'=>$status, 'account'=>$account]);
    }

    // public function getProfile()
    // {
    //     $obj = User::find(\Auth::user()->id);
    //     return view('back-end.info.profile',['obj'=>$obj]);
    // }

    // public function postProfile(Request $request)
    // {
    //     $user = User::find(\Auth::user()->id);
    //     $tmp = $request->all();
    //     if(isset($tmp['password_new']) && $tmp['password_new'] != ""){
    //         $tmp['password'] = bcrypt($tmp['password_new']);
    //     }
    //     $user->update($tmp);
    //     Session::flash('success-user', 'Thay đổi thông tin thành công.');
    //     return redirect()->route('info.get');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $account = auth()->guard('admin')->user();
        if (!$account->can('create-agent')) return abort(403);
        $tmp_u = $request->all();
        $tmp_i = $request->all();
        $tmp_u['password'] =  bcrypt($tmp_u['password']);
        if(isset($tmp_u['shares']))
            $tmp_u['shares'] = implode(";",  $tmp_u['shares']);
        $user = User::create($tmp_u);
        $tmp_i['user_id'] = $user->id;

        $data['name'] = $request->p_name;
        $data['position'] = $request->p_position;
        $data['birthday'] = $request->p_birthday;
        $data['phone'] = $request->p_phone;
        $data['email'] = $request->p_email;
        $data['skype'] = $request->p_skype;
        $data['status'] = $request->p_status;
        if($data['name'] != null && $data['name'] != "" && $data['email'] != null && $data['email'] != "" && $data['status'] != null && $data['status'] != "")
        {
            $contact = $info->person;
            $contact = Person::create($data);
            $tmp_i['contact_person'] =  $contact->id;
            $tmp_i['contact_person'];
        }

        if(isset($tmp_i['b_status'])) $tmp_i['status'] = $tmp_i['b_status'];
        Info::create($tmp_i);
        Session::flash('success-info', 'Create new agent "'.$request->name.'" successfull.');
        return redirect(route('info.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = auth()->guard('admin')->user();
        if (!$account->can('edit-agent')) return abort(403);
        $obj = User::find($id);
        if($obj == null) return abort(404);
        $contact_person = $obj->person;
        if($obj->info == null) return abort(404);
        $products = Service::where('status',1)->get();
        $staffs = Admin::where('status',1)->get();
        $status = config('admin.status');
        \Session::put('count', 0);
        return view('back-end.info.edit',['obj'=>$obj, 'products'=>$products, 'staffs'=>$staffs, 'status'=>$status, 'account'=>$account]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);
        if($user == null) return abort(404);
        $account = auth()->guard('admin')->user();
        if (!$account->can('edit-agent',$user)) return abort(403);
        $info = $user->info;
        if($info == null) return abort(404);
        $tmp_u = $request->all();
        if(isset($tmp_u['password_new']) && $tmp_u['password_new'] != ""){
            $tmp_u['password'] = bcrypt($tmp_u['password_new']);
        }
        //COMMM
        $count = $request->count - 1;
        $tmp_data = $request->all();
        foreach($user->commission as $comm){
            $tmp = [];
            $tmp['user_id'] = $id;
            $tmp['service_id'] = $tmp_data['service_'.$comm->id];
            $tmp['type'] = $tmp_data['policy_'.$comm->id];
            $tmp['comm'] = str_replace("%", "", $tmp_data['comm_'.$comm->id]);
            $tmp['date'] = $tmp_data['date_'.$comm->id];
            $tmp_comm = Commission::where('user_id',$id)->where('service_id',$tmp['service_id'])->where('type',$tmp['type'])->where('id','<>',$comm->id)->first();
            if($tmp_comm != null){
                $tmp_comm->delete();
                $comm->update($tmp);
            }else $comm->update($tmp);
        }
        for($i = 1; $i <= $count; $i++){
            $tmp = [];
            $tmp['user_id'] = $id;
            $tmp['service_id'] = $tmp_data['add_service_'.$i];
            $tmp['type'] = $tmp_data['add_policy_'.$i];
            $tmp['comm'] = str_replace("%", "", $tmp_data['add_comm_'.$i]);
            $tmp['date'] = $tmp_data['add_date_'.$i];
            $tmp['status'] = 1;
            $tmp_comm = Commission::where('user_id',$id)->where('service_id',$tmp_data['add_service_'.$i])->where('type',$tmp_data['add_policy_'.$i])->first();
            if($tmp_comm != null) $tmp_comm->update($tmp);
            else Commission::create($tmp);
        }

        ///CONTACT
        $data['name'] = $request->p_name;
        $data['name'] = $request->p_name;
        $data['position'] = $request->p_position;
        $data['birthday'] = $request->p_birthday;
        $data['phone'] = $request->p_phone;
        $data['email'] = $request->p_email;
        $data['skype'] = $request->p_skype;
        $data['status'] = $request->p_status;
        if($data['name'] != null && $data['name'] != "" && $data['email'] != null && $data['email'] != "" && $data['status'] != null && $data['status'] != "")
        {
            $contact = $info->person;
            if($contact == null) $contact = Person::create($data);
            else $contact->update($data);
            ///
            $tmp_i['contact_person'] =  $contact->id;
        }
        if(isset($tmp_u['shares']))
            $tmp_u['shares'] = implode(";",  $tmp_u['shares']);
        $tmp_u['status'] =  $user->status;
        $user->update($tmp_u);

        $tmp_i = $request->all();
        if(isset($tmp_i['b_status'])) $tmp_i['status'] = $tmp_i['b_status'];
        $info->update($tmp_i);
        Session::flash('success-info', 'Update successfull.');
        return redirect(route('info.edit', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user == null) return abort(404);
        $account = auth()->guard('admin')->user();
        if (!$account->can('edit-agent',$user)) return abort(403);
        $obj = $user->info;
        if($obj == null) return abort(404);
        if($user->status == 2){
            $email   = $user->email;
            $title   = "Từ chối đơn đăng ký trở thành agent!";
            $subject = "OSHC Global Từ chối đơn đăng ký trở thành agent!";
            $content_mail = "Dear ".$user->name.",<br>";
            send_mail($email, $title, $subject, $content_mail);
        }

        if($obj == null) return abort(404);
        $user = $obj->User->delete();
        $obj->delete();
        Session::flash('success-info', 'Delete agent successfull.');
        return redirect()->route('info.index');
    }

    public function mutileUpdate(Request $request)
    {
        return redirect()->route('info.index');
    }
}
