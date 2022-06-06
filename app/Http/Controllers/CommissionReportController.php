<?php

namespace App\Http\Controllers;

use App\Admin\Person;
use App\User;
use App\Admin\Apply;
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

class CommissionReportController extends Controller
{
    public function index()
    {
        $flag = 'commission-report';
        $agents = User::select('id', 'name', 'status', 'country')->where('status', 4)->where('country', 'VN')->get();
        $counsellors = Person::select('id', 'name', 'position')->where('position', 'Counsellor')->get();
        $data = [
            'agents' => $agents,
            'counsellors' => $counsellors,
            'flag' => $flag
        ];
        // resources/views/CRM/pages/commission-report/index.blade.php
        return view('CRM.pages.commission-report.index', $data);
    }

    public function create($agentId, $fromDate, $toDate)
    {
        $flag = 'commission-report';
        $reports = DB::select("CALL create_commission_report(:agent_id, :from_date, :to_date)", [
            'agent_id' => $agentId,
            'from_date' => $fromDate,
            'to_date' => $toDate
        ]);

        $insuranceRreports = Apply::where('agent_id', $agentId)
            ->whereIn('type_service', [2,3])
            ->where('start_date', '>=', $fromDate)
            ->where('end_date', '<=', $toDate)
            ->get();
        foreach ($insuranceRreports as $report) {
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
            }else {
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
            if (isset($report->commission->comm)) {
                $report->comm_percent = $report->commission->comm;
            } else {
                $report->comm_percent = 0;
            }
            if (isset($report->total)) {
                $report->comm_vnd = $report->total * ($report->commission->comm / 100);
            } else {
                $report->comm_vnd = 0;
            }
            if (isset($report->profit->pay_agent_bonus)) {
                $report->bonus = $report->profit->pay_agent_bonus;
            } else {
                $report->bonus = 0;
            }
            if (isset($report->profit->pay_agent_extra)) {
                $report->pay_agent_extra = $report->profit->pay_agent_extra;
            } else {
                $report->pay_agent_extra = 0;
            }
            $report->recall_com = 0;//k hieu???
            $report->total_vnd = $report->comm_vnd + $report->bonus + $report->pay_agent_extra;
            $report->comm_status = $com_status;
            $report->visa_status = $visa_status;
            $report->date_of_payment = '';
            $report->note = '';
        }

        $agents = User::select('id', 'name', 'status', 'country')->where('status', 4)->where('country', 'VN')->get();
        $counsellors = Person::select('id', 'name', 'position')->where('position', 'Counsellor')->get();
        $data = [
            'agentId' => $agentId,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'agents' => $agents,
            'counsellors' => $counsellors,
            'flag' => $flag,
            'reports' => $reports,
            'insuranceRreports' => $insuranceRreports
        ];
        return view('CRM.pages.commission-report.index', $data);
    }

    public function export($agentId, $fromDate, $toDate)
    {
        return Excel::download(new OshcReportExport($agentId, $fromDate, $toDate), 'ComissionReport.xlsx');
    }

}
