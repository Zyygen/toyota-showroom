<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerContactMail;
use App\Models\Contact; 

class ContactController extends Controller
{
    public function submitForm(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'car_model' => 'required|string',
            'message' => 'nullable|string'
        ]);

        // 1. Lưu thông tin vào Database
        Contact::create($validatedData);

        // 2. Gửi email thông báo (Nếu mail có lỗi thì hệ thống vẫn đã lưu khách vào DB ở bước 1)
        try {
            Mail::to('email_cua_ban@gmail.com')->send(new CustomerContactMail($validatedData));
        } catch (\Exception $e) {
            // Bỏ qua lỗi gửi mail để không làm gián đoạn trải nghiệm khách hàng
        }

        return back()->with('success', 'Cảm ơn bạn đã để lại thông tin! Chúng tôi sẽ liên hệ lại sớm nhất.');
    }
}