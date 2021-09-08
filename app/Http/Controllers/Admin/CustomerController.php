<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Admin\Apply;
use App\Admin\Commission;
use App\Admin\ConfMail;
use App\Admin\Customer;
use App\Admin\Dichvu;
use App\Admin\Hoahong;
use App\Admin\Profit;
use App\Admin\Promotion;
use App\Admin\Refund;
use App\Admin\School;
use App\Admin\Service;
use App\Http\Controllers\Controller;
use App\Http\Requests\CRM\UpdateCustomer;
use App\Http\Requests\CustomerGetPriceRequest;
use App\Http\Requests\CustomerStoreRequest;
use App\Info;
use App\Mail\InvoiceMail;
use App\User;
//use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Session;
use Spipu\Html2Pdf\Html2Pdf;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $staffs = Admin::orderby('username')->where('status', 1)->get();
        $emailTempletes = ConfMail::get();
        return view('CRM.pages.customer', [
            'tab_name' => 'CUSTOMER',
            'staffs' => $staffs,
            'flag' => 'customer',
            'tab' => 'cus',
            'emailTempletes' => $emailTempletes,
        ]);
    }

    public function getData(Request $request, $tab)
    {
        switch ($tab) {
            case 'cus':
                if (!auth()->user()->can('customer.index')) {
                    return abort(403);
                }
                $data = Apply::filter($request->all())
                    ->where('type_get_data_payment', '=', 1)
                    ->orderby('created_at', 'desc')
                    ->with([
                        'customers',
                        'agent',
                        'hoahongs',
                        'master',
                        'service',
                        'provider',
                        'promotion',
                        'staff',
                    ])
                    ->paginate(20);
                $lastPage = $data->lastPage();
                $totalData = $data->total();
                return response()->json([
                    'view' => view('CRM.elements.customers.data.cus', compact('data'))->render(),
                    'last_page' => $lastPage,
                    'total_data' => $totalData,
                ]);
            case 'com':
                if (!auth()->user()->can('commissionInvoice.index')) {
                    return abort(403);
                }
                $tab_name = 'COMMISSION';
                $data = Hoahong::filter($request->all())
                    ->has('invoice')
                    ->with([
                        'invoice' => function ($query) {
                            $query->with([
                                'agent',
                                'comms',
                                'provider',
                                'service',
                                'customers',
                                'phieuthus',
                                'hoahong'
                            ]);
                        },
                        'creater'
                    ])
                    ->orderby('created_at', 'desc')
                    ->paginate(20);
                $lastPage = $data->lastPage();
                return response()->json([
                    'view' => view('CRM.elements.customers.data.com', compact('data'))->render(),
                    'last_page' => $lastPage,
                ]);
                break;
            case 'profit':
                if (!auth()->user()->can('profitInvoice.index')) {
                    return abort(403);
                }
                $tab_name = 'PROFIT';
                $data = Profit::filter($request->all())
                    ->whereHas('invoice',function($q){
                       $q->where('type_get_data_payment',1);
                    })
                    ->with([
                        'invoice' => function ($query) {
                            $query->with([
                                'agent',
                                'provider',
                                'phieuthus',
                                'service',
                                'customers',
                                'provider_com',
                                'hoahong',
                                'comms'
                            ]);
                        },
                    ])
                    ->orderby('id', 'desc')
                    ->paginate(20);
                $lastPage = $data->lastPage();
                return response()->json([
                    'view' => view('CRM.elements.customers.data.profit', compact('data'))->render(),
                    'last_page' => $lastPage,
                ]);
                break;
            case 'refund':
                if (!auth()->user()->can('refundInvoice.index')) {
                    return abort(403);
                }
                $tab_name = 'REFUND';

                $hoahongIds = Hoahong::when($request->get('policy_no'), function ($query) use ($request) {
                    $query->where('policy_no', 'LIKE', '%'.$request->get('policy_no').'%');
                })->when($request->get('email'), function ($query) use ($request) {
                    $query->where('email', 'LIKE', '%'.$request->get('email').'%');
                })->when($request->get('payment_note_provider'), function ($query) use ($request) {
                    $query->where('payment_note_provider', $request->get('payment_note_provider'));
                })
                    ->pluck('apply_id')
                    ->unique();

                $customerIds = Customer::when($request->get('register'), function ($query) use ($request) {
                    $query
                        ->where('first_name', 'LIKE', '%'.$request->get('register').'%')
                        ->orWhere('last_name', 'LIKE', '%'.$request->get('register').'%');
                })->when($request->get('email'), function ($query) use ($request) {
                    $query->where('email', 'LIKE', '%'.$request->get('email').'%');
                })
                    ->pluck('apply_id')
                    ->unique();

                $agentIds = Info::when($request->get('country_id'), function ($query) use ($request) {
                    $query->where('country', $request->get('country_id'));
                })->when($request->get('f_department'), function ($query) use ($request) {
                    $query->where('department', $request->get('f_department'));
                })->pluck('user_id')->unique();

                $applyIds = Apply::when($request->get('ref_no'), function ($query) use ($request) {
                    $query->where('ref_no', 'LIKE', '%'.$request->get('ref_no').'%');
                })
                    ->when($request->get('agent_id'), function ($query) use ($request) {
                        $query->where('agent_id', $request->get('agent_id'));
                    })
                    ->when($request->get('country_id'), function ($query) use ($agentIds) {
                        $query->whereIn('agent_id', $agentIds);
                    })
                    ->when($request->get('provider_id'), function ($query) use ($request) {
                        $query->where('provider_id', $request->get('provider_id'));
                    })
                    ->when($request->get('type_service'), function ($query) use ($request) {
                        $query->where('type_service', $request->get('type_service'));
                    })
                    ->when($request->get('service_country'), function ($query) use ($request) {
                        $query->where('service_country', $request->get('service_country'));
                    })
                    ->when($request->get('status'), function ($query) use ($request) {
                        $query->where('status', $request->get('status'));
                    })
                    ->when($request->get('type_visa'), function ($query) use ($request) {
                        $query->where('type_visa', $request->get('type_visa'));
                    })
                    ->when($request->get('policy'), function ($query) use ($request) {
                        $query->where('policy', $request->get('policy'));
                    })
                    ->when($request->get('start_date'), function ($query) use ($request) {
                        $query->whereDate('start_date', convert_date_to_db($request->get('start_date')));
                    })
                    ->when($request->get('end_date'), function ($query) use ($request) {
                        $query->whereDate('end_date', convert_date_to_db($request->get('end_date')));
                    })
                    ->when($request->get('f_department'), function ($query) use ($request, $agentIds) {
                        $query->whereIn('agent_id', $agentIds);
                    })
                    ->when($request->get('f_status'), function ($query) use ($request) {
                        $query->where('status', $request->get('f_status'));
                    })
                    ->when($request->get('f_country'), function ($query) use ($request) {
                        $query->where('service_country', $request->get('f_country'));
                    })
                    ->when($request->get('f_time'), function ($query) use ($request) {
                        $query->whereBetween('created_at', dateRangePicker($request->get('f_time')));
                    })
                    ->when($request->get('f_time_start') && $request->get('f_time_end'), function ($query) use ($request) {
                        $query->whereBetween('created_at', [
                            convert_date_to_db($request->get('f_time_start')),
                            convert_date_to_db($request->get('f_time_end')),
                        ]);
                    })
                    ->when($request->get('f_period'), function ($query) use ($request) {
                        if ($request->get('f_period') == 1) {
                            $query->where('created_at', Carbon::now()->format('Y-m-d'));
                        } else {
                            if ($request->get('f_period') == 2) {
                                $query->whereBetween('created_at', [
                                    Carbon::now()->subWeek(1)->format('Y-m-d h:i:s'),
                                    Carbon::now()->format('Y-m-d h:i:s'),
                                ]);
                            } else {
                                if ($request->get('f_period') == 3) {
                                    $query->whereBetween('created_at', [
                                        Carbon::now()
                                            ->subMonth(1)
                                            ->format('Y-m-d h:i:s'),
                                        Carbon::now()->format('Y-m-d h:i:s'),
                                    ]);
                                } else {
                                    if ($request->get('f_period') == 4) {
                                        $query->whereBetween('created_at', [
                                            Carbon::now()
                                                ->subYear(1)
                                                ->format('Y-m-d h:i:s'),
                                            Carbon::now()->format('Y-m-d h:i:s'),
                                        ]);
                                    } else {
                                        if ($request->get('f_period') == 't01') {
                                            $query->whereBetween('created_at', [
                                                date('Y-01-01 h:i:s'),
                                                Carbon::parse(date('Y-01-01 h:i:s'))->endOfMonth(),
                                            ]);
                                        } else {
                                            if ($request->get('f_period') == 't02') {
                                                $query->whereBetween('created_at', [
                                                    date('Y-02-01 h:i:s'),
                                                    Carbon::parse(date('Y-02-01 h:i:s'))->endOfMonth(),
                                                ]);
                                            } else {
                                                if ($request->get('f_period') == 't03') {
                                                    $query->whereBetween('created_at', [
                                                        date('Y-03-01 h:i:s'),
                                                        Carbon::parse(date('Y-03-01 h:i:s'))->endOfMonth(),
                                                    ]);
                                                } else {
                                                    if ($request->get('f_period') == 't04') {
                                                        $query->whereBetween('created_at', [
                                                            date('Y-04-01 h:i:s'),
                                                            Carbon::parse(date('Y-04-01 h:i:s'))->endOfMonth(),
                                                        ]);
                                                    } else {
                                                        if ($request->get('f_period') == 't05') {
                                                            $query->whereBetween('created_at', [
                                                                date('Y-05-01 h:i:s'),
                                                                Carbon::parse(date('Y-05-01 h:i:s'))->endOfMonth(),
                                                            ]);
                                                        } else {
                                                            if ($request->get('f_period') == 't06') {
                                                                $query->whereBetween('created_at', [
                                                                    date('Y-06-01 h:i:s'),
                                                                    Carbon::parse(date('Y-06-01 h:i:s'))->endOfMonth(),
                                                                ]);
                                                            } else {
                                                                if ($request->get('f_period') == 't07') {
                                                                    $query->whereBetween('created_at', [
                                                                        date('Y-07-01 h:i:s'),
                                                                        Carbon::parse(date('Y-07-01 h:i:s'))
                                                                            ->endOfMonth(),
                                                                    ]);
                                                                } else {
                                                                    if ($request->get('f_period') == 't08') {
                                                                        $query->whereBetween('created_at', [
                                                                            date('Y-08-01 h:i:s'),
                                                                            Carbon::parse(date('Y-08-01 h:i:s'))
                                                                                ->endOfMonth(),
                                                                        ]);
                                                                    } else {
                                                                        if ($request->get('f_period') == 't09') {
                                                                            $query->whereBetween('created_at', [
                                                                                date('Y-09-01 h:i:s'),
                                                                                Carbon::parse(date('Y-09-01 h:i:s'))
                                                                                    ->endOfMonth(),
                                                                            ]);
                                                                        } else {
                                                                            if ($request->get('f_period') == 't10') {
                                                                                $query->whereBetween('created_at', [
                                                                                    date('Y-10-01 h:i:s'),
                                                                                    Carbon::parse(date('Y-10-01 h:i:s'))
                                                                                        ->endOfMonth(),
                                                                                ]);
                                                                            } else {
                                                                                if ($request->get('f_period') == 't11') {
                                                                                    $query->whereBetween('created_at', [
                                                                                        date('Y-11-01 h:i:s'),
                                                                                        Carbon::parse(date('Y-11-01 h:i:s'))
                                                                                            ->endOfMonth(),
                                                                                    ]);
                                                                                } else {
                                                                                    if ($request->get('f_period') == 't12') {
                                                                                        $query->whereBetween('created_at', [
                                                                                            date('Y-12-01 h:i:s'),
                                                                                            Carbon::parse(date('Y-12-01 h:i:s'))
                                                                                                ->endOfMonth(),
                                                                                        ]);
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    })
                    ->pluck('id')
                    ->unique();

                $profitIds = Profit::when($request->get('visa_status'), function ($query) use ($request, $applyIds) {
                    $query->where('visa_status', $request->get('visa_status'));
                })->when($request->get('visa_status'), function ($query) use ($request, $applyIds) {
                    $query->where('visa_status', $request->get('visa_status'));
                })->when($request->get('visa_month'), function ($query) use ($request, $applyIds) {
                    $query->where('visa_month', 'LIKE', '%'.$request->get('visa_month').'%');
                })->when($request->get('visa_year'), function ($query) use ($request, $applyIds) {
                    $query->where('visa_year', 'LIKE', '%'.$request->get('visa_year').'%');
                })->when($request->get('profit_status'), function ($query) use ($request, $applyIds) {
                    $query->where('profit_status', $request->get('profit_status'));
                })->when($request->get('commission_payment_status'), function ($query) use ($request, $applyIds) {
                    $query->where('comm_status', $request->get('commission_payment_status'));
                })->when($request->get('date_payment'), function ($query) use ($request, $applyIds) {
                    $query->whereDate('pay_provider_date', convert_date_to_db($request->get('date_payment')));
                })->when($request->get('bank_account'), function ($query) use ($request) {
                    $query->where('pay_provider_bank_account', 'LIKE', '%'.$request->get('bank_account').'%');
                })->when($request->get('pay_agent_date'), function ($query) use ($request) {
                    $query->whereDate('pay_agent_date', convert_date_to_db($request->get('pay_agent_date')));
                })->when($request->get('date_of_receipt'), function ($query) use ($request, $applyIds) {
                    $query->whereDate('date_of_receipt', convert_date_to_db($request->get('date_of_receipt')));
                })->when($request->get('note_of_receipt'), function ($query) use ($request, $applyIds) {
                    $query->where('note_of_receipt', 'LIKE', '%'.$request->get('note_of_receipt').'%');
                })
                    ->pluck('apply_id')
                    ->unique();
                $data = Refund::get();
                //dd(Refund::whereIn('apply_id',$applyIds)->get());
                $data = Refund::when($request->get('ref_no'), function ($query) use ($request, $applyIds) {
                    $query->whereIn('apply_id', $applyIds);
                })
                    ->when($request->get('refund_type_of_refund_pp'), function ($query) use ($request) {
                        $query->where('refund_type_of_refund_pp', $request->input('refund_type_of_refund_pp'));
                    })
                    ->when($request->get('refund_type_of_refund_pp_tt'), function ($query) use ($request) {
                        $query->where('refund_type_of_refund_pp', $request->input('refund_type_of_refund_pp_tt'));
                    })
                    ->when($request->get('paid_date'), function ($query) use ($request) {
                        $query->whereDate('refund_provider_date', '<=', convert_date_to_db($request->input('paid_date')));
                    })
                    ->when($request->get('refund_bank_pp'), function ($query) use ($request) {
                        $query->where('refund_bank_pp', $request->input('refund_bank_pp'));
                    })
                    ->when($request->get('request_date'), function ($query) use ($request) {
                        $query->whereDate('request_date', '<=', convert_date_to_db($request->input('request_date')));
                    })
                    ->when($request->get('country_id'), function ($query) use ($request, $applyIds) {
                        $query->whereIn('apply_id', $applyIds);
                    })
                    ->when($request->get('net_amount'), function ($query) use ($request, $applyIds) {
                        $query->whereIn('apply_id', $applyIds);
                    })
                    ->when($request->get('provider_id'), function ($query) use ($request, $applyIds) {
                        $query->whereIn('apply_id', $applyIds);
                    })
                    ->when($request->get('agent_id'), function ($query) use ($request, $applyIds) {
                        $query->whereIn('apply_id', $applyIds);
                    })
                    ->when($request->get('register'), function ($query) use ($request, $customerIds) {
                        $query->whereIn('apply_id', $customerIds);
                    })
                    ->when($request->get('status'), function ($query) use ($request, $applyIds) {
                        $query->whereIn('apply_id', $applyIds);
                    })
                    ->when($request->get('policy_no'), function ($query) use ($request, $hoahongIds) {
                        $query->whereIn('apply_id', $hoahongIds);
                    })
                    ->when($request->get('type_service'), function ($query) use ($request, $applyIds) {
                        $query->whereIn('apply_id', $applyIds);
                    })
                    ->when($request->get('type_visa'), function ($query) use ($request, $applyIds) {
                        $query->whereIn('apply_id', $applyIds);
                    })
                    ->when($request->get('policy'), function ($query) use ($request, $applyIds) {
                        $query->whereIn('apply_id', $applyIds);
                    })
                    ->when($request->get('start_date'), function ($query) use ($request, $applyIds) {
                        $query->whereIn('apply_id', $applyIds);
                    })
                    ->when($request->get('end_date'), function ($query) use ($request, $applyIds) {
                        $query->whereIn('apply_id', $applyIds);
                    })
                    ->when($request->get('bank_account'), function ($query) use ($request, $profitIds) {
                        $query->whereIn('apply_id', $profitIds);
                    })
                    ->when($request->get('refund_provider_date'), function ($query) use ($request) {
                        $query->whereDate('refund_provider_date', convert_date_to_db($request->get('refund_provider_date')));
                    })
                    ->when($request->get('std_date_apyment'), function ($query) use ($request) {
                        $query->whereDate('std_date_apyment', convert_date_to_db($request->get('std_date_apyment')));
                    })
                    ->when($request->get('profit_status'), function ($query) use ($request, $profitIds) {
                        $query->whereIn('apply_id', $profitIds);
                    })
                    ->when($request->get('email'), function ($query) use ($request, $hoahongIds) {
                        $query->whereIn('apply_id', $hoahongIds);
                    })
                    ->when($request->get('commission_payment_status'), function ($query) use ($request, $profitIds) {
                        $query->whereIn('apply_id', $profitIds);
                    })
                    ->when($request->get('pay_agent_date'), function ($query) use ($request, $profitIds) {
                        $query->whereIn('apply_id', $profitIds);
                    })
                    ->when($request->get('date_of_receipt'), function ($query) use ($request, $profitIds) {
                        $query->whereIn('apply_id', $profitIds);
                    })
                    ->when($request->get('note_of_receipt'), function ($query) use ($request, $profitIds) {
                        $query->whereIn('apply_id', $profitIds);
                    })
                    ->when($request->get('payment_note_provider'), function ($query) use ($request, $hoahongIds) {
                        $query->whereIn('apply_id', $hoahongIds);
                    })
                    ->when($request->get('date_payment'), function ($query) use ($request, $profitIds) {
                        $query->whereIn('apply_id', $profitIds);
                    })
                    ->when($request->get('std_note'), function ($query) use ($request, $applyIds) {
                        $query->where('std_note', 'LIKE', '%'.$request->get('std_note').'%');
                    })
                    ->when($request->get('note2'), function ($query) use ($request, $applyIds) {
                        $query->where('note2', 'LIKE', '%'.$request->get('note2').'%');
                    })
                    ->when($request->get('request_date'), function ($query) use ($request, $applyIds) {
                        $query->whereDate('request_date', convert_date_to_db($request->get('request_date')));
                    })
                    ->when($request->get('std_status'), function ($query) use ($request, $applyIds) {
                        $query->where('std_status', $request->get('std_status'));
                    })
                    ->when($request->get('f_department'), function ($query) use ($request, $applyIds) {
                        $query->whereIn('apply_id', $applyIds);
                    })
                    ->when($request->get('f_status'), function ($query) use ($request, $applyIds) {
                        $query->whereIn('apply_id', $applyIds);
                    })
                    ->when($request->get('f_country'), function ($query) use ($request, $applyIds) {
                        $query->whereIn('apply_id', $applyIds);
                    })
                    ->when($request->get('f_time'), function ($query) use ($request, $applyIds) {
                        $query->whereIn('apply_id', $applyIds);
                    })
                    ->when($request->get('f_time_start') && $request->get('f_time_end'), function ($query) use ($request, $applyIds) {
                        $query->whereIn('apply_id', $applyIds);
                    })
                    ->when($request->get('f_period'), function ($query) use ($request, $applyIds) {
                        $query->whereIn('apply_id', $applyIds);
                    })
                    ->with([
                        'invoice' => function ($query) {
                            $query->with([
                                'agent.info',
                                'profit',
                                'service',
                                'provider',
                                'phieuthus',
                                'customers',
                                'provider_com',
                                'hhs',
                                'refund',
                                'comms',
                            ]);
                        },
                    ])
                    ->orderby('id', 'desc')
                    ->paginate(20);

                $lastPage = $data->lastPage();
                return response()->json([
                    'view' => view('CRM.elements.customers.data.refund', compact('data'))->render(),
                    'last_page' => $lastPage,
                ]);
                break;
            case 'extend':
                if (!auth()->user()->can('extendInvoice.index')) {
                    abort(403);
                }

                $tab_name = 'EXTEND';
                if ($request->get('register') || $request->get('email')) {
                    $customerIds = Customer::getApplyDataExtend($request);
                } else {
                    $customerIds = [];
                }
                if ($request->get('policy_number') || $request->get('issue_date') || $request->get('payment_note')) {
                    $hoahongIds = Hoahong::getApplyDataExtend($request);
                } else {
                    $hoahongIds = [];
                }
                if ($request->get('country_id') || $request->get('f_department')) {
                    $agentIds = Info::getApplyDataExtend($request);
                } else {
                    $agentIds = [];
                }
                if ($request->get('promotion_code')) {
                    $promotionIds = Promotion::when($request->get('promotion_code'), function ($query) use ($request) {
                        $query->where('code', 'LIKE', '%'.$request->get('promotion_code').'%');
                    })->pluck('id');
                } else {
                    $promotionIds = [];
                }
                $data = Apply::getApplyDataExtend($request, $agentIds, $customerIds, $hoahongIds, $promotionIds)
                    ->paginate(20);
                $lastPage = $data->lastPage();
                return response()->json([
                    'view' => view('CRM.elements.customers.data.extend', compact('data', 'tab'))->render(),
                    'last_page' => $lastPage,
                ]);
                break;
            default:
                # code...
                break;
        }
    }

    public function showData(Request $request, $tab, $id)
    {
        switch ($tab) {
            case 'cus':
                $obj = Apply::where('type_get_data_payment', '=', 1)->with([
                    'customer',
                    'customers',
                    'agent',
                    'hoahongs',
                    'master',
                    'service',
                    'provider',
                    'promotion',
                    'staff',
                ])->findOrFail($id);
                $data = [$obj];
                return response()->json([
                    'view' => view('CRM.elements.customers.data.cus', compact(
                        'data'
                    ))->render(),
                    'id' => $obj->id,
                    'type' => 'update',
                ]);
            case 'com':
                $obj = Hoahong::with([
                    'invoice' => function ($query) {
                        $query->with([
                            'agent.info',
                            'comms',
                            'provider',
                            'service',
                            'customers',
                            'phieuthus',
                        ]);
                    },
                    'creater',
                ])->findOrFail($id);
                $data = [$obj];
                return response()->json([
                    'view' => view('CRM.elements.customers.data.com', compact(
                        'data'
                    ))->render(),
                    'id' => $obj->id,
                    'type' => 'update',
                ]);
                break;
            case 'profit':
                $obj = Profit::with([
                    'invoice' => function ($query) {
                        $query->with([
                            'agent',
                            'provider',
                            'phieuthus',
                            'service',
                            'customers',
                            'provider_com',
                        ]);
                    },
                ])->findOrFail($id);
                $data = [$obj];
                return response()->json([
                    'view' => view('CRM.elements.customers.data.profit', compact(
                        'data'
                    ))->render(),
                    'id' => $obj->id,
                    'type' => 'update',
                ]);
                break;
            case 'refund':
                $obj = Refund::with([
                    'invoice' => function ($query) {
                        $query->with([
                            'agent.info',
                            'profit',
                            'service',
                            'provider',
                            'phieuthus',
                            'customers',
                            'provider_com',
                            'hhs',
                            'refund',
                            'comms',
                        ]);
                    },
                ])->findOrFail($id);
                $data = [$obj];
                return response()->json([
                    'view' => view('CRM.elements.customers.data.refund', compact(
                        'data'
                    ))->render(),
                    'id' => $obj->id,
                    'type' => 'update',
                ]);
                break;
            case 'extend':
                $obj = Apply::where('type_get_data_payment', '=', 1)->with([
                    'customer',
                    'customers',
                    'agent.info',
                    'hoahongs',
                    'master',
                    'service',
                    'provider',
                    'promotion',
                    'staff',
                ])->findOrFail($id);
                $data = [$obj];
                return response()->json([
                    'view' => view('CRM.elements.customers.data.extend', compact(
                        'data'
                    ))->render(),
                    'id' => $obj->id,
                    'type' => 'update',
                ]);
                break;
            default:
                # code...
                break;
        }
    }

    public function getCommAplly($tab)
    {
        $alls = Apply::where('type_get_data_payment', '=', 1)->get();
        switch ($tab) {
            case 'com':
                $tab_name = 'COMMISSION';
                break;
            case 'profit':
                $tab_name = 'PROFIT';
                break;
            case 'refund':
                $tab_name = 'REFUND';
                break;
            case 'extend':
                $tab_name = 'EXTEND';
                break;
            default:
                # code...
                break;
        }
        return view('CRM.pages.customer', [
            'alls' => $alls,
            'flag' => 'customer',
            'tab' => $tab,
        ], compact('tab_name'));
    }

    public function multiDeleteData(Request $request)
    {
        $ids = $request->get('ids');
        $dataType = $request->get('type');
        if ($dataType == 'cus' || $dataType == 'extend') {
            try {
                $invoices = Apply::whereIn('id', $ids)->get()->each(function ($invoice, $key) {
                    $invoice->delete();
                });;
                return response()->json(['success' => 1]);
            } catch (Exception $e) {
                return response()->json(['error' => $e]);
            }
        }
    }

    public
    function exportInvoice(Request $request)
    {
        $data = $request->all();
        $obj = Apply::with([
            'customers' => function ($query) {
                $query->where('type', 1);
            },
        ])->find($data['apply_id_export']);
        if ($obj == null) {
            abort(404);
        }
        $provider = $obj->provider;

        if ($provider == null) {
            abort(404);
        }
        $cus = (!empty($obj->customers[0])) ? $obj->customers[0] : [];
        if ($cus == []) {
            return redirect()->back();
        }
        //        $agent = $obj->agent;
        //        dd($obj);
        //        if($agent == null || $agent->info == null) abort(404);
        //
        //        $info = $agent->info;

        //        $cus = $obj->registerCus();
        //        if($cus == null) abort(404);

        //        $is_gst = $info->gst;
        $is_gst = '';
        $typeFile = $data['type_file'];
        $template = Storage::disk('template')->get('template_invoice_'.$data['type_file'].'.php');
        $templateConfig = Admin\TemplateInvoiceManager::where('template_name', $typeFile)->first();

        if (
            $typeFile == 1 ||
            $typeFile == 6 ||
            $typeFile == 7 ||
            $typeFile == 8 ||
            $typeFile == 9 ||
            $typeFile == 10 ||
            $typeFile == 13 ||
            $typeFile == 14
        ) {
            $template = str_replace('_nameCompany', $templateConfig->company_name, $template);
            $template = str_replace('_addressCompany', $templateConfig->company_address, $template);
            $template = str_replace('_phoneCompany', $templateConfig->company_phone, $template);
            $template = str_replace('_websiteCompany', $templateConfig->company_website, $template);
            $template = str_replace('_currentDate', date('d/m/Y'), $template);
        } elseif (
            $typeFile == 2 ||
            $typeFile == 3 ||
            $typeFile == 4 ||
            $typeFile == 5 ||
            $typeFile == 11 ||
            $typeFile == 12 ||
            $typeFile == 15
        ) {
            $template = str_replace('_companyNameVi', $templateConfig->company_name_vi, $template);
            $template = str_replace('_companyAddressVi1', $templateConfig->company_address_vi_1, $template);
            $template = str_replace('_companyPhoneVi1', $templateConfig->company_phone_vi_1, $template);
            $template = str_replace('_companyAddressVi2', $templateConfig->company_address_vi_2, $template);
            $template = str_replace('_companyPhoneVi2', $templateConfig->company_phone_vi_2, $template);
            $template = str_replace('_companyEmailVi1', $templateConfig->company_email_vi, $template);
        }
        $template = str_replace('_moreInformation', $templateConfig->content, $template);
        $template = str_replace('_invoiceNo', $obj->ref_no, $template);
        $template = str_replace('_staffCreate', $obj->invoice_code, $template);
        $template = str_replace('_providerName', $provider->name, $template);
        $template = str_replace('_invoicePolicy', $obj->policyName(), $template);
        $template = str_replace('_invoiceStartDate', $obj->start_date, $template);
        $template = str_replace('_invoiceEndDate', $obj->end_date, $template);
        $template = str_replace('_invoiceAmount', number_format($obj->net_amount), $template);
        $template = str_replace('_currencyInvoice', $provider->currency(), $template);

        if ($templateConfig->logo)
        {
            $template = str_replace('_logoCompany', $templateConfig->logo, $template);
        }elseif (!$templateConfig->logo)
        {
            $template = str_replace('_logoCompany', "data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D", $template);
        }

        if ($data['type_file'] == 1) {
            $template = str_replace('_currentDate', date('d/m/Y'), $template);
            $template = str_replace('_invoiceNo', $obj->ref_no, $template);
            $template = str_replace('_staffCreate', $obj->invoice_code, $template);
            $template = str_replace('_currencyInvoice', $provider->currency(), $template);
            $template = str_replace('_providerName', $provider->name, $template);
            $template = str_replace('_invoicePolicy', $obj->policyName(), $template);
            $template = str_replace('_invoiceStartDate', $obj->start_date, $template);
            $template = str_replace('_invoiceEndDate', $obj->end_date, $template);
            $template = str_replace('_invoiceAmount', number_format($obj->net_amount), $template);
        }
        //dd($template);
        //if (
        //    $data['type_file'] == 1 || $data['type_file'] == 6
        //    || $data['type_file'] == 7 || $data['type_file'] == 8
        //    || $data['type_file'] == 9 || $data['type_file'] == 10
        //    || $data['type_file'] == 13 || $data['type_file'] == 14
        //) {
        //    $template = str_replace('_nameCompany', config('export_invoice.nameCompany'), $template);
        //    $template = str_replace('_addressCompany', config('export_invoice.addressCompany'), $template);
        //    $template = str_replace('_phoneCompany', config('export_invoice.phoneCompany'), $template);
        //    $template = str_replace('_websiteCompany', config('export_invoice.websiteCompany'), $template);
        //    $template = str_replace('_logoCompany', config('export_invoice.logoCompany'), $template);
        //    $template = str_replace('_currentDate', date('d/m/Y'), $template);
        //    $template = str_replace('_invoiceNo', $obj->ref_no, $template);
        //    $template = str_replace('_staffCreate', $obj->invoice_code, $template);
        //    $template = str_replace('_currencyInvoice', $provider->currency(), $template);
        //    $template = str_replace('_providerName', $provider->name, $template);
        //    $template = str_replace('_invoicePolicy', $obj->policyName(), $template);
        //    $template = str_replace('_invoiceStartDate', $obj->start_date, $template);
        //    $template = str_replace('_invoiceEndDate', $obj->end_date, $template);
        //    $template = str_replace('_invoiceAmount', number_format($obj->net_amount), $template);
        //}
        //
        if ($data['type_file'] == 1 || $data['type_file'] == 6 || $data['type_file'] == 9 || $data['type_file'] == 10) {
            if ($is_gst == 1) {
                $_tmp = "GST inclusive";
            } else {
                $_tmp = "GST not inclusive";
            }
            $template = str_replace('_agentGST', $_tmp, $template);
        }

        if ($data['type_file'] == 6) {
            $template = str_replace('_signCompany', config('export_invoice.signCompany'), $template);
        }
        //
        if ($data['type_file'] == 7) {
            $template = str_replace('_commInvoice', number_format(floatval($obj->comm)), $template);
            $template = str_replace('_gstInvoice', number_format(floatval($obj->gst)), $template);
            $template = str_replace('_surInvoice', number_format(floatval($obj->surcharge)), $template);
            $template = str_replace('_totalAmount', number_format(floatval($obj->net_amount) - floatval($obj->comm) + floatval($obj->gst) + floatval($obj->surcharge)), $template);
        }
        //
        if ($data['type_file'] == 8) {
            $template = str_replace('_commInvoice', number_format(floatval($obj->comm)), $template);
            $template = str_replace('_surInvoice', number_format(floatval($obj->surcharge)), $template);
            $template = str_replace('_totalAmount', number_format(floatval($obj->net_amount) - floatval($obj->comm) + floatval($obj->surcharge)), $template);
        }
        //
        if ($data['type_file'] == 13) {
            $template = str_replace('_commInvoice', number_format(floatval($obj->comm)), $template);
            $template = str_replace('_gstInvoice', number_format(floatval($obj->gst)), $template);
            $template = str_replace('_totalAmount', number_format(floatval($obj->net_amount) - floatval($obj->comm) + floatval($obj->gst)), $template);
        }
        //
        if ($data['type_file'] == 14) {
            $template = str_replace('_commInvoice', number_format(floatval($obj->comm)), $template);
            $template = str_replace('_totalAmount', number_format(floatval($obj->net_amount) - floatval($obj->comm)), $template);
        }
        //
        if ($data['type_file'] == 2 || $data['type_file'] == 5 || $data['type_file'] == 15) {
            $template = str_replace('_cusName', $cus->first_name." ".$cus->last_name, $template);
            $template = str_replace('_cusContent', $obj->invoice_code, $template);
            $template = str_replace('_invoiceStartDate', $obj->start_date, $template);
            $template = str_replace('_invoiceEndDate', $obj->end_date, $template);
            $template = str_replace('_providerName', $provider->name, $template);
            $template = str_replace('_invoiceAmount', number_format(floatval($obj->net_amount)), $template);
            $template = str_replace('_invoiceBankFee', number_format(floatval($obj->bank_fee)), $template);
            $template = str_replace('_invoiceTotal', number_format(floatval($obj->bank_fee) + floatval($obj->net_amount)), $template);
        }
        //
        if ($data['type_file'] == 3 || $data['type_file'] == 4) {
            $start = convert_date_form_db($obj->start_date);
            $end = convert_date_form_db($obj->end_date);
            $template = str_replace('_cusName', $cus->first_name." ".$cus->last_name, $template);
            $template = str_replace('_cusContent', $obj->ref_no . ' ' . $cus->first_name." ".$cus->last_name, $template);
            $template = str_replace('_invoiceStartDate', $start, $template);
            $template = str_replace('_invoiceEndDate', $end, $template);
            $template = str_replace('_providerName', $provider->name, $template);
            $template = str_replace('_invoiceTotal', number_format(floatval($obj->net_amount)), $template);
        }
        //
        if ($data['type_file'] == 11 || $data['type_file'] == 12) {
            $template = str_replace('_currentDate', date('d/m/Y'), $template);
            $template = str_replace('_invoiceNo', $obj->ref_no, $template);
            $template = str_replace('_staffCreate', $obj->invoice_code, $template);
            $template = str_replace('_providerName', $provider->name, $template);
            $template = str_replace('_invoicePolicy', $obj->policyName(), $template);
            $template = str_replace('_invoiceStartDate', $obj->start_date, $template);
            $template = str_replace('_invoiceEndDate', $obj->end_date, $template);
            $template = str_replace('_invoiceAmount', number_format($obj->net_amount), $template);
            $template = str_replace('_invoiceBankFee', number_format(floatval($obj->bank_fee)), $template);
            $template = str_replace('_currencyInvoice', $provider->currency(), $template);
            $template = str_replace('_invoiceTotal', number_format(floatval($obj->bank_fee) + floatval($obj->net_amount)), $template);
        }

        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->addFont('DejaVu Sans', '', '');
        $html2pdf->addFont('DejaVu Sans', 'B', '');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($template, true);
        $html2pdf->output('Invoive.pdf', 'D');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('CRM.elements.customers.create', [
            'flag' => 'customer',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request)
    {
        $data = $request->validated();
        $statuses = cache()->remember('customer.statuses.store', 60, function () {
            return \App\Admin\Status::whereIn('type', [
                'customer_database_manager_type_of_customer',
                'customer_database_manager_resource',
                'customer_database_manager_english_center',
                'customer_database_manager_event',
                'customer_database_manager_study_tour',
            ])->get();
        });
        $idStatusCRMOshc = $statuses->where('name', 'CRM OSHC')->first()->id;
        $statusInvoiceDone = 1;
        $statusInvoiceVisa = 3;
        $statusInvoiceHold = 7;
        $statusInvoicePaidCom = 5;
        $country = $request->input('service_country');
        $dichvu = $request->input('type_service');
        $dichvu = Dichvu::find($dichvu);
        if ($dichvu == null) {
            return '';
        }
        $stt = Apply::max('id') + 1;
        $invoice_code = $dichvu->viettat.$country.date("y").str_pad($stt, 6, '0', STR_PAD_LEFT);
        $data = $request->all();
        // $data['staff_id'] = auth()->guard('admin')->user()->id;
        $data['ref_no'] = $invoice_code;
        $data['start_date'] = convert_date_to_db($request->get('start_date'));
        $data['end_date'] = convert_date_to_db($request->get('end_date'));
        $arrayNumberCurrency = [
            'net_amount',
            'promotion_amount',
            'bank_fee_number',
            'gst',
            'extra',
            'comm',
            'total',
            'exchange_rate'
        ];
        foreach ($arrayNumberCurrency as $one) {
            $data[$one] = convert_number_currency_to_db($data[$one]);
        }
        if (
            $data['status'] == $statusInvoiceDone ||
            $data['status'] == $statusInvoiceVisa ||
            $data['status'] == $statusInvoiceHold ||
            $data['status'] == $statusInvoicePaidCom
        ) {
            $data['has_email'] = 1;
        }
        $agent_id = $request->get('agent_id');
        $agent = User::find($agent_id);

        $data['type_get_data_payment'] = 1;
        //Create apply
        $dataCustomerManager['full_name'] = $request->get('first_name').$request->get('last_name');
        $dataCustomerManager['source_id'] = $idStatusCRMOshc;
        $dataCustomerManager['agent_id'] = $request->get('agent_id');
        $dataCustomerManager['gender'] = $request->get('gender');
        $dataCustomerManager['date_of_birth'] = convert_date_to_db($request->get('birth_of_date'));
        $dataCustomerManager['mail'] = $request->get('email');
        $dataCustomerManager['phone_number'] = $request->get('phone');
        $dataCustomerManager['country_id'] = $request->get('country');
        $dataCustomerManager['potential_service'] = $request->get('provider_id');
        $customerDatabaseManager = Admin\CustomerDatabaseManager::create($dataCustomerManager);
        $data['customer_manager_id'] = $customerDatabaseManager->id;

        $invoice = Apply::create($data);

        if (!empty($agent) && empty($agent->had_case)) {
            $agent->update([
                'had_case' => $invoice->id,
                'first_case_date' => date('Y-m-d'),
            ]);
        }

        //Create customer
        $data_register = $request->only('provider_of_school', 'destination', 'prefix_name', 'first_name', 'last_name', 'gender', 'birth_of_date', 'passport', 'country', 'place_study', 'student_id', 'phone', 'email', 'fb');
        $data_register['apply_id'] = $invoice->id;
        $data_register['exchange_rate'] = convert_number_currency_to_db($request->get('exchange_rate'));
        $data_register['exchange_rate'] = convert_number_currency_to_db($request->get('exchange_rate'));
        $data_register['extend_fee'] = convert_number_currency_to_db($request->get('extend_fee'));
        $data_register['type'] = 1;
        Customer::create($data_register);
        $data_partner = $request->only('partner_prefix_name', 'partner_first_name', 'partner_last_name', 'partner_gender', 'partner_birth_of_date', 'partner_passport');
        $data_child = $request->only('child_prefix_name', 'child_first_name', 'child_last_name', 'child_gender', 'child_birth_of_date', 'child_passport');

        if (isset($data_partner['partner_prefix_name'])) {
            $tmp_prefix_name = $data_partner['partner_prefix_name'];
            $tmp_first_name = $data_partner['partner_first_name'];
            $tmp_last_name = $data_partner['partner_last_name'];
            $tmp_gender = $data_partner['partner_gender'];
            $tmp_birth_of_date = $data_partner['partner_birth_of_date'];
            $tmp_passport = $data_partner['partner_passport'];
            foreach ($tmp_prefix_name as $key => $value) {
                Customer::create([
                    'apply_id' => $invoice->id,
                    'prefix_name' => $value,
                    'first_name' => $tmp_first_name[$key],
                    'last_name' => $tmp_last_name[$key],
                    'gender' => $tmp_gender[$key],
                    'birth_of_date' => $tmp_birth_of_date[$key],
                    'passport' => $tmp_passport[$key],
                    'type' => 2,
                ]);
            }
        }

        if (isset($data_child['child_prefix_name'])) {
            $tmp_prefix_name = $data_child['child_prefix_name'];
            $tmp_first_name = $data_child['child_first_name'];
            $tmp_last_name = $data_child['child_last_name'];
            $tmp_gender = $data_child['child_gender'];
            $tmp_birth_of_date = $data_child['child_birth_of_date'];
            $tmp_passport = isset($data_child['child_passport']) ? $data_child['child_passport'] : '';
            foreach ($tmp_prefix_name as $key => $value) {
                Customer::create([
                    'apply_id' => $invoice->id,
                    'prefix_name' => $value,
                    'first_name' => $tmp_first_name[$key],
                    'last_name' => $tmp_last_name[$key],
                    'gender' => $tmp_gender[$key],
                    'birth_of_date' => $tmp_birth_of_date[$key],
                    'passport' => isset($tmp_passport[$key]) ? $tmp_passport[$key] : '',
                    'type' => 3,
                ]);
            }
        }
        \Session::flash('success-create-customer', 'Create new invoice successfull.');
        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
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
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if (!auth()->user()->can('customer.edit')) {
            abort(403);
        }
        $obj = Apply::with(['customers', 'customer', 'agent', 'agentMaster', 'provider', 'service.providers'])
            ->findOrFail($id);

        $cus = $obj->customers->first();
        $flag = 'edit';
        $partners = $obj->partners()->first();
        $childrens = $obj->childrens();
        $arrChild = [];
        foreach ($childrens as $children) {
            array_push($arrChild, $children);
        }
        $childrens = collect($arrChild);
        $page = (!empty($request->get('page'))) ? $request->get('page') : 1;
        $getComm = Commission::where('status', 1)
            ->where('user_id', $obj->agent_id)
            ->where('provider_id', $obj->provider_id)
            ->where('policy', $obj->policy)
            ->first();
        if (!empty($getComm)) {
            $comm = $getComm->getCom();
            $gst = $getComm->getGst();
            $typePayment = $getComm->getTypePayment();
        } else {
            $comm = '';
            $gst = '';
            $typePayment = '';
        }
        return view('CRM.elements.customers.create', compact(
            'obj',
            'cus',
            'flag',
            'partners',
            'childrens',
            'page',
            'comm',
            'gst',
            'typePayment'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomer $request, $id)
    {
        if (!auth()->user()->can('customer.update')) {
            abort(403);
        }
        $data = $request->validated();
        $statuses = cache()->remember('customer.statuses.store', 60, function () {
            return \App\Admin\Status::whereIn('type', [
                'customer_database_manager_type_of_customer',
                'customer_database_manager_resource',
                'customer_database_manager_english_center',
                'customer_database_manager_event',
                'customer_database_manager_study_tour',
            ])->get();
        });
        $idStatusCRMOshc = $statuses->where('name', 'CRM OSHC')->first()->id;
        $statusInvoiceDone = 1;
        $statusInvoiceVisa = 3;
        $statusInvoiceHold = 7;
        $statusInvoicePaidCom = 5;
        $request->validated();
        $data = $request->all();
        $page = $request->get('page');
        if (!empty($data['net_amount'])) {
            $data['net_amount'] = str_replace(
                ',',
                '',
                $data['net_amount']
            );
        }
        if (!empty($data['net_amount'])) {
            $data['net_amount'] = str_replace(
                ',',
                '',
                $data['net_amount']
            );
        }
        // $data['staff_id'] = auth()->guard('admin')->user()->id;

        $country = $request->input('service_country');
        $dichvu = $request->input('type_service');
        $dichvu = Dichvu::find($dichvu);
        if ($dichvu == null) {
            return '';
        }
        $invoice = Apply::find($id);
        $invoice_code = $dichvu->viettat.$country.date("y").str_pad($id, 6, 0, STR_PAD_LEFT);
        $data['ref_no'] = $invoice_code;
        //Update apply
        $data['start_date'] = convert_date_to_db($request->get('start_date'));
        $data['end_date'] = convert_date_to_db($request->get('end_date'));
        $arrayNumberCurrency = [
            'net_amount',
            'promotion_amount',
            'bank_fee_number',
            'gst',
            'extra',
            'comm',
            'total',
        ];
        foreach ($arrayNumberCurrency as $one) {
            $data[$one] = convert_number_currency_to_db($data[$one]);
        }
        if (
            $data['status'] == $statusInvoiceDone ||
            $data['status'] == $statusInvoiceVisa ||
            $data['status'] == $statusInvoiceHold ||
            $data['status'] == $statusInvoicePaidCom
        ) {
            $data['has_email'] = 1;
        }
        $dataCustomerManager['full_name'] = $request->get('first_name').$request->get('last_name');
        $dataCustomerManager['source_id'] = $idStatusCRMOshc;
        $dataCustomerManager['agent_id'] = $request->get('agent_id');
        $dataCustomerManager['gender'] = $request->get('gender');
        $dataCustomerManager['date_of_birth'] = convert_date_to_db($request->get('birth_of_date'));
        $dataCustomerManager['mail'] = $request->get('email');
        $dataCustomerManager['phone_number'] = $request->get('phone');
        $dataCustomerManager['country_id'] = $request->get('country');
        $dataCustomerManager['potential_service'] = $request->get('provider_id');
        $customerDatabaseManager = Admin\CustomerDatabaseManager::findOrFail($invoice->customer_manager_id);
        $customerDatabaseManager->update($dataCustomerManager);
        $invoice->update($data);

        //Create customer
        $data_register = $request->only('provider_of_school', 'destination', 'prefix_name', 'first_name', 'last_name', 'gender', 'birth_of_date', 'passport', 'country', 'place_study', 'student_id', 'phone', 'email', 'fb');
        $data_register['exchange_rate'] = convert_number_currency_to_db($request->get('exchange_rate'));
        $data_register['extend_fee'] = convert_number_currency_to_db($request->get('extend_fee'));
        $apply_id = $invoice->id;
        $data_register['type'] = 1;
        $customer = Customer::where('type', 1)->where('apply_id', $apply_id)->first();

        if (!empty($customer)) {
            $customer->update($data_register);
        } else {
            $data_register['apply_id'] = $apply_id;
            Customer::create($data_register);
        }

        $data_partner = $request->only('partner_prefix_name', 'partner_first_name', 'partner_last_name', 'partner_gender', 'partner_birth_of_date', 'partner_passport');
        $data_child = $request->only('child_prefix_name', 'child_first_name', 'child_last_name', 'child_gender', 'child_birth_of_date', 'child_passport');
        if (isset($data_partner['partner_prefix_name'])) {
            $tmp_prefix_name = $data_partner['partner_prefix_name'];
            $tmp_first_name = $data_partner['partner_first_name'];
            $tmp_last_name = $data_partner['partner_last_name'];
            $tmp_gender = $data_partner['partner_gender'];
            $tmp_birth_of_date = $data_partner['partner_birth_of_date'];
            $tmp_passport = $data_partner['partner_passport'];
            foreach ($tmp_prefix_name as $key => $value) {
                $customerPartner = Customer::where('type', 2)->where('apply_id', $apply_id)->first();
                if (!empty($customerPartner)) {
                    $customerPartner->update([
                        'apply_id' => $invoice->id,
                        'prefix_name' => $value,
                        'first_name' => $tmp_first_name[$key],
                        'last_name' => $tmp_last_name[$key],
                        'gender' => $tmp_gender[$key],
                        'birth_of_date' => $tmp_birth_of_date[$key],
                        'passport' => $tmp_passport[$key],
                        'type' => 2,
                    ]);
                } else {
                    Customer::create([
                        'apply_id' => $invoice->id,
                        'prefix_name' => $value,
                        'first_name' => $tmp_first_name[$key],
                        'last_name' => $tmp_last_name[$key],
                        'gender' => $tmp_gender[$key],
                        'birth_of_date' => $tmp_birth_of_date[$key],
                        'passport' => $tmp_passport[$key],
                        'type' => 2,
                    ]);
                }
            }
        } else {
            $customerPartner = Customer::where('type', 2)->where('apply_id', $apply_id)->first();
            if (!empty($customerPartner)) {
                $customerPartner->delete();
            }
        }

        if (isset($data_child['child_prefix_name'])) {
            $tmp_prefix_name = $data_child['child_prefix_name'];
            $tmp_first_name = $data_child['child_first_name'];
            $tmp_last_name = $data_child['child_last_name'];
            $tmp_gender = $data_child['child_gender'];
            $tmp_birth_of_date = $data_child['child_birth_of_date'];
            $tmp_passport = isset($data_child['child_passport']) ? $data_child['child_passport'] : '';
            $customerChildren = Customer::where('type', 3)->where('apply_id', $apply_id)->get();
            if ($customerChildren->isNotEmpty()) {
                foreach ($tmp_prefix_name as $key => $value) {
                    $customerChildren[$key]->update([
                        'apply_id' => $invoice->id,
                        'prefix_name' => $value,
                        'first_name' => $tmp_first_name[$key],
                        'last_name' => $tmp_last_name[$key],
                        'gender' => $tmp_gender[$key],
                        'birth_of_date' => $tmp_birth_of_date[$key],
                        'passport' => isset($tmp_passport[$key]) ? $tmp_passport[$key] : '',
                        'type' => 3,
                    ]);
                }
            } else {
                foreach ($tmp_prefix_name as $key => $value) {
                    Customer::create([
                        'apply_id' => $invoice->id,
                        'prefix_name' => $value,
                        'first_name' => $tmp_first_name[$key],
                        'last_name' => $tmp_last_name[$key],
                        'gender' => $tmp_gender[$key],
                        'birth_of_date' => $tmp_birth_of_date[$key],
                        'passport' => isset($tmp_passport[$key]) ? $tmp_passport[$key] : '',
                        'type' => 3,
                    ]);
                }
            }
        } else {
            $customerChildren = Customer::where('type', 3)->where('apply_id', $apply_id)->get();
            foreach ($customerChildren as $one) {
                $one->delete();
            }
        }
        return redirect()->back();
    }

    public
    function updateCustomer(Request $request)
    {
        //        dd('a');
        //        dd($request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        if (!auth()->user()->can('customer.delete')) {
            abort(403);
        }
        $obj = Apply::find($id);
        if ($obj == null) {
            abort(404);
        }
        $resCus = $obj->registerCus();
        if ($resCus != null) {
            $resCus->delete();
        }
        $partners = $obj->partners();
        foreach ($partners as $partner) {
            $partner->delete();
        }
        $childrens = $obj->childrens();
        foreach ($childrens as $children) {
            $children->delete();
        }
        $phieuthus = $obj->phieuthus()->get();
        foreach ($phieuthus as $phieuthu) {
            $phieuthu->delete();
        }
        $tailieus = $obj->tailieus()->get();
        foreach ($tailieus as $tailieu) {
            $tailieu->delete();
        }
        $hhs = $obj->hhs()->get();
        foreach ($hhs as $hh) {
            $hh->delete();
        }
        $profits = $obj->profit()->get();
        foreach ($profits as $profit) {
            $profit->delete();
        }
        $refunds = $obj->refund()->get();
        foreach ($refunds as $refund) {
            $refund->delete();
        }
        $obj->delete();
        Session::flash('success-list-customer', 'Delete successful !');
        return back();
    }

    public
    function getCurrency(Request $request)
    {
        $provider_id = $request->get('provider_id');
        $provider = Service::find($provider_id);
        $currency = $provider->currency();
        return $currency;
    }

    public
    function formPartner(Request $request)
    {
        $number = $request->input('num');
        return view('CRM.elements.customers.partner', ['number' => $number - 1]);
    }

    public
    function formChild(Request $request)
    {
        $number = $request->input('num');
        return view('CRM.elements.customers.child', ['number' => $number]);
    }

    public
    function getRef(Request $request)
    {
        $country = $request->input('country');
        $dichvu = $request->input('dichvu');
        $dichvu = Dichvu::find($dichvu);
        if ($dichvu == null) {
            return '';
        }
        $stt = Apply::count() + 1;
        return $dichvu->viettat.$country.date('y').$stt;
    }

    public function getSu(Request $request)
    {
        $payment_method = $request->input('payment_method');
        $net_amount = $request->input('net_amount') != '' ? $request->input('net_amount') : 0;
        $su = isset(config('myconfig.su_payment_method')[$payment_method]) ? config('myconfig.su_payment_method')[$payment_method] : 0;
        return $su * $net_amount;
    }

    public
    function getCus(Request $request)
    {
        $cus_id = $request->input('id');
        $obj = Customer::find($cus_id);
        return view('CRM.elements.customers.modal-customer', ['obj' => $obj]);
    }

    public
    function getInvoice(Request $request)
    {
        $agents = User::orderby('name')->get();
        $staffs = Admin::orderby('username')->where('status', 1)->get();
        $dichvus = Dichvu::orderby('name')->get();
        $providers = Service::orderby('name')->where('status', 1)->get();
        $promotions = Promotion::all();
        $schools = School::orderby('name')->get();
        $_id = $request->input('id');
        $tmp = Apply::find($_id);
        return view('CRM.elements.customers.modal-invoice', compact(
            'tmp',
            'agents',
            'schools',
            'staffs',
            'dichvus',
            'providers',
            'promotions'
        ));
    }

    public function searchInvoice(Request $request)
    {
        $agent = $request->input('agent');
        $country = $request->input('country');
        $master_agent = $request->input('master_agent');
        $service_country = $request->input('service_country');
        $type_invoice = $request->input('type_invoice');
        $dichvu = $request->input('dichvu');
        $provider = $request->input('provider');
        $status = $request->input('status');
        return view('CRM.elements.customers.table', ['data' => $data]);
    }

    public function sendEmailInvoice(Request $request)
    {
        $content = $request->get('content_mail');
        $mails = (!empty($request->get('send_email_invoice'))) ? $request->get('send_email_invoice') : [];
        $names = (!empty($request->get('send_name_invoice'))) ? $request->get('send_name_invoice') : [];
        $filesSendMail = (!empty($request->files_send_mail)) ? $request->files_send_mail : [];
        $fileLists = [];

        foreach ($filesSendMail as $one) {
            $newNameAttr = rand().'.'.$one->getClientOriginalExtension();
            $one->move(public_path('/storage/attr'), $newNameAttr);
            array_push($fileLists, $newNameAttr);
        }
        foreach ($mails as $key => $mail) {
            $customerName = $names[$key];
            try {
                Mail::to($mail)->later(20, new InvoiceMail($content, $customerName, $fileLists));
            } catch (\Exception $e) {
                report($e);
            }
        }
        return response()->json(['success' => 1]);
    }

    public function getComm(Request $request)
    {
        $agent_id = $request->input('agent');
        $policy_id = $request->input('policy');
        $provider_id = $request->input('provider');
        $net_amount = $request->input('net_amount');
        $comm = Commission::where('status', 1)
            ->where('user_id', $agent_id)
            ->where('provider_id', $provider_id)
            ->where('policy', $policy_id)
            ->first();
        $agent = User::find($agent_id);
        if ($agent == null || $comm == null) {
            return ['comm' => 0, 'gst' => 0];
        }

        $res = [];
        $res['comm_agent'] = $comm->comm;
        $res['text_comm_agent'] = $comm->donvi == 1 ? number_format($comm->comm).'%' : number_format($comm->comm).'$';
        $res['comm_donvi'] = $comm->donvi;
        $res['comm_gst'] = $comm->gst;
        $res['text_comm_gst'] = $comm->gst == 1 ? 'Include' : 'Not Include';
        $res['comm_type_payment'] = $comm->type_payment;
        $res['text_comm_type_payment'] = $comm->type_payment == 1 ? 'Monthly' : 'Deduction com';
        $type_payment = $comm->type_payment;
        $donvi = $comm->donvi;
        $amount = $comm->comm;
        $provider = Service::find($provider_id);
        $currency = $provider->currency();

        if ($donvi == 2) {
            return $amount;
        } else {
            $res_comm = round(floatval($amount * floatval($net_amount) / 100), 2);
        }
        if ($agent->gst == 1) {
            $gst = round(floatval($res_comm / 11), 2);
        } else {
            $gst = 0;
        }
        if ($type_payment == 1) {
            $res_comm = 0;
        }
        $res['comm'] = $res_comm;
        $res['gst'] = $gst;
        $res['currency'] = $currency;
        return $res;
    }

    public function statusAgent(Request $request)
    {
        $status = $request->input('id');
        $request->session()->put('invoice_status', $status);
        if ($status != 'all') {
            $data = Apply::where('status', $status)->paginate(50);
        } else {
            $data = Apply::paginate(50);
        }
        return view('CRM.elements.customers.table', ['data' => $data]);
    }

    public function fillterInvoice(Request $request)
    {
        $department = $request->input('department');
        $period = $request->input('period');
        $time = $request->input('time');
        $country = $request->input('country');
        $type = $request->input('type');
        $status = $request->input('status');
        $request->session()->put('invoice_fillter', [
            'department' => $department,
            'period' => $period,
            'time' => $time,
            'country' => $country,
            'status' => $status,
        ]);

        $query = Apply::join('users', 'users.id', '=', 'applies.agent_id')
            ->join('infos', 'users.id', '=', 'infos.user_id');
        if ($department != 'all') {
            $query = $query->where('infos.department', $department);
        }
        if ($country != 'all') {
            $query = $query->where('applies.service_country', $country);
        }
        if ($status != 'all') {
            $query = $query->where('applies.status', $status);
        }
        if ($time == null || $time == "") {
            if ($period != 'all') {
                switch ($period) {
                    case '1':
                        $today = date("Y-m-d");
                        $query = $query->whereRaw("STR_TO_DATE(applies.created_at,'%Y-%m-%d') = '".$today."'");
                        break;
                    case '2':
                        $week = get_week(0);
                        $query = $query->whereRaw("STR_TO_DATE(applies.created_at,'%Y-%m-%d') >= '".$week['start']."' AND STR_TO_DATE(applies.created_at,'%Y-%m-%d') <= '".$week['end']."'");
                        break;
                    case '3':
                        $month = date('m');
                        $query->whereRaw("EXTRACT(MONTH FROM STR_TO_DATE(applies.created_at,'%Y-%m-%d')) =".$month);
                        break;
                    case '4':
                        $year = date('Y');
                        $query->whereRaw("EXTRACT(YEAR FROM STR_TO_DATE(applies.created_at,'%Y-%m-%d')) =".$year);
                        break;
                    default:
                        $month = intval(trim(str_replace('t', '', $period), ' '));
                        $query->whereRaw("EXTRACT(MONTH FROM STR_TO_DATE(applies.created_at,'%Y-%m-%d')) =".$month);
                        break;
                }
            }
        } else {
            $tmp = explode('to', $time);
            if (sizeof($tmp) != 2) {
                $start = trim($tmp[0], ' ');
                $query = $query->whereRaw("STR_TO_DATE(applies.created_at,'%Y-%m-%d') >= '".$start."'");
            } else {
                $start = trim($tmp[0], ' ');
                $end = trim($tmp[1], ' ');
                $query = $query->whereRaw("STR_TO_DATE(applies.created_at,'%Y-%m-%d') >= '".$start."' AND STR_TO_DATE(applies.created_at,'%Y-%m-%d') <= '".$end."'");
            }
        }
        $query = $query->select('applies.*')->paginate(50);
        return view('CRM.elements.customers.table', ['data' => $query]);
    }

    public function getPrice(CustomerGetPriceRequest $request)
    {
        $start_date_from = $request->input('start_date');
        $end_date_from = $request->input('end_date');
        $adults = $request->input('adults');
        $childs = $request->input('childs');
        $prices = get_price($start_date_from, $end_date_from, $adults, $childs);
        return $prices;
    }

    public function getProvider(Request $request)
    {
        $providerId = $request->get('provider_id');
        $services = Service::where('dichvu_id', $providerId)->get();
        return $services;
    }

    public function getStatusFilterCustomer(Request $request, $tab)
    {
        $totalStatus = [];
        switch ($tab) {
            case 'cus':
                $getCountCus = Apply::where('type_get_data_payment', 1)->get(['id', 'status']);
                foreach (config('myconfig.status_invoice') as $keyStatus => $valueStatus) {
                    $totalStatus[$valueStatus] = [
                        'count' => $getCountCus->where('status', $keyStatus)->count(),
                        'id' => $keyStatus,
                    ];
                }
                break;
            case 'com':
                $getIdCus = Apply::where('type_get_data_payment', 1)->get(['id']);
                $getCountCus = Hoahong::with([
                    'invoice',
                ])
                    ->whereIn('apply_id', $getIdCus)
                    ->get(['id', 'apply_id'])->map(function ($q) {
                        $q->status_invoice = !empty($q->invoice) ? $q->invoice->status : null;
                        return $q;
                    });
                foreach (config('myconfig.status_invoice') as $keyStatus => $valueStatus) {
                    $totalStatus[$valueStatus] = [
                        'count' => $getCountCus->where('status_invoice', $keyStatus)->count(),
                        'id' => $keyStatus,
                    ];
                }
                break;
            case 'profit':
                $getIdCus = Apply::where('type_get_data_payment', 1)->get(['id']);
                $getCountCus = Profit::with(['invoice'])
                    ->get(['id', 'apply_id'])
                    ->map(function ($q) {
                        $q->status_invoice = !empty($q->invoice) ? $q->invoice->status : null;
                        return $q;
                    });
                foreach (config('myconfig.status_invoice') as $keyStatus => $valueStatus) {
                    $totalStatus[$valueStatus] = [
                        'count' => $getCountCus->where('status_invoice', $keyStatus)->count(),
                        'id' => $keyStatus,
                    ];
                }
                break;
            case 'refund':
                $getIdCus = Apply::where('type_get_data_payment', 1)->get(['id']);
                $getCountCus = Refund::with(['invoice'])
                    ->whereIn('apply_id', $getIdCus)
                    ->get(['id', 'apply_id'])
                    ->map(function ($q) {
                        $q->status_invoice = !empty($q->invoice) ? $q->invoice->status : null;
                        return $q;
                    });
                foreach (config('myconfig.status_invoice') as $keyStatus => $valueStatus) {
                    $totalStatus[$valueStatus] = [
                        'count' => $getCountCus->where('status_invoice', $keyStatus)->count(),
                        'id' => $keyStatus,
                    ];
                }
                break;
            case 'extend':
                $getCountCus = Apply::where('type_get_data_payment', 1)->get(['id', 'status']);
                foreach (config('myconfig.status_invoice') as $keyStatus => $valueStatus) {
                    $totalStatus[$valueStatus] = [
                        'count' => $getCountCus->where('status', $keyStatus)->count(),
                        'id' => $keyStatus,
                    ];
                }
                break;
            default:
        }

        return response()->json([
            'total_row_data_status' => $totalStatus,
            'total_data' => $getCountCus->count(),
        ]);
    }

    public function getBankFeeByPaymentMethod(Request $request){
        $paymentMethods= config('myconfig.payment_method');
        $creditCardId = array_search('Credit card',$paymentMethods);
        $paypalId = array_search('Paypal',$paymentMethods);
        $paymentId = $request->get('payment_id');
        if($paymentId == $paypalId || $paymentId == $creditCardId){
            return response()->json([
                'bankfee'=>3
            ]);
        }else{
            return response()->json([
                'bankfee'=>0
            ]);
        }
    }

    function viewInvoice(Request $request)
    {
        $template_id = $request->get('template');
        $apply_id = $request->get('apply_id');

        $obj = Apply::with([
            'customers' => function ($query) {
                $query->where('type', 1);
            },
            'phieuthus',
            'promotion'

        ])->find($apply_id);
        $templateConfig = Admin\TemplateInvoiceManager::where('template_name', $template_id)->first();

        if ($obj == null) {
            abort(404);
        }

        if ($obj->provider == null) {
            abort(404);
        }

        $cus = (!empty($obj->customers[0])) ? $obj->customers[0] : [];
        if ($cus == []) {
            return redirect()->back();
        }

        $dataInvoice = $this->mappingDataInvoice($templateConfig, $obj, $template_id, $apply_id, $cus);

        return view("CRM.template_invoice.template_invoice_$template_id", [
            'flag' => 'customer',
            'dataInvoice' => $dataInvoice
        ]);
    }

    function exportInvoiceWithBalde(Request $request)
    {
        try {
            $template_id = $request->get('type_file');
            $apply_id = $request->get('apply_id_export');

            $obj = Apply::with([
                'customers' => function ($query) {
                    $query->where('type', 1);
                },
                'phieuthus',
                'promotion'
            ])->find($apply_id);
            $templateConfig = Admin\TemplateInvoiceManager::where('template_name', $template_id)->first();

            if ($obj == null || $obj->provider == null) {
                abort(404);
            }

            $cus = (!empty($obj->customers[0])) ? $obj->customers[0] : [];
            if ($cus == []) {
                return redirect()->back();
            }

            $dataInvoice = $this->mappingDataInvoice($templateConfig, $obj, $template_id, $apply_id, $cus);

            $pdf = PDF::loadView('CRM.template_invoice.template_export_invoice.template_export_invoice_'.$template_id,compact('dataInvoice'));
            PDF::setOptions(['isHtml5ParserEnabled' => true]);
            $pdf->setPaper('a4');
            return $pdf->download('invoice.pdf');
        }catch(DOMPDF_Exception $e){
            echo '<pre>',print_r($e),'</pre>';
        }
    }

    function mappingDataInvoice($templateConfig, $obj, $template_id, $apply_id, $cus)
    {
        $dataInvoice = [];
        $phieuthus = $obj->phieuthus->sortByDesc('created_at');
        $dataInvoice['sum_amount_receipt'] = $phieuthus->sum('amount');
        $dataInvoice['sum_exchange_rate_receipt'] = $phieuthus->sum('exchange_rate');

        $dataInvoice['content'] = ($templateConfig->content) ?? '';
        $dataInvoice['currency'] = ($obj->provider->currency()) ?? '';
        $dataInvoice['logo'] = ($templateConfig->logo) ? asset('FILES/source/') . '/' . $templateConfig->logo : "data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D";
        $dataInvoice['term'] = 'Immediate payment';
        $dataInvoice['amount'] = (convert_price_float($obj->net_amount)) ?? '';
        $dataInvoice['template_id'] = ($template_id) ?? '';
        $dataInvoice['apply_id'] = ($apply_id) ?? '';

        if ($template_id == 9 || $template_id == 10 || $template_id == 11 || $template_id == 12 ||  $template_id == 13 || $template_id == 14)
        {
            $dataInvoice['company_name'] = ($templateConfig->company_name) ?? '';
            $dataInvoice['company_address'] = ($templateConfig->company_address) ?? '';
            $dataInvoice['company_phone'] = ($templateConfig->company_phone) ?? '';
            $dataInvoice['company_website'] = ($templateConfig->company_website) ?? '';
        }

        if ($template_id == 1 || $template_id == 2 || $template_id == 3 || $template_id == 4 || $template_id == 5 || $template_id == 6 || $template_id == 7 || $template_id == 8 || $template_id == 15)
        {
            $dataInvoice['agentName'] = $obj->getAgentName();
            $dataInvoice['ref_no'] = ($obj->ref_no) ?? '';
            $dataInvoice['cusContent'] = $obj->ref_no .' '. $cus->first_name." ".$cus->last_name;
            $dataInvoice['cusName'] = $cus->first_name.' '.$cus->last_name;
            $dataInvoice['provider_name'] = ($obj->provider->name) ?? '';
            $dataInvoice['policy'] = ($obj->policyName()) ?? '';
            $dataInvoice['start_date'] = ($obj->start_date) ?? '';
            $dataInvoice['end_date'] = ($obj->end_date) ?? '';
            $dataInvoice['amount'] = $obj->net_amount;
            $dataInvoice['bank_fee'] = $obj->bank_fee_number;
            $dataInvoice['amount_AUD'] = $obj->net_amount + $obj->bank_fee_number;
            $dataInvoice['amount_VND'] = ($obj->net_amount + $obj->bank_fee_number) * $cus->exchange_rate;
            $dataInvoice['exchange_rate'] = $cus->exchange_rate;
            $dataInvoice['date'] = ($obj->created_at) ?? '';
        }

        if ($template_id == 9 || $template_id == 10 || $template_id == 11 || $template_id == 12 ||  $template_id == 13 || $template_id == 14)
        {
            $dataInvoice['ref_no'] = ($obj->ref_no) ?? '';
            $dataInvoice['date'] = ($obj->created_at) ?? '';
            $dataInvoice['cusName'] = $cus->first_name.' '.$cus->last_name;
            $dataInvoice['provider_name'] = ($obj->provider->name) ?? '';
            $dataInvoice['policy'] = ($obj->policyName()) ?? '';
            $dataInvoice['start_date'] = ($obj->start_date) ?? '';
            $dataInvoice['end_date'] = ($obj->end_date) ?? '';
            $dataInvoice['amount'] = $obj->net_amount;

        }

        if ($template_id == 10)
        {
            $dataInvoice['amount'] = $obj->net_amount + $obj->surcharge;
            $dataInvoice['bank_fee'] = $obj->bank_fee_number;
            $dataInvoice['total'] = $obj->net_amount;

        }

        if ($template_id == 11)
        {
            $dataInvoice['amount'] = $obj->net_amount;
            $dataInvoice['comm'] = $obj->comm;
            $dataInvoice['total'] = $obj->net_amount - $obj->comm;

        }

        if ($template_id == 12)
        {
            $dataInvoice['amount'] = $obj->net_amount;
            $dataInvoice['comm'] = $obj->comm;
            $dataInvoice['bank_fee'] = $obj->bank_fee_number;
            $dataInvoice['total'] = $obj->net_amount - $obj->comm + $obj->surcharge;

        }

        if ($template_id == 13)
        {
            $dataInvoice['amount'] = $obj->net_amount;
            $dataInvoice['comm'] = $obj->comm;
            $dataInvoice['gst'] = $obj->gst;
            $dataInvoice['total'] = $obj->net_amount - $obj->comm + $obj->gst;

        }

        if ($template_id == 14)
        {
            $dataInvoice['amount'] = $obj->net_amount;
            $dataInvoice['comm'] = $obj->comm;
            $dataInvoice['gst'] = $obj->gst;
            $dataInvoice['bank_fee'] = $obj->bank_fee_number;
            $dataInvoice['total'] = $obj->net_amount - $obj->comm + $obj->gst + $obj->bank_fee_number;

        }

        if ($template_id == 3)
        {
            $dataInvoice['comm'] = $obj->comm;
            $dataInvoice['total'] = $obj->net_amount + $obj->bank_fee_number - $obj->comm;
        }

        if ($template_id == 15){
            $dataInvoice['amount'] = $obj->net_amount - $obj->promotion_amount - $obj->extra;
            $dataInvoice['bank_fee'] = $obj->bank_fee_number;
            $dataInvoice['total_amount_due'] = $obj->total;
        }

        if ($template_id == 4)
        {
            $dataInvoice['comm'] = $obj->comm;
            $dataInvoice['total'] = $obj->net_amount - $obj->comm;
        }

        if ($template_id == 5 || $template_id == 8)
        {
            $dataInvoice['total'] = $obj->net_amount;
        }

        if ( $template_id == 21)
        {
            $dataInvoice['total'] = number_format($obj->net_amount - $obj->extra);
            $dataInvoice['discount/cashback'] = $obj->extra + $obj->promotion_amount;
            $dataInvoice['totalAUD'] = $obj->net_amount - $obj->extra - $obj->promotion_amount + $obj->bank_fee_number;
            $dataInvoice['totalVND'] = convert_price_float($dataInvoice['totalAUD'] *  $obj->exchange_rate);
            $dataInvoice['totalVND'] = ($dataInvoice['totalVND'] > 0) ? $dataInvoice['totalVND'] : '';
        }
        if ($template_id == 8 || $template_id == 7 || $template_id == 6 || $template_id == 4 || $template_id == 1 || $template_id == 3 || $template_id == 5 || $template_id == 15 || $template_id == 2 || $template_id == 22 || $template_id == 23 || $template_id == 24 || $template_id == 25 || $template_id == 26)
        {
            $dataInvoice['companyNameVi'] = $templateConfig->company_name_vi;
            $dataInvoice['companyAddressVi1'] = $templateConfig->company_address_vi_1;
            $dataInvoice['companyAddressVi2'] = $templateConfig->company_address_vi_2;
            $dataInvoice['companyPhoneVi1'] = $templateConfig->company_phone_vi_1;
            $dataInvoice['companyPhoneVi2'] = $templateConfig->company_phone_vi_2;
            $dataInvoice['companyEmailVi1'] = $templateConfig->company_email_vi;
        }
        if ($template_id == 16 || $template_id == 17 || $template_id == 18 || $template_id == 19 || $template_id == 20 || $template_id == 27)
        {
            $dataInvoice['cusName'] = $cus->first_name.' '.$cus->last_name;
            $dataInvoice['tmp'] = "GST inclusive";
            $dataInvoice['comm'] = $obj->comm;
        }
        if ($template_id == 17 || $template_id == 19 ||  $template_id == 20)
        {
            $dataInvoice['bank_fee'] = $obj->bank_fee_number;
            $dataInvoice['promotion_amount'] = $obj->promotion_amount;
            $dataInvoice['gst'] = convert_price_float($obj->comm / 11);
        }

        if ($template_id == 22 || $template_id == 25 || $template_id == 26)
        {
            $dataInvoice['bank_fee'] = $obj->bank_fee_number;
        }

        if ($template_id == 22)
        {
            $dataInvoice['comm'] = $obj->comm;
            $dataInvoice['discount/cashback'] = $obj->extra + $obj->promotion_amount;
            $dataInvoice['totalAUD'] = $obj->net_amount - $obj->extra - $obj->promotion_amount - $obj->comm + $obj->bank_fee_number;
            $dataInvoice['totalVND'] = convert_price_float($dataInvoice['totalAUD'] *  $obj->exchange_rate);
            $dataInvoice['totalVND'] = ($dataInvoice['totalVND'] > 0) ? $dataInvoice['totalVND'] : '';
        }

        if ($template_id == 6)
        {
            $dataInvoice['biiling_address'] = $obj->getAgentName();
            $dataInvoice['cusName'] = $cus->first_name.' '.$cus->last_name;
        }

        if ($template_id == 19 || $template_id == 8)
        {
            $dataInvoice['total'] = $obj->net_amount - $obj->extra;
            $dataInvoice['gst'] = convert_price_float($obj->comm / 11);
        }

        if ($template_id == 25 || $template_id == 26)
        {
            $dataInvoice['insuranceFees'] = $obj->total - $obj->bank_fee_number;
            $dataInvoice['totalAUD'] = $obj->total;
            $dataInvoice['agentName'] = $obj->getAgentName();
        }

        if ($template_id == 23)
        {
            $dataInvoice['agentName'] = $obj->getAgentName();
            $dataInvoice['total'] = $obj->net_amount - $obj->extra;
            $dataInvoice['bank_fee'] = $obj->bank_fee_number;
            $dataInvoice['totalAUD'] =  $obj->net_amount +  $obj->bank_fee_number;
            $dataInvoice['totalVND'] =  $obj->net_amount +  $obj->bank_fee_number;
            $dataInvoice['totalVND'] = ($dataInvoice['currency'] == 'VND') ? $dataInvoice['currency'] : '';
        }

        if ($template_id == 23 || $template_id == 27 || $template_id == 18)
        {
            $dataInvoice['serviceCharge'] = $obj->net_amount;
        }

        if ($template_id == 26 || $template_id == 1)
        {
            $dataInvoice['serviceCharge'] = $obj->total - $obj->bank_fee_number;
        }

        if ($template_id == 27 || $template_id == 26)
        {
            $dataInvoice['bank_fee'] = $obj->bank_fee_number;
        }

        if ($template_id == 27 || $template_id == 26)
        {
            $dataInvoice['totalAmountReceivable'] = $obj->net_amount + $obj->bank_fee_number;
        }

        if($template_id == 27 || $template_id == 18)
        {
            $dataInvoice['agentName'] = $obj->getAgentName();
            $dataInvoice['office'] = $obj->getOfficeAgent();
        }


        if ($template_id == 24)
        {
            $dataInvoice['agentName'] = $obj->getAgentName();
            $dataInvoice['total'] = $obj->net_amount - $obj->extra;
        }


        if ($template_id == 19)
        {
            $dataInvoice['totalPayAmountPayable'] = convert_price_float($obj->net_amount - $obj->extra - $dataInvoice['comm'] + $obj->comm / 11 + $dataInvoice['bank_fee']);
        }

        return $dataInvoice;
    }
}
