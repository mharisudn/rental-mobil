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
            <div class="grow w-full content-center bg-white shadow-lg rounded-sm border border-slate-200">
                <header class="flex flex-row px-5 py-4 border-b border-slate-100 justify-between">
                    <h2 class="font-semibold text-slate-800">Create {{ $title }}</h2>
                    <a href="{{ route('admin.item.index') }}" item="button">
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
                        <form action="{{ route('admin.item.store') }}" method="post" class="w-full mx-auto"
                              enctype="multipart/form-data">
                            @csrf

                            <!-- Name -->
                            <div class="mb-5">
                                <label class="block text-sm font-medium text-slate-600 mb-2 ">
                                    Name
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input value="{{ old('name') }}" name="name" type="text" placeholder="Nama Item"
                                       class="form-input w-full focus:border-blue-500" required>
                            </div>

                            <!-- Grid Brand and Type -->
                            <div class="grid grid-cols md:grid-cols-2 md:gap-4">
                                <div class="mb-5 w-full">
                                    <label class="block text-sm font-medium text-slate-600 mb-2 ">
                                        Brand
                                        <span class="text-rose-500">*</span>
                                    </label>
                                    <select value="{{ old('brand_id') }}" name="brand_id"
                                            class="form-select w-full focus:border-blue-500" required>
                                        <option value="">Select Brands</option>
                                        @foreach($brands as $brand)
                                            <option
                                                value="{{ $brand->id }}" {{ old(['brand_id'] == $brand->id ? 'selected' : '') }}>

                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-5 w-full">
                                    <label class="block text-sm font-medium text-slate-600 mb-2 ">
                                        Type
                                        <span class="text-rose-500">*</span>
                                    </label>
                                    <select value="{{ old('type_id') }}" name="type_id"
                                            class="form-select w-full focus:border-blue-500" required>
                                        <option value="">Select Types</option>
                                        @foreach($types as $type)
                                            <option
                                                value="{{ $type->id }}" {{ old(['type_id'] == $type->id ? 'selected' : '') }}>

                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Grid Price and Feature -->
                            <div class="grid grid-cols md:grid-cols-2 md:gap-4">
                                <div class="mb-5 w-full">
                                    <label class="block text-sm font-medium text-slate-600 mb-2 ">
                                        Price
                                        <span class="text-rose-500">*</span>
                                    </label>
                                    <input value="{{ old('price') }}" name="price" type="number"
                                           class="form-input w-full focus:border-blue-500"
                                           placeholder="Price" required>
                                </div>
                                <div class="mb-5 w-full">
                                    <label for="features" class="block text-sm font-medium text-slate-600 mb-2 ">
                                        Features
                                        <span class="text-rose-500">*</span>
                                    </label>
                                    <input value="{{ old('features') }}" name="features" type="text"
                                           placeholder="Description Features"
                                           class="form-textarea w-full focus:border-blue-500" required/>
                                </div>
                            </div>

                            <!-- Grid Rating and Review -->
                            <div class="grid grid-cols md:grid-cols-2 md:gap-4">
                                <div class="mb-5 w-full">
                                    <label class="block text-sm font-medium text-slate-600 mb-2 ">
                                        Rating
                                        <span class="text-rose-500">*</span>
                                    </label>
                                    <input value="{{ old('star') }}" name="star" type="number"
                                           class="form-input w-full focus:border-blue-500"
                                           placeholder="Rating" required>
                                </div>
                                <div class="mb-5 w-full">
                                    <label class="block text-sm font-medium text-slate-600 mb-2 ">
                                        Review
                                        <span class="text-rose-500">*</span>
                                    </label>
                                    <input value="{{ old('review') }}" name="review" type="number"
                                           class="form-input w-full focus:border-blue-500"
                                           placeholder="Review" required>
                                </div>
                            </div>

                            <!-- Photos -->
                            <div class="bg-white p7 rounded w-9/12 mx-auto">
                                <div x-data="dataFileDnD()"
                                     class="relative flex flex-col p-4 text-gray-400 border border-gray-200 rounded mb-5">
                                    <div x-ref="dnd"
                                         class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
                                        <input type="file" name="photos[]" multiple
                                               class="absolute inset-0 z-50 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer"
                                               @change="addFiles($event)"
                                               @dragover="$refs.dnd.classList.add('border-blue-400'); $refs.dnd.classList.add('ring-4'); $refs.dnd.classList.add('ring-inset');"
                                               @dragleave="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                                               @drop="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                                               title=""/>

                                        <div class="flex flex-col items-center justify-center py-10 text-center">
                                            <svg class="w-6 h-6 mr-1 text-current-50" xmlns="http://www.w3.org/2000/svg"
                                                 fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <p class="m-0">Drag your files here or click in this area.</p>
                                        </div>
                                    </div>

                                    <template x-if="files.length > 0">
                                        <div class="grid grid-cols-2 gap-4 mt-4 md:grid-cols-6"
                                             @drop.prevent="drop($event)"
                                             @dragover.prevent="$event.dataTransfer.dropEffect = 'move'">
                                            <template x-for="(_, index) in Array.from({ length: files.length })">
                                                <div
                                                    class="relative flex flex-col items-center overflow-hidden text-center bg-gray-100 border rounded cursor-move select-none"
                                                    style="padding-top: 100%;" @dragstart="dragstart($event)"
                                                    @dragend="fileDragging = null"
                                                    :class="{'border-blue-600': fileDragging == index}" draggable="true"
                                                    :data-index="index">
                                                    <button
                                                        class="absolute top-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none"
                                                        type="button" @click="remove(index)">
                                                        <svg class="w-4 h-4 text-gray-700"
                                                             xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                    <template x-if="files[index].type.includes('audio/')">
                                                        <svg
                                                            class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                                                        </svg>
                                                    </template>
                                                    <template
                                                        x-if="files[index].type.includes('application/') || files[index].type === ''">
                                                        <svg
                                                            class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                        </svg>
                                                    </template>
                                                    <template x-if="files[index].type.includes('image/')">
                                                        <img
                                                            class="absolute inset-0 z-0 object-cover w-full h-full border-4 border-white preview"
                                                            x-bind:src="loadFile(files[index])"/>
                                                    </template>
                                                    <template x-if="files[index].type.includes('video/')">
                                                        <video
                                                            class="absolute inset-0 object-cover w-full h-full border-4 border-white pointer-events-none preview">
                                                            <fileDragging x-bind:src="loadFile(files[index])"
                                                                          type="video/mp4">
                                                        </video>
                                                    </template>

                                                    <div
                                                        class="absolute bottom-0 left-0 right-0 flex flex-col p-2 text-xs bg-white bg-opacity-50">
                                                        <span class="w-full font-bold text-gray-900 truncate"
                                                              x-text="files[index].name">Loading</span>
                                                        <span class="text-xs text-gray-900"
                                                              x-text="humanFileSize(files[index].size)">...</span>
                                                    </div>

                                                    <div class="absolute inset-0 z-40 transition-colors duration-300"
                                                         @dragenter="dragenter($event)"
                                                         @dragleave="fileDropping = null"
                                                         :class="{'bg-blue-200 bg-opacity-80': fileDropping == index && fileDragging != index}">
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <x-photos-script/>

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
