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
    private $currency;
    private $counsellor;

    public function __construct($agentId, $fromDate, $toDate, $currency, $counsellor)
    {
        $this->agentId = $agentId;
        $this->fromDate  = $fromDate;
        $this->toDate  = $toDate;
        $this->currency  = $currency;
        $this->counsellor  = $counsellor;
    }

    public function registerEvents(): array
    {
        return [
            BeforeWriting::class => function(BeforeWriting $event) {
                $gst = User::select('id', 'gst')->where('id', $this->agentId)->first();
                if ($this->currency != 'null') {
                    if ($this->currency == 'VND' && $this->counsellor != 'null') {
                        $templateFile = new LocalTemporaryFile(public_path('oshc/VND-counsellor.xlsx'));
                    } elseif ($this->currency == 'VND' && $this->counsellor == 'null') {
                        $templateFile = new LocalTemporaryFile(public_path('oshc/VND.xlsx'), 'cre');
                    } elseif ($this->currency == 'AUD' && $gst->gst < 1) {
                        $templateFile = new LocalTemporaryFile(public_path('oshc/AUD-exgst.xlsx'));
                    } elseif ($this->currency == 'AUD' && $gst->gst > 1) {
                        $templateFile = new LocalTemporaryFile(public_path('oshc/AUD-ingst.xlsx'));
                    }
                }

                $event->writer->reopen($templateFile, Excel::XLSX);
                $sheet = $event->writer->getSheetByIndex(0);

                $this->populateSheet($sheet, $gst);

                $event->writer->getSheetByIndex(0)->export($event->getConcernable()); // call the export on the first sheet

                return $event->getWriter()->getSheetByIndex(0);
            },
        ];
    }

    private function populateSheet($sheet, $gst)
    {
        $reports = DB::select("CALL create_commission_report(:agent_id, :from_date, :to_date)", [
            'agent_id' => $this->agentId,
            'from_date' => $this->fromDate,
            'to_date' => $this->toDate
        ]);
        $agent = User::where('id', $this->agentId)->first();
        $sheet->setCellValue('b3', $agent->name);
        $sheet->setCellValue('b4', Carbon::parse($this->fromDate)->format('d/m/Y').'-'. Carbon::parse($this->toDate)->format('d/m/Y'));
        $columns = ['A', 'B', 'C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','X','Y','Z','AA','AB'];
        $startRow = 7;
        $total = 0;
        foreach ($reports as $report) {
            if ($this->counsellor != "null" ) {
                if (isset($report->customer->person_counsellor_id) && $report->customer->person_counsellor_id == $this->counsellor) {
                    $key = 0;
                    // Populate the static cells
                    foreach ($report as $nameField => $value) {
                        if ($nameField == 'start_date' || $nameField == "end_date" || $nameField == 'date_of_policy') {
                            $sheet->setCellValue($columns[$key] . $startRow, Carbon::parse($value)->format('d/m/Y'));
                        } else {
                            $sheet->setCellValue($columns[$key] . $startRow, $value);
                        }
                        if ($nameField == 'total_amount_AUD') {
                            $total = $total + $value;
                        }
                        if ($this->currency != 'AUD' && $gst->gst > 1) {
                            if ($nameField == 'comm_inc_gst') {
                                $sheet->setCellValue($columns[$key] . $startRow, $report['comm_exc_gst']);
                            }
                            if ($nameField == 'comm_exc_gst') {
                                $sheet->setCellValue($columns[$key] . $startRow, $report['comm_inc_gst']);
                            }
                        }
                        $key++;
                    }
                    $startRow++;
                }
            } else {
                $key = 0;
                // Populate the static cells
                foreach ($report as $nameField => $value) {
                    if ($nameField == 'start_date' || $nameField == "end_date" || $nameField == 'date_of_policy') {
                        $sheet->setCellValue($columns[$key] . $startRow, Carbon::parse($value)->format('d/m/Y'));
                    } else {
                        $sheet->setCellValue($columns[$key] . $startRow, $value);
                    }
                    if ($nameField == 'total_amount_AUD') {
                        $total = $total + $value;
                    }
                    if ($this->currency != 'AUD' && $gst->gst > 1) {
                        if ($nameField == 'comm_inc_gst') {
                            $sheet->setCellValue($columns[$key] . $startRow, $report['comm_exc_gst']);
                        }
                        if ($nameField == 'comm_exc_gst') {
                            $sheet->setCellValue($columns[$key] . $startRow, $report['comm_inc_gst']);
                        }
                    }
                    $key++;
                }
                $startRow++;
            }
        }
        $sheet->mergeCells('A'.$startRow.':Q'.$startRow);

        $sheet->setCellValue('A'.$startRow, 'Total');
        $sheet->setCellValue('T'.$startRow, $total);
    }

}
