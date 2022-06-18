<?php

namespace App\Http\Controllers;

use App\Admin\Person;
use App\User;
use App\Admin\Apply;
use App\Admin\Customer;
use App\Admin\ApprovedComReport;
use App\Admin\ComReport;
use App\Admin\ComReportDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Exports\CommissionReportExport;
use App\Exports\OshcReportExport;
use App\Exports\VisitorInsuranceReport;
use App\Exports\CommissionReportMultiSheetExport;
use App\Exports\TestReport;
use Illuminate\Http\Request;
use App\Http\Requests\CRM\SaveCommissionReportRequest;
use Illuminate\Support\Facades\Auth;

class CommissionReportController extends Controller
{
    public function index(Request $request)
    {
        $customer = Customer::pluck('person_counsellor_id')->toArray();
        $newComReport = ApprovedComReport::latest('id')->first();
        if (!empty($newComReport)) {
            $newComReportId = $newComReport->id;
        } else {
            $newComReportId = 1;
        }

        $data = $request->all();
        if (!empty($data) && isset($data['agentId']) && isset($data['fromDate']) && isset($data['toDate'])) {
            $agentId = $data['agentId'];
            $fromDate = $data['fromDate'];
            $toDate = $data['toDate'];
            $flag = 'commission-report';
            $reports = DB::select("CALL create_commission_report(:agent_id, :from_date, :to_date)", [
                'agent_id' => $agentId,
                'from_date' => $fromDate,
                'to_date' => $toDate
            ]);
            $gst = User::select('id', 'gst', 'name')->where('id', $agentId)->first();
            if ($data['view'] == 'insurance') {
                $reports = Apply::select('id', 'agent_id', 'type_service', 'provider_id', 'policy', 'no_of_adults', 'no_of_children', 'start_date', 'end_date', 'total')
                    ->where('agent_id', $agentId)
                    ->whereIn('type_service', [4, 6])
                    ->where('start_date', '>=', $fromDate)
                    ->where('end_date', '<=', $toDate)
                    ->get();
            }
            $agents = User::select('id', 'name', 'status', 'country')->where('status', 4)->where('country', 'VN')->get();
            if ($data['counsellor'] != 'null') {
                $counsellor_id = $data['counsellor'];
            } else {
                $counsellor_id = null;
            }
            $comReportCheck = ComReport::where('from_date', $fromDate)
                ->where('to_date', $toDate)
                ->where('agent_id', $agentId)
                ->where('counsellor_id', $counsellor_id)
                ->where('report_type', $data['currency'])
                ->where('report_name', $data['view'])
                ->first();
            $status = 'off';
            if (!empty($comReportCheck)) {
                $status = 'on';
            }
            $counsellors = Person::select('id', 'name', 'position')->where('position', 'Counsellor')->get();
            $data = [
                'agentId' => $agentId,
                'fromDate' => $fromDate,
                'toDate' => $toDate,
                'agents' => $agents,
                'gst' => $gst,
                'status' => $status,
                'view' => $data['view'],
                'currency' => $data['currency'],
                'counsellorId' => $data['counsellor'],
                'view' => $data['view'],
                'counsellors' => $counsellors,
                'newComReportId' => $newComReportId,
                'flag' => $flag,
                'reports' => $reports,
            ];
        } else {
            $flag = 'commission-report';
            $agents = User::select('id', 'name', 'status', 'country')->where('status', 4)->where('country', 'VN')->get();
            $counsellors = Person::select('id', 'name', 'position')->where('position', 'Counsellor')->get();
            $data = [
                'agents' => $agents,
                'counsellors' => $counsellors,
                'flag' => $flag
            ];
        }
        // resources/views/CRM/pages/commission-report/index.blade.php
        return view('CRM.pages.commission-report.index', $data);
    }

    public function export($agentId, $fromDate, $toDate, $currency, $counsellor)
    {
        return Excel::download(new CommissionReportMultiSheetExport($agentId, $fromDate, $toDate, $currency, $counsellor), 'ComissionReport.xlsx');
    }

