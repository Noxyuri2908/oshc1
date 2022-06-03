<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CommissionReportMultiSheetExport implements WithMultipleSheets
{
    use Exportable;

    protected $agentId;
    protected $fromDate;
    protected $toDate;

    public function __construct($agentId, $fromDate, $toDate)
    {
        $this->agentId = $agentId;
        $this->fromDate  = $fromDate;
        $this->toDate  = $toDate;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new OshcReportExport($this->agentId, $this->fromDate, $this->toDate);
        $sheets[] = new ACCIReport();
        $sheets[] = new HomestayReport();
        $sheets[] = new FlywireReport();
        $sheets[] = new PTEReport();
        $sheets[] = new VisitorInsuranceReport();

        return $sheets;
    }
}
