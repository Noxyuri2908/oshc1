<?php

namespace App\Jobs;

use App\Admin\QueueErrorLogs;
use App\Imports\AgentImport;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportExcelAgent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $rowData;

    public function __construct($rowData)
    {
        //
        //$this->file = $file;
        $this->rowData =$rowData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $row = $this->rowData;
        $validator = Validator::make($row,$this->rules(),$this->validationMessages());
        if($validator->fails()){
            foreach ($validator->errors()->messages() as $messages) {
                foreach ($messages as $error) {
                    // accumulating errors:
                    $this->errors[] = $error;
                    QueueErrorLogs::create([
                        'model' =>User::class,
                        'exception'=>$error
                    ]);
                }
            }
        }else{
            $typeAgent = config('admin.type_agent');
            $userStatus = config('admin.status');
            $infoMarket = config('myconfig.market');
            $countries = config('country.list');
            $departments = config('myconfig.department');
            $admins = \App\Admin::where('username', $row[13])->first();

            $typeOfAgentData = collect($typeAgent)->filter(function ($item) use ($row) {
                if (!empty($row[2])) {
                    return false !== stristr(\Str::ascii($row[2]), \Str::ascii($item));
                }
            })->toArray();

            $userStatusData = collect($userStatus)->filter(function ($item) use ($row) {
                if (!empty($row[3])) {
                    return false !== stristr(\Str::ascii($item), \Str::ascii($row[3]));
                }
            })->toArray();

            $infoMarketData = '';
            $dataArrMarket = explode(', ', $row[4]);
            foreach ($dataArrMarket as $one) {
                $arrOneValue = [];
                if (!empty($one)) {
                    $infoMarketDataArr = array_map('strval',collect($infoMarket)->filter(function ($item) use ($one) {
                        if (!empty($one)) {
                            return false !== stristr(\Str::ascii($item), \Str::ascii($one));
                        }
                    })->keys()->all());
                    $infoMarketData = json_encode($infoMarketDataArr);
                }else{
                    $infoMarketData = null;
                }
            }

            $countriesData = collect($countries)->filter(function ($item) use ($row) {
                if (!empty($row[9])) {
                    return false !== stristr(\Str::ascii($item), \Str::ascii($row[9]));
                }
            })->toArray();

            $departmentsData = collect($departments)->filter(function ($item) use ($row) {
                if (!empty($row[12])) {
                    return false !== stristr(\Str::ascii($item), \Str::ascii($row[12]));
                }
            })->toArray();
            if ($row[0] != null) {
                $user = User::create([
                    'name' => $row[0],
                    'status' => !empty($userStatusData) ? array_keys($userStatusData)[0] : null,
                    'email' => $row[5],
                    'staff_id' => !empty($admins) ? $admins->id : null,
                    'created_by' => null,
                    'note1'=>$row[16],
                    'note2'=>$row[17],
                    'agent_code' => $row[1],
                    'type_id' => !empty($typeOfAgentData) ? array_keys($typeOfAgentData)[0] : null,
                    'market_id' => $infoMarketData,
                    'tel_1' => $row[6],
                    'tel_2' => $row[7],
                    'website' => $row[8],
                    'country' => !empty($countriesData) ? array_keys($countriesData)[0] : null,
                    'city' => $row[10],
                    'office' => $row[11],
                    'department' => !empty($departmentsData) ? array_keys($departmentsData)[0] : null,
                    'registered_date' => !empty($row[14])?Carbon::parse(Date::excelToDateTimeObject($row[14]))->format('d/m/Y'):null,
                ]);
            }
        }

    }

    public function rules(): array
    {
        return [
            'required|string',
            'nullable',
            'nullable',
            'nullable',
            'nullable',
            'nullable|unique:users,email|sometimes'
        ];
    }
    public function getErrors()
    {
        return $this->errors;
    }
    public function validationMessages()
    {
        return [
            'required' => trans('user. :attribute name_is_required'),
            'unique' => 'user.email :input has already been taken',
        ];
    }
}
