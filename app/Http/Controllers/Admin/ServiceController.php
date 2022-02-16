<?php

namespace App\Http\Controllers\Admin;

use App\Admin\HospitalAccess;
use App\Cover;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest as ServiceRequest;
use App\Admin\Service;
use App\Admin\Dichvu;
use Session;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Service::all();
        return view('back-end.service.list',['data'=>$objs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dichvus = Dichvu::where('status',1)->orderby('name')->get();
        return view('back-end.service.create', ['dichvus'=>$dichvus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        //
        $arr_data = $request->all();
        $arr_data['created_by'] = \Auth::user()->id;
        Service::create($arr_data);
        Session::flash('success-service', 'Tạo mới service thành công.');
        return redirect(route('service.create'));
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
        $obj = Service::find($id);
        $covers = Cover::where('service_id', $id)->get();
        $hospitals = HospitalAccess::where('service_id', $id)->get();
        if($obj == null){
            Session::flash('error-service', 'Không tìm thấy dữ liệu.');
            return redirect()->route('service.index');
        }
        $dichvus = Dichvu::where('status',1)->orderby('name')->get();
        return view('back-end.service.edit',['obj'=>$obj, 'dichvus'=>$dichvus, 'covers' => $covers, 'hospitals' => $hospitals]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {
        $obj = Service::find($id);
        if($obj == null){
            Session::flash('error-service', 'Không tìm thấy dữ liệu.');
            return redirect()->route('service.index');
        }
        $arr_data = $request->all();
        $arr_data['created_by'] = \Auth::user()->id;
        $obj->update($arr_data);
        Session::flash('success-service', 'Thay đổi thông tin thành công.');
        return redirect(route('service.edit', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Service::find($id);
        if($obj == null){
            Session::flash('error-service', 'Không tìm thấy dữ liệu.');
            return redirect()->route('service.index');
        }
        $obj->delete();
        Session::flash('success-service', 'Xóa thông tin thành công.');
        return redirect()->route('service.index');
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
                $obj = Service::find($data[$i]);
                if($obj != null)
                {
                    $obj->status = $status;
                    $obj->update();
                }
            }
        }else{
            for($i = 0; $i < sizeof($data); $i++)
            {
                $obj = Service::find($data[$i]);
                if($obj != null)
                {
                    $obj->delete();
                }
            }
        }
        Session::flash('success-service', 'Update đồng loạt thành công.');
        return redirect()->route('service.index');
    }
}
