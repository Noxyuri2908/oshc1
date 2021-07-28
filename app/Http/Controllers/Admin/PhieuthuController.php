<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Apply;
use App\Admin\Phieuthu;

class PhieuthuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [];
        $data['apply_id'] = $request->input('id');
        $data['payer'] = $request->input('payer');
        $data['address'] = $request->input('address');
        $data['account_bank'] = $request->input('account_bank');
        $data['note'] = $request->input('note');
        $data['code'] = $request->input('code');
        $data['current_id'] = $request->input('current_id');
        $data['amount'] = convert_number_currency_to_db($request->input('amount'));
        $data['bank_fee'] = convert_number_currency_to_db($request->input('bank_fee'));
        $data['type'] = $request->input('type');
        $data['type_payment'] = $request->input('type_payment');
        $data['exchange_rate'] = $request->input('exchange_rate');
        $data['receipt_net_amount'] = (!empty($request->get('receipt_net_amount')))?str_replace(',','',$request->get('receipt_net_amount')):0;


        if($request->has(['date_receipt'])){
            $data['date_receipt']= convert_date_to_db($request->get('date_receipt'));
        }

        $apply = Apply::find($data['apply_id']);
        if($apply == null) return view('CRM.elements.customer-process.table-receipt');

        $id_phieuthu = $request->input('id_phieuthu');
        if($id_phieuthu != 0){
            $phieuthu = Phieuthu::find($id_phieuthu);
            if($phieuthu != null){
                $data['admin_update'] = auth()->guard('admin')->user()->id;
                $phieuthu->update($data);
            }else{
                $data['admin_create'] = auth()->guard('admin')->user()->id;
                Phieuthu::create($data);
            }
        }else{
            $data['admin_create'] = auth()->guard('admin')->user()->id;
            Phieuthu::create($data);
        }
        $getApply = Apply::with('phieuthus','agent')->find($data['apply_id']);
        $phieuthus = Phieuthu::where('apply_id',$data['apply_id'])->orderby('created_at','desc')->get();
        $totalAmount = $phieuthus->sum('amount');
        $totalExchangeRate = $phieuthus->sum('exchange_rate');
        $resCus = (!empty($getApply))?$getApply->registerCus():'';
        $providerCom = $getApply->getProviderCom();
        return response()->json([
            'view'=>view('CRM.elements.customer-process.table-receipt', compact(
                'phieuthus',
                'getApply',
                'resCus',
                'providerCom'
            ))->render(),
            'total'=>$totalAmount,
            'totalExchangeRate'=>$totalExchangeRate
        ]);
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
    public function edit(Request $request)
    {
        $obj = Apply::find($request->input('id'));
        $phieuthu = Phieuthu::find($request->input('id_phieuthu'));
        return view('CRM.elements.customer-process.btn-receipt',['type'=>3, 'obj'=>$obj, 'phieuthu'=>$phieuthu]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id_phieuthu');
        $phieuthu = Phieuthu::find($id);
        if($phieuthu != null) $phieuthu->delete();
        return '';
    }
}
