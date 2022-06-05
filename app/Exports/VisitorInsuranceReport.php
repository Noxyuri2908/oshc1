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
                $templateFile = new LocalTemporaryFile(storage_path('app/oshc-report.xlsx'));
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
        $reports = Apply::select('id',
        'agent_id',
        'type_service',
        'provider_id',
        'policy',
        'no_of_adults',
        'no_of_children',
        'start_date',
        'end_date',
        'total')->where('agent_id', $this->agentId)
            ->whereIn('type_service', [2,3])
            ->where('start_date', '>=', $this->fromDate)
            ->where('end_date', '<=', $this->toDate)
            ->get();
        $sheet->setCellValue('b4', 'From '.$this->fromDate.' to '. $this->toDate);
        $columns = ['A', 'B', 'C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','X','Y','Z','AA','AB'];
        $startRow = 7;
        foreach ($reports as $report) {
            $contents = [];
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
                $contents['service'] = $report->dichvu->name;
            } else {
                $contents['service'] = '';
            }
            if (isset($report->customer)) {
                $contents['full_name'] = $report->customer->first_name . ' ' . $report->customer->last_name;
            } else {
                $contents['full_name'] = '';
            }
            if (isset($report->serviceReport->name)) {
                $contents['provider'] = $report->serviceReport->name;
            } else {
                $contents['provider'] = '';
            }

            $contents['cover'] = '';
            if (isset($report->dichvu->policy_no)) {
                $contents['policy_no'] = $report->dichvu->policy_no;
            } else {
                $contents['policy_no'] = 0;
            }
            $contents['no_of_adults_sort'] = $report->no_of_adults;
            $contents['no_of_children_sort'] = $report->no_of_children;
            if (isset($report->hoahong->issue_date)) {
                $contents['date_of_policy'] = $report->hoahong->issue_date;
            } else {
                $contents['date_of_policy'] = '0000/00/00';
            }
            $contents['start_date_sort'] = $report->start_date;
            $contents['end_date_sort'] = $report->end_date;
            $contents['total_sort'] = $report->total;
            if (isset($report->commission->comm)) {
                $contents['comm_percent'] = $report->commission->comm;
            } else {
                $contents['comm_percent'] = 0;
            }
            if (isset($report->total)) {
                $contents['comm_vnd'] = $report->total * ($report->commission->comm / 100);
            } else {
                $contents['comm_vnd'] = 0;
            }
            if (isset($report->profit->pay_agent_bonus)) {
                $contents['bonus'] = $report->profit->pay_agent_bonus;
            } else {
                $contents['bonus'] = 0;
            }
            if (isset($report->profit->pay_agent_extra)) {
                $contents['pay_agent_extra'] = $report->profit->pay_agent_extra;
            } else {
                $contents['pay_agent_extra'] = 0;
            }
            $contents['recall_com'] = 0;//k hieu???
            $contents['total_vnd'] = $report->comm_vnd + $report->bonus + $report->pay_agent_extra;
            $contents['comm_status'] = $com_status;
            $contents['visa_status'] = $visa_status;
            $contents['date_of_payment'] = '';
            $contents['note'] = '';
            $key = 0;
            // Populate the static cells
            foreach ($contents as $nameField=>$value) {
                if ($nameField == 'start_date_sort' || $nameField == "end_date_sort" || $nameField == 'date_of_policy') {
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
