<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AppliMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data_email;
    public $subject;

    public function __construct($data_email,$getInvoiceCode)
    {
        //
        $this->data_email = $data_email;
        $this->subject($getInvoiceCode.' - '.$data_email['main'][0]['first_name'].' '.$data_email['main'][0]['last_name'].' - '.'OSHC application - AU');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('fontend.mail.apply.apply');
    }
}
