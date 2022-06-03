<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest as AreaRequest;
use App\Admin\Area;
use Session;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Area::all();
        return view('back-end.area.list',['data'=>$objs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-end.area.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaRequest $request)
    {
        //
        $arr_data = $request->all();
        Area::create($arr_data);
        Session::flash('success-area', 'Tạo mới Area thành công.');
        return redirect(route('area.create'));
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
        $obj = Area::find($id);
        if($obj == null){
            Session::flash('error-area', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('area.index');  
        }
        return view('back-end.area.edit',['obj'=>$obj]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AreaRequest $request, $id)
    {
        $obj = Area::find($id);
        if($obj == null){
            Session::flash('error-area', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('area.index');  
        }
        $arr_data = $request->all();
        $obj->update($arr_data);
        Session::flash('success-area', 'Thay đổi thông tin thành công.');
        return redirect(route('area.edit', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Area::find($id);
        if($obj == null){
            Session::flash('error-area', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('area.index');  
        }
        $obj->delete();
        Session::flash('success-area', 'Xóa thông tin thành công.');  
        return redirect()->route('area.index');  
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
                $obj = Area::find($data[$i]);
                if($obj != null)
                {
                    $obj->status = $status;
                    $obj->update();
                }
            }
        }else{
            for($i = 0; $i < sizeof($data); $i++)
            {
                $obj = Area::find($data[$i]);
                if($obj != null)
                {
                    $obj->delete();
                }
            }
        }       
        Session::flash('success-area', 'Update đồng loạt thành công.');
        return redirect()->route('area.index');
    }
}
