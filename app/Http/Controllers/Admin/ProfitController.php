<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Hoahong;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Profit;
use App\Admin\Apply;
use Exception;
use Illuminate\Support\Facades\App;
use SebastianBergmann\Environment\Console;

class ProfitController extends Controller
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
        $data['exchange_rate_re_provider'] = $request->input('exchange_rate_re_provider');
        $data['date_of_receipt'] = convert_date_to_db($request->input('date_of_receipt'));
        $data['note_of_receipt'] = $request->input('note_of_receipt');
        $data['pay_provider_exchange_rate'] = $request->input('pay_provider_exchange_rate');
        $data['pay_provider_paid'] = $request->input('pay_provider_paid');
        $data['pay_provider_date'] = convert_date_to_db($request->input('pay_provider_date'));
        $data['pay_provider_bank_account'] = $request->input('pay_provider_bank_account');
        $data['pay_provider_bank_fee'] = $request->input('pay_provider_bank_fee');
        $data['pay_agent_bonus'] = $request->input('pay_agent_bonus');
        $data['pay_agent_deduction'] = $request->input('pay_agent_deduction');
        $data['pay_agent_exchange_rate'] = $request->input('pay_agent_exchange_rate');
        $data['pay_agent_date'] = convert_date_to_db($request->input('pay_agent_date'));

        $data['unit_money'] = $request->input('unit_money');
        $data['extra_time'] = $request->input('extra_time');
        $data['profit_status'] = $request->input('profit_status');
        $data['comm_status'] = $request->input('comm_status');
        $data['visa_status'] = $request->input('visa_status');
        $data['visa_month'] = $request->input('visa_month');
        $data['visa_year'] = $request->input('visa_year');
        $data['note_cp'] = $request->input('note_cp');

        $data['pay_provider_amount'] = $request->input('pay_provider_amount');
        $data['pay_provider_total_amount'] = $request->input('pay_provider_total_amount');
        $data['pay_provider_total_VN'] = convert_number_currency_to_db($request->input('pay_provider_total_VN'));
        $data['pay_provider_balancer_1'] = convert_number_currency_to_db($request->input('pay_provider_balancer_1'));
        $data['profit_payment_note_provider'] = $request->input('profit_payment_note_provider');
        $data['profit_money'] = convert_number_currency_to_db($request->input('profit_money'));
        $data['profit_money_VND'] = convert_number_currency_to_db($request->input('profit_money_VND'));
        $data['comm_re'] = $request->input('comm_re');
        $data['re_total_amount'] = convert_number_currency_to_db($request->input('re_total_amount'));
        $data['re_total_amount_vn'] = convert_number_currency_to_db($request->input('re_total_amount_vn'));
        $data['comm_rate_agent_profit'] = $request->input('comm_rate_agent_profit');
        $data['pay_agent_amount_comm'] = convert_number_currency_to_db($request->input('pay_agent_amount_comm'));
        $data['pay_agent_amount_VN'] = convert_number_currency_to_db($request->input('pay_agent_amount_VN'));
        $data['gst_status_agent_profit'] = $request->input('gst_status_agent_profit');
        $data['profit_extra_money'] = $request->get('profit_extra_money');
        $data['profit_exchange_rate'] = $request->get('profit_exchange_rate');
        $data['issue_date_com_agent'] = convert_date_to_db($request->get('issue_date_com_agent'));
        $data['pay_agent_extra'] = convert_number_currency_to_db($request->get('pay_agent_extra'));
        $data['pay_agent_extra'] = convert_number_currency_to_db($request->get('pay_agent_extra'));
        $data['vnd'] = convert_number_currency_to_db($request->get('vnd'));
        $data['profit_total'] = convert_number_currency_to_db($request->get('profit_total'));
        $data['profit_bankfee_VND'] = convert_number_currency_to_db($request->get('profit_bankfee_VND'));
        $data['gst'] = convert_number_currency_to_db($request->get('gst'));

        $apply = Apply::find($data['apply_id']);
        if ($apply == null) return view('CRM.elements.customer-process.table-profit');

        $id_profit = $request->input('id_profit');
        Apply::where('id', $data['apply_id'])->update(['difference' => $request->get('difference')]);
        $profit = $apply->profit()->first();
        if ($profit != null) {
            $data['admin_update'] = auth()->guard('admin')->user()->id;
            $profit->update($data);

            Hoahong::where('apply_id', $data['apply_id'])
                ->update(['date_payment_agent' => $data['pay_agent_date'], 'note' => $data['note_cp']]);
        } else {
            $data['admin_create'] = auth()->guard('admin')->user()->id;
            Profit::create($data);
        }
        $profits = $apply->profit()->get();
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
        //
        $profit = Profit::findOrFail($id);
        try {
            $profit->delete();
            return response()->json(['success' => 1]);
        } catch (Exception $e) {
            return response()->json(['error' => $e]);
        }
    }
    public function multiDelete(Request $request)
    {
        $dataType = $request->get('type');
        $ids = $request->get('ids');
        if ($dataType == 'com') {
            try {
                $profits = Profit::whereIn('id', $ids)->get()->each(function ($profit, $key) {
                    $profit->delete();
                });;
                return response()->json(['success' => 1]);
            } catch (Exception $e) {
                return response()->json(['error' => $e]);
            }
        }
    }

    public function updateAllDateProfit(Request $request)
    {
        $dataType = $request->get('type');
        $ids = $request->get('ids');
        $update_pay_provider_date = convert_date_to_db($request->get('update_pay_provider_date'));
        $update_pay_agent_date = convert_date_to_db($request->get('update_pay_agent_date'));
        $update_date_of_receipt = convert_date_to_db($request->get('update_date_of_receipt'));

        if ($dataType == 'profit') {
            try {
                $profits = Profit::whereIn('id', $ids);
                $profits->update([
                    'pay_provider_date' => $update_pay_provider_date,
                    'pay_agent_date' => $update_pay_agent_date,
                    'date_of_receipt' => $update_date_of_receipt
                ]);
                return response()->json(['success' => 1]);
            } catch (Exception $e) {
                return response()->json(['error' => $e]);
            }
        }
    }
}
