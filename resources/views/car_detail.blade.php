<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết xe {{ $carModel->name }} - Toyota Việt Nam</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center text-white font-bold text-xl">T</div>
                <span class="text-2xl font-bold tracking-widest text-red-600 uppercase">Toyota</span>
            </a>
            <nav class="hidden md:flex gap-8 font-semibold text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-red-600 transition-colors">Trang chủ</a>
                <a href="#booking" class="hover:text-red-600 transition-colors">Đăng ký lái thử</a>
            </nav>
        </div>
    </header>

    <div class="w-full h-[50vh] bg-gray-200 flex items-center justify-center relative overflow-hidden">
        @if($carModel->image)
            <img src="{{ $carModel->image }}" alt="{{ $carModel->name }}" class="absolute inset-0 w-full h-full object-cover">
        @else
            <div class="text-gray-400 text-2xl">Chưa có hình ảnh</div>
        @endif
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative z-10 text-center text-white">
            <h1 class="text-5xl font-bold uppercase tracking-wider shadow-sm">{{ $carModel->name }}</h1>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold text-gray-800 border-b-4 border-red-600 inline-block pb-2 mb-8">Bảng Giá Các Phiên Bản</h2>
        
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-800 text-white text-lg">
                        <th class="p-4">Tên phiên bản</th>
                        <th class="p-4">Động cơ</th>
                        <th class="p-4 text-right">Giá niêm yết</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($carModel->cars as $car)
                        <tr class="border-b hover:bg-gray-100 transition-colors">
                            <td class="p-4 font-bold text-gray-800 text-lg">{{ $car->variant_name }}</td>
                            <td class="p-4">
                                @if($car->fuel_type == 'hybrid')
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-bold border border-green-300">Hybrid</span>
                                @else
                                    <span class="bg-gray-200 text-gray-800 px-3 py-1 rounded-full text-sm font-bold border border-gray-300">Xăng</span>
                                @endif
                            </td>
                            <td class="p-4 text-right font-black text-red-600 text-xl">{{ number_format($car->price, 0, ',', '.') }} VNĐ</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-6 text-center text-gray-500 text-lg">Dòng xe này hiện chưa có phiên bản nào được mở bán.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="booking" class="bg-gray-200 py-16">
        <div class="max-w-3xl mx-auto px-4">
            <div class="bg-white rounded-lg shadow-xl p-8">
                <h2 class="text-3xl font-bold text-center mb-2 uppercase text-red-600">Nhận báo giá & Lái thử</h2>
                <p class="text-center text-gray-500 mb-8">Bạn đang quan tâm dòng xe <strong>{{ $carModel->name }}</strong>? Vui lòng để lại thông tin.</p>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="car_model" value="{{ $carModel->name }}">

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Họ và tên *</label>
                        <input type="text" name="fullname" required class="w-full border-gray-300 border rounded-md px-4 py-2 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Số điện thoại *</label>
                        <input type="text" name="phone" required class="w-full border-gray-300 border rounded-md px-4 py-2 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Ghi chú thêm (VD: Tôi muốn hỏi giá bản 1.5G)</label>
                        <textarea name="message" rows="3" class="w-full border-gray-300 border rounded-md px-4 py-2 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-red-600 text-white font-bold py-3 rounded-md hover:bg-red-700 transition-colors uppercase">
                        Gửi yêu cầu
                    </button>
                </form>
            </div>
        </div>
    </div>

    <footer class="bg-gray-900 text-white text-center py-6 mt-12">
        <p>&copy; 2026 Bài tập lớn - Quản lý Showroom Toyota.</p>
    </footer>

</body>
</html>