<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApprovedComReportController extends Controller
{
    //

    public function index()
    {
        $flag = 'com-report';
        return view('CRM.pages.approved-com-report.index', compact('flag')); // resources/views/CRM/pages/approved-com-report/index.blade.php
    }
}
