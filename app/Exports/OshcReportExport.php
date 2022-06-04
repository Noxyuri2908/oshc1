<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OshcReportExport implements WithEvents, WithHeadings, WithCustomStartCell, ShouldAutoSize, WithStyles
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

                $this->populateSheet($sheet);

                $event->writer->getSheetByIndex(1)->export($event->getConcernable()); // call the export on the first sheet

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
        foreach ($reports as $report) {
            $key = 0;

            // Populate the static cells
            foreach ($report as $value) {
                $sheet->setCellValue($columns[$key] . $startRow, $value);
                $key ++;
//                $sheet->setCellValue('A2', Carbon::now()->format('Y-m-d'));
            }

            $startRow++;
        }
    }

    public function headings(): array
    {
        $reports = DB::select("CALL create_commission_report(:agent_id, :from_date, :to_date)", [
            'agent_id' => $this->agentId,
            'from_date' => $this->fromDate,
            'to_date' => $this->toDate
        ]);
        $listname = [];
        foreach ($reports[0] as $key=>$value) {
            $listname[] = $key;
        }
        return $listname;
    }

    public function startCell(): string
    {
        return 'A6';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            6    => ['font' => ['bold' => true, 'size' => 12]],

        ];
    }
}