    public function save(SaveCommissionReportRequest $request)
    {
        $validated = $request->validated();
        if ($validated) {
            $data = $request->all();
            #create or update your data here
            $approvedComReport =  new ApprovedComReport();
            $approvedComReport->agent_id = $data['agentId'];
            $approvedComReport->month = date('m');
            $approvedComReport->year = date('Y');
            $approvedComReport->from_date = $data['fromDate'];
            $approvedComReport->to_date = $data['toDate'];
            $approvedComReport->amount = $data['amount'];
            $approvedComReport->checked_by = Auth::user()->id;
            $approvedComReport->checked_date = Carbon::now();
            $approvedComReport->approved_by = '';
            $approvedComReport->emailed_date = Carbon::now();
            $approvedComReport->paid_date = '';
            $approvedComReport->created_by = Auth::user()->id;
            $approvedComReport->updated_by = Auth::user()->id;
            $approvedComReport->save();
            $filename = $data['type'] . $approvedComReport->id;
            if ($data['type'] == 'insurance') {
                $approvedComReport->report_type = 2;
                Excel::store(new VisitorInsuranceReport($data['agentId'], $data['fromDate'], $data['toDate'], $data['typeOfReport'], $data['counsellor']), 'excelFiles/'.$filename.'.xlsx', 'excel_public');
            } else {
                $approvedComReport->report_type = 1;
                Excel::store(new OshcReportExport($data['agentId'], $data['fromDate'], $data['toDate'], $data['typeOfReport'], $data['counsellor']), 'excelFiles/'.$filename.'.xlsx', 'excel_public');
            }
            $approvedComReport->report_file = '/public/excelFiles/'.$filename.'.xlsx';
            $approvedComReport->save();
            if ($data['counsellor'] != 'null') {
                $counsellor_id = $data['counsellor'];
            }else {
                $counsellor_id = null;
            }
            $comReportCheck = ComReport::where('from_date', $data['fromDate'])
                ->where('to_date', $data['toDate'])
                ->where('agent_id', $data['agentId'])
                ->where('counsellor_id', $counsellor_id)
                ->where('report_type', $data['typeOfReport'])
                ->where('report_name', $data['type'])
                ->first();
            if (!empty($comReportCheck)) {
                $comReportCheck->approved_com_id = $approvedComReport->id;
                $comReportCheck->updated_by = Auth::user()->username;
                $comReportCheck->save();
            }
            $dataJson = ['message' => 'Save Success'];
            return response()->json($dataJson, 200);
        } else {
            $dataJson = ['message' => "Can't find Item"];
            return response()->json($dataJson, 404);
        }
    }

    public function check(Request $request)
    {
//        dd(ComReportDetails::truncate());die;
        $data = $request->all();
        #create or update your data here
        if ($data['counsellor'] != 'null') {
            $counsellor_id = $data['counsellor'];
        }else {
            $counsellor_id = null;
        }
        $comReportCheck = ComReport::where('from_date', $data['fromDate'])
            ->where('to_date', $data['toDate'])
            ->where('agent_id', $data['agentId'])
            ->where('counsellor_id', $counsellor_id)
            ->where('report_type', $data['typeOfReport'])
            ->where('report_name', $data['type'])
            ->first();
        if ($data['status'] == 'on') {
            if (empty($comReportCheck)) {
                $comReport = new ComReport();
                $comReport->from_date = $data['fromDate'];
                $comReport->to_date = $data['toDate'];
                $comReport->agent_id = $data['agentId'];
                $comReport->counsellor_id = $counsellor_id;
                $comReport->approved_com_id = null;
                $comReport->report_type = $data['typeOfReport'];
                $comReport->report_name = $data['type'];
                $comReport->created_by = Auth::user()->username;
                $comReport->updated_by = Auth::user()->username;
                $comReport->save();
                if ($data['type'] == 'oshc') {
                    $this->createOshcDetail($data, $comReport->id);
                } else if ($data['type'] == 'insurance') {
                    $this->createInsuranceDetail($data, $comReport->id);
                }
            } else {
                $checkDetail = ComReportDetails::where('com_report_id', $comReportCheck->id)->delete();
                if ($data['type'] == 'oshc') {
                    $this->createOshcDetail($data, $comReportCheck->id);
                } else if ($data['type'] == 'insurance') {
                    $this->createInsuranceDetail($data, $comReportCheck->id);
                }
            }
            $dataJson = ['message' => 'Save Success'];
            return response()->json($dataJson, 200);
        } else {
            ComReportDetails::where('com_report_id', $comReportCheck->id)->delete();
            $comReportCheck->delete();
            $dataJson = ['message' => 'Delete Success'];
            return response()->json($dataJson, 200);
        }


    }

