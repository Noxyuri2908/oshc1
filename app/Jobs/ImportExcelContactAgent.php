<?php

namespace App\Jobs;

use App\Admin\Person;
use App\Admin\QueueErrorLogs;
use App\User;
use Aws\Api\Validator;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportExcelContactAgent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $row;
    public function __construct($row)
    {
        //
        $this->row=$row;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $row = $this->row;
        $validator = \Illuminate\Support\Facades\Validator::make($row,$this->rules(),$this->validationMessage());
        if($validator->fails()){
            foreach ($validator->errors()->messages() as $messages){
                foreach ($messages as $error) {
                    // accumulating errors:
                    $this->errors[] = $error;
                    QueueErrorLogs::create([
                        'model' =>Person::class,
                        'exception'=>$error
                    ]);
                }
            }
        }else{

            $user_id = User::where('name', $row[0])->pluck('id')->first();
            $name = $row[1];
            $position = $row[2];
            $phone = $row[3];
            $birthday = !empty($row[4])?Carbon::parse(Date::excelToDateTimeObject($row[4]))->format('d/m/Y'):null;
            $email = $row[5];
            $skype = $row[6];
            $facebook = $row[7];
            $note = $row[8];
            if(empty($user_id)){
                QueueErrorLogs::create([
                    'model' =>Person::class,
                    'exception'=>$row[0].':User not found'
                ]);
            }else{
                Person::create([
                    'user_id' => $user_id,
                    'name' => $name,
                    'position' => $position,
                    'phone' => $phone,
                    'birthday' => $birthday,
                    'email' => $email,
                    'skype' => $skype,
                    'status' => 1,
                    'facebook' => $facebook,
                    'note' => $note,
                ]);
            }
        }
    }

    public function rules()
    {
        return [
            'required',
            'nullable',
            'nullable',
            'nullable',
            'nullable',
            'nullable',
        ];
    }

    public function validationMessage()
    {
        return [
            'required' => trans('user. :attribute agent_not_found'),
            'unique'=> trans('email. :attribute exist')
        ];
    }
}
