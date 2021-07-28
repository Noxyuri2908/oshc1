<?php

namespace App\Jobs;

use App\Admin\Commission;
use App\Admin\Dichvu;
use App\Admin\QueueErrorLogs;
use App\Admin\Service;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportExcelComAgent implements ShouldQueue
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
        $this->rowData = $rowData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $row = $this->rowData;
        $validator = Validator::make($row, $this->rules(), $this->validationMessages());
        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $messages) {
                foreach ($messages as $error) {
                    // accumulating errors:
                    $this->errors[] = $error;
                    QueueErrorLogs::create([
                        'model' =>Commission::class,
                        'exception'=>$error
                    ]);
                }
            }
        } else {
            $agent_id = User::where('name',$row[1])->pluck('id')->first();
            if(!empty($agent_id)){
                $service = Dichvu::where('name',$row[2])->pluck('id')->first();
                $provider = Service::where('name',$row[3])->pluck('id')->first();
                $policy = collect(config('myconfig.policy'))->filter(function ($item) use ($row) {
                    if (!empty($row[4])) {
                        return stristr(\Str::ascii($item), \Str::ascii($row[4]));
                    }
                })->toArray();
                $arr_replace = ['%', '$'];
                $comm =$row[5];
                //        $donvi =
                $donvi = collect(config('myconfig.donvi'))->filter(function ($item) use ($row) {

                    if (!empty($row[6])) {
                        if (strpos($row[6], '$') !== false) {
                            return stristr(\Str::ascii($item), '$');
                        } elseif (strpos($row[6], '%') !== false) {
                            return stristr(\Str::ascii($item), '%');
                        }
                    }
                })->toArray();
                $date = (strpos($row[7],'/') !==false)?$row[7]:Carbon::parse(Date::excelToDateTimeObject($row[7]))->format('Y-m-d');
                $status = !empty($row[10]) && $row[10] == 'x' ? 1 : 0;
                $type_payment = collect(config('myconfig.type_payment'))->filter(function ($item) use ($row) {
                    if (!empty($row[8])) {
                        return stristr(\Str::ascii($item), \Str::ascii($row[8]));
                    }
                })->toArray();
                $gst = collect(config('myconfig.gst'))->filter(function ($item) use ($row) {
                    if (!empty($row[9])) {
                        return \Str::ascii($item) == \Str::ascii($row[9]);
                    }
                })->toArray();
                if(!empty($provider)){
                    \App\Admin\Commission::create([
                        'user_id' => $agent_id,
                        'provider_id' => $provider,
                        'service_id'=>$service,
                        'policy' => !empty($policy) ? array_keys($policy)[0] : null,
                        'comm' => $comm,
                        'donvi' => !empty($donvi) ? array_keys($donvi)[0] : null,
                        'validity_start_date' =>$date ,
                        'status' => $status,
                        'type_payment' => !empty($type_payment) ? array_keys($type_payment)[0] : null,
                        'gst' => !empty($gst) ? array_keys($gst)[0] : null,
                    ]);
                }else{
                    QueueErrorLogs::create([
                        'model' =>Commission::class,
                        'exception'=>'Provider not found! User : '.$row[1].' Provider : '.$row[3].' Type : '.$row[4]
                    ]);
                }

            }else{
                $this->errors[] = 'Not found agent '.$row[1];
                QueueErrorLogs::create([
                    'model' =>Commission::class,
                    'exception'=>'Not found agent '.$row[1]
                ]);
            }
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
}
