<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuHeaderRequest as MenuHeaderRequest;
use App\Admin\MenuHeader;
use Illuminate\Support\Facades\Storage;
use Session;

class MenuHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $template = Storage::disk('template')->get('email-1.php');
        send_mail('nm.dung.1991@gmail.com', 'title', 'subject', $template);
        $objs = MenuHeader::all();
        return view('back-end.menu.list')->with('data',$objs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-end.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuHeaderRequest $request)
    {
        MenuHeader::create($request->all());
        Session::flash('success-menu', 'Tạo mới menu header "'.$request->name.'" thành công.');
        return redirect(route('menu.create'));
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
        $obj = MenuHeader::find($id);
        if($obj == null){
            Session::flash('error-menu', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('menu.index');  
        }
        return view('back-end.menu.edit',['obj'=>$obj]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuHeaderRequest $request, $id)
    {
        $obj = MenuHeader::find($id);
        if($obj == null){
            Session::flash('error-menu', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('menu.index');  
        }
        $obj->update($request->all());
        Session::flash('success-menu', 'Thay đổi thông tin thành công.');
        return redirect(route('menu.edit', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = MenuHeader::find($id);
        if($obj == null){
            Session::flash('error-menu', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('menu.index');  
        }
        $obj->delete();
        Session::flash('success-menu', 'Xóa thông tin thành công.');  
        return redirect()->route('menu.index');  
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
                $obj = MenuHeader::find($data[$i]);
                if($obj != null)
                {
                    $obj->status = $status;
                    $obj->update();
                }
            }
        }else{
            for($i = 0; $i < sizeof($data); $i++)
            {
                $obj = MenuHeader::find($data[$i]);
                if($obj != null)
                {
                    $obj->delete();
                }
            }
        }
        Session::flash('success-menu', 'Update đồng loạt thành công.');
        return redirect()->route('menu.index');
    }
}
