<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">{{ $title }} ✨</h1>
            </div>

        </div>

        <!-- Card -->
        <div class="flex sm:flex-row md:flex-col items-center">
            <div class="grow w-2/3 content-center bg-white shadow-lg rounded-sm border border-slate-200">
                    <header class="flex flex-row px-5 py-4 border-b border-slate-100 justify-between">
                        <h2 class="font-semibold text-slate-800">Create {{ $title }}</h2>
                        <a href="{{ route('admin.type.index') }}" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
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
                        <form action="{{ route('admin.type.store') }}" method="post" class="w-full mx-auto">
                            @csrf
                            <div class="mb-5">
                                <label class="block text-sm font-medium text-slate-600 mb-2 ">
                                    Name
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input value="{{ old('name') }}" name="name" type="text" placeholder="Nama Type"
                                       class="form-input w-full focus:border-blue-500" required>
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
