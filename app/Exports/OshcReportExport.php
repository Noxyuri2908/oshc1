<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OshcReportExport implements FromCollection, WithTitle, WithHeadings, WithDrawings, WithCustomStartCell, ShouldAutoSize, WithStyles
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
    /**
    * @return \Illuminate\Support\Collection
    */


    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/images/logoExcel.png'));
        $drawing->setHeight(90);
//        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function collection()
    {
        $reports = DB::select("CALL create_commission_report(:agent_id, :from_date, :to_date)", [
            'agent_id' => $this->agentId,
            'from_date' => $this->fromDate,
            'to_date' => $this->toDate
        ]);
        return collect($reports);
    }

    public function title(): string
    {
        return 'OSHC & OVHC Report';
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
