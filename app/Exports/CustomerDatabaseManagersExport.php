<?php

namespace App\Exports;

use App\CustomerDatabaseManager;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerDatabaseManagersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CustomerDatabaseManager::all();
    }
}
