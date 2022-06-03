<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Admin;
use App\Admin\ExchangRate;

class TemplateExchangeRate implements FromCollection,WithHeadings,ShouldAutoSize
{
   
    public function __construct()
    {
        
    }

    public function collection()
    {
        $data_file=[];
        $condition = session()->get('data_fillter_exchange');
        $query = ExchangRate::where('id', '>', 0);
        if(isset($condition) && $condition != null){
            if($condition['month'] != 'all'){
                $query = $query->where('month', $condition['month']);
            }
            if($condition['year'] != 'all'){
                $query = $query->where('year', $condition['year']);
            }
            if($condition['type'] != 'all'){
                $query = $query->where('type', $condition['type']);
            }
            if($condition['admin'] != 'all'){
                $query = $query->where('created_by', $condition['admin']);
            }
        }
        $data = $query->get();
        foreach($data as $tmp){
            $arr_tmp = [];
            $arr_tmp['Month'] = isset(config('date-time.month')[$tmp->month]) ? config('date-time.month')[$tmp->month] : '';
            $arr_tmp['Year'] = isset(config('date-time.year')[$tmp->year]) ? config('date-time.year')[$tmp->year] : '';
            $arr_tmp['Unit'] = isset(config('myconfig.currency')[$tmp->unit]) ? config('myconfig.currency')[$tmp->unit] : '';
            $arr_tmp['Value'] = $tmp->rate;
            $arr_tmp['Type'] = isset(config('myconfig.type_exchange')[$tmp->type]) ? config('myconfig.type_exchange')[$tmp->type] : '';
            $arr_tmp['Created by'] = $tmp->staffCreate != null ? $tmp->staffCreate->username : '';
            $arr_tmp['Created at'] = $tmp->created_at;
            $arr_tmp['Updated by'] = $tmp->staffUpdate != null ? $tmp->staffUpdate->username : '';
            $arr_tmp['Updated at'] = $tmp->updated_at;
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
            'Month',
            'Year',
            'Unit',
            'Value',
            'Type',
            'Created by',
            'Created at',
            'Update by',
            'Updated by',
        ];
    }
}
