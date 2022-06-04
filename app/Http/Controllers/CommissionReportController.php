<?php

namespace App\Http\Controllers;

use App\Admin\Person;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Exports\CommissionReportExport;
use App\Exports\OshcReportExport;
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

        $agents = User::select('id', 'name', 'status', 'country')->where('status', 4)->where('country', 'VN')->get();
        $counsellors = Person::select('id', 'name', 'position')->where('position', 'Counsellor')->get();
        $data = [
            'agentId' => $agentId,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'agents' => $agents,
            'counsellors' => $counsellors,
            'flag' => $flag,
            'reports' => $reports
        ];
        return view('CRM.pages.commission-report.index', $data);
    }

    public function export($agentId, $fromDate, $toDate)
    {
        return Excel::download(new OshcReportExport($agentId, $fromDate, $toDate), 'ComissionReport.xlsx');
    }

}
