<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Quản lý Các Phiên bản Xe
            </h2>
            <a href="{{ route('admin.cars.create') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow">
                + Thêm phiên bản mới
            </a>
        </div>
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
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Thuộc dòng xe</th>
                                <th class="px-6 py-3">Tên phiên bản</th>
                                <th class="px-6 py-3">Giá niêm yết</th>
                                <th class="px-6 py-3">Động cơ</th>
                                <th class="px-6 py-3 text-right">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cars as $car)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $car->id }}</td>
                                    <td class="px-6 py-4 font-bold text-gray-900">{{ $car->car_model->name }}</td>
                                    <td class="px-6 py-4">{{ $car->variant_name }}</td>
                                    <td class="px-6 py-4 font-bold text-red-600">{{ number_format($car->price, 0, ',', '.') }} VNĐ</td>
                                    <td class="px-6 py-4">
                                        @if($car->fuel_type == 'hybrid')
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold">Hybrid</span>
                                        @else
                                            <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded text-xs font-bold">Xăng</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end items-center gap-2">
                                            <a href="{{ route('admin.cars.edit', $car->id) }}" class="flex items-center gap-1.5 bg-blue-100 hover:bg-blue-200 text-blue-800 px-3 py-1.5 rounded-lg text-xs font-bold transition">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                Sửa
                                            </a>
                                            <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');" class="inline-block m-0 p-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="flex items-center gap-1.5 bg-red-100 hover:bg-red-200 text-red-800 px-3 py-1.5 rounded-lg text-xs font-bold transition">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    Xóa
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Chưa có phiên bản xe nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>