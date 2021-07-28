<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Admin;
use App\Admin\Promotion;

class TemplatePromotion implements FromCollection,WithHeadings,ShouldAutoSize
{
   
    public function __construct()
    {
        
    }

   public function collection()
    {
        $data_file=[];
        
        $data = Promotion::orderby('created_at', 'desc')->get();
        foreach($data as $tmp){
            $arr_tmp = [];
            $arr_tmp['Name'] = $tmp->name;
            $arr_tmp['Start date'] = $tmp->start_date;
            $arr_tmp['End date'] = $tmp->end_date;
            $arr_tmp['Code'] = $tmp->code;
            $arr_tmp['Amount'] = $tmp->amount;
            $arr_tmp['Created at'] = $tmp->created_at;

            $data_file[] =  $arr_tmp; 
        }
        return collect($data_file);
    }

    /**
     * @return array
     */
    public function headings(): array
    {   

        return [
            'Name',
            'Start date',
            'End date',
            'Code',
            'Amount',
            'Created at',
        ];
    }
}
