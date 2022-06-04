<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use Maatwebsite\Excel\Excel;

class TestReport implements WithEvents
{
    public function __construct()
    {
    }

    public function registerEvents(): array
    {
        return [
            BeforeWriting::class => function(BeforeWriting $event) {
                $templateFile = new LocalTemporaryFile(public_path('ReportComission.xlsx'));
                $event->writer->reopen($templateFile, Excel::XLSX);
                $sheet = $event->writer->getSheetByIndex(1);

                $this->populateSheet($sheet);

                $event->writer->getSheetByIndex(0)->export($event->getConcernable()); // call the export on the first sheet

                return $event->getWriter()->getSheetByIndex(0);
            },
        ];
    }

    private function populateSheet($sheet){

        // Populate the static cells
        $sheet->setCellValue('A2', Carbon::now()->format('Y-m-d'));
        $sheet->setCellValue('B2', Carbon::now()->format('Y-m-d'));
        $sheet->setCellValue('C2', Carbon::now()->format('Y-m-d'));
        $sheet->setCellValue('D2', Carbon::now()->format('Y-m-d'));
        $sheet->setCellValue('E2', Carbon::now()->format('Y-m-d'));
        $sheet->setCellValue('F1', Carbon::now()->format('Y-m-d'));
        $sheet->setCellValue('H1', Carbon::now()->format('Y-m-d'));

    }
}
