<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DocRequest as DocRequest;
use App\Admin\Doc;
use App\Admin\Service;
use Session;


class DocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Doc::all();
        return view('back-end.doc.list',['data'=>$objs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::where('status',1)->get();
        return view('back-end.doc.create',['services'=>$services]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocRequest $request)
    {
        $arr_data = $request->all();
        $arr_data['created_by'] = \Auth::user()->id;
        Doc::create($arr_data);
        Session::flash('success-doc', 'Tạo mới tài liệu thành công.');
        return redirect()->route('doc.create');
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
        $obj = Doc::find($id);
        if($obj == null){
            Session::flash('error-doc', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('doc.index');  
        }
        $services = Service::where('status',1)->get();
        return view('back-end.doc.edit',['obj'=>$obj,'services'=>$services]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocRequest $request, $id)
    {
        $obj = Doc::find($id);
        if($obj == null){
            Session::flash('error-doc', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('doc.index');  
        }
        $arr_data = $request->all();
        $arr_data['created_by'] = \Auth::user()->id;
        $obj->update($arr_data);
        Session::flash('success-doc', 'Cập nhật tài liệu thành công.'); 
        return redirect()->route('doc.edit',['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Doc::find($id);
        if($obj == null){
            Session::flash('error-doc', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('doc.index');  
        }
        $obj->delete();
        Session::flash('success-doc', 'Xóa bài viết thành công.');  
        return redirect()->route('doc.index');  
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
                $obj = Doc::find($data[$i]);
                if($obj != null)
                {
                    $obj->status = $status;
                    $obj->update();
                }
            }
        }else{
            for($i = 0; $i < sizeof($data); $i++)
            {
                $obj = Doc::find($data[$i]);
                if($obj != null)
                {
                    $obj->delete();
                }
            }
        }       
        Session::flash('success-doc', 'Update đồng loạt thành công.');
        return redirect()->route('doc.index');
    }
}
