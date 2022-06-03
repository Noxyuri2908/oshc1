<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Apply;
use App\Admin\ExchangRate;
use App\Admin\Hoahong;
use App\Admin\Profit;
use App\Admin\Refund;
use App\Exports\ApplyExport;
use App\Exports\FlywireExport;
use App\Exports\ReportExport;
use App\Exports\UsersExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use Spipu\Html2Pdf\Html2Pdf;
use TCPDF;

class ReportCrmController extends Controller
{
    //
    public function reportMonthly(Request $request)
    {
        $flag = 'report-month';
        $reportAgent = Profit::getReportAgentMonthly($request)->map(function ($query) use ($request) {
            $query->date = $query->invoice->hoahongs->first()->hoahong_month . '/' . $query->invoice->hoahongs->first()->hoahong_year;
            return $query;
        });
        return view('CRM.pages.report_monthly', compact(
            'flag',
            'reportAgent'
        ));
    }
    public function reportQuarterly(Request $request)
    {
        $flag = 'report-quarterly';
        $flywirePaymentId = 4;
        $applyIds = Apply::where('payment_method', $flywirePaymentId)->pluck('id')->toArray();
        $profits = Profit::with([
            'invoice'
        ])->whereIn('apply_id', $applyIds)->get();
        return view('CRM.pages.report_quarterly', compact(
            'flag',
            'profits'
        ));
    }
    public function exportExcel(Request $request)
    {
        // $data = $request->all();
        $reportAgent = Profit::getReportAgent($request)->map(function ($query) use ($request) {
            $query->date = $query->invoice->hoahongs->first()->hoahong_month . '/' . $query->invoice->hoahongs->first()->hoahong_year;
            return $query;
        });
        $agents = User::get()->pluck('name', 'id');
        $array_month = getMonthYearInDateRange(convertTwoDateInputToDateRange(request()->get('start_date'), request()->get('end_date')));
        $data = [
            'reportAgent' => $reportAgent,
            'agents' => $agents,
            'array_month' => $array_month
        ];
        return FacadesExcel::download(new ReportExport("CRM.elements.report.excel_export.index", $data), 'abc.xlsx');
    }
    public function exportPdf(Request $request)
    {
        $reportAgent = Profit::getReportAgent($request)->map(function ($query) use ($request) {
            $query->date = $query->invoice->hoahongs->first()->hoahong_month . '/' . $query->invoice->hoahongs->first()->hoahong_year;
            return $query;
        });
        $agents = User::get()->pluck('name', 'id');
        $array_month = getMonthYearInDateRange(convertTwoDateInputToDateRange(request()->get('start_date'), request()->get('end_date')));
        $data = [
            'reportAgent' => $reportAgent,
            'agents' => $agents,
            'array_month' => $array_month
        ];

        $width = 2587;
        $height = 1000;
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array($width, $height), true, 'UTF-8', false);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('helvetica', 'B', 20);

        // add a page
        $pdf->AddPage();

        // $pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);

        $pdf->SetFont('helvetica', '', 8);

        // -----------------------------------------------------------------------------
        $template = view('CRM.elements.report.pdf_export.index', compact(
            'reportAgent',
            'agents',
            'array_month'
        ))->render();
        $tbl = $template;

        $pdf->writeHTML($tbl, true, false, false, false, '');
        $pdf->Output('example_048.pdf', 'I');
    }

    public function reportFlywire(Request $request)
    {
        set_time_limit(300);
        $flag = 'report-flywire';
        $agentName = '';
        if ($request->get('agent_id'))
        {
            $agentName = User::findOrFail($request->get('agent_id'))->name;
        }

        if ($request->get('type') == 'en')
        {
            $flywire = \App\Admin\Apply::getFlywireReport($request);
            return view('CRM.pages.report_flywire_en', compact('flag', 'flywire', 'agentName'))->render();
        }elseif ($request->get('type') == 'vi')
        {
            $flywire = \App\Admin\Apply::getFlywireReport($request);
            return view('CRM.pages.report_flywire_vi', compact('flag', 'flywire', 'agentName'))->render();
        }
    }

    function exportFlywire(Request $request)
    {   set_time_limit(300);
        return FacadesExcel::download((new ApplyExport)->request($request), 'flywire_export.xlsx');
    }

    function exportExcelTest(Request $request)
    {
        return FacadesExcel::download((new FlywireExport())->request($request), 'flywire_export.xlsx');
    }
}
