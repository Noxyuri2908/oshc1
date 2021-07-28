<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Dichvu;
use App\Admin\Campain;
use Session;

class DichvuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Dichvu::orderby('created_at','desc')->paginate(50);
        $flag = "dichvu";
        return view('CRM.pages.dichvu')->with(compact('objs', 'flag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $check = Dichvu::where('slug',$request->slug)->count();

       if ($check > 0){
            Session::flash('error-list-dichvu', 'Service slug is exists!');
       }else{
            $data = $request->all();
            Dichvu::create($request->all());
            Session::flash('success-list-dichvu', 'Create service successful!');
       }
       return redirect()->back();
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
       
    }

    public function editService(Request $request){
        $id = $request->input('id');
        $obj = Dichvu::find($id);
        return view('CRM.elements.dichvu.modal-update',['obj'=>$obj]);
    }

    public function delete(Request $request){
        $obj = Dichvu::find($request->dichvu_id);
        if($obj == null){
            Session::flash('error-list-dichvu', 'Can not found service data!');
        }else{
            $obj->delete();
            Session::flash('success-list-dichvu', 'Delete service successful!');
        }
        return redirect()->back();
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
        $obj = Dichvu::find($id);
        if($obj == null){
            Session::flash('error-list-dichvu', 'Can not found service data!');
        }else{
            $obj->update($request->all());
            Session::flash('success-list-dichvu', 'Update service successful!');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

   
}
