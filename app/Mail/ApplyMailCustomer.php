<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplyMailCustomer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data_email_customer;
    public $subject;
    public function __construct($data_email_customer)
    {
        //
        $this->data_email_customer = $data_email_customer;
        $this->subject('Thanks for your application.');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('fontend.mail.apply.apply_customer');
    }
}
