<?php

namespace App\Imports;

use App\Jobs\ImportExcelAgent;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AgentImport implements ToCollection, WithStartRow
{
    /**
     * @param  array  $row
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
        foreach ($rows as $key => $row) {
            dispatch(new ImportExcelAgent($row));
        }
    }



}
