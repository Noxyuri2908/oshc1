<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Admin;
use App\Admin\Shool;

class TemplateSchool implements FromCollection,WithHeadings,ShouldAutoSize
{
   
    public function __construct()
    {
        
    }

   public function collection()
    {
        $data_file=[];
        $condition = session()->get('data_fillter_school');
        $query = School::where('id', '>', 0);
        if(isset($condition) && $condition != null){
            if($condition['name'] != null && $condition['name'] != ''){
                $_tmp = mb_strtolower($condition['name'], 'UTF-8');
                $query = $query->whereRaw('lower(name) like (?)', ["%{$_tmp}%"]);
            }
            if($condition['state'] != null && $condition['state'] != ''){
                $_tmp = mb_strtolower($condition['state'], 'UTF-8');
                $query = $query->whereRaw('lower(state) like (?)', ["%{$_tmp}%"]);
            }
            if($condition['city'] != null && $condition['city'] != ''){
                $_tmp = mb_strtolower($condition['city'], 'UTF-8');
                $query = $query->whereRaw('lower(city) like (?)', ["%{$_tmp}%"]);
            }
            if($condition['country'] != 'all'){
                $query = $query->where('country', $condition['country']);
            }
        }
        $data = $query->get();
        foreach($data as $tmp){
            $arr_tmp = [];
            $arr_tmp['Name'] = $tmp->name;
            $arr_tmp['Country'] = isset(config('country.list')[$tmp->country]) ? config('country.list')[$tmp->country] : '';
            $arr_tmp['State/Region'] = $tmp->state;
            $arr_tmp['City'] = $tmp->city;
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
            'Name',
            'Country',
            'State/Region',
            'City',
            'Created by',
            'Created at',
            'Update by',
            'Updated by',
        ];
    }
}
