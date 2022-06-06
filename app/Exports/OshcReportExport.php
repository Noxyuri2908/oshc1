<?php

namespace App\Exports;

use App\Admin\Apply;
use App\Admin\ExchangRate;
use App\User;
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

class OshcReportExport implements WithEvents, ShouldAutoSize
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
                $sheet = $event->writer->getSheetByIndex(1);
                $sheet1 = $event->writer->getSheetByIndex(2);

                $this->populateSheet($sheet);
                $this->populateSheet1($sheet1);

                $event->writer->getSheetByIndex(1)->export($event->getConcernable()); // call the export on the first sheet
                $event->writer->getSheetByIndex(2)->export($event->getConcernable()); // call the export on the first sheet

                $event->getWriter()->getSheetByIndex(2);
                return $event->getWriter()->getSheetByIndex(1);
            },
        ];
    }

    private function populateSheet($sheet)
    {
        $reports = DB::select("CALL create_commission_report(:agent_id, :from_date, :to_date)", [
            'agent_id' => $this->agentId,
            'from_date' => $this->fromDate,
            'to_date' => $this->toDate
        ]);
        $sheet->setCellValue('b4', 'From '.$this->fromDate.' to '. $this->toDate);
        $columns = ['A', 'B', 'C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','X','Y','Z','AA','AB'];
        $startRow = 7;
        $total = 0;
        foreach ($reports as $report) {
            $key = 0;
            // Populate the static cells
            foreach ($report as $nameField=>$value) {
                if ($nameField == 'start_date' || $nameField == "end_date" || $nameField == 'date_of_policy') {
                    $sheet->setCellValue($columns[$key] . $startRow, Carbon::parse($value)->format('d/m/Y'));
                } else {
                    $sheet->setCellValue($columns[$key] . $startRow, $value);
                }
                if ($nameField == 'total_amount_AUD') {
                    $total = $total + $value;
                }
                $key ++;
            }
            $startRow++;
        }
        $sheet->mergeCells('A'.$startRow.':S'.$startRow);

        $sheet->setCellValue('A'.$startRow, 'Total');
        $sheet->setCellValue('T'.$startRow, $total);
    }

    private function populateSheet1($sheet)
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
            ->whereIn('type_service', [4,6])
            ->where('start_date', '>=', $this->fromDate)
            ->where('end_date', '<=', $this->toDate)
            ->get();
        $pitAgent = User::where('id', $this->agentId)->first()->pit;
        $sheet->setCellValue('b4', 'From '.$this->fromDate.' to '. $this->toDate);
        $columns = ['A', 'B', 'C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','X','Y','Z','AA','AB'];
        $startRow = 7;
        $sumTotalVnd = 0;
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
                $contents['comm_vnd'] = round($report->total * ($report->commission->comm / 100), 2 );
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
            if (isset($report->refund->refund_amount_com_agent_gbcfa) && isset($report->refund->std_status) && $report->refund->std_status == 1) {
                $contents['recall_com'] = $report->refund->refund_amount_com_agent_gbcfa;
            } else {
                $contents['recall_com'] = 0;//k hieu???
            }
            if ($contents['recall_com'] == 0) {
                $contents['total_vnd'] = $contents['comm_vnd'] + $contents['bonus'] + $contents['pay_agent_extra'];
            } else {
                $contents['total_vnd'] = $contents['recall_com'];
            }
            $sumTotalVnd = $sumTotalVnd + $contents['total_vnd'];
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
        if ($pitAgent == 1) {
            $pit = 0;
        } else {
            if ($sumTotalVnd > 2000000) {
                $pit = round($sumTotalVnd / 11, 2);
            } else {
                $pit = 0;
            }
        }

        $exchangRate = ExchangRate::where('month', Carbon::now()->month)->where('year', Carbon::now()->year)->first();
        if (isset($exchangRate->rate)) {
            $rate = $exchangRate->rate / 100;
        } else {
            $rate = 0;
        }
        $startRow1 = $startRow + 1;
        $startRow2 = $startRow + 2;
        $startRow3 = $startRow + 3;

        $sheet->mergeCells('A'.$startRow.':P'.$startRow);
        $sheet->mergeCells('A'.$startRow1.':P'.$startRow1);
        $sheet->mergeCells('A'.$startRow2.':P'.$startRow2);
        $sheet->mergeCells('A'.$startRow3.':P'.$startRow3);

        $sheet->setCellValue('A'.$startRow, 'Total (VND)');
        $sheet->setCellValue('A'.$startRow1, 'PIT (VND)');
        $sheet->setCellValue('A'.$startRow2, 'Payable amount (VND)');
        $sheet->setCellValue('A'.$startRow3, 'Payable amount (AUD)');

        $sheet->setCellValue('Q'.$startRow, $sumTotalVnd);
        $sheet->setCellValue('Q'.$startRow1, $pit);
        $sheet->setCellValue('Q'.$startRow2, $sumTotalVnd - $pit);
        $sheet->setCellValue('Q'.$startRow3, ($sumTotalVnd - $pit) * $rate);
    }
}
