<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentMail;

class ContactManageController extends Controller
{
    // Hiển thị danh sách khách hàng
    public function index()
    {
        // Lấy danh sách, ưu tiên khách hàng mới nhất và đang "pending" lên đầu
        $contacts = Contact::orderBy('status', 'desc')
                           ->orderBy('created_at', 'desc')
                           ->get();
                           
        return view('admin.contacts.index', compact('contacts'));
    }

    // Hàm cập nhật trạng thái (Đã gọi tư vấn)
    public function updateStatus($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->status = 'contacted';
        $contact->save();

        return back()->with('success', 'Đã cập nhật trạng thái: Đã tư vấn!');
    }
    
    // Hàm xóa yêu cầu (Nếu là spam)
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return back()->with('success', 'Đã xóa thông tin liên hệ!');
    }

    // Xác nhận Kế toán đã nhận được tiền chuyển khoản
    public function confirmDeposit($id)
    {
        $contact = \App\Models\Contact::findOrFail($id);
        $contact->payment_status = 'paid'; // Chuyển trạng thái sang Đã thanh toán
        $contact->save();

        // KÍCH HOẠT GỬI MAIL CHỨA FILE PDF CHO KHÁCH HÀNG
        try {
            Mail::to($contact->email)->send(new AppointmentMail($contact));
        } catch (\Exception $e) {
            return back()->with('success', 'Đã xác nhận thanh toán, nhưng có lỗi khi gửi Email: ' . $e->getMessage());
        }

        return back()->with('success', 'Đã xác nhận nhận tiền cọc thành công của khách hàng: '.$contact->fullname.'');
    }
}
