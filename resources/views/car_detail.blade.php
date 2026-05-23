<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $carModel->name }} | Thông số chi tiết & Giá lăn bánh mới nhất</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.5s ease-out forwards; }
    </style>
</head>
<body class="bg-white text-neutral-900 antialiased">

    <header class="bg-white/95 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-neutral-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-11 h-11 bg-neutral-950 rounded-full flex items-center justify-center text-white font-black text-xl">T</div>
                <div class="flex flex-col">
                    <span class="text-2xl font-black tracking-widest text-neutral-900 uppercase leading-none">Toyota</span>
                    <span class="text-[10px] tracking-widest text-neutral-400 uppercase font-semibold mt-1">Move Your World</span>
                </div>
            </a>
            <nav class="flex items-center gap-6 font-semibold text-sm">
                <a href="{{ route('home') }}" class="text-neutral-500 hover:text-red-600 transition-colors">← Trang chủ</a>
                <a href="#booking" class="bg-red-600 text-white px-5 py-2.5 rounded text-xs uppercase tracking-wider hover:bg-red-700 font-bold transition shadow-sm shadow-red-600/10">Đăng ký báo giá</a>
            </nav>
        </div>
    </header>

    <div class="bg-white border-b border-neutral-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                
                <div class="text-center md:text-left order-2 md:order-1">
                    <span class="text-xs font-bold uppercase tracking-widest text-neutral-400">Khám phá dòng xe</span>
                    <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tight text-neutral-950 mt-1 mb-3 animate-fade-in-up">
                        {{ $carModel->name }}
                    </h1>
                    @if($carModel->tagline)
                        <p class="text-lg md:text-xl font-light text-neutral-600 tracking-widest italic max-w-xl mx-auto md:mx-0 leading-relaxed drop-shadow-sm">
                            "{{ $carModel->tagline }}"
                        </p>
                    @endif
                    
                    <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <a href="#premium-price" class="bg-neutral-950 text-white font-bold py-3.5 px-8 rounded text-sm tracking-wider uppercase hover:bg-neutral-800 shadow-lg transition text-center">
                            Xem bảng giá
                        </a>
                        <a href="#booking" class="bg-white text-neutral-950 font-bold py-3.5 px-8 rounded text-sm tracking-wider uppercase border border-neutral-200 hover:border-neutral-300 transition text-center">
                            Nhận báo giá
                        </a>
                    </div>
                </div>

                <div class="order-1 md:order-2 flex items-center justify-center">
                    <div class="w-full h-80 md:h-[450px] bg-neutral-100 rounded-2xl p-6 flex items-center justify-center border border-neutral-200 shadow-inner relative overflow-hidden group">
                        
                        @if($carModel->banner_image)
                             <img src="{{ $carModel->banner_image }}" class="absolute inset-0 w-full h-full object-cover opacity-10 blur-xl scale-110">
                        @else
                             <img src="{{ $carModel->image }}" class="absolute inset-0 w-full h-full object-cover opacity-10 blur-xl scale-110">
                        @endif

                        @if($carModel->banner_image)
                            <img src="{{ $carModel->banner_image }}" alt="{{ $carModel->name }}" class="relative z-10 max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-700 drop-shadow-2xl">
                        @else
                            <img src="{{ $carModel->image }}" alt="{{ $carModel->name }}" class="relative z-10 max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-700 drop-shadow-2xl opacity-40">
                            <p class="absolute z-20 text-neutral-400 text-xs">Vui lòng up ảnh Banner ở Admin</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($carModel->description)
    <section class="max-w-4xl mx-auto px-4 py-16 md:py-24 border-b border-neutral-100">
        <div class="text-center mb-10">
            <span class="text-xs font-bold uppercase tracking-widest text-red-600">Tổng quan sản phẩm</span>
            <h2 class="text-2xl md:text-3xl font-black uppercase tracking-tight mt-1">Khám Phá Chi Tiết</h2>
            <div class="w-12 h-1 bg-red-600 mx-auto mt-3"></div>
        </div>
        <div class="text-neutral-600 text-base md:text-lg font-light leading-relaxed whitespace-pre-line space-y-4">
            {{ $carModel->description }}
        </div>
    </section>
    @endif

    <section id="premium-price" class="max-w-5xl mx-auto px-4 py-16">
        <h3 class="text-2xl font-black uppercase tracking-tight text-neutral-900 mb-8 flex items-center gap-3">
            <span class="w-2 h-7 bg-red-600 inline-block"></span>
            Các phiên bản & Giá niêm yết hiện tại
        </h3>
        
        <div class="bg-white border border-neutral-200/60 rounded-xl shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-neutral-900 text-white text-xs font-bold uppercase tracking-wider">
                        <th class="p-4 md:p-5">Tên phiên bản xe</th>
                        <th class="p-4 md:p-5">Hệ thống truyền động</th>
                        <th class="p-4 md:p-5 text-right">Giá bán đề xuất (VAT)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse($carModel->cars as $car)
                        <tr class="hover:bg-neutral-50/80 transition-colors">
                            <td class="p-4 md:p-5 font-bold text-neutral-800 text-base md:text-lg">
                                {{ $carModel->name }} {{ $car->variant_name }}
                                <span class="block text-xs font-medium text-neutral-400 mt-0.5">Năm sản xuất: {{ $car->year }}</span>
                            </td>
                            <td class="p-4 md:p-5">
                                @if($car->fuel_type == 'hybrid')
                                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1 rounded-full text-xs font-bold tracking-wide uppercase inline-flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Hybrid (HEV)
                                    </span>
                                @else
                                    <span class="bg-neutral-50 text-neutral-600 border border-neutral-200 px-3 py-1 rounded-full text-xs font-bold tracking-wide uppercase">
                                        Động cơ Xăng
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 md:p-5 text-right font-black text-red-600 text-lg md:text-xl">
                                {{ number_format($car->price, 0, ',', '.') }} <span class="text-sm font-bold">₫</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-8 text-center text-neutral-400 font-light">Mẫu xe này hiện tại đang cập nhật giá bán tại đại lý. Vui lòng liên hệ hotline để nhận thông tin sớm nhất.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    @php
        // Gom nhóm tính năng theo loại
        $groupedFeatures = $carModel->features->groupBy('type');
        $hasFeatures = $groupedFeatures->count() > 0;
        
        // Cấu hình tên hiển thị
        $tabNames = [
            'ngoai_that' => 'Ngoại Thất',
            'noi_that' => 'Nội Thất',
            'van_hanh' => 'Vận Hành',
            'an_toan' => 'An Toàn'
        ];
    @endphp

    @if($hasFeatures)
    <section class="max-w-7xl mx-auto px-4 py-16 border-b border-neutral-100">
        
        <div class="flex overflow-x-auto justify-start md:justify-center border-b border-neutral-200 mb-12 scrollbar-hide">
            <div class="flex space-x-8 min-w-max px-2">
                @foreach($tabNames as $key => $name)
                    @if(isset($groupedFeatures[$key]))
                        <button onclick="switchTab('{{ $key }}')" 
                                id="tab-btn-{{ $key }}"
                                class="feature-tab pb-4 text-sm md:text-base font-bold uppercase tracking-widest text-neutral-400 hover:text-neutral-900 transition-colors relative">
                            {{ $name }}
                            <div class="tab-indicator hidden absolute bottom-0 left-0 w-full h-1 bg-red-600"></div>
                        </button>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="tab-container min-h-[400px]">
            @foreach($tabNames as $key => $name)
                @if(isset($groupedFeatures[$key]))
                    <div id="tab-content-{{ $key }}" class="feature-content hidden animate-fade-in-up">
                        <div class="text-center mb-10">
                            <h3 class="text-2xl font-black uppercase tracking-tight">{{ $name }}</h3>
                            <p class="text-neutral-500 font-light mt-2">Các tính năng có thể khác nhau giữa các phiên bản</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @foreach($groupedFeatures[$key] as $feature)
                                <div class="bg-neutral-50 rounded-xl overflow-hidden group hover:shadow-lg transition duration-300">
                                    <div class="overflow-hidden bg-white flex items-center justify-center">
                                        <img src="{{ $feature->image }}" alt="{{ $feature->title }}" class="w-full h-64 object-cover group-hover:scale-105 transition duration-500">
                                    </div>
                                    <div class="p-6">
                                        <h4 class="text-lg font-bold text-neutral-900 mb-2">{{ $feature->title }}</h4>
                                        @if($feature->description)
                                            <p class="text-neutral-600 text-sm font-light leading-relaxed">{{ $feature->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    <script>
        function switchTab(tabKey) {
            // 1. Ẩn tất cả nội dung
            document.querySelectorAll('.feature-content').forEach(el => {
                el.classList.add('hidden');
            });
            // 2. Reset trạng thái tất cả các nút
            document.querySelectorAll('.feature-tab').forEach(btn => {
                btn.classList.remove('text-neutral-900');
                btn.classList.add('text-neutral-400');
                btn.querySelector('.tab-indicator').classList.add('hidden');
            });

            // 3. Hiện nội dung tab được chọn
            document.getElementById('tab-content-' + tabKey).classList.remove('hidden');
            // 4. Highlight nút được chọn
            let activeBtn = document.getElementById('tab-btn-' + tabKey);
            activeBtn.classList.remove('text-neutral-400');
            activeBtn.classList.add('text-neutral-900');
            activeBtn.querySelector('.tab-indicator').classList.remove('hidden');
        }

        // Tự động mở Tab đầu tiên khi load trang
        document.addEventListener('DOMContentLoaded', () => {
            let firstTab = document.querySelector('.feature-tab');
            if(firstTab) {
                let firstTabKey = firstTab.id.replace('tab-btn-', '');
                switchTab(firstTabKey);
            }
        });
    </script>
    @endif

    <section id="booking" class="bg-neutral-50 border-t border-neutral-100 py-20">
        <div class="max-w-3xl mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-xl border border-neutral-100 p-8 sm:p-12 relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-2 bg-red-600"></div>
                
                <h2 class="text-3xl font-black text-center uppercase tracking-tight text-neutral-900 mb-2">Đăng Ký Đặt Lịch Tư Vấn</h2>
                <p class="text-center text-neutral-400 font-light mb-8">Cơ hội nhận ưu đãi đặc quyền giảm thuế trước bạ và gói phụ kiện Toyota chính hãng dành riêng cho <strong>{{ $carModel->name }}</strong>.</p>

                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3.5 rounded-lg mb-6 text-center font-semibold text-sm flex items-center justify-center gap-2 shadow-sm">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold uppercase text-neutral-500 tracking-wider mb-2">Họ và tên quý khách *</label>
                            <input type="text" name="fullname" required class="w-full border-neutral-200 rounded px-4 py-3 text-sm shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-neutral-500 tracking-wider mb-2">Số điện thoại *</label>
                            <input type="text" name="phone" required class="w-full border-neutral-200 rounded px-4 py-3 text-sm shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all outline-none">
                        </div>
                        <div class="col-span-1 sm:col-span-2">
                            <label class="block text-xs font-bold uppercase text-neutral-500 tracking-wider mb-2">Email nhận thông báo *</label>
                            <input type="email" name="email" required class="w-full border-neutral-200 rounded px-4 py-3 text-sm shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-neutral-500 tracking-wider mb-2">Phiên bản xe bạn quan tâm *</label>
                        <select name="car_model" required class="w-full border-neutral-200 rounded px-4 py-3 text-sm shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 bg-white transition-all outline-none">
                            <option value="{{ $carModel->name }}">-- Cần tư vấn tất cả phiên bản của {{ $carModel->name }} --</option>
                            @foreach($carModel->cars as $car)
                                <option value="{{ $carModel->name }} {{ $car->variant_name }}">
                                    {{ $carModel->name }} {{ $car->variant_name }} - Giá từ: {{ number_format($car->price, 0, ',', '.') }} ₫
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-neutral-500 tracking-wider mb-2">Yêu cầu tư vấn cụ thể (Không bắt buộc)</label>
                        <textarea name="message" rows="3" placeholder="Ví dụ: Tôi muốn hỏi về thủ tục trả góp 80% của dòng xe này..." class="w-full border-neutral-200 rounded px-4 py-3 text-sm shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all outline-none resize-none"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-red-600 text-white font-bold py-4 rounded text-sm tracking-wider uppercase hover:bg-red-700 shadow-md shadow-red-600/10 transition-colors duration-200">
                        Yêu cầu lái thử & Báo giá lăn bánh
                    </button>
                </form>
            </div>
        </div>
    </section>

    <footer class="bg-neutral-900 text-neutral-500 text-center py-8 text-sm border-t border-neutral-800">
        <p>&copy; 2026 Hệ thống Showroom Toyota Việt Nam. Đồ án xây dựng Website Quản lý Showroom.</p>
    </footer>

</body>
</html>