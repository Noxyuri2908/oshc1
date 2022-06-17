<?php

namespace App\Http\Controllers;

use App\Admin\ComReport;
use App\EmailCategories;
use App\EmailTemplate;
use Illuminate\Http\Request;
use App\Admin\ApprovedComReport;
use App\Admin\ComReportDetails;

class ApprovedComReportController extends Controller
{
    //

    public function index()
    {
        $flag = 'com-report';
        $emailCategories = EmailCategories::all()->where('status', 1);
        $approvedReports = ApprovedComReport::all();
        $data = [
            'emailCategories' => $emailCategories,
            'approvedReports' => $approvedReports,
            'flag' => $flag
        ];

        return view('CRM.pages.approved-com-report.index', $data); // resources/views/CRM/pages/approved-com-report/index.blade.php
    }

    public function preview($id) {
        $checkedReport = ComReport::where('approved_com_id', $id)->first();
        $previewReports = ComReportDetails::where('com_report_id', $checkedReport->id)->get();
        $flag = 'preview-com-report';

        $data = [
            'flag' => $flag,
            'previewReports' => $previewReports,
        ];

        return view('CRM.pages.approved-com-report.preview', $data);
    }
}
