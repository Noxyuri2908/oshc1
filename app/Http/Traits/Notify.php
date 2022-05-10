<?php

namespace App\Http\Traits;

use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

trait Notify
{
    public function sendMail($emailSetting, $receiver, $emailTemplate)
    {
        $message = str_replace('[[name]]', 'Anthony', $emailSetting->email_description);
        $message = str_replace('[[message]]', $emailTemplate->template, $message);
        @Mail::to($receiver)->send(new SendMail($emailSetting->email_from, $receiver, $emailTemplate->subject, $message));
    }
}
