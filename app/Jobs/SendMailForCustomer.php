<?php

namespace App\Jobs;

use App\Mail\InvoiceMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendMailForCustomer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $mail;
    public $name;
    public $content;
    public $fileLists;
    public function __construct($mail,$name,$content,$fileLists)
    {
        //
        $this->mail = $mail;
        $this->name = $name;
        $this->content = $content;
        $this->fileLists = $fileLists;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $mail = $this->mail;
        $name = $this->name;
        $content = $this->content;
        $fileLists = $this->fileLists;
        try {
            Mail::to('mhieupham1@gmail.com')->send(new InvoiceMail($content, $name, $fileLists));
        } catch (\Exception $e) {
            report($e);
        }
    }
}
