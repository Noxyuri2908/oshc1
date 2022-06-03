<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ReportExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $view;
    public $data;
    public $reportAgent;
    public $agents;
    public $array_month;

    public function __construct($view, $reportAgent, $agents, $array_month)
    {
        $this->view = $view;
        $this->reportAgent = $reportAgent;
        $this->agents = $agents;
        $this->array_month = $array_month;
    }
    public function view(): View
    {
        return view($this->view, [
            'reportAgent' => $this->reportAgent,
            'agents' => $this->agents,
            'array_month' => $this->array_month,
        ]);
    }
}
