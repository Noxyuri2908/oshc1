<?php

namespace App\Console\Commands;

use App\Admin\Follow;
use App\RemindFollowUps;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RunningScanRemindFollowUps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scan:remind-follow-ups';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $followUps = new Follow();
        $result = $followUps->getDataNotUpdateFollowUpsByProcessingDate();
        $dateNow = Carbon::now();
        foreach ($result as $key => $item) {
            $dateFromProcessingDate = Carbon::parse($item->process_date);
            $lastDays = $dateNow->diffInDays($dateFromProcessingDate);

            $remindFollowUp = new RemindFollowUps();
            $remindFollowUp->follow_up_id = $item->id;
            $remindFollowUp->time_no_follow_up = $lastDays;


            // check Create or Update
            $checkFollowId = RemindFollowUps::where('follow_up_id', $item->id)->first();
            if (!empty($checkFollowId)) {
                if ($lastDays >= 15) {
                    $remindFollowUp->save();
                }
            } else {
                $remindFollowUp->update();
            }


        }

        return $result;

    }
}
