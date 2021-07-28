<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Refund;
use App\Admin\Apply;
use Exception;

class RefundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $page = $request->get('page');
        $data = [];
        $data['apply_id'] = $request->input('id');
        $data['refund_provider_amount'] = $request->input('refund_provider_amount');
        $data['request_date'] = convert_date_to_db($request->input('request_date'));
        $data['refund_provider_date'] = convert_date_to_db($request->input('refund_provider_date'));
        $data['std_deduction'] = $request->input('std_deduction');
        $data['refund_provider_exchange_rate'] = $request->input('refund_provider_exchange_rate');
        $data['std_date_apyment'] = convert_date_to_db($request->input('std_date_apyment'));
        $data['std_status'] = $request->input('std_status');
        $data['std_amount'] = $request->input('std_amount');
        $data['std_exchange_rate'] = $request->input('std_exchange_rate');
        $data['std_note'] = $request->input('std_note');
        $data['note2'] = $request->input('note2');
        $data['refund_profit_2'] = convert_number_currency_to_db($request->input('refund_profit_2'));
        $data['refund_profit_2_VN'] = convert_number_currency_to_db($request->input('refund_profit_2_VN'));
        $data['refund_amount_com_agent'] = convert_number_currency_to_db($request->input('refund_amount_com_agent'));
        $data['refund_exchange_rate_agent'] = convert_number_currency_to_db($request->input('refund_exchange_rate_agent'));
        $data['refund_agent_vnd'] = convert_number_currency_to_db($request->input('refund_agent_vnd'));
        $data['refund_amount_com_agent_gbcfa'] = convert_number_currency_to_db($request->input('refund_amount_com_agent_gbcfa'));
        $data['refund_situation_pp'] = $request->input('refund_situation_pp');
        $data['refund_type_of_refund_pp'] = $request->input('refund_type_of_refund_pp');
        $data['refund_bank_pp'] = $request->input('refund_bank_pp');
        $apply = Apply::find($data['apply_id']);
        if ($apply == null) abor(404);
        $id_refund = $request->input('id_refund');
        $refund = $apply->refund()->first();
        if ($refund != null) {
            $data['admin_update'] = auth()->guard('admin')->user()->id;
            $refund->update($data);
        } else {
            $data['admin_create'] = auth()->guard('admin')->user()->id;
            Refund::create($data);
        }
        return route('customer.index', ['page' => $page]);
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
        //
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
    public function destroy($id)
    {
        $refund = Refund::findOrFail($id);
        try {
            $refund->delete();
            return response()->json(['success' => 1]);
        } catch (Exception $e) {
            return response()->json(['error' => $e]);
        }
    }
    public function multiDelete(Request $request)
    {
        $dataType = $request->get('type');
        $ids = $request->get('ids');
        if ($dataType == 'refund') {
            try {
                $refunds = Refund::whereIn('id', $ids)->get()->each(function ($refund, $key) {
                    $refund->delete();
                });
                return response()->json(['success' => 1]);
            } catch (Exception $e) {
                return response()->json(['error' => $e]);
            }
        }
    }
}
