<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerContactMail;

class ContactController extends Controller
{
    public function submitForm(Request $request)
    {
        // 1. Validate dữ liệu người dùng nhập
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'car_model' => 'required|string',
            'message' => 'nullable|string'
        ]);

        // 2. Gửi email tới email của bạn
        // Chú ý: Thay địa chỉ email dưới đây bằng email của bạn để nhận thông báo
        Mail::to('email_cua_ban@gmail.com')->send(new CustomerContactMail($validatedData));

        // 3. Quay lại trang chủ kèm thông báo thành công
        return back()->with('success', 'Cảm ơn bạn đã để lại thông tin! Chúng tôi sẽ liên hệ lại sớm nhất.');
    }
}