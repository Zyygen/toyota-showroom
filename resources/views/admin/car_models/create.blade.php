<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Thêm Dòng Xe Mới') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.car_models.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Tên dòng xe *</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                            <p class="text-xs text-gray-500 mt-1">Ví dụ: Toyota Vios, Toyota Camry...</p>
                        </div>

                        <div class="mb-6">
                            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Hình ảnh đại diện</label>
                            <input type="file" name="image" id="image" accept="image/*"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-red-500">
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('admin.car_models.index') }}" class="text-gray-600 hover:text-gray-900 font-bold">Hủy bỏ</a>
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded focus:outline-none shadow">
                                Lưu Thông Tin
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>