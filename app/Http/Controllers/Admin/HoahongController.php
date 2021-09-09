<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Profit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Hoahong;
use App\Admin\Apply;
use Exception;

class HoahongController extends Controller
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
        $data['visa_status'] = $request->input('visa_status');
        $data['hoahong_month'] = $request->input('hoahong_month');
        $data['hoahong_year'] = $request->input('hoahong_year');
        $data['date_payment_provider'] = convert_date_to_db($request->input('date_payment_provider'));
        $data['account_bank'] = $request->input('account_bank');
        $data['note'] = $request->input('note');
        $data['date_payment_agent'] = convert_date_to_db($request->input('date_payment_agent'));
        $data['policy_no'] = $request->input('policy_no');
        $data['issue_date'] = convert_date_to_db($request->input('issue_date'));
        $data['policy_status'] = $request->input('policy_status');
        $data['payment_note_provider'] = $request->input('payment_note_provider');
        $data['extra_money'] = convert_number_currency_to_db($request->input('extra_money'));
        $data['unit_money'] = $request->input('unit_money');
        $data['extra_time'] = convert_date_to_db($request->input('extra_time'));
        $data['com_payment_method'] = $request->get('com_payment_method');
        // dd($data);
        $apply = Apply::find($data['apply_id']);
        $id_hh = $request->input('id_hh');
        if ($id_hh != 0) {
            $hh = Hoahong::find($id_hh);
            if ($hh != null) {
                $data['admin_update'] = auth()->guard('admin')->user()->id;
                $hh->update($data);

                Profit::where('apply_id', $data['apply_id'])
                    ->update(['pay_agent_date' => $data['date_payment_agent'], 'note_cp' => $data['note']]);
            } else {
                $data['admin_create'] = auth()->guard('admin')->user()->id;
                Hoahong::create($data);
            }
        } else {
            $data['admin_create'] = auth()->guard('admin')->user()->id;
            Hoahong::create($data);
        }

        return route('customer.process.index', ['id'=>$apply->id,'page' => 1,'tab'=>3,'tab_link'=>3]);
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
        $hoahong = Hoahong::find($request->input('id_hh'));
        return view('CRM.elements.customer-process.btn-hh', ['type' => 3, 'obj' => $obj, 'hh' => $hoahong]);
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
        $comm = Hoahong::findOrFail($id);
        try {
            $comm->delete();
            return response()->json(['success' => 1]);
        } catch (Exception $e) {
            return response()->json(['error' => 1]);
        }
    }
    public function multiDelete(Request $request)
    {
        $dataType = $request->get('type');
        $ids = $request->get('ids');
        if ($dataType == 'com') {
            try {
                $hoahongs = Hoahong::whereIn('id', $ids)->get()->each(function ($hoahong, $key) {
                    $hoahong->delete();
                });
                return response()->json(['success' => 1]);
            } catch (Exception $e) {
                return response()->json(['error' => $e]);
            }
        }
    }

    public function getDateOfPayment(Request $request)
    {
        $agent_id = $request->get('agent');
        $dateOfPayment = Hoahong::select('date_payment_provider')->where('apply_id', $agent_id)->first();

        return response()->json(['date' => convert_date_form_db($dateOfPayment->date_payment_provider ?? "")]);

    }
}
