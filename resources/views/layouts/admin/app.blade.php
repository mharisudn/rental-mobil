<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title ?? config('app.name') }}</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('admin/css/vendors/flatpickr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/style.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body
    class="font-inter antialiased bg-slate-100 text-slate-600"
    :class="{ 'sidebar-expanded': sidebarExpanded }"
    x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }"
    x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))"
>
@include('sweetalert::alert')
<script>
    if (localStorage.getItem('sidebar-expanded') == 'true') {
        document.querySelector('body').classList.add('sidebar-expanded');
    } else {
        document.querySelector('body').classList.remove('sidebar-expanded');
    }
</script>

<!-- Page wrapper -->
<div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <div>
        @include('layouts.admin.sidebar')
    </div>

    <!-- Content area -->
    <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">

        <!-- Site header -->
        <header class="sticky top-0 bg-white border-b border-slate-200 z-30">
            @include('layouts.admin.navbar')
        </header>

        <main>
            {{ $slot }}
        </main>

    </div>

</div>

@livewireScripts

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts/>
</body>

</html>
