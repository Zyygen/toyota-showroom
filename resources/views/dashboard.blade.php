<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-neutral-800 leading-tight uppercase tracking-wider">
            Bảng Điều Khiển Tổng Quan
        </h2>
    </x-slot>

    <div class="py-12 bg-neutral-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div>
                <h3 class="text-sm font-black text-neutral-500 uppercase tracking-widest mb-4">Khách Hàng Đăng Ký Tư Vấn</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-neutral-200 border-l-4 border-l-blue-500">
                        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-1">Hôm nay</p>
                        <p class="text-3xl font-black text-neutral-900">{{ $reqToday }} <span class="text-sm font-medium text-neutral-500">yêu cầu</span></p>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-neutral-200 border-l-4 border-l-blue-500">
                        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-1">Tuần này</p>
                        <p class="text-3xl font-black text-neutral-900">{{ $reqWeek }} <span class="text-sm font-medium text-neutral-500">yêu cầu</span></p>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-neutral-200 border-l-4 border-l-blue-500">
                        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-1">Tháng này</p>
                        <p class="text-3xl font-black text-neutral-900">{{ $reqMonth }} <span class="text-sm font-medium text-neutral-500">yêu cầu</span></p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-black text-neutral-500 uppercase tracking-widest mb-4">Khách Hàng Đã Chốt Cọc</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-neutral-200 border-l-4 border-l-emerald-500 relative overflow-hidden">
                        <div class="absolute -right-4 -top-4 opacity-10">
                            <svg class="w-24 h-24 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-1">Hôm nay</p>
                        <p class="text-3xl font-black text-emerald-600">{{ $paidToday }} <span class="text-sm font-medium text-neutral-500">xe</span></p>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-neutral-200 border-l-4 border-l-emerald-500 relative overflow-hidden">
                        <div class="absolute -right-4 -top-4 opacity-10">
                            <svg class="w-24 h-24 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-1">Tuần này</p>
                        <p class="text-3xl font-black text-emerald-600">{{ $paidWeek }} <span class="text-sm font-medium text-neutral-500">xe</span></p>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-neutral-200 border-l-4 border-l-emerald-500 relative overflow-hidden">
                        <div class="absolute -right-4 -top-4 opacity-10">
                            <svg class="w-24 h-24 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-1">Tháng này</p>
                        <p class="text-3xl font-black text-emerald-600">{{ $paidMonth }} <span class="text-sm font-medium text-neutral-500">xe</span></p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-black text-neutral-500 uppercase tracking-widest mb-4">Kho Sản Phẩm</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-neutral-200 flex justify-between items-center">
                        <div>
                            <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-1">Dòng xe đang bán</p>
                            <p class="text-2xl font-black text-neutral-900">{{ $totalModels }} <span class="text-sm font-medium text-neutral-500">Mẫu mã</span></p>
                        </div>
                        <a href="{{ route('admin.car_models.index') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 underline">Quản lý</a>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-neutral-200 flex justify-between items-center">
                        <div>
                            <p class="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-1">Phiên bản chi tiết</p>
                            <p class="text-2xl font-black text-neutral-900">{{ $totalCars }} <span class="text-sm font-medium text-neutral-500">Phiên bản</span></p>
                        </div>
                        <a href="{{ route('admin.cars.index') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 underline">Quản lý</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>