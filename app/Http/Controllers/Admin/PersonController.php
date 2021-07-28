<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Person;
use Session;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Person::all();
        return view('back-end.person.list')->with('data',$objs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-end.person.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Person::create($request->all());
        Session::flash('success-person', 'Tạo mới liên hệ "'.$request->name.'" thành công.');
        return redirect(route('person.create'));
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
        $obj = Person::find($id);
        if($obj == null){
            Session::flash('error-person', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('person.index');  
        }
        return view('back-end.person.edit',['obj'=>$obj]);
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
        $obj = Person::find($id);
        if($obj == null){
            Session::flash('error-person', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('person.index');  
        }
        $obj->update($request->all());
        Session::flash('success-person', 'Thay đổi thông tin thành công.');
        return redirect(route('person.edit', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Person::find($id);
        if($obj == null){
            Session::flash('error-person', 'Không tìm thấy dữ liệu.');  
            return redirect()->route('person.index');  
        }
        $obj->delete();
        Session::flash('success-person', 'Xóa thông tin thành công.');  
        return redirect()->route('person.index');  
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
                $obj = Person::find($data[$i]);
                if($obj != null)
                {
                    $obj->status = $status;
                    $obj->update();
                }
            }
        }else{
            for($i = 0; $i < sizeof($data); $i++)
            {
                $obj = Person::find($data[$i]);
                if($obj != null)
                {
                    $obj->delete();
                }
            }
        }       
        Session::flash('success-person', 'Update đồng loạt thành công.');
        return redirect()->route('person.index');
    }
}
