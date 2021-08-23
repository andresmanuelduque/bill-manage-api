<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BillRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The demo object instance.
     *
     * @var BillRequest
     */
    public $billRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($billRequest)
    {
        $this->billRequest = $billRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->text('mails.bill_request_plain');
    }
}
