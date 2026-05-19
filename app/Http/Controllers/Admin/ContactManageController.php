<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

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
}
