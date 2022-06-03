<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExcel implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //do something
        return  DB::table('applies')->select('ref_no', 'agent_id')->where('agent_id', '0')->get();
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
          'ref_no',
          'agent'
        ];
    }
}
