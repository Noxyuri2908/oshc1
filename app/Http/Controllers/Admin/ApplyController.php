<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Apply;
use App\Admin\Customer;
use App\Admin\Service;
use Session;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Apply::all();
        return view('back-end.apply.list',['data'=>$objs]);
    }

    public function notify()
    {
        $objs = reload_notifi();
        return view('back-end.apply.list')->with('data',$objs)->with('flag_n_apply','notify');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('apply.index');
    }

    public function updateStatus(Request $request, $id){
        $obj = Apply::find($id);
        if($obj == null){
            Session::flash('error-apply', 'Can not find data.');  
            return redirect()->route('apply.index');  
        }
        if($obj->status != 1){
            Session::flash('error-apply', 'Apply can not update status!');  
            return redirect()->route('apply.index');  
        }
        $obj->status = $request->value_apply_status;
        $obj->update();
        Session::flash('success-apply', 'Updated success !');  
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('apply.index');
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
        $obj = Apply::find($id);
        if($obj == null){
            Session::flash('error-apply', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('apply.index');  
        }
        $services = Service::where('status',1)->get();
        $person_reg = $obj->customers()->where('type',0)->first();
        if($person_reg == null){
            Session::flash('error-apply', 'Không tìm thấy thông tin người đăng ký.');  
            return redirect()->route('apply.index');
        }
        return view('back-end.apply.edit',['obj'=>$obj, 'services'=>$services, 'person_reg'=>$person_reg]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $obj = Apply::find($id);
        if($obj == null){
            Session::flash('error-apply', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('apply.index');  
        }
        $arr_data = $request->all();
        $main_id = $arr_data['main_id'];
        $person = Customer::find($main_id);
        if($person == null){
            Session::flash('error-apply', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('apply.index');      
        }
        $person['prefix_name'] = $arr_data['main_title'];
        $person['first_name'] = $arr_data['main_first_name'];
        $person['last_name'] = $arr_data['main_last_name'];
        $person['birth_of_date'] = $arr_data['main_birth_of_date'];
        $person['gender'] = $arr_data['main_gender'];
        $person['phone'] = $arr_data['main_phone'];
        $person['email'] = $arr_data['main_email'];
        $person['is_locate'] = $arr_data['main_is_locate'];
        $person['passport'] = $arr_data['main_passport'];
        $person['country'] = $arr_data['main_country'];
        $person['place_study'] = $arr_data['main_education'];
        $person['agent_code'] = $arr_data['main_agent_code'];
        $person['education_agent'] = $arr_data['main_education_agent'];
        $person['student_id'] = $arr_data['main_student_id'];
        $person->update();

        $i = 0;
        foreach($obj->customers()->where('type',1)->get() as $customer){
            $customer['prefix_name'] = $arr_data[$i.'_title'];
            $customer['first_name'] = $arr_data[$i.'_first_name'];
            $customer['last_name'] = $arr_data[$i.'_last_name'];
            $customer['birth_of_date'] = $arr_data[$i.'_dob'];
            $customer['gender'] = $arr_data[$i.'_gender'];
            $customer['passport'] = $arr_data[$i.'_pass'];
            $customer['country'] = $arr_data[$i.'_country'];
            $customer->update();
            $i++;
        }

        $i = 0;
        foreach($obj->customers()->where('type',2)->get() as $customer){
            $customer['prefix_name'] = $arr_data[$i.'_child_title'];
            $customer['first_name'] = $arr_data[$i.'_child_first_name'];
            $customer['last_name'] = $arr_data[$i.'_child_last_name'];
            $customer['birth_of_date'] = $arr_data[$i.'_child_dob'];
            $customer['gender'] = $arr_data[$i.'_child_gender'];
            $customer['passport'] = $arr_data[$i.'_child_pass'];
            $customer['country'] = $arr_data[$i.'_child_country'];
            $customer->update();
            $i++;
        }

        Session::flash('success-apply', 'Thay đổi thông tin thành công.');
        return redirect(route('apply.edit', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Apply::find($id);
        if($obj == null){
            Session::flash('error-apply', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('apply.index');  
        }
        $obj->delete();
        Session::flash('success-apply', 'Xóa thông tin thành công.');  
        return redirect()->route('apply.index');  
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
                $obj = Apply::find($data[$i]);
                if($obj != null)
                {
                    $obj->status = $status;
                    $obj->update();
                }
            }
        }else{
            for($i = 0; $i < sizeof($data); $i++)
            {
                $obj = Apply::find($data[$i]);
                if($obj != null)
                {
                    $obj->delete();
                }
            }
        }       
        Session::flash('success-apply', 'Update đồng loạt thành công.');
        return redirect()->route('apply.index');
    }
}

