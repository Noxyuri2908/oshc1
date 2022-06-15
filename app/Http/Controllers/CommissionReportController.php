<?php

namespace App\Http\Controllers;

use App\Admin\Person;
use App\User;
use App\Admin\Apply;
use App\Admin\Customer;
use App\Admin\ApprovedComReport;
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
        $newComReport = ApprovedComReport::latest('id')->first();
        if (!empty($newComReport)) {
            $newComReportId = $newComReport->id;
        } else {
            $newComReportId = 1;
        }
        $data = $request->all();
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
        $counsellors = Person::select('id', 'name', 'position')->where('position', 'Counsellor')->get();
        $data = [
            'agentId' => $agentId,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'agents' => $agents,
            'gst' => $gst,
            'currency' => $data['currency'],
            'counsellorId' => $data['counsellor'],
            'view' => $data['view'],
            'counsellors' => $counsellors,
            'newComReportId' => $newComReportId,
            'flag' => $flag,
            'reports' => $reports,
        ];
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

            $dataJson = ['message' => 'Save Success'];
            return response()->json($dataJson, 200);
        } else {
            $dataJson = ['message' => "Can't find Item"];
            return response()->json($dataJson, 404);
        }
    }
}
