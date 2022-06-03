<?php

namespace App\Exports;

use App\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class OshcReportExport implements FromCollection, WithTitle
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
}
