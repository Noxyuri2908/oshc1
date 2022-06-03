<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Sub;
use Session;

class SubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Sub::all();
        return view('back-end.sub.list',['data'=>$objs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-end.sub.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $arr_data = $request->all();
        Sub::create($arr_data);
        Session::flash('success-sub', 'Tạo mới sub thành công.');
        return redirect(route('sub.create'));
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
        $obj = Sub::find($id);
        if($obj == null){
            Session::flash('error-sub', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('sub.index');  
        }
        return view('back-end.sub.edit',['obj'=>$obj]);
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
        $obj = Sub::find($id);
        if($obj == null){
            Session::flash('error-sub', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('sub.index');  
        }
        $arr_data = $request->all();
        $obj->update($arr_data);
        Session::flash('success-sub', 'Thay đổi thông tin thành công.');
        return redirect(route('sub.edit', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Sub::find($id);
        if($obj == null){
            Session::flash('error-sub', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('sub.index');  
        }
        $obj->delete();
        Session::flash('success-sub', 'Xóa thông tin thành công.');  
        return redirect()->route('sub.index');  
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
                $obj = Sub::find($data[$i]);
                if($obj != null)
                {
                    $obj->status = $status;
                    $obj->update();
                }
            }
        }else{
            for($i = 0; $i < sizeof($data); $i++)
            {
                $obj = Sub::find($data[$i]);
                if($obj != null)
                {
                    $obj->delete();
                }
            }
        }       
        Session::flash('success-sub', 'Update đồng loạt thành công.');
        return redirect()->route('sub.index');
    }
}