    public function createOshcDetail($data, $comReportId) {
        $reports = DB::select("CALL create_commission_report(:agent_id, :from_date, :to_date)", [
            'agent_id' => $data['agentId'],
            'from_date' => $data['fromDate'],
            'to_date' => $data['toDate']
        ]);
        foreach ($reports as $report) {
            $comReportDetail = new ComReportDetails();
            $comReportDetail->com_report_id = $comReportId;
            $comReportDetail->fullname = $report->full_name;
            $comReportDetail->service = $report->service;
            $comReportDetail->provider = $report->provider;
            if (isset($report->policy_no)) {
                $comReportDetail->policy = $report->policy_no;
            } else {
                $comReportDetail->policy = '';
            }
            $comReportDetail->no_of_adults = $report->no_of_adults;
            $comReportDetail->no_of_children = $report->no_of_children;
            $comReportDetail->amount = $report->amount;
            $comReportDetail->com_percent = $report->comm;
            $comReportDetail->com = 0;
            $comReportDetail->total = $report->total_amount;
            $comReportDetail->total_AUD = $report->total_amount_AUD;
            $comReportDetail->extra = $report->pay_agent_extra;
            $comReportDetail->exchange_rate = 0;
            $comReportDetail->gst = $report->gst;
            $comReportDetail->comm_inc_gst = $report->comm_inc_gst;
            $comReportDetail->comm_exc_gst = $report->comm_exc_gst;
            $comReportDetail->recall_com = $report->recall_com;
            $comReportDetail->bonus = $report->bonus;
            $comReportDetail->com_status = $report->comm_status;
            $comReportDetail->visa_status = $report->visa_status_text;
            if (isset($comReportDetail->note)) {
                $comReportDetail->note = $report->note;
            } else {
                $comReportDetail->note = '';
            }
            $comReportDetail->date_of_payment = $report->date_of_payment;
            $comReportDetail->start_date = $report->start_date;
            $comReportDetail->end_date = $report->end_date;
            $comReportDetail->created_by = Auth::user()->username;
            $comReportDetail->updated_by = Auth::user()->username;
            $comReportDetail->save();
        }
    }

