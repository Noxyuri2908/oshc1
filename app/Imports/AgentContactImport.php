<?php

namespace App\Imports;

use App\Admin\Person;
use App\Jobs\ImportExcelContactAgent;
use App\User;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Collection;

class AgentContactImport implements ToCollection,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }
    //public function chunkSize(): int
    //{
    //    // TODO: Implement chunkSize() method.
    //    return 200;
    //}

    public function collection(Collection $row)
    {
        $rows = $row->toArray();
        foreach($rows as $row){
            dispatch(new ImportExcelContactAgent($row));
        }
    }
}
