<?php

namespace App\Http\Controllers;

use App\Admin\Person;
use App\User;
use App\Admin\Apply;
use App\Admin\Customer;
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

    public function create($agentId, $fromDate, $toDate, Request $request)
    {
        $customer = Customer::pluck('person_counsellor_id')->toArray();
//        dd(array_unique($customer));
        $data = $request->all();
        $flag = 'commission-report';
        $reports = DB::select("CALL create_commission_report(:agent_id, :from_date, :to_date)", [
            'agent_id' => $agentId,
            'from_date' => $fromDate,
            'to_date' => $toDate
        ]);
        $gst = User::select('id', 'gst')->where('id', $agentId)->first();

        $insuranceRreports = Apply::select('id', 'agent_id', 'type_service', 'provider_id', 'policy', 'no_of_adults', 'no_of_children', 'start_date', 'end_date', 'total')
            ->where('agent_id', $agentId)
            ->whereIn('type_service', [4, 6])
            ->where('start_date', '>=', $fromDate)
            ->where('end_date', '<=', $toDate)
            ->get();
        $agents = User::select('id', 'name', 'status', 'country')->where('status', 4)->where('country', 'VN')->get();
        $counsellors = Person::select('id', 'name', 'position')->where('position', 'Counsellor')->get();
        $data = [
            'agentId' => $agentId,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'agents' => $agents,
            'gst' => $gst,
            'currency' => $data['currency'],
            'counsellorId' => $data['counsellor'],
            'counsellors' => $counsellors,
            'flag' => $flag,
            'reports' => $reports,
            'insuranceRreports' => $insuranceRreports
        ];
        return view('CRM.pages.commission-report.index', $data);
    }

    public function export($agentId, $fromDate, $toDate, $currency, $counsellor)
    {
        return Excel::download(new OshcReportExport($agentId, $fromDate, $toDate, $currency, $counsellor), 'ComissionReport.xlsx');
    }

}
