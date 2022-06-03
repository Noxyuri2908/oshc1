<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Promotion;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Admin\TemplatePromotion;
use App\Admin;
use Excel;
use File;
use Session;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objs = Promotion::orderby('created_at','desc')->paginate(50);
        $flag = "promotion";
        return view('CRM.pages.promotion')->with(compact('objs', 'flag'));
    }

    public function importPromotion(Request $request){
        $extension = File::extension($request->file->getClientOriginalName());
        if ($extension == "xlsx" || $extension == "xls" ) {    
            $path = $request->file->getRealPath();        
            try{
                (new FastExcel)->sheet(1)->import($path, function ($line) 
                {
                    $arr_tmp = [];
                    $arr_tmp['name'] = $line['Name'];
                    $arr_tmp['start_date'] = $line['Start date'];
                    $arr_tmp['end_date'] = $line['End date'];
                    $arr_tmp['code'] = $line['Code']; 
                    $arr_tmp['amount'] = $line['Amount'];  
                    if($arr_tmp['code'] != null && $arr_tmp['code'] != ""){
                        $check = Promotion::where('code', $arr_tmp['code'])->first();
                        if($check == null) Promotion::create($arr_tmp);
                        else $check->update($arr_tmp);
                        
                    }
                });
            }catch(Exception $e){
                Session::flash('error-list-promotion', "Format file incorrect !");
                return back();
            }
        }else{
            Session::flash('error-list-promotion', "File import must is excel !");
            return back();
        }
        Session::flash('success-list-promotion', "Import successful !");
        return back();  
    }

    public function exportPromotion(Request $request){

        return Excel::download(new TemplatePromotion()
            , 'export_promotion_'.date('d_m_Y').'.xlsx');
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
       $check = Promotion::where('code',$request->code)->count();
       if ($check > 0){
            Session::flash('error-list-promotion', 'Promotion code is exists!');
       }else{
            Promotion::create($request->all());
            Session::flash('success-list-promotion', 'Create promotion successful!');
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

    public function editPromotion(Request $request){
        $id = $request->input('id');
        $obj = Promotion::find($id);
        return view('CRM.elements.promotions.modal-update',['obj'=>$obj]);
    }

    public function deletePromotion(Request $request){
        $obj = Promotion::find($request->promotion_id);
        if($obj == null){
            Session::flash('error-list-promotion', 'Can not found promotion data!');
        }else{
            $obj->delete();
            Session::flash('success-list-promotion', 'Delete promotion successful!');
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
        $obj = Promotion::find($id);
        if($obj == null){
            Session::flash('error-list-promotion', 'Can not found promotion data!');
        }else{
            $obj->update($request->all());
            Session::flash('success-list-promotion', 'Update promotion successful!');
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
