<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest as UserRequest;
use App\User;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role','admin')->where('id','<>', \Auth::user()->id)->get();
        return view('back-end.users.list')->with('data',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-end.users.create');
    }

    public function getProfile()
    {
        $obj = User::find(\Auth::user()->id);
        return view('back-end.users.profile',['obj'=>$obj]);
    }

    public function postProfile(Request $request)
    {
        $user = User::find(\Auth::user()->id);
        $tmp = $request->all();
        if(isset($tmp['password_new']) && $tmp['password_new'] != ""){
            $tmp['password'] = bcrypt($tmp['password_new']);   
        }
        $user->update($tmp);
        Session::flash('success-user', 'Thay đổi thông tin thành công.');
        return redirect()->route('profile.get');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $tmp = $request->all();
        $tmp['password'] =  bcrypt($tmp['password']);
        $tmp['role'] =  "admin";
        if(isset($tmp['authorization']))
        $tmp['authorization'] =  implode(';', $tmp['authorization']);
        User::create($tmp);
        Session::flash('success-user', 'Tạo mới người dùng "'.$request->name.'" thành công.');
        return redirect(route('user.create'));
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
        $obj = User::find($id);
        if($obj == null){
            Session::flash('error-user', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('user.index');  
        }
        return view('back-end.users.edit',['obj'=>$obj]);
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
        if (!isset($user)){
            Session::flash('error-user', 'Không tìm thấy người dùng cần sửa.');
            return redirect(route('user.index'));
        }
        $tmp = $request->all();
        if(isset($tmp['password_new']) && $tmp['password_new'] != ""){
            $tmp['password'] = bcrypt($tmp['password_new']);   
        }
        if(isset($tmp['authorization'])) 
        $tmp['authorization'] =  implode(';', $tmp['authorization']);   
        $user->update($tmp);
        Session::flash('success-user', 'Thay đổi thông tin thành công.');
        return redirect(route('user.edit', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = User::find($id);
        if($obj == null){
            Session::flash('error-user', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('user.index');  
        }
        $obj->delete();
        Session::flash('success-user', 'Xóa người dùng thành công.');  
        return redirect()->route('user.index');  
    }

    public function mutileUpdate(Request $request)
    {
        $status = $request->status;
        $data = $request->data_selected;
        $data = explode(",", $data[0]);
        if($status != 2)
        {
            for($i = 0; $i < sizeof($data); $i++)
            {
                $user = User::find($data[$i]);
                if($user != null)
                {
                    $user->status = $status;
                    $user->update();
                }
            }
        }else{
            for($i = 0; $i < sizeof($data); $i++)
            {
                $user = User::find($data[$i]);
                if($user != null)
                {
                    $user->delete();
                }
            }
        }       
        Session::flash('success-user', 'Update đồng loạt thành công.');
        return redirect()->route('user.index');
    }
}
