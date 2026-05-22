<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Danh sách Khách hàng Liên hệ & Đặt cọc</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class="px-6 py-3">Ngày gửi</th>
                                <th class="px-6 py-3">Khách hàng</th>
                                <th class="px-6 py-3">Thông tin liên hệ</th>
                                <th class="px-6 py-3">Xe quan tâm / Chốt cọc</th>
                                <th class="px-6 py-3 text-center">Trạng thái</th>
                                <th class="px-6 py-3 text-right">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contacts as $contact)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                                    
                                    <td class="px-6 py-4 font-bold text-gray-900">{{ $contact->fullname }}</td>
                                    
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-red-600">{{ $contact->phone }}</div>
                                        <div class="text-xs text-gray-500">{{ $contact->email ?? 'Chưa cập nhật' }}</div>
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-800">{{ $contact->car_model }}</div>
                                        @if($contact->final_car_model && $contact->final_car_model != $contact->car_model)
                                            <div class="text-xs text-blue-600 mt-1">↳ Đổi sang: {{ $contact->final_car_model }}</div>
                                        @endif
                                    </td>
                                    
                                    <td class="px-6 py-4 text-center">
                                        @if($contact->consultation_status == 'pending')
                                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-bold">Chờ gọi điện</span>
                                        @elseif($contact->consultation_status == 'completed' && $contact->payment_status == 'unpaid')
                                            <span class="bg-amber-100 text-amber-800 px-2 py-1 rounded text-xs font-bold">Đang chờ khách cọc</span>
                                        @elseif($contact->payment_status == 'pending_verification')
                                            <span class="bg-blue-100 text-blue-800 border border-blue-200 px-2 py-1 rounded text-xs font-bold animate-pulse">Đã CK (Chờ Check Bank)</span>
                                        @elseif($contact->payment_status == 'paid')
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold">Đã xác nhận cọc</span>
                                        @endif
                                    </td>
                                    
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end items-center gap-2">
                                            
                                            @if($contact->consultation_status == 'pending')
                                                <form action="{{ route('admin.contacts.confirm', $contact->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-blue-100 text-blue-800 hover:bg-blue-600 hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm" onclick="return confirm('Bạn đã tư vấn xong và muốn hệ thống gửi Email lấy cọc cho khách hàng này?');">
                                                        ✓ Đã tư vấn
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            @if($contact->payment_status == 'pending_verification')
                                                <form action="{{ route('admin.contacts.confirm_deposit', $contact->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-emerald-100 text-emerald-800 hover:bg-emerald-600 hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm border border-emerald-200" onclick="return confirm('Kế toán xác nhận ĐÃ NHẬN ĐƯỢC TIỀN cọc từ khách hàng này?');">
                                                        ✓ Xác nhận Đã Cọc
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Xóa liên hệ này?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-100 text-red-800 hover:bg-red-200 px-3 py-1.5 rounded-lg text-xs font-bold transition">
                                                    Xóa
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">Chưa có khách hàng nào liên hệ.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>