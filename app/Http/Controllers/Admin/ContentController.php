<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContentRequest as ContentRequest;
use App\Admin\Section;
use App\Admin\Content;
use Session;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Content::all();
        return view('back-end.content.list',['data'=>$objs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::where('status',1)->get();
        return view('back-end.content.create',['sections'=>$sections]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContentRequest $request)
    {
        $arr_data = $request->all();
        $arr_data['created_by'] = \Auth::user()->id;
        Content::create($arr_data);
        Session::flash('success-content', 'Tạo mới content thành công.');
        return redirect(route('content.create'));
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
        $obj = Content::find($id);
        if($obj == null){
            Session::flash('error-content', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('content.index');  
        }
        $sections = Section::where('status',1)->get();
        return view('back-end.content.edit',['obj'=>$obj, 'sections'=>$sections]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContentRequest $request, $id)
    {
        $obj = Content::find($id);
        if($obj == null){
            Session::flash('error-content', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('content.index');  
        }
        $arr_data = $request->all();
        $arr_data['created_by'] = \Auth::user()->id;
        $obj->update($arr_data);
        Session::flash('success-content', 'Thay đổi thông tin thành công.');
        return redirect(route('content.edit', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Content::find($id);
        if($obj == null){
            Session::flash('error-content', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('content.index');  
        }
        $obj->delete();
        Session::flash('success-content', 'Xóa thông tin thành công.');  
        return redirect()->route('content.index');  
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
                $obj = Content::find($data[$i]);
                if($obj != null)
                {
                    $obj->status = $status;
                    $obj->update();
                }
            }
        }else{
            for($i = 0; $i < sizeof($data); $i++)
            {
                $obj = Content::find($data[$i]);
                if($obj != null)
                {
                    $obj->delete();
                }
            }
        }       
        Session::flash('success-content', 'Update đồng loạt thành công.');
        return redirect()->route('content.index');
    }
}
