<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\CatBenefit;
use Session;

class CatBenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = CatBenefit::with('user')->get();
//        dd($objs);
        return view('back-end.cat-benefit.list',['data'=>$objs]);
    }

    public function create()
    {
        return view('back-end.cat-benefit.create');
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
        $arr_data['created_by'] = \Auth::user()->id;
        CatBenefit::create($arr_data);
        Session::flash('success-cat-benefit', 'Tạo mới loại lợi ích thành công.');
        return redirect(route('cat-benefit.create'));
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
        $obj = CatBenefit::find($id);
        if($obj == null){
            Session::flash('error-cat-benefit', 'Không tìm thấy dữ liệu.');
            return redirect()->route('cat-benefit.index');
        }
        return view('back-end.cat-benefit.edit',['obj'=>$obj]);
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
        $obj = CatBenefit::find($id);
        if($obj == null){
            Session::flash('error-cat-benefit', 'Không tìm thấy dữ liệu.');
            return redirect()->route('cat-benefit.index');
        }
        $arr_data = $request->all();
        $arr_data['created_by'] = \Auth::user()->id;
        $obj->update($arr_data);
        Session::flash('success-cat-benefit', 'Thay đổi thông tin thành công.');
        return redirect(route('cat-benefit.edit', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = CatBenefit::find($id);
        if($obj == null){
            Session::flash('error-cat-benefit', 'Không tìm thấy dữ liệu.');
            return redirect()->route('cat-benefit.index');
        }
        $obj->delete();
        Session::flash('success-cat-benefit', 'Xóa thông tin thành công.');
        return redirect()->route('cat-benefit.index');
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
                $obj = CatBenefit::find($data[$i]);
                if($obj != null)
                {
                    $obj->status = $status;
                    $obj->update();
                }
            }
        }else{
            for($i = 0; $i < sizeof($data); $i++)
            {
                $obj = CatBenefit::find($data[$i]);
                if($obj != null)
                {
                    $obj->delete();
                }
            }
        }
        Session::flash('success-cat-benefit', 'Update đồng loạt thành công.');
        return redirect()->route('cat-benefit.index');
    }
}
