<div
    data-te-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none backdrop-blur-sm"
    id="modalDelete"
    tabindex="-1"
    aria-labelledby="modalDeleteTitle"
    aria-modal="true"
    role="dialog">

    <div
        data-te-modal-dialog-ref
        id="modalDelete{{ $item->id }}"
        class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
        <div
            class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
            <div class="px-5 py-4 max-h-[500px] overflow-y-scroll min-h-fit">
                <div class="text-center w-full">
                    <!--Icon-->
                    <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 bg-rose-100 mx-auto">
                        <svg class="w-4 h-4 shrink-0 fill-current text-rose-500" viewBox="0 0 16 16">
                            <path
                                d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z"/>
                        </svg>
                    </div>
                    <!--Modal title-->
                    <div class="mb-2 mt-4">
                        <h5 class="text-lg text-slate-800 font-semibold leading-normal"
                            id="modalDeleteTitle">
                            Are you sure to delete this?
                        </h5>
                    </div>

                    <!--Modal body-->
                    <div class="text-sm mb-4">
                        <p class="text-slate-800">You won't be able to revert this!</p>
                    </div>

                    <!--Modal footer-->
                    <div class="flex flex-wrap justify-end space-x-2">
                        <button
                            type="button"
                            class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600"
                            data-te-modal-dismiss
                            data-te-ripple-init
                            data-te-ripple-color="light">
                            Cancel
                        </button>
                        <button
                            type="button"
                            class="btn-sm bg-rose-500 hover:bg-rose-600 text-white"
                            wire:click="delete({{ $item->id }})"
                            data-te-ripple-init
                            data-te-modal-dismiss
                            data-te-ripple-color="light">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
