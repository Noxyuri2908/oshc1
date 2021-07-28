<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Support;
use App\Http\Requests\SupportRequest as SupportRequest;
use App\User;
use Session;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Support::all();
        return view('back-end.support.list')->with('data',$objs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::where('status',1)->where('role','agent')->get();
        return view('back-end.support.create',['users'=>$user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupportRequest $request)
    {
        Support::create($request->all());
        Session::flash('success-support', 'Tạo mới thành công.');
        return redirect(route('support.create'));
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
        $obj = Support::find($id);
        if($obj == null){
            Session::flash('error-support', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('support.index');  
        }
        $user = User::where('status',1)->get();
        return view('back-end.support.edit',['obj'=>$obj,'users'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupportRequest $request, $id)
    {
        $obj = Support::find($id);
        if($obj == null){
            Session::flash('error-support', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('support.index');  
        }
        $obj->update($request->all());
        Session::flash('success-support', 'Thay đổi thông tin thành công.');
        return redirect(route('support.edit', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Support::find($id);
        if($obj == null){
            Session::flash('error-support', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('support.index');  
        }
        $obj->delete();
        Session::flash('success-support', 'Xóa thông tin thành công.');  
        return redirect()->route('support.index');  
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
                $obj = Support::find($data[$i]);
                if($obj != null)
                {
                    $obj->status = $status;
                    $obj->update();
                }
            }
        }else{
            for($i = 0; $i < sizeof($data); $i++)
            {
                $obj = Support::find($data[$i]);
                if($obj != null)
                {
                    $obj->delete();
                }
            }
        }       
        Session::flash('success-support', 'Update đồng loạt thành công.');
        return redirect()->route('support.index');
    }
}
