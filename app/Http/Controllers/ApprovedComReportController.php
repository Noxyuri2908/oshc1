<?php

namespace App\Http\Controllers;

use App\EmailCategories;
use App\EmailTemplate;
use Illuminate\Http\Request;

class ApprovedComReportController extends Controller
{
    //

    public function index()
    {
        $flag = 'com-report';
        $emailCategories = EmailCategories::all()->where('status', 1);
        return view('CRM.pages.approved-com-report.index', compact('flag', 'emailCategories')); // resources/views/CRM/pages/approved-com-report/index.blade.php
    }
}
