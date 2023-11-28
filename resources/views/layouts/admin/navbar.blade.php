<div class="px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16 -mb-px">

        <!-- Header: Left side -->
        <div class="flex">
            <!-- Hamburger button -->
            <button
                class="text-slate-500 hover:text-slate-600 lg:hidden"
                @click.stop="sidebarOpen = !sidebarOpen"
                aria-controls="sidebar"
                :aria-expanded="sidebarOpen"
            >
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <rect x="4" y="5" width="16" height="2"/>
                    <rect x="4" y="11" width="16" height="2"/>
                    <rect x="4" y="17" width="16" height="2"/>
                </svg>
            </button>

        </div>

        <!-- Header: Right side -->
        <div class="flex items-center space-x-3">

            <!-- Divider -->
            <hr class="w-px h-6 bg-slate-200"/>

            <!-- User button -->
            <div class="relative inline-flex" x-data="{ open: false }">
                <button
                    class="inline-flex justify-center items-center group"
                    aria-haspopup="true"
                    @click.prevent="open = !open"
                    :aria-expanded="open"
                >
                    <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                         alt="{{ Auth::user()->name }}" width="32"
                         height="32" alt="User"/>
                    <div class="flex items-center truncate">
                                    <span
                                        class="truncate ml-2 text-sm font-medium group-hover:text-slate-800">{{ auth()->user()->name }}</span>
                        <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" viewBox="0 0 12 12">
                            <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z"/>
                        </svg>
                    </div>
                </button>
                <div
                    class="origin-top-right z-10 absolute top-full right-0 min-w-44 bg-white border border-slate-200 py-1.5 rounded shadow-lg overflow-hidden mt-1"
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
                    <div class="pt-0.5 pb-2 px-3 mb-1 border-b border-slate-200">
                        <div class="font-medium text-slate-800">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-slate-500 italic">{{ auth()->user()->roles }}</div>
                    </div>
                    <ul>
                        <li>
                            <a class="font-medium text-sm text-indigo-500 hover:text-indigo-600 flex items-center py-1 px-3"
                               href="{{ route('profile.show') }}" @click="open = false" @focus="open = true"
                               @focusout="open = false">Settings</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <a class="font-medium text-sm text-indigo-500 hover:text-indigo-600 flex items-center py-1 px-3"
                                   href="{{ route('logout') }}" @click="open = false" @focus="open = true"
                                   @click.prevent="$root.submit();"
                                   @focusout="open = false">Sign Out</a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </div>
</div>
