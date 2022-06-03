<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfMailRequest as ConfMailRequest;
use App\Admin\ConfMail;
use Session;


class ConfMailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = ConfMail::all();
        $types = Config('conf-mail.types');
        return view('back-end.conf-mail.list',['data'=>$objs, 'types'=>$types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Config('conf-mail.types');
        return view('back-end.conf-mail.create',['types'=>$types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConfMailRequest $request)
    {
        $arr_data = $request->all();
        ConfMail::create($arr_data);
        Session::flash('success-conf-mail', 'Create new success.');
        return redirect()->route('conf-mail.create');
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
        $obj = ConfMail::find($id);
        if($obj == null){
            Session::flash('error-conf-mail', 'Can not find data.');
            return redirect()->route('conf-mail.index');
        }
        $types = Config('conf-mail.types');
        return view('back-end.conf-mail.edit',['obj'=>$obj,'types'=>$types]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConfMailRequest $request, $id)
    {
        $obj = ConfMail::find($id);
        if($obj == null){
            Session::flash('error-conf-mail', 'Can not find data.');
            return redirect()->route('conf-mail.index');
        }
        $arr_data = $request->all();
        $obj->update($arr_data);
        Session::flash('success-conf-mail', 'Updated success.');
        return redirect()->route('conf-mail.edit',['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = ConfMail::find($id);
        if($obj == null){
            Session::flash('error-conf-mail', 'Can not find data.');
            return redirect()->route('conf-mail.index');
        }
        $obj->delete();
        Session::flash('success-conf-mail', 'Deleted success.');
        return redirect()->route('conf-mail.index');
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
                $obj = ConfMail::find($data[$i]);
                if($obj != null)
                {
                    $obj->status = $status;
                    $obj->update();
                }
            }
        }else{
            for($i = 0; $i < sizeof($data); $i++)
            {
                $obj = ConfMail::find($data[$i]);
                if($obj != null)
                {
                    $obj->delete();
                }
            }
        }
        Session::flash('success-conf-mail', 'Updated success.');
        return redirect()->route('conf-mail.index');
    }
}
