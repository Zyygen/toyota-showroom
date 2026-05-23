<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;
use Barryvdh\DomPDF\Facade\Pdf;

class AppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        // 1. Tạo file PDF ngay lập tức từ file giao diện receipt.blade.php
        $pdf = Pdf::loadView('pdf.receipt', ['contact' => $this->contact]);

        // 2. Định dạng Email và đính kèm (attachData) file PDF vào
        return $this->subject('Xác nhận Thanh toán & Lịch hẹn tham quan Showroom Toyota')
                    ->view('emails.appointment')
                    ->attachData($pdf->output(), 'Bien_Lai_Dat_Coc_' . str_replace(' ', '_', $this->contact->fullname) . '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}