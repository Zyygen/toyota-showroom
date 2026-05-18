<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData; // Biến lưu trữ dữ liệu khách hàng điền

    public function __construct($data)
    {
        $this->contactData = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Khách hàng mới đăng ký tư vấn - Toyota Showroom',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.customer_contact', // Trỏ tới file giao diện email
        );
    }
}
