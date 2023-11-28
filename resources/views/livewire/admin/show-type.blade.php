<div>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">{{ $title }} ✨</h1>
            </div>

        </div>

        <!-- Table -->
        <div class="bg-white shadow-lg rounded-sm border border-slate-200">
            <header class="block justify-between items-center sm:flex py-6 px-4">
                <h2 class="font-semibold text-slate-800">
                    All {{ $title }}
                    <span class="text-slate-400 font-medium">{{ $type->total() }}</span>
                </h2>

                <!-- Right: Actions -->
                <div class="mt-3 sm:mt-0 flex space-x-2 sm:justify-between justify-end">

                    @if(!$selected)
                        <!-- Search -->
                        <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center px-2 cursor-pointer">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.4375 9.375C7.61212 9.375 9.375 7.61212 9.375 5.4375C9.375 3.26288 7.61212 1.5 5.4375 1.5C3.26288 1.5 1.5 3.26288 1.5 5.4375C1.5 7.61212 3.26288 9.375 5.4375 9.375Z"
                                    stroke="#8C8C8C" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path
                                    d="M8.22192 8.22168L10.5 10.4998" stroke="#8C8C8C" stroke-linecap="round"
                                    stroke-linejoin="round">
                                </path>
                            </svg>
                        </span>
                            <input wire:model.live.debounce.500ms="search"
                                   class="border-slate-200 hover:border-slate-300 focus:border-primary pl-7 leading-5 shadow-sm placeholder-slate-400 rounded text-sm text-slate-800 bg-white border w-full focus:ring-0"
                                   type="text" placeholder="Search by name" autocomplete="new-text">
                        </div>

                        <!-- Per page -->
                        <select wire:model.live="paginate" class="form-select">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="500">500</option>
                        </select>

                        <!-- Add button -->
                        <a type="button" href="{{ route('admin.type.create') }}"
                           class="mt-0 btn bg-blue-500 hover:bg-blue-400 text-white">
                            <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                                <path
                                    d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z"/>
                            </svg>
                            <span class="hidden xs:block ml-2">{{ $title }}</span>
                        </a>
                    @else
                        <!-- Delete button -->
                        <div class="table-items-action">
                            <div class="flex items-center">
                                <div class="text-sm italic mr-2 whitespace-nowrap">
                                    <span class="table-items-count">{{ count($selected) }}</span> items selected
                                </div>
                                <button
                                    class="btn bg-white border-slate-200 hover:border-slate-300 text-rose-500 hover:text-rose-600"
                                    data-te-toggle="modal"
                                    data-te-target="#modalDeleteSelected"
                                    data-te-ripple-init
                                    data-te-ripple-color="light">
                                    Delete Selected
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </header>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <!-- Table header -->
                    <thead
                        class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-b border-slate-200">
                    <tr>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                            <input wire:model.live="selectAll" class="form-checkbox" type="checkbox"/>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">Name</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left">Slug</div>
                        </th>
                        <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-semibold text-left"></div>
                        </th>

                    </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody class="text-sm divide-y divide-slate-200 border-b border-slate-200">
                    @forelse($type as $key => $item)
                        <tr wire:key="row{{ $item->id }}">
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                <input value="{{ $item->id }}" type="checkbox" class="form-checkbox"
                                       wire:model.live="selected">
                            </td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">{{ $item->name }}</td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">{{ $item->slug }}</td>
                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                                <div class="relative inline-flex" x-data="{ open: false }">
                                    <button
                                        class="text-slate-400 hover:text-slate-500 rounded-full"
                                        :class="{ 'bg-slate-100 text-slate-500': open }"
                                        aria-haspopup="true"
                                        @click.prevent="open = !open"
                                        :aria-expanded="open"
                                    >
                                        <span class="sr-only">Menu</span>
                                        <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                                            <circle cx="16" cy="16" r="2"/>
                                            <circle cx="10" cy="16" r="2"/>
                                            <circle cx="22" cy="16" r="2"/>
                                        </svg>
                                    </button>
                                    <div
                                        class="origin-top-right z-10 absolute bg-white border border-slate-200 rounded shadow-lg overflow-hidden mt-1 mr-2 right-8 -bottom-4"
                                        @click.outside="open = false"
                                        @keydown.escape.window="open = false"
                                        x-show="open"
                                        x-transition:enter="transition ease-out duration-200 transform"
                                        x-transition:enter-start="opacity-0 -translate-y-2"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        x-transition:leave="transition ease-out duration-200"
                                        x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0"
                                        x-cloak
                                    >
                                        <ul>
                                            <li class="cursor-pointer hover:bg-slate-100">
                                                <div class="flex items-center space-x-2 p-3">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke-width="1.5"
                                                             stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round"
                                                                  stroke-linejoin="round"
                                                                  class="text-blue-600"
                                                                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                                                            />
                                                        </svg>
                                                    </span>
                                                    <span>
                                                        <a href="{{ route('admin.type.edit', $item->id) }}">Edit</a>
                                                    </span>
                                                </div>
                                            </li>
                                            <li class="cursor-pointer hover:bg-slate-100">
                                                <div class="flex justify-between items-center space-x-2 p-3">
                                                    <span>
                                                        <button type="button"
                                                                data-te-toggle="modal"
                                                                data-te-target="#modalDelete"
                                                                data-te-ripple-init
                                                                data-te-ripple-color="light"
                                                                class="flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                 viewBox="0 0 24 24" stroke-width="1.5"
                                                                 stroke="currentColor" class="mr-2 w-4 h-4">
                                                            <path stroke-linecap="round"
                                                                  stroke-linejoin="round"
                                                                  class="text-rose-600"
                                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                                            />
                                                        </svg>
                                                            Delete
                                                        </button>
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <x-delete :$item/>
                    @empty
                        <div class="flex justify-center ">
                            <div
                                class="mb-4 rounded-lg bg-slate-100 px-3 py-3 text-sm font-semibold text-slate-400 text-center w-96"
                                role="alert">
                                Result Not Found!
                            </div>
                        </div>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-6">
                {{ $type->onEachSide(2)->links() }}
            </div>
            <x-delete-selected/>
        </div>
    </div>
</div>

