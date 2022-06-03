<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\QaRequest as QaRequest;
use App\Admin\Qa;
use App\Admin\Area;
use Session;

class QaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Qa::all();
        return view('back-end.qa.list',['data'=>$objs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::where('status',1)->get();
        return view('back-end.qa.create',['areas'=>$areas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QaRequest $request)
    {
        //
        $arr_data = $request->all();
        Qa::create($arr_data);
        Session::flash('success-qa', 'Tạo mới Qa thành công.');
        return redirect(route('qa.create'));
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
        $obj = Qa::find($id);
        if($obj == null){
            Session::flash('error-qa', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('qa.index');  
        }
        $areas = Area::where('status',1)->get();
        return view('back-end.qa.edit',['obj'=>$obj,'areas'=>$areas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QaRequest $request, $id)
    {
        $obj = Qa::find($id);
        if($obj == null){
            Session::flash('error-qa', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('qa.index');  
        }
        $arr_data = $request->all();
        $obj->update($arr_data);
        Session::flash('success-qa', 'Thay đổi thông tin thành công.');
        return redirect(route('qa.edit', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Qa::find($id);
        if($obj == null){
            Session::flash('error-qa', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('qa.index');  
        }
        $obj->delete();
        Session::flash('success-qa', 'Xóa thông tin thành công.');  
        return redirect()->route('qa.index');  
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
                $obj = Qa::find($data[$i]);
                if($obj != null)
                {
                    $obj->status = $status;
                    $obj->update();
                }
            }
        }else{
            for($i = 0; $i < sizeof($data); $i++)
            {
                $obj = Qa::find($data[$i]);
                if($obj != null)
                {
                    $obj->delete();
                }
            }
        }       
        Session::flash('success-qa', 'Update đồng loạt thành công.');
        return redirect()->route('qa.index');
    }
}
