<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Bank;
use Session;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Bank::orderby('name')->paginate(50);
        $flag = "bank";
        return view('CRM.pages.bank')->with(compact('objs', 'flag'));
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
        $data = $request->all();
        $data['created_by'] = auth()->guard('admin')->user()->id;
        Bank::create($data);
        Session::flash('success-list-bank', 'Create bank successful!');
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

    public function editBank(Request $request){
        $id = $request->input('id');
        $obj = Bank::find($id);
        return view('CRM.elements.banks.modal-update',['obj'=>$obj]);
    }

    public function deleteBank(Request $request){
        $obj = Bank::find($request->bank_id);
        if($obj == null){
            Session::flash('error-list-bank', 'Can not found bank data!');
        }else{
            $obj->delete();
            Session::flash('success-list-bank', 'Delete bank successful!');
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
        $obj = Bank::find($id);
        if($obj == null){
            Session::flash('error-list-bank', 'Can not found bank data!');
        }else{
           $data = $request->all();
           $data['updated_by'] = auth()->guard('admin')->user()->id;
           $obj->update($data);
           Session::flash('success-list-bank', 'Update Bank successful!');
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
