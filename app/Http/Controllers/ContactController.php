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
            Mail::to('email_cua_ban@gmail.com')->send(new CustomerContactMail($validatedData));
        } catch (\Exception $e) {
            // Bỏ qua lỗi gửi mail để không làm gián đoạn trải nghiệm khách hàng
        }

        // ĐÃ XÓA LUỒNG VNPAY Ở ĐÂY.
        // Chỉ thông báo thành công và yêu cầu khách chờ tư vấn.
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

        $carModels = CarModel::all(); // Load danh sách xe để khách có thể đổi ý tại form
        return view('deposit_form', compact('contact', 'carModels'));
    }

    // 3. KHÁCH HÀNG: Bấm xác nhận "Đã chuyển khoản"
    public function submitDeposit(Request $request, $token)
    {
        $contact = Contact::where('deposit_token', $token)->firstOrFail();
        
        // Cập nhật lại xe khách chọn (trong trường hợp sau khi tư vấn khách muốn đổi dòng xe khác)
        $selectedCar = $request->input('final_car_model', $contact->car_model);
        
        // Tính lại giá cọc 5% cho dòng xe mới chốt
        $carModelInfo = CarModel::with('cars')->where('name', $selectedCar)->first();
        $minPrice = ($carModelInfo && $carModelInfo->cars->count() > 0) ? $carModelInfo->cars->min('price') : 0;
        
        $contact->final_car_model = $selectedCar;
        $contact->deposit_amount = $minPrice * 0.05;
        $contact->payment_status = 'pending_verification'; // Chuyển sang chờ Admin duyệt
        $contact->save();

        // TODO: Gửi Email lịch hẹn đến Showroom
        Mail::to($contact->email)->send(new AppointmentMail($contact));

        return redirect()->route('home')->with('success', 'Xác nhận chuyển khoản thành công! Chúng tôi đã gửi Lịch hẹn đến Showroom qua Email của bạn.');
    }
}