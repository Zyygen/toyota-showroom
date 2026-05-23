<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerContactMail;
use App\Models\Contact; 
use App\Models\CarModel;
use App\Mail\DepositRequestMail;
use App\Mail\AppointmentMail;

class ContactController extends Controller
{
    // PHẦN 1: KHÁCH HÀNG ĐĂNG KÝ TƯ VẤN (LUỒNG MỚI)
    public function submitForm(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'email'    => 'required|email',
            'phone'    => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'car_model'=> 'required|string',
            'message'  => 'nullable|string'
        ]);

        // Tính 5% số tiền cọc tạm tính lúc khách mới đăng ký
        $carModelInfo = CarModel::with('cars')->where('name', $request->car_model)->first();
        $minPrice = ($carModelInfo && $carModelInfo->cars->count() > 0) ? $carModelInfo->cars->min('price') : 0;
        $depositAmount = $minPrice * 0.05;

        // Lưu thông tin vào Database
        $contact = Contact::create([
            'fullname'       => $validatedData['fullname'],
            'email'          => $validatedData['email'],
            'phone'          => $validatedData['phone'],
            'car_model'      => $validatedData['car_model'],
            'message'        => $validatedData['message'],
            'deposit_amount' => $depositAmount,
            'payment_status' => 'unpaid',
        ]);

        // Gửi email thông báo cho Admin có khách hàng mới
        try {
            Mail::to('datbkp2k4@gmail.com')->send(new CustomerContactMail($validatedData));
        } catch (\Exception $e) {
            // Bỏ qua lỗi gửi mail để không làm gián đoạn trải nghiệm khách hàng
        }
        return back()->with('success', 'Yêu cầu tư vấn của bạn đã được gửi. Chuyên viên sẽ sớm liên hệ và gửi thông tin đặt cọc qua Email cho bạn!');
    }

    // PHẦN 2: NGHIỆP VỤ ĐẶT CỌC (DEMO BANK TRANSFER)

    // 1. ADMIN: Bấm nút xác nhận đã tư vấn
    public function confirmConsultation($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->consultation_status = 'completed';
        $contact->deposit_token = Str::random(40); // Tạo chuỗi bảo mật ngẫu nhiên
        $contact->save();

        // TODO: Gửi Email chứa link: route('deposit.form', $contact->deposit_token)
        Mail::to($contact->email)->send(new DepositRequestMail($contact));

        return back()->with('success', 'Đã lưu trạng thái tư vấn và gửi Email mời đặt cọc cho khách!');
    }

    // 2. KHÁCH HÀNG: Bấm vào link trong Email mở ra trang Đặt cọc
    public function showDepositForm($token)
    {
        $contact = Contact::where('deposit_token', $token)->firstOrFail();
        
        // Tránh tình trạng khách bấm lại link khi đã thanh toán
        if($contact->payment_status === 'paid' || $contact->payment_status === 'pending_verification'){
            return redirect()->route('home')->with('success', 'Đơn đặt cọc này đã được xử lý!');
        }

        $carModels = CarModel::with('cars')->get();
        return view('deposit_form', compact('contact', 'carModels'));
    }

    // 3. KHÁCH HÀNG: Bấm xác nhận "Đã chuyển khoản"
    public function submitDeposit(Request $request, $token)
    {
        $contact = Contact::where('deposit_token', $token)->firstOrFail();
        $carId = $request->input('final_car_id');
    
        $selectedCar = \App\Models\Car::find($carId);

        if ($selectedCar) {
            $carModelInfo = \App\Models\CarModel::find($selectedCar->car_model_id);
            $modelName = $carModelInfo ? $carModelInfo->name : '';
            $contact->final_car_model = trim($modelName . ' ' . $selectedCar->variant_name);
            
            $contact->deposit_amount = $selectedCar->price * 0.05;
        } else {
            // Đề phòng trường hợp lỗi mạng, giữ nguyên tên xe khách định cọc ban đầu
            $contact->final_car_model = $contact->car_model;
        }
        
        $contact->payment_status = 'pending_verification'; 
        $contact->save();

        return redirect()->route('home')->with('success', 'Xác nhận chuyển khoản thành công! Chúng tôi sẽ kiểm tra giao dịch và gửi Lịch hẹn qua Email cho bạn sớm nhất.');
    }
}