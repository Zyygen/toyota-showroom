<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Thêm Phiên Bản Xe</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                        <ul>@foreach ($errors->all() as $error) <li>- {{ $error }}</li> @endforeach</ul>
                    </div>
                @endif

                <form action="{{ route('admin.cars.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Thuộc dòng xe *</label>
                        <select name="car_model_id" required class="w-full border rounded p-2 focus:ring-red-500">
                            <option value="">-- Chọn dòng xe --</option>
                            @foreach($carModels as $model)
                                <option value="{{ $model->id }}">{{ $model->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Tên phiên bản (VD: 1.5G CVT) *</label>
                        <input type="text" name="variant_name" required class="w-full border rounded p-2 focus:ring-red-500">
                    </div>

                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Giá niêm yết (VNĐ) *</label>
                            <input type="number" name="price" required class="w-full border rounded p-2 focus:ring-red-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Năm sản xuất *</label>
                            <input type="number" name="year" value="{{ date('Y') }}" required class="w-full border rounded p-2 focus:ring-red-500">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">Loại động cơ *</label>
                        <select name="fuel_type" required class="w-full border rounded p-2 focus:ring-red-500">
                            <option value="petrol">Xăng</option>
                            <option value="hybrid">Hybrid</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.cars.index') }}" class="font-bold text-gray-600 mt-2">Hủy</a>
                        <button type="submit" class="bg-red-600 text-white font-bold py-2 px-6 rounded shadow hover:bg-red-700">Lưu Thông Tin</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>