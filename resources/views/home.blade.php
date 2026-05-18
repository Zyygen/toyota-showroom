<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toyota Việt Nam - Trang Chủ</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <!-- Navbar chuẩn doanh nghiệp -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <!-- Giả lập Logo Toyota -->
                <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center text-white font-bold text-xl">T</div>
                <span class="text-2xl font-bold tracking-widest text-red-600 uppercase">Toyota</span>
            </div>
            <nav class="hidden md:flex gap-8 font-semibold text-gray-600">
                <a href="#" class="hover:text-red-600 transition-colors">Sản phẩm</a>
                <a href="#" class="hover:text-red-600 transition-colors">Dịch vụ</a>
                <a href="#contact-section" class="hover:text-red-600 transition-colors">Đăng ký lái thử</a>
            </nav>
        </div>
    </header>

    <!-- Banner chính -->
    <div class="w-full h-[60vh] bg-gray-900 flex items-center justify-center relative overflow-hidden">
        <img src="https://via.placeholder.com/1920x800/222222/ffffff?text=TOYOTA+CAMRY+MỚI" alt="Banner" class="absolute inset-0 w-full h-full object-cover opacity-50">
        <div class="relative z-10 text-center text-white">
            <h1 class="text-5xl md:text-7xl font-bold mb-4">CHUYỂN ĐỘNG TIÊN PHONG</h1>
            <p class="text-xl md:text-2xl font-light">Khám phá các dòng xe thế hệ mới.</p>
        </div>
    </div>

    <!-- Danh sách xe -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-center mb-12 uppercase">Các dòng xe nổi bật</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($carModels as $model)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden group">
                <div class="overflow-hidden">
                    <img src="{{ $model->image }}" alt="{{ $model->name }}" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-2xl font-bold mb-2">{{ $model->name }}</h3>
                    <p class="text-gray-500 mb-6">Giá từ: <span class="text-red-600 font-bold">{{ number_format($model->cars->min('price'), 0, ',', '.') }} VNĐ</span></p>
                    <a href="#contact-section" class="inline-block bg-white text-red-600 font-semibold border-2 border-red-600 px-6 py-2 rounded hover:bg-red-600 hover:text-white transition-colors duration-300">
                        Nhận báo giá
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Form Liên Hệ / Đăng ký lái thử -->
    <div id="contact-section" class="bg-gray-200 py-16">
        <div class="max-w-3xl mx-auto px-4">
            <div class="bg-white rounded-lg shadow-xl p-8">
                <h2 class="text-3xl font-bold text-center mb-2 uppercase text-red-600">Đăng ký tư vấn & Lái thử</h2>
                <p class="text-center text-gray-500 mb-8">Vui lòng để lại thông tin, chúng tôi sẽ liên hệ lại ngay.</p>

                <!-- Hiển thị thông báo thành công -->
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Họ và tên *</label>
                        <input type="text" name="fullname" required class="w-full border-gray-300 border rounded-md px-4 py-2 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Số điện thoại *</label>
                        <input type="text" name="phone" required class="w-full border-gray-300 border rounded-md px-4 py-2 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Dòng xe quan tâm *</label>
                        <select name="car_model" required class="w-full border-gray-300 border rounded-md px-4 py-2 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 bg-white">
                            <option value="">-- Chọn dòng xe --</option>
                            @foreach($carModels as $model)
                                <option value="{{ $model->name }}">{{ $model->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Ghi chú thêm</label>
                        <textarea name="message" rows="3" class="w-full border-gray-300 border rounded-md px-4 py-2 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-red-600 text-white font-bold py-3 rounded-md hover:bg-red-700 transition-colors duration-300 uppercase">
                        Gửi yêu cầu
                    </button>
                </form>
            </div>
        </div>
    </div>

    <footer class="bg-gray-900 text-white text-center py-6">
        <p>&copy; 2026 Bài tập lớn - Quản lý Showroom Toyota.</p>
    </footer>

</body>
</html>