<?php

namespace App\Http\Controllers;

use App\Admin\Person;
use App\User;
use Illuminate\Support\Facades\DB;
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
        DB::select("CALL create_commission_report(".$agentId.",".$fromDate.",".$toDate.")");
        $reports = DB::table('tmp_comm_report')->get();
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
}
