<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;

class DepositRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->subject('Xác nhận tư vấn & Yêu cầu Đặt cọc xe Toyota - ' . $this->contact->car_model)
                    ->view('emails.deposit_request');
    }
}