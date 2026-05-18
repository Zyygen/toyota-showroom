<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Quản lý Dòng xe Toyota') }}
            </h2>
            <a href="#" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow">
                + Thêm dòng xe mới
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-3">ID</th>
                                    <th scope="col" class="px-6 py-3">Hình ảnh</th>
                                    <th scope="col" class="px-6 py-3">Tên dòng xe</th>
                                    <th scope="col" class="px-6 py-3">Đường dẫn (Slug)</th>
                                    <th scope="col" class="px-6 py-3 text-right">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($carModels as $model)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 font-bold">{{ $model->id }}</td>
                                        <td class="px-6 py-4">
                                            @if($model->image)
                                                <img src="{{ $model->image }}" alt="{{ $model->name }}" class="w-20 h-12 object-cover rounded border">
                                            @else
                                                <span class="text-gray-400 italic">Chưa có ảnh</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 font-semibold text-gray-900">{{ $model->name }}</td>
                                        <td class="px-6 py-4">{{ $model->slug }}</td>
                                        <td class="px-6 py-4 text-right space-x-2">
                                            <a href="#" class="font-medium text-blue-600 hover:underline">Sửa</a>
                                            <a href="#" class="font-medium text-red-600 hover:underline">Xóa</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            Chưa có dòng xe nào trong hệ thống.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>