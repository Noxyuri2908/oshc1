<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class HomestayReport implements FromCollection, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([
            (object) [
                '0' => '',
                '1' => ''
            ],
            (object) [
                '0' => '',
                '1' => ''
            ]
        ]);
    }

    public function title(): string
    {
        return 'Homestay Report';
    }
}
