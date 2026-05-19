<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nâng cấp thông tin Dòng Xe: {{ $carModel->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-8 text-gray-900">
                    
                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6 text-sm">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.car_models.update', $carModel->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="name" class="block text-xs font-bold uppercase text-gray-700 tracking-wider mb-2">Tên dòng xe *</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $carModel->name) }}" required
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>

                        <div>
                            <label for="tagline" class="block text-xs font-bold uppercase text-gray-700 tracking-wider mb-2">Câu Slogan / Khẩu hiệu giới thiệu xe</label>
                            <input type="text" name="tagline" id="tagline" value="{{ old('tagline', $carModel->tagline) }}" placeholder="Ví dụ: Hiệu suất vinh quang, lột xác kiêu hãnh"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                <label class="block text-xs font-bold uppercase text-gray-700 tracking-wider mb-2">Ảnh đại diện sản phẩm (PNG/Chống cắt góc)</label>
                                @if($carModel->image)
                                    <div class="mb-3 bg-white p-2 border rounded flex justify-center h-32 items-center">
                                        <img src="{{ $carModel->image }}" class="max-h-full object-contain">
                                    </div>
                                @endif
                                <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-neutral-800 file:text-white hover:file:bg-red-600 file:cursor-pointer">
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                <label class="block text-xs font-bold uppercase text-gray-700 tracking-wider mb-2">Ảnh Banner lớn đầu trang (Tỉ lệ 16:9 nằm ngang)</label>
                                @if($carModel->banner_image)
                                    <div class="mb-3 bg-white p-2 border rounded flex justify-center h-32 items-center">
                                        <img src="{{ $carModel->banner_image }}" class="max-h-full object-cover w-full">
                                    </div>
                                @endif
                                <input type="file" name="banner_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-neutral-800 file:text-white hover:file:bg-red-600 file:cursor-pointer">
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-xs font-bold uppercase text-gray-700 tracking-wider mb-2">Thông tin giới thiệu & Thông số nổi bật</label>
                            <textarea name="description" id="description" rows="8" placeholder="Nhập bài viết mô tả chi tiết, trang bị kỹ thuật hoặc thiết kế ngoại thất..."
                                      class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 resize-none font-sans text-sm leading-relaxed">{{ old('description', $carModel->description) }}</textarea>
                            <p class="text-xs text-gray-400 mt-2">Mẹo: Bạn có thể nhấn Enter xuống dòng thoải mái để bài viết hiển thị rõ ràng từng đoạn ở ngoài trang chủ.</p>
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('admin.car_models.index') }}" class="text-gray-500 hover:text-gray-800 font-semibold underline text-sm">Hủy bỏ</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-8 rounded-md shadow transition duration-150 text-sm">
                                Lưu Cập Nhật Premium
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h3 class="font-black text-2xl text-gray-900 mb-6 uppercase tracking-tight">Quản lý Hình ảnh Phân bổ</h3>

        @php
            // Định nghĩa sẵn các danh mục để tạo form tự động
            $featureCategories = [
                'ngoai_that' => 'Ngoại thất',
                'noi_that' => 'Nội thất',
                'van_hanh' => 'Vận hành',
                'an_toan' => 'An toàn'
            ];
            // Gom nhóm các tính năng đã up theo từng danh mục
            $groupedFeatures = $carModel->features->groupBy('type');
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach($featureCategories as $typeKey => $typeName)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-t-4 border-red-600">
                    <h4 class="font-black text-lg text-gray-800 mb-4 uppercase">{{ $typeName }}</h4>

                    <div class="space-y-3 mb-6 min-h-[100px]">
                        @if(isset($groupedFeatures[$typeKey]))
                            @foreach($groupedFeatures[$typeKey] as $feature)
                                <div class="flex gap-4 p-3 border rounded-lg bg-gray-50 relative group">
                                    <img src="{{ $feature->image }}" class="w-20 h-16 object-cover rounded shadow-sm border border-gray-200">
                                    <div class="pr-6">
                                        <h5 class="font-bold text-sm text-gray-900">{{ $feature->title }}</h5>
                                        <p class="text-xs text-gray-500 line-clamp-2 mt-1">{{ $feature->description }}</p>
                                    </div>
                                    <form action="{{ route('admin.car_models.features.destroy', $feature->id) }}" method="POST" class="absolute top-2 right-2 opacity-50 group-hover:opacity-100 transition">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:bg-red-100 rounded-full w-6 h-6 flex items-center justify-center font-bold text-xl leading-none" onclick="return confirm('Xóa hình ảnh này?');">&times;</button>
                                    </form>
                                </div>
                            @endforeach
                        @else
                            <div class="flex items-center justify-center h-full border-2 border-dashed border-gray-200 rounded-lg p-4">
                                <p class="text-xs text-gray-400 italic">Chưa có hình ảnh {{ $typeName }} nào.</p>
                            </div>
                        @endif
                    </div>

                    <form action="{{ route('admin.car_models.features.store', $carModel->id) }}" method="POST" enctype="multipart/form-data" class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        @csrf
                        <input type="hidden" name="type" value="{{ $typeKey }}">

                        <div class="mb-3">
                            <label class="block text-xs font-bold text-gray-600 mb-1">Tiêu đề ảnh *</label>
                            <input type="text" name="title" required placeholder="VD: Cụm đèn LED..." class="w-full border-gray-300 rounded text-sm focus:ring-red-500 py-2">
                        </div>
                        <div class="mb-3">
                            <label class="block text-xs font-bold text-gray-600 mb-1">Mô tả chi tiết</label>
                            <textarea name="description" rows="2" class="w-full border-gray-300 rounded text-sm focus:ring-red-500 resize-none py-2"></textarea>
                        </div>
                        <div class="flex flex-col xl:flex-row items-start xl:items-center justify-between gap-3 mt-4">
                            <input type="file" name="image" required accept="image/*" class="text-xs w-full text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 cursor-pointer">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-xs font-bold whitespace-nowrap shadow-sm w-full xl:w-auto uppercase tracking-wide">
                                + Up {{ $typeName }}
                            </button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>