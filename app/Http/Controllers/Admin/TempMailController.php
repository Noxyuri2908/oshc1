<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TempMailRequest as TempMailRequest;
use App\Admin\TempMail;
use Session;


class TempMailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = TempMail::all();
        $types = Config('conf-mail.temp');
        return view('back-end.temp-mail.list',['data'=>$objs, 'types'=>$types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Config('conf-mail.temp');
        return view('back-end.temp-mail.create',['types'=>$types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TempMailRequest $request)
    {
        $arr_data = $request->all();
        TempMail::create($arr_data);
        Session::flash('success-temp-mail', 'Create new success.');
        return redirect()->route('temp-mail.create');
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
        $obj = TempMail::find($id);
        if($obj == null){
            Session::flash('error-temp-mail', 'Can not find data.');
            return redirect()->route('temp-mail.index');
        }
        $types = Config('conf-mail.temp');
        return view('back-end.temp-mail.edit',['obj'=>$obj,'types'=>$types]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TempMailRequest $request, $id)
    {
        $obj = TempMail::find($id);
        if($obj == null){
            Session::flash('error-temp-mail', 'Can not find data.');
            return redirect()->route('temp-mail.index');
        }
        $arr_data = $request->all();
        $obj->update($arr_data);
        Session::flash('success-temp-mail', 'Updated success.');
        return redirect()->route('temp-mail.edit',['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = TempMail::find($id);
        if($obj == null){
            Session::flash('error-temp-mail', 'Can not find data.');
            return redirect()->route('temp-mail.index');
        }
        $obj->delete();
        Session::flash('success-temp-mail', 'Deleted success.');
        return redirect()->route('temp-mail.index');
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
                $obj = TempMail::find($data[$i]);
                if($obj != null)
                {
                    $obj->status = $status;
                    $obj->update();
                }
            }
        }else{
            for($i = 0; $i < sizeof($data); $i++)
            {
                $obj = TempMail::find($data[$i]);
                if($obj != null)
                {
                    $obj->delete();
                }
            }
        }
        Session::flash('success-temp-mail', 'Updated success.');
        return redirect()->route('temp-mail.index');
    }
}
