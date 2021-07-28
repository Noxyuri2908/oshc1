<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentCustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data_email_payment_customer;

    public function __construct($data_email_payment_customer)
    {
        //
        $this->data_email_payment_customer = $data_email_payment_customer;
        $this->subject = 'Thanks for your application.';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(!empty($this->data_email_payment_customer['list_file'])){
            foreach ($this->data_email_payment_customer['list_file'] as $one) {
                $this->attach(public_path('/storage/pdf') . '/' . $one);
            }
        }
        return $this->view('fontend.mail.payment.payment_customer');
    }
}
