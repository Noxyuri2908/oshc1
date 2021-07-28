<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\ExchangRate;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Admin\TemplateExchangeRate;
use App\Admin;
use Carbon\Carbon;
use Excel;
use File;
use Session;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class ExchangeRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->forget('data_fillter_exchange');
        $objs = ExchangRate::with(['staffCreate'])->paginate(50);
        $flag = "exchange-rate";
        $admins = Admin::where('status', 1)->orderby('username')->get();
        $typeFlywireComProvider = 8;
        $typeFlywireComAgent = 9;
        return view('CRM.pages.exchange_rate')->with(compact(
            'objs',
            'flag',
            'admins',
            'typeFlywireComProvider',
            'typeFlywireComAgent'
        ));
    }

    public function searchExchange(Request $request)
    {
        $month = $request->input('f_month');
        $year = $request->input('f_year');
        $type = $request->input('f_type');
        $admin = $request->input('f_created_by');
        $request->session()->put('data_fillter_exchange', [
            'month' => $month,
            'year' => $year,
            'type' => $type,
            'admin' => $admin,
        ]);
        $query = ExchangRate::where('id', '>', 0);
        if ($month != 'all') {
            $query = $query->where('month', $month);
        }
        if ($year != 'all') {
            $query = $query->where('year', $year);
        }
        if ($type != 'all') {
            $query = $query->where('type', $type);
        }
        if ($admin != 'all') {
            $query = $query->where('created_by', $admin);
        }
        $query = $query->get();
        return view('CRM.elements.exchanges.table', ['objs' => $query]);
    }

    public function exportData(Request $request)
    {

        return Excel::download(
            new TemplateExchangeRate(),
            'export_exchange_rate_' . date('d_m_Y') . '.xlsx'
        );
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
    public function createExchange()
    {
        $typeFlywireComProvider = 8;
        $typeFlywireComAgent = 9;
        return view('CRM.elements.exchanges.modal-add-new', compact(
            'typeFlywireComProvider',
            'typeFlywireComAgent'
        ));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $typeExchange = $request->get('type');
        $typeFlywireComProvider = 8;
        $typeFlywireComAgent = 9;
        if ($typeExchange == $typeFlywireComProvider) {
            $validationData = $request->validate([
                'quarter_id' => 'required',
                'unit' => 'required',
                'type' => 'required',
                'year' => 'required'
            ]);
            $check = ExchangRate::where('quarter_id', $request->quarter_id)
                ->where('unit', $request->unit)
                ->where('year', $request->year)
                ->where('type', $request->type)->count();
            if ($check > 0) {
                \Session::flash('error-list-exchange', 'Exchange Rate is exists!');
            } else {
                $data = $request->all();
                $data['created_by'] = auth()->guard('admin')->user()->id;
                $data['unit_to_aud'] = convert_number_currency_to_db($data['unit_to_aud']);
                ExchangRate::create($data);
                \Session::flash('success-list-exchange', 'Create exchange rate successful!');
            }
        } else if ($typeExchange == $typeFlywireComAgent) {
            $validationData = $request->validate([
                'quarter_id' => 'required',
                'type' => 'required',
                'year' => 'required'
            ]);
            $check = ExchangRate::where('quarter_id', $request->quarter_id)
                ->where('year', $request->year)
                ->where('type', $request->type)->count();
            if ($check > 0) {
                \Session::flash('error-list-exchange', 'Exchange Rate is exists!');
            } else {
                $data = $request->all();
                $data['created_by'] = auth()->guard('admin')->user()->id;
                $data['aud_to_vnd'] = convert_number_currency_to_db($data['aud_to_vnd']);
                ExchangRate::create($data);
                \Session::flash('success-list-exchange', 'Create exchange rate successful!');
            }
        } else {
            $validationData = $request->validate([
                'month' => 'required',
                'year' => 'required',
                'type' => 'required',
                'unit' => 'required'
            ]);
            $check = ExchangRate::where('month', $request->month)
                ->where('year', $request->year)
                ->where('unit', $request->unit)
                ->where('type', $request->type)->count();
            if ($check > 0) {
                \Session::flash('error-list-exchange', 'Exchange Rate is exists!');
            } else {
                $data = $request->all();
                $data['created_by'] = auth()->guard('admin')->user()->id;
                $data['aud_to_vnd'] = convert_number_currency_to_db($data['aud_to_vnd']);
                $data['unit_to_aud'] = convert_number_currency_to_db($data['unit_to_aud']);
                ExchangRate::create($data);
                \Session::flash('success-list-exchange', 'Create exchange rate successful!');
            }
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

    public function editEchange(Request $request)
    {
        $id = $request->input('id');
        $obj = ExchangRate::find($id);
        $typeFlywireComProvider = 8;
        $typeFlywire = $typeFlywireComProvider;
        return view('CRM.elements.exchanges.modal-add-new', compact(
            'obj',
            'typeFlywire'
        ));
        // return view('CRM.elements.exchanges.modal-update', ['obj' => $obj]);
    }

    public function deleteExchange(Request $request)
    {
        $obj = ExchangRate::find($request->exchange_id);
        if ($obj == null) {
            Session::flash('error-list-exchange', 'Can not found exchange rate data!');
        } else {
            $obj->delete();
            Session::flash('success-list-promotion', 'Delete exchange rate successful!');
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
        $data = $request->all();
        $typeExchange = $request->get('type');
        $typeFlywireComProvider = 8;
        $typeFlywireComAgent = 9;
        $obj = ExchangRate::find($id);
        if ($obj == null) {
            \Session::flash('error-list-exchange', 'Can not found exchange rate data!');
        } else {
            if ($typeExchange == $typeFlywireComProvider) {
                $validationData = $request->validate([
                    'quarter_id' => 'required',
                    'unit' => 'required',
                    'type' => 'required',
                    'year' => 'required'
                ]);
                $check = ExchangRate::where('quarter_id', $request->quarter_id)
                    ->where('id', '<>', $id)
                    ->where('unit', $request->unit)
                    ->where('year', $request->year)
                    ->where('type', $request->type)->count();
                if ($check > 0) {
                    Session::flash('error-list-exchange', 'Exchange Rate is exists!');
                } else {
                    $data['unit_to_aud'] = convert_number_currency_to_db($data['unit_to_aud']);
                    $data['updated_by'] = auth()->guard('admin')->user()->id;
                    $obj->update($data);
                    Session::flash('success-list-exchange', 'Update exchange rate successful!');
                }
            } elseif ($typeExchange == $typeFlywireComAgent) {
                $validationData = $request->validate([
                    'quarter_id' => 'required',
                    'type' => 'required',
                    'year' => 'required'
                ]);
                $check = ExchangRate::where('quarter_id', $request->quarter_id)
                    ->where('id', '<>', $id)
                    ->where('year', $request->year)
                    ->where('type', $request->type)->count();
                if ($check > 0) {
                    Session::flash('error-list-exchange', 'Exchange Rate is exists!');
                } else {
                    $data['aud_to_vnd'] = convert_number_currency_to_db($data['aud_to_vnd']);
                    $data['updated_by'] = auth()->guard('admin')->user()->id;
                    $obj->update($data);
                    Session::flash('success-list-exchange', 'Update exchange rate successful!');
                }
            } else {
                $validationData = $request->validate([
                    'month' => 'required',
                    'year' => 'required',
                    'type' => 'required',
                    'unit' => 'required'
                ]);
                $check = ExchangRate::where('month', $request->month)
                    ->where('id', '<>', $id)
                    ->where('year', $request->year)
                    ->where('unit', $request->unit)
                    ->where('type', $request->type)->count();
                if ($check > 0) {
                    Session::flash('error-list-exchange', 'Exchange Rate is exists!');
                } else {
                    $data['aud_to_vnd'] = convert_number_currency_to_db($data['aud_to_vnd']);
                    $data['unit_to_aud'] = convert_number_currency_to_db($data['unit_to_aud']);
                    $data['updated_by'] = auth()->guard('admin')->user()->id;
                    $obj->update($data);
                    Session::flash('success-list-exchange', 'Update exchange rate successful!');
                }
            }
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
