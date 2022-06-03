<?php

namespace App\Imports;

use App\Admin\Dichvu;
use App\Admin\Service;
use App\Commission;
use App\Jobs\ImportExcelComAgent;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CommissionImport implements ToCollection, WithStartRow
{
    /**
     * @param  array  $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private $errors = [];

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
            dispatch(new ImportExcelComAgent($row));
        }
    }

    public
    function rules(): array
    {
        return [
            'nullable',
            'required',
            'nullable',
            'nullable',
            'nullable',
            'nullable',
            'nullable',
            'nullable',
            'nullable',
            'nullable',
            'nullable'
        ];
    }

    public
    function validationMessages()
    {
        return [
            'required' => trans('Field :input is required'),
        ];
    }

    public
    function getErrors()
    {
        return $this->errors;
    }
}
