<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Booking ✨</h1>
            </div>

        </div>

        <!-- Card -->
        <div class="flex sm:flex-row md:flex-col items-center">
            <div class="grow w-full content-center bg-white shadow-lg rounded-sm border border-slate-200">
                <header class="flex flex-row px-5 py-4 border-b border-slate-100 justify-between">
                    <h2 class="font-semibold text-slate-800">Edit Booking - {{ $booking->name }}</h2>
                    <a href="{{ route('admin.booking.index') }}" item="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </a>
                </header>

                <div class="p-3">
                    <!-- Handling errors -->
                    @if($errors->any())
                        <div
                            class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Danger</span>
                            <div>
                                <span class="font-medium">Whoops.. terjadi kesalahan!</span>
                                <ul class="mt-1.5 list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <!-- Card content -->
                    <div class="flex flex-wrap">
                        <form action="{{ route('admin.booking.update', $booking->id) }}" method="POST"
                              class="w-full mx-auto"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div class="mb-5">
                                <label class="block text-sm font-medium text-slate-600 mb-2 ">
                                    Nama
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input value="{{ old('name') ?? $booking->name }}" name="name" type="text"
                                       placeholder="Nama Item"
                                       class="form-input w-full focus:border-blue-500" required>
                            </div>

                            <!-- Grid Start and End Date -->
                            <div class="grid grid-cols md:grid-cols-2 md:gap-4">
                                <div class="mb-5 w-full">
                                    <label class="block text-sm font-medium text-slate-600 mb-2 ">
                                        Tanggal Mulai
                                        <span class="text-rose-500">*</span>
                                    </label>
                                    <input value="{{ old('start_date') ?? $booking->start_date->format('Y-m-d') }}" name="start_date" type="date"
                                            class="form-input w-full focus:border-blue-500" required />
                                </div>
                                <div class="mb-5 w-full">
                                    <label class="block text-sm font-medium text-slate-600 mb-2 ">
                                        Tanggal Selesai
                                        <span class="text-rose-500">*</span>
                                    </label>
                                    <input value="{{ old('end_date') ?? $booking->end_date->format('Y-m-d') }}" name="end_date" type="date"
                                           class="form-input w-full focus:border-blue-500" required />
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="mb-5">
                                <label class="block text-sm font-medium text-slate-600 mb-2 ">
                                    Alamat
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input value="{{ old('address') ?? $booking->address }}" name="address" type="text"
                                       placeholder="Alamat"
                                       class="form-input w-full focus:border-blue-500" required>
                            </div>

                            <!-- Grid Livewire Dropdown Laravolt -->
                            @livewire('admin.list-region', [
                            'province_id' => old('province_code', $booking->province_code),
                            'city_id' => old('city_code', $booking->city_code),
                            'district_id' => old('district_code', $booking->district_code),
                            'village_id' => old('village_code', $booking->village_code),
                            ])

                            <!-- Grid Status and Payment -->
                            <div class="grid grid-cols md:grid-cols-2 md:gap-4">
                                <div class="mb-5 w-full">
                                    <label class="block text-sm font-medium text-slate-600 mb-2 ">
                                        Status Booking
                                        <span class="text-rose-500">*</span>
                                    </label>
                                    <select value="{{ old('status') }}" name="status"
                                            class="form-select w-full focus:border-blue-500" required>
                                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirm" {{ $booking->status == 'confirm' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="done" {{ $booking->status == 'done' ? 'selected' : '' }}>Done</option>
                                    </select>
                                </div>

                                <div class="mb-5 w-full">
                                    <label class="block text-sm font-medium text-slate-600 mb-2 ">
                                        Status Pembayaran
                                        <span class="text-rose-500">*</span>
                                    </label>
                                    <select value="{{ old('payment_status') }}" name="payment_status"
                                            class="form-select w-full focus:border-blue-500" required>
                                        <option value="success" {{ $booking->payment_status == 'success' ? 'selected' : '' }}>Success</option>
                                        <option value="failed" {{ $booking->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                                        <option value="expired" {{ $booking->payment_status == 'expired' ? 'selected' : '' }}>Expired</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Card button -->
                            <div class="flex justify-end mb-3">
                                <button type="reset" class="btn bg-gray-200 text-slate-500 mx-2 active:bg-gray-100">
                                    Reset
                                </button>
                                <button type="submit" class="btn bg-blue-500 text-white active:bg-blue-300">
                                    Submit
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
