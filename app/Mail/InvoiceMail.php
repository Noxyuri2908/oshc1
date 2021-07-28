<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $template;
    public $customerName;
    public $fileLists;
    public function __construct($template, $customerName, $fileLists)
    {
        //
        $this->template = $template;
        $this->customerName = $customerName;
        $this->fileLists = $fileLists;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (!empty($this->fileLists)) {
            foreach ($this->fileLists as $one) {
                $this->attach(public_path('/storage/attr') . '/' . $one);
            }
        }
        return $this->view('CRM.elements.customers.mail.invoice');
    }
}