    public function createInsuranceDetail($data, $comReportId) {
        $reports = Apply::select('id',
            'agent_id',
            'type_service',
            'provider_id',
            'policy',
            'no_of_adults',
            'no_of_children',
            'start_date',
            'end_date',
            'total')->where('agent_id', $data['agentId'])
            ->whereIn('type_service', [4, 6])
            ->where('start_date', '>=', $data['fromDate'])
            ->where('end_date', '<=', $data['toDate'])
            ->get();
        foreach ($reports as $report) {
            if (isset($data['counsellor']) && $data['counsellor'] != "null") {
                if(isset($report->customer->person_counsellor_id) && $report->customer->person_counsellor_id == $data['counsellor']) {
            }
                if (isset($report->hoahong->policy_status)) {
                    if ($report->hoahong->policy_status == 1) {
                        $com_status = 'Done';
                    } elseif ($report->hoahong->policy_status == 2) {
                        $com_status = 'Customer Bank';
                    } elseif ($report->hoahong->policy_status == 3) {
                        $com_status = 'Monthly deduct';
                    } elseif ($report->hoahong->policy_status == 4) {
                        $com_status = 'Monthly deduct - Annalink';
                    } else {
                        $com_status = '';
                    }
                } else {
                    $com_status = '';
                }

                if (isset($report->profit->visa_status)) {
                    if ($report->profit->visa_status == 1) {
                        $visa_status = 'Granted';
                    } elseif ($report->profit->visa_status == 2) {
                        $visa_status = 'Not yet';
                    } elseif ($report->profit->visa_status == 3) {
                        $visa_status = 'Failed / Cancelled';
                    } elseif ($report->profit->visa_status == 4) {
                        $visa_status = 'Cancel';
                    } else {
                        $visa_status = '';
                    }
                } else {
                    $visa_status = '';
                }
                $comReportDetail = new ComReportDetails();
                $comReportDetail->com_report_id = $comReportId;
                if (isset($report->customer)) {
                    $comReportDetail->fullname = $report->customer->first_name . ' ' . $report->customer->last_name;
                } else {
                    $comReportDetail->fullname = '';
                }
                if (isset($report->serviceReport->name)) {
                    $comReportDetail->provider = $report->serviceReport->name;
                } else {
                    $comReportDetail->provider = '';
                }
                if (isset($report->dichvu->name)) {
                    $comReportDetail->service = $report->dichvu->name;
                } else {
                    $comReportDetail->service = '';
                }
                if (isset($report->dichvu->policy_no)) {
                    $comReportDetail->policy = $report->dichvu->policy_no;
                } else {
                    $comReportDetail->policy = 0;
                }
                if (isset($report->no_of_adults)) {
                    $comReportDetail->no_of_adults = $report->no_of_adults;
                } else {
                    $comReportDetail->no_of_adults = 0;
                }
                if (isset($report->no_of_children)) {
                    $comReportDetail->no_of_children = $report->no_of_children;
                } else {
                    $comReportDetail->no_of_children = 0;
                }
                if (isset($report->total)) {
                    $comReportDetail->amount = $report->total;
                } else {
                    $comReportDetail->amount = 0;
                }
                if (isset($report->commission->comm)) {
                    $comReportDetail->com_percent = $report->commission->comm;
                } else {
                    $comReportDetail->com_percent = 0;
                }
                if (isset($report->total)) {
                    $comReportDetail->com = round($report->total * ($report->commission->comm / 100), 2);
                } else {
                    $comReportDetail->com = 0;
                }

                if (isset($report->profit->pay_agent_extra)) {
                    $comReportDetail->extra = $report->profit->pay_agent_extra;
                } else {
                    $comReportDetail->extra = 0;
                }
                $comReportDetail->gst = 0;
                $comReportDetail->comm_inc_gst = 0;
                $comReportDetail->comm_exc_gst =0;
                if (isset($report->hoahong->issue_date)) {
                    $comReportDetail->date_of_policy = $report->hoahong->issue_date;
                } else {
                    $comReportDetail->date_of_policy = '';
                }
                if (isset($report->refund->refund_amount_com_agent_gbcfa) && isset($report->refund->std_status) && $report->refund->std_status == 1) {
                    $comReportDetail->recall_com = $report->refund->refund_amount_com_agent_gbcfa;
                } else {
                    $comReportDetail->recall_com = 0;//k hieu???
                }
                if (isset($report->customer->exchange_rate)) {
                    $comReportDetail->exchange_rate = $report->customer->exchange_rate;
                } else {
                    $comReportDetail->exchange_rate = 0;
                }

                if (isset($report->profit->pay_agent_bonus)) {
                    $comReportDetail->bonus = $report->profit->pay_agent_bonus;
                } else {
                    $comReportDetail->bonus = 0;
                }

                if ($comReportDetail->recall_com  == 0) {
                    $totalAUD = $comReportDetail->com + $comReportDetail->bonus + $comReportDetail->extra;
                } else {
                    $totalAUD = $comReportDetail->com;
                }
                $comReportDetail->total_AUD = $totalAUD;
                $comReportDetail->total = $totalAUD * $comReportDetail->exchange_rate;
                $comReportDetail->com_status = $com_status;
                $comReportDetail->visa_status = $visa_status;
                if (isset($report->refund->refund_provider_date)) {
                    $comReportDetail->date_of_payment = $report->refund->refund_provider_date;
                } else {
                    $comReportDetail->date_of_payment = '';
                }
                if (isset($report->refund->note)) {
                    $comReportDetail->note = $report->refund->note;
                } else {
                    $comReportDetail->note = '';
                }
                $comReportDetail->start_date = $report->start_date;
                $comReportDetail->end_date = $report->end_date;
                $comReportDetail->created_by = Auth::user()->username;
                $comReportDetail->updated_by = Auth::user()->username;
                $comReportDetail->save();
            if (isset($data['counsellor']) && $data['counsellor'] != "null") {
                }
            }
        }
        dd($reports);
    }
}
