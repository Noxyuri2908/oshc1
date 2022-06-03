<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Benefit;
use App\Admin\CatBenefit;
use Session;


class BenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Benefit::all();
        return view('back-end.benefit.list',['data'=>$objs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat_benefits = CatBenefit::where('status',1)->get();
        return view('back-end.benefit.create',['cat_benefits'=>$cat_benefits]);
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
        Benefit::create($arr_data);
        Session::flash('success-benefit', 'Tạo mới lợi ích thành công.');
        return redirect()->route('benefit.create');
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
        $obj = Benefit::find($id);
        if($obj == null){
            Session::flash('error-benefit', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('benefit.index');  
        }
        $cat_benefits = CatBenefit::where('status',1)->get();
        return view('back-end.benefit.edit',['obj'=>$obj,'cat_benefits'=>$cat_benefits]);

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
        $obj = Benefit::find($id);
        if($obj == null){
            Session::flash('error-benefit', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('benefit.index');  
        }
        $arr_data = $request->all();
        $arr_data['created_by'] = \Auth::user()->id;
        $obj->update($arr_data);
        Session::flash('success-benefit', 'Cập nhật tài liệu thành công.'); 
        return redirect()->route('benefit.edit',['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Benefit::find($id);
        if($obj == null){
            Session::flash('error-benefit', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('benefit.index');  
        }
        $obj->delete();
        Session::flash('success-benefit', 'Xóa bài viết thành công.');  
        return redirect()->route('benefit.index');  
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
                $obj = Benefit::find($data[$i]);
                if($obj != null)
                {
                    $obj->status = $status;
                    $obj->update();
                }
            }
        }else{
            for($i = 0; $i < sizeof($data); $i++)
            {
                $obj = Benefit::find($data[$i]);
                if($obj != null)
                {
                    $obj->delete();
                }
            }
        }       
        Session::flash('success-benefit', 'Update đồng loạt thành công.');
        return redirect()->route('benefit.index');
    }
}
