<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest as SectionRequest;
use App\Admin\Section;
use App\Admin\Page;
use Session;


class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Section::all();
        return view('back-end.section.list',['data'=>$objs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = Page::where('status',1)->get();
        return view('back-end.section.create',['pages'=>$pages]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionRequest $request)
    {
        $arr_data = $request->all();
        $arr_data['created_by'] = \Auth::user()->id;
        Section::create($arr_data);
        Session::flash('success-section', 'Tạo mới section thành công.');
        return redirect(route('section.create'));
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
        $obj = Section::find($id);
        if($obj == null){
            Session::flash('error-section', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('section.index');  
        }
        $pages = Page::where('status',1)->get();
        return view('back-end.section.edit',['obj'=>$obj, 'pages'=>$pages]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SectionRequest $request, $id)
    {
        $obj = Section::find($id);
        if($obj == null){
            Session::flash('error-section', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('section.index');  
        }
        $arr_data = $request->all();
        $arr_data['created_by'] = \Auth::user()->id;
        $obj->update($arr_data);
        Session::flash('success-section', 'Thay đổi thông tin thành công.');
        return redirect(route('section.edit', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Section::find($id);
        if($obj == null){
            Session::flash('error-section', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('section.index');  
        }
        $obj->delete();
        Session::flash('success-section', 'Xóa thông tin thành công.');  
        return redirect()->route('section.index');  
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
                $obj = Section::find($data[$i]);
                if($obj != null)
                {
                    $obj->status = $status;
                    $obj->update();
                }
            }
        }else{
            for($i = 0; $i < sizeof($data); $i++)
            {
                $obj = Section::find($data[$i]);
                if($obj != null)
                {
                    $obj->delete();
                }
            }
        }       
        Session::flash('success-section', 'Update đồng loạt thành công.');
        return redirect()->route('section.index');
    }
}
