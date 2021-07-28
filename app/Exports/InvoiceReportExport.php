<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class InvoiceReportExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }
}
