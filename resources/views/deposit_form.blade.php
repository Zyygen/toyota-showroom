<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Đặt Cọc | Toyota Showroom</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-neutral-50 flex items-center justify-center min-h-screen p-4 md:p-8">

    <div class="bg-white rounded-2xl shadow-xl max-w-4xl w-full overflow-hidden border border-neutral-200 flex flex-col md:flex-row">
        
        <div class="bg-neutral-900 p-8 md:p-12 text-white w-full md:w-5/12 flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center font-black text-2xl mb-6 shadow-lg shadow-red-600/30">T</div>
                <h2 class="text-2xl font-black uppercase tracking-tight mb-2">Thông tin thanh toán</h2>
                <p class="text-neutral-400 text-sm font-light leading-relaxed">Vui lòng chuyển khoản số tiền cọc (5% giá niêm yết) vào tài khoản dưới đây để giữ chỗ và nhận ưu đãi đặc quyền.</p>
            </div>

            <div class="mt-10 space-y-6">
                <div class="bg-white p-3 rounded-xl inline-block">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=ChuyenKhoanToyota" alt="QR Code" class="w-32 h-32 rounded">
                </div>
                
                <div class="space-y-4 text-sm">
                    <div>
                        <span class="text-neutral-500 block text-xs uppercase font-bold tracking-wider">Ngân hàng</span>
                        <span class="font-bold text-lg">Vietcombank - CN Hà Nội</span>
                    </div>
                    <div>
                        <span class="text-neutral-500 block text-xs uppercase font-bold tracking-wider">Số tài khoản</span>
                        <span class="font-black text-xl text-red-500 tracking-widest">0123456789</span>
                    </div>
                    <div>
                        <span class="text-neutral-500 block text-xs uppercase font-bold tracking-wider">Chủ tài khoản</span>
                        <span class="font-bold text-lg uppercase">CTY TOYOTA VIET NAM</span>
                    </div>
                    
                    <div class="bg-red-600/10 border border-red-500/20 p-4 rounded-lg">
                        <span class="text-red-300 block text-xs uppercase font-bold tracking-wider mb-1">Số tiền cần thanh toán (5%)</span>
                        <span id="display-deposit-amount" class="font-black text-2xl text-red-500 tracking-widest">0 VNĐ</span>
                    </div>

                    <div class="bg-neutral-800 p-4 rounded-lg border border-neutral-700">
                        <span class="text-neutral-400 block text-xs uppercase font-bold tracking-wider mb-1">Nội dung chuyển khoản:</span>
                        <span class="font-mono text-white font-bold text-lg">DATCOC {{ $contact->id }} {{ strtoupper(Str::slug($contact->fullname)) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 md:p-12 w-full md:w-7/12 bg-white flex flex-col justify-center">
            <h3 class="text-xl font-black uppercase tracking-tight text-neutral-900 mb-6 border-b border-neutral-100 pb-4">Xác nhận đơn đặt cọc</h3>
            
            <form action="{{ route('deposit.submit', $contact->deposit_token) }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase text-neutral-500 tracking-wider mb-2">Họ & Tên</label>
                        <input type="text" value="{{ $contact->fullname }}" disabled class="w-full border-neutral-200 bg-neutral-50 rounded px-4 py-3 text-sm text-neutral-500 cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-neutral-500 tracking-wider mb-2">Số điện thoại</label>
                        <input type="text" value="{{ $contact->phone }}" disabled class="w-full border-neutral-200 bg-neutral-50 rounded px-4 py-3 text-sm text-neutral-500 cursor-not-allowed">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-neutral-900 tracking-wider mb-2 flex items-center justify-between">
                        <span>Phiên bản xe chốt đặt cọc *</span>
                    </label>
                    
                    <select name="final_car_id" id="car-version-select" required class="w-full border-neutral-300 rounded px-4 py-3 text-sm font-bold text-neutral-900 focus:ring-red-500 focus:border-red-500">
                        <option value="">-- Chọn phiên bản xe chi tiết --</option>
                        @foreach($carModels as $model)
                            @if($model->cars->count() > 0)
                                <optgroup label="{{ $model->name }}">
                                    @foreach($model->cars as $car)
                                        @php
                                            // Ghép tên dòng xe và tên phiên bản để tạo chuỗi so sánh
                                            $fullVariantName = trim($model->name . ' ' . $car->variant_name);
                                            
                                            // Kiểm tra xem chuỗi này có khớp với xe khách đã đăng ký không
                                            $isSelected = ($contact->car_model == $fullVariantName) ? 'selected' : '';
                                        @endphp
                                        <option value="{{ $car->id }}" data-deposit="{{ $car->price * 0.05 }}" {{ $isSelected }}>
                                            {{ $fullVariantName }} - Giá: {{ number_format($car->price, 0, ',', '.') }} ₫
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endif
                        @endforeach
                    </select>
                    <p class="text-xs text-neutral-500 mt-2">Hệ thống sẽ tự động tính lại số tiền cọc dựa trên phiên bản chi tiết bạn chọn tại đây.</p>
                </div>

                <div class="pt-6 border-t border-neutral-100 mt-8">
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-black py-4 rounded-lg flex items-center justify-center gap-2 transition duration-200 shadow-lg shadow-red-600/20 uppercase tracking-widest text-sm" onclick="return confirm('Bạn xác nhận đã chuyển khoản số tiền cọc?');">
                        Tôi đã chuyển khoản thành công
                    </button>
                    <p class="text-center text-xs text-neutral-400 mt-4">Bằng việc xác nhận, chúng tôi sẽ kiểm tra giao dịch và gửi Lịch hẹn qua Email của bạn.</p>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectEl = document.getElementById('car-version-select');
            const amountEl = document.getElementById('display-deposit-amount');

            function updateDepositAmount() {
                const selectedOption = selectEl.options[selectEl.selectedIndex];
                
                if (!selectedOption) return; 

                const deposit = selectedOption.getAttribute('data-deposit');
                
                if (deposit) {
                    // Format số thành chuẩn tiền tệ VNĐ (ví dụ: 50.000.000)
                    amountEl.innerText = new Intl.NumberFormat('vi-VN').format(deposit) + ' VNĐ';
                } else {
                    amountEl.innerText = '0 VNĐ';
                }
            }

            selectEl.addEventListener('change', updateDepositAmount);
            updateDepositAmount();
        });
    </script>
</body>
</html>