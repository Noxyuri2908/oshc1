<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Conf;
use App\Admin\Service;
use App\Admin\Benefit;
use Session;


class ConfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Conf::all();
        $flag = 'conf';
        return view('back-end.conf.list',['data'=>$objs,'flag'=>$flag]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::where('status',1)->get();
        $benefits = Benefit::where('status',1)->get();
        return view('back-end.conf.create',['services'=>$services, 'benefits'=>$benefits]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr_data = $request->all();
        $arr_data['created_by'] = \Auth::user()->id;
        $conf = Conf::where('service_id', $arr_data['service_id'])->where('benefit_id', $arr_data['benefit_id'])->first();
        if($conf != null){
            Session::flash('error-conf', 'Dữ liệu bị trùng. Xin kiểm tra lại.');
        }else{
            Conf::create($arr_data);
        }
        Session::flash('success-conf', 'Tạo mới tài liệu thành công.');
        return redirect()->route('conf.create');
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
        $obj = Conf::find($id);
        if($obj == null){
            Session::flash('error-conf', 'Không tìm thấy dữ liệu.');
            return redirect()->route('conf.index');
        }
        $services = Service::where('status',1)->get();
        $benefits = Benefit::where('status',1)->get();
        return view('back-end.conf.edit',['obj'=>$obj,'services'=>$services, 'benefits'=>$benefits]);

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
        $obj = Conf::find($id);
        if($obj == null){
            Session::flash('error-conf', 'Không tìm thấy dữ liệu.');
            return redirect()->route('conf.index');
        }
        $arr_data = $request->all();
        $arr_data['created_by'] = \Auth::user()->id;
        $conf = Conf::where('service_id', $arr_data['service_id'])->where('benefit_id', $arr_data['benefit_id'])->where('id','<>',$id)->first();
        if($conf != null){
            Session::flash('error-conf', 'Dữ liệu bị trùng. Xin kiểm tra lại.');
        }else{
            $obj->update($arr_data);
        }

        Session::flash('success-conf', 'Cập nhật tài liệu thành công.');
        return redirect()->route('conf.edit',['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Conf::find($id);
        if($obj == null){
            Session::flash('error-conf', 'Không tìm thấy dữ liệu.');
            return redirect()->route('conf.index');
        }
        $obj->delete();
        Session::flash('success-conf', 'Xóa bài viết thành công.');
        return redirect()->route('conf.index');
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
                $obj = Conf::find($data[$i]);
                if($obj != null)
                {
                    $obj->status = $status;
                    $obj->update();
                }
            }
        }else{
            for($i = 0; $i < sizeof($data); $i++)
            {
                $obj = Conf::find($data[$i]);
                if($obj != null)
                {
                    $obj->delete();
                }
            }
        }
        Session::flash('success-conf', 'Update đồng loạt thành công.');
        return redirect()->route('conf.index');
    }
}
