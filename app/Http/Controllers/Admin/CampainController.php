<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Campain;
use Session;

class CampainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Campain::orderby('created_at','desc')->paginate(50);
        $flag = "campain";
        return view('CRM.pages.campain')->with(compact('objs', 'flag'));
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
       $check = Campain::where('code',$request->code)->count();

       if ($check > 0){
            Session::flash('error-list-campain', 'Campain code is exists!');
       }else{
            $data = $request->all();
            $data['created_by'] = auth()->guard('admin')->user()->id;
            Campain::create($request->all());
            Session::flash('success-list-campain', 'Create campain successful!');
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

    public function editCampain(Request $request){
        $id = $request->input('id');
        $obj = Campain::find($id);
        return view('CRM.elements.campain.modal-update',['obj'=>$obj]);
    }

    public function deleteCampain(Request $request){
        $obj = Campain::find($request->campain_id);
        if($obj == null){
            Session::flash('error-list-campain', 'Can not found campain data!');
        }else{
            $obj->delete();
            Session::flash('success-list-campain', 'Delete campain successful!');
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
        $obj = Campain::find($id);
        if($obj == null){
            Session::flash('error-list-campain', 'Can not found campain data!');
        }else{
            $obj->update($request->all());
            Session::flash('success-list-campain', 'Update campain successful!');
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
