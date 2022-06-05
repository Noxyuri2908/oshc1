<?php

namespace App\Exports;

use App\Admin\Apply;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VisitorInsuranceReport implements WithEvents, ShouldAutoSize
{
    private $agentId;
    private $fromDate;
    private $toDate;

    public function __construct($agentId, $fromDate, $toDate)
    {
        $this->agentId = $agentId;
        $this->fromDate  = $fromDate;
        $this->toDate  = $toDate;
    }

    public function registerEvents(): array
    {
        return [
            BeforeWriting::class => function(BeforeWriting $event) {
                $templateFile = new LocalTemporaryFile(public_path('template.xlsx'));
                $event->writer->reopen($templateFile, Excel::XLSX);
                $sheet = $event->writer->getSheetByIndex(2);

                $this->populateSheet($sheet);

                $event->writer->getSheetByIndex(2)->export($event->getConcernable()); // call the export on the first sheet

                return $event->getWriter()->getSheetByIndex(2);
            },
        ];
    }

    private function populateSheet($sheet)
    {
        $reports = Apply::where('agent_id', $this->agentId)
            ->whereIn('type_service', [2,3])
            ->where('start_date', '>=', $this->fromDate)
            ->where('end_date', '<=', $this->toDate)
            ->get();
        $sheet->setCellValue('b4', 'From '.$this->fromDate.' to '. $this->toDate);
        $columns = ['A', 'B', 'C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','X','Y','Z','AA','AB'];
        $startRow = 7;
        foreach ($reports as $report) {
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
            if (isset($report->dichvu->name)) {
                $report->service = $report->dichvu->name;
            } else {
                $report->service = '';
            }
            if (isset($report->customer)) {
                $report->full_name = $report->customer->first_name . ' ' . $report->customer->last_name;
            } else {
                $report->full_name = '';
            }
            $report->cover = '';
            if (isset($report->dichvu->policy_no)) {
                $report->policy_no = $report->dichvu->policy_no;
            } else {
                $report->policy_no = 0;
            }
            $report->no_of_adults;
            $report->no_of_children;
            if (isset($report->hoahong->issue_date)) {
                $report->date_of_policy = $report->hoahong->issue_date;
            } else {
                $report->date_of_policy = 0;
            }
            $report->start_date;
            $report->end_date;
            $report->total;
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
            $key = 0;
            // Populate the static cells
            foreach ($report as $nameField=>$value) {
                if ($nameField == 'start_date' || $nameField == "end_date" || $nameField == 'date_of_policy') {
                    $sheet->setCellValue($columns[$key] . $startRow, Carbon::parse($value)->format('d/m/Y'));
                } else {
                    $sheet->setCellValue($columns[$key] . $startRow, $value);
                }
                $key ++;
            }

            $startRow++;
        }
    }
}
