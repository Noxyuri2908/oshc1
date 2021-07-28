<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Report;
use App\User;
use Session;

class ReportController extends Controller
{
    public function index()
    {
        $agents = User::where('status', 1)->get();
        $month = date("m");
        return view('back-end.report.list', ['agents' => $agents, 'month' => $month]);
    }

    public function reportByAgent($id, $month)
    {
        $agents = User::where('status', 1)->get();
        $agent = User::find($id);
        if ($agent == null) return redirect()->route('report.index');
        $reports = get_list_comm_by_month($month, $id);
        return view('back-end.report.list', ['agents' => $agents, 'month' => $month, 'agent' => $agent, 'reports' => $reports]);
    }

    public function reportAll($month)
    {
        $agents = User::where('role', 'agent')->where('status', 1)->get();
        return view('back-end.report.list', ['agents' => $agents, 'month' => $month]);
    }
}
