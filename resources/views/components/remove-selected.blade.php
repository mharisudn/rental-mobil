<div
    class="fixed inset-0 bg-slate-900 bg-opacity-30 z-50 transition-opacity"
    x-data="{ show : false }"
    x-show="show"
    x-on:open-modal.window="show = true"
    x-on:close-modal.window="show = false"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-out duration-100"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    tabindex="-1"
    x-cloak
>
    <!-- Modal backdrop -->
    <div
        class="fixed inset-0 bg-slate-900 bg-opacity-30 z-50 transition-opacity"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-out duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        aria-hidden="true"
        x-cloak
    ></div>

    <!-- Modal dialog -->
    <div
        id="modalRemoveSelected"
        class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center px-4 sm:px-6"
        role="dialog"
        aria-modal="true"
        x-transition:enter="transition ease-in-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in-out duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        x-cloak
    >
        <div class="bg-white rounded shadow-lg overflow-auto max-w-lg w-full max-h-full">
            <div class="p-5 flexspace-x-4">
                <div class="text-center">
                    <!-- Icon -->
                    <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 bg-rose-100 mx-auto">
                        <svg class="w-4 h-4 shrink-0 fill-current text-rose-500" viewBox="0 0 16 16">
                            <path
                                d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z"/>
                        </svg>
                    </div>
                    <!-- Content -->
                    <form action="#">
                        @csrf
                        <div>
                            <!-- Modal header -->
                            <div class="mb-2 mt-4">
                                <div class="text-lg font-semibold text-slate-800">Are you sure to delete this?</div>
                            </div>
                            <!-- Modal content -->
                            <div class="text-sm mb-4">
                                <div class="space-y-2">
                                    <p>You won't able to revert this!</p>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex flex-wrap justify-end space-x-2">
                                <button class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600"
                                        type="button"
                                        x-data x-on:click="$dispatch('close-modal')">
                                    Cancel
                                </button>
                                <a wire:click="removeSelected()" type="button"
                                   class="btn-sm bg-rose-500 hover:bg-rose-600 text-white">Yes, Delete it</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
