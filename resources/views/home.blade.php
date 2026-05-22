<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toyota Việt Nam</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white text-neutral-900 antialiased">

    <header class="bg-white/95 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-neutral-100 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-11 h-11 bg-neutral-900 group-hover:bg-red-600 rounded-full flex items-center justify-center text-white font-black text-xl transition-colors duration-300">
                    T
                </div>
                <div class="flex flex-col">
                    <span class="text-2xl font-black tracking-widest text-neutral-900 uppercase leading-none">Toyota</span>
                    <span class="text-[10px] tracking-widest text-neutral-400 uppercase font-semibold mt-1">Move Your World</span>
                </div>
            </a>
            
            <nav class="hidden md:flex items-center gap-10 font-medium text-sm text-neutral-600">
                <a href="#dong-xe" class="hover:text-red-600 transition-colors py-2 border-b-2 border-transparent hover:border-red-600">Sản phẩm</a>
                <a href="#contact-section" class="hover:text-red-600 transition-colors py-2 border-b-2 border-transparent hover:border-red-600">Đăng ký lái thử</a>
                <a href="{{ route('login') }}" class="bg-neutral-950 text-white px-5 py-2.5 rounded text-xs font-bold uppercase tracking-wider hover:bg-red-600 shadow-sm transition-all duration-300">
                    Đại lý / Admin
                </a>
            </nav>
        </div>
    </header>

    <section class="relative w-full h-[70vh] bg-neutral-950 flex items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1617469167446-80e3a4466759?auto=format&fit=crop&q=80&w=1920" alt="Toyota Premium Banner" class="absolute inset-0 w-full h-full object-cover opacity-60 object-center">
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10 text-white">
            <span class="text-red-500 font-bold tracking-widest text-xs uppercase bg-red-500/10 border border-red-500/20 px-3 py-1 rounded mb-4 inline-block">Thế hệ mới</span>
            <h1 class="text-4xl sm:text-6xl font-black tracking-tight uppercase max-w-2xl leading-tight mb-4">
                Khám Phá <br><span class="text-red-500">Kỷ Nguyên</span> Di Chuyển Mới
            </h1>
            <p class="text-lg text-neutral-300 max-w-md font-light mb-8 leading-relaxed">
                Công nghệ Hybrid tiên phong mang đến trải nghiệm vận hành hứng khởi và thân thiện với môi trường.
            </p>
            <a href="#dong-xe" class="inline-flex items-center gap-2 bg-red-600 text-white font-bold text-sm tracking-wider uppercase px-8 py-4 rounded hover:bg-red-700 shadow-lg shadow-red-600/30 transition-all duration-300 transform hover:-translate-y-0.5">
                Xem bảng giá các dòng xe
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
            </a>
        </div>
    </section>

    @if(isset($viewedCars) && $viewedCars->count() > 0)
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8">
        <h2 class="text-2xl md:text-3xl font-light uppercase text-center text-neutral-800 mb-10 tracking-widest">
            Các mẫu xe đã tham khảo
        </h2>
        <div class="flex flex-wrap justify-center gap-8 md:gap-16 items-center">
            @foreach($viewedCars as $vCar)
            <a href="{{ route('car.detail', $vCar->slug) }}" class="group flex flex-col items-center">
                <div class="w-48 h-28 md:w-56 md:h-32 flex items-center justify-center mb-4">
                    <img src="{{ $vCar->image ?? 'https://via.placeholder.com/300x150?text=Toyota' }}" alt="{{ $vCar->name }}" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                </div>
                <p class="text-sm font-semibold uppercase tracking-wider text-neutral-800 group-hover:text-red-600 transition-colors">
                    {{ $vCar->name }}
                </p>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    <section id="dong-xe" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl font-black uppercase tracking-tight text-neutral-900 sm:text-4xl mb-3">Danh Sách Sản Phẩm</h2>
            <div class="w-16 h-1 bg-red-600 mx-auto mb-4"></div>
            <p class="text-neutral-500 font-light">Lựa chọn mẫu xe Toyota phù hợp nhất với phong cách sống và nhu cầu của bạn.</p>
        </div>

        <div class="flex flex-wrap justify-center gap-2 md:gap-4 mb-12 border-b border-neutral-100 pb-6">
            <button onclick="filterCategory('all')" id="btn-all" class="filter-btn active-btn font-semibold text-sm px-6 py-2.5 rounded transition-all duration-200">Tất cả</button>
            <button onclick="filterCategory('sedan')" id="btn-sedan" class="filter-btn inactive-btn font-semibold text-sm px-6 py-2.5 rounded transition-all duration-200">Sedan</button>
            <button onclick="filterCategory('hatchback')" id="btn-hatchback" class="filter-btn inactive-btn font-semibold text-sm px-6 py-2.5 rounded transition-all duration-200">Hatchback</button>
            <button onclick="filterCategory('suv')" id="btn-suv" class="filter-btn inactive-btn font-semibold text-sm px-6 py-2.5 rounded transition-all duration-200">SUV & MPV</button>
            <button onclick="filterCategory('pickup')" id="btn-pickup" class="filter-btn inactive-btn font-semibold text-sm px-6 py-2.5 rounded transition-all duration-200">Bán tải</button>
            <button onclick="filterCategory('hybrid')" id="btn-hybrid" class="filter-btn inactive-btn font-semibold text-sm px-6 py-2.5 rounded transition-all duration-200 flex items-center gap-1.5 text-emerald-700 bg-emerald-50 border border-emerald-200 hover:bg-emerald-100">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Xe Hybrid
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="car-grid">
            @foreach($carModels as $model)
                @php
                    $nameLower = strtolower($model->name);
                    $cat = 'suv';
                    
                    if(str_contains($nameLower, 'vios') || str_contains($nameLower, 'camry') || str_contains($nameLower, 'altis')) {
                        $cat = 'sedan';
                    } elseif (str_contains($nameLower, 'wigo')) {
                        $cat = 'hatchback';
                    } elseif (str_contains($nameLower, 'hilux')) {
                        $cat = 'pickup';
                    }

                    $isHybrid = $model->cars->contains('fuel_type', 'hybrid');
                @endphp

                <div class="car-card bg-white rounded-xl border border-neutral-200/80 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group" style="display: none;"
                     data-segment="{{ $cat }}" 
                     data-hybrid="{{ $isHybrid ? 'true' : 'false' }}">
                    
                    <div class="h-52 w-full overflow-hidden bg-white relative p-6 flex items-center justify-center border-b border-neutral-100">
                        <img src="{{ $model->image ?? 'https://via.placeholder.com/640x360?text=Toyota' }}" alt="{{ $model->name }}" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500 drop-shadow-md">
                        
                        <div class="absolute top-4 left-4 flex flex-col gap-1.5 z-10">
                            @if($isHybrid)
                                <span class="bg-emerald-600 text-white text-[10px] font-bold tracking-wider uppercase px-2.5 py-1 rounded shadow-sm">HEV (Hybrid)</span>
                            @endif
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-bold text-neutral-900 group-hover:text-red-600 transition-colors mb-1 uppercase tracking-tight">{{ $model->name }}</h3>
                        
                        <p class="text-xs text-neutral-400 font-medium mb-4 uppercase tracking-widest">
                            Phân khúc: 
                            @if($cat == 'sedan') Sedan
                            @elseif($cat == 'hatchback') Hatchback
                            @elseif($cat == 'pickup') Bán tải
                            @else SUV & MPV
                            @endif
                        </p>
                        
                        <div class="flex justify-between items-center pt-4 border-t border-neutral-100">
                            <div>
                                <p class="text-[11px] text-neutral-400 uppercase font-semibold tracking-wider">Giá niêm yết từ</p>
                                <p class="text-lg font-black text-red-600">
                                    @if($model->cars->count() > 0)
                                        {{ number_format($model->cars->min('price'), 0, ',', '.') }} <span class="text-xs font-bold">₫</span>
                                    @else
                                        Liên hệ
                                    @endif
                                </p>
                            </div>
                            
                            <a href="{{ route('car.detail', $model->slug) }}" class="inline-flex items-center gap-1 bg-neutral-50 hover:bg-red-600 text-neutral-800 hover:text-white border border-neutral-200 hover:border-red-600 px-4 py-2 rounded text-xs font-bold uppercase tracking-wider shadow-sm transition-all duration-200">
                                Chi tiết
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="pagination-wrapper" class="flex justify-center items-center gap-2 mt-12">
            </div>

    </section>

    <section id="contact-section" class="bg-neutral-50 border-t border-neutral-100 py-20">
        <div class="max-w-3xl mx-auto px-4 sm:px-6">
            <div class="bg-white rounded-2xl shadow-xl border border-neutral-100 p-8 sm:p-12 relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-2 bg-red-600"></div>
                
                <h2 class="text-3xl font-black text-center uppercase tracking-tight text-neutral-900 mb-2">Đăng Ký Nhận Báo Giá & Lái Thử</h2>
                <p class="text-center text-neutral-400 font-light mb-10">Để lại thông tin chính xác, đội ngũ cố vấn thương mại chuyên nghiệp sẽ hỗ trợ bạn lập tức.</p>

                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3.5 rounded-lg mb-6 text-center font-semibold text-sm shadow-sm flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold uppercase text-neutral-500 tracking-wider mb-2">Họ và tên *</label>
                            <input type="text" name="fullname" required class="w-full border-neutral-200 rounded px-4 py-3 text-sm shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-neutral-500 tracking-wider mb-2">Số điện thoại *</label>
                            <input type="text" name="phone" required class="w-full border-neutral-200 rounded px-4 py-3 text-sm shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-neutral-500 tracking-wider mb-2">Email nhận thông báo *</label>
                        <input type="email" name="email" required placeholder="Nhập email" class="w-full border-neutral-200 rounded px-4 py-3 text-sm shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-neutral-500 tracking-wider mb-2">Dòng xe bạn đang quan tâm *</label>
                        <select name="car_model" required class="w-full border-neutral-200 rounded px-4 py-3 text-sm shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 bg-white transition-all outline-none">
                            <option value="">-- Vui lòng chọn mẫu xe --</option>
                            @foreach($carModels as $model)
                                <option value="{{ $model->name }}">{{ $model->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-neutral-500 tracking-wider mb-2">Lời nhắn / Yêu cầu đặc biệt</label>
                        <textarea name="message" rows="4" placeholder="Ví dụ: Tôi muốn nhận báo giá lăn bánh kèm phụ kiện của bản Camry Hybrid tại Hà Nội..." class="w-full border-neutral-200 rounded px-4 py-3 text-sm shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all outline-none resize-none"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-red-600 text-white font-bold py-4 rounded text-sm tracking-wider uppercase hover:bg-red-700 shadow-md shadow-red-600/20 transition-colors duration-200">
                        Gửi yêu cầu đăng ký
                    </button>
                </form>
            </div>
        </div>
    </section>

    <footer class="bg-neutral-900 text-neutral-400 py-12 border-t border-neutral-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-sm">
            <div class="flex items-center gap-3">
                <span class="text-white font-black tracking-widest text-lg uppercase">TOYOTA</span>
                <span class="text-neutral-600">|</span>
                <p>&copy; 2026 Hệ thống Showroom Ô tô Toyota Việt Nam.</p>
            </div>
            <div class="flex gap-6 text-xs font-medium">
                <a href="#" class="hover:text-white transition-colors">Chính sách bảo mật</a>
                <a href="#" class="hover:text-white transition-colors">Điều khoản sử dụng</a>
                <a href="#dong-xe" class="hover:text-white transition-colors">Sản phẩm</a>
            </div>
        </div>
    </footer>

    <script>
        // CẤU HÌNH PHÂN TRANG
        let currentPage = 1;
        const itemsPerPage = 6; // Số xe tối đa trên 1 trang
        let currentCategory = 'all';

        function filterCategory(category) {
            currentCategory = category;
            currentPage = 1; // Reset về trang 1 mỗi khi đổi bộ lọc

            // Cập nhật giao diện nút bấm bộ lọc
            const buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(btn => {
                btn.className = "filter-btn inactive-btn font-semibold text-sm px-6 py-2.5 rounded transition-all duration-200 text-neutral-600";
            });
            
            const activeBtn = document.getElementById('btn-' + category);
            if(category === 'hybrid') {
                activeBtn.className = "filter-btn font-semibold text-sm px-6 py-2.5 rounded transition-all duration-200 text-white bg-emerald-600 shadow-sm";
            } else {
                activeBtn.className = "filter-btn font-semibold text-sm px-6 py-2.5 rounded transition-all duration-200 text-white bg-red-600 shadow-sm";
            }

            // Gọi hàm render xe
            renderCars();
        }

        function renderCars() {
            const cards = Array.from(document.querySelectorAll('.car-card'));
            
            // 1. Lọc ra các xe thuộc danh mục được chọn
            const filteredCards = cards.filter(card => {
                const segment = card.getAttribute('data-segment');
                const isHybrid = card.getAttribute('data-hybrid') === 'true';

                if (currentCategory === 'all') return true;
                if (currentCategory === 'hybrid') return isHybrid;
                return segment === currentCategory;
            });

            // 2. Ẩn tất cả xe
            cards.forEach(card => card.style.display = 'none');

            // 3. Tính toán số trang và index cắt mảng
            const totalPages = Math.ceil(filteredCards.length / itemsPerPage);
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;

            // 4. Chỉ hiển thị xe thuộc trang hiện tại
            filteredCards.slice(startIndex, endIndex).forEach(card => {
                card.style.display = 'block';
            });

            // 5. Render nút phân trang
            renderPagination(totalPages);
        }

        function renderPagination(totalPages) {
            const wrapper = document.getElementById('pagination-wrapper');
            wrapper.innerHTML = ''; // Xóa nút cũ

            if (totalPages <= 1) return; // Nếu chỉ có 1 trang thì không cần hiện phân trang

            for (let i = 1; i <= totalPages; i++) {
                const btn = document.createElement('button');
                btn.innerText = i;
                
                // Style cho nút phân trang
                if (i === currentPage) {
                    btn.className = "w-10 h-10 flex items-center justify-center bg-red-600 text-white rounded-lg font-bold shadow-md transition-all";
                } else {
                    btn.className = "w-10 h-10 flex items-center justify-center bg-white border border-neutral-200 text-neutral-600 rounded-lg hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-all font-semibold";
                }
                
                // Sự kiện click chuyển trang
                btn.onclick = () => {
                    currentPage = i;
                    renderCars();
                    // Cuộn mượt mà lên đầu phần danh sách xe
                    document.getElementById('dong-xe').scrollIntoView({ behavior: 'smooth' });
                };
                
                wrapper.appendChild(btn);
            }
        }

        // Khởi chạy khi trang vừa tải xong
        document.addEventListener('DOMContentLoaded', () => {
            // Định dạng nút "Tất cả" sáng lên đầu tiên
            document.getElementById('btn-all').className = "filter-btn font-semibold text-sm px-6 py-2.5 rounded transition-all duration-200 text-white bg-red-600 shadow-sm";
            renderCars(); // Bắt đầu render và phân trang
        });
    </script>
</body>
</html>