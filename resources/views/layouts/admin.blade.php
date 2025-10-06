<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            @php
                $adminMenu = [
                    [
                        'label' => 'Dashboard',
                        'route' => 'admin.dashboard',
                        'active' => 'admin.dashboard',
                        'icon' => 'dashboard',
                    ],
                    [
                        'label' => 'Courses',
                        'route' => 'admin.courses.index',
                        'active' => 'admin.courses.*',
                        'icon' => 'courses',
                    ],
                    [
                        'label' => 'Create Course',
                        'route' => 'admin.courses.create',
                        'active' => 'admin.courses.create',
                        'icon' => 'create',
                    ],
                    [
                        'label' => 'Course Contents',
                        'route' => 'admin.course-contents.index',
                        'active' => 'admin.course-contents.*',
                        'icon' => 'contents',
                    ],
                    [
                        'label' => 'Categories',
                        'route' => 'admin.categories.index',
                        'active' => 'admin.categories.*',
                        'icon' => 'categories',
                    ],
                    [
                        'label' => 'Users',
                        'route' => 'admin.users.index',
                        'active' => 'admin.users.*',
                        'icon' => 'users',
                    ],
                    [
                        'label' => 'Reports',
                        'route' => 'admin.reports.index',
                        'active' => 'admin.reports.*',
                        'icon' => 'reports',
                    ],
                ];
                // Hanya tampilkan item yang routenya terdaftar
                $adminMenu = array_values(array_filter($adminMenu, function($item) {
                    return \Illuminate\Support\Facades\Route::has($item['route']);
                }));
            @endphp
            <div x-show="sidebarOpen" class="fixed inset-0 z-40 flex lg:hidden" role="dialog" aria-modal="true">
                <div x-show="sidebarOpen" class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>

                <div class="relative flex flex-col w-full max-w-xs pb-4 bg-white">
                    <div class="absolute top-0 right-0 p-2 -mr-12">
                        <button @click="sidebarOpen = false" class="flex items-center justify-center w-10 h-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Mobile Sidebar Content -->
                    <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                        <div class="flex items-center flex-shrink-0 px-4">
                            <img class="w-auto h-8" src="/logo.svg" alt="Logo">
                        </div>
                        <nav class="px-2 mt-5 space-y-1">
                            @foreach ($adminMenu as $item)
                                @php
                                    $isActive = request()->routeIs($item['active']);
                                @endphp
                                <a href="{{ route($item['route']) }}" class="flex items-center px-2 py-2 text-base font-medium rounded-md {{ $isActive ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    @switch($item['icon'])
                                        @case('dashboard')
                                            <svg class="w-6 h-6 mr-4 {{ $isActive ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                                            @break
                                        @case('courses')
                                            <svg class="w-6 h-6 mr-4 {{ $isActive ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12l9-5-9-5-9 5 9 5z" /></svg>
                                            @break
                                        @case('create')
                                            <svg class="w-6 h-6 mr-4 {{ $isActive ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                            @break
                                        @case('contents')
                                            <svg class="w-6 h-6 mr-4 {{ $isActive ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                            @break
                                        @case('categories')
                                            <svg class="w-6 h-6 mr-4 {{ $isActive ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
                                            @break
                                        @case('users')
                                            <svg class="w-6 h-6 mr-4 {{ $isActive ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 100-8 4 4 0 000 8zm8 0a4 4 0 100-8 4 4 0 000 8z" /></svg>
                                            @break
                                        @case('reports')
                                            <svg class="w-6 h-6 mr-4 {{ $isActive ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 00-2-2H5v10h4zm6 0V7h-4v10h4zm2 0h2V5h-2v12z" /></svg>
                                            @break
                                    @endswitch
                                    {{ $item['label'] }}
                                </a>
                            @endforeach
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Static sidebar for desktop -->
            <div class="hidden lg:flex lg:flex-shrink-0">
                <div class="flex flex-col w-64">
                    <div class="flex flex-col flex-1 min-h-0 bg-white border-r border-gray-200">
                        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
                            <div class="flex items-center flex-shrink-0 px-4">
                                <img class="w-auto h-8" src="/logo.svg" alt="Logo">
                            </div>
                            <nav class="flex-1 px-2 mt-5 space-y-1 bg-white">
                                @foreach ($adminMenu as $item)
                                    @php
                                        $isActive = request()->routeIs($item['active']);
                                    @endphp
                                    <a href="{{ route($item['route']) }}" class="flex items-center px-2 py-2 text-sm font-medium rounded-md {{ $isActive ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                        @switch($item['icon'])
                                            @case('dashboard')
                                                <svg class="w-6 h-6 mr-3 {{ $isActive ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                                                @break
                                            @case('courses')
                                                <svg class="w-6 h-6 mr-3 {{ $isActive ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12l9-5-9-5-9 5 9 5z" /></svg>
                                                @break
                                            @case('create')
                                                <svg class="w-6 h-6 mr-3 {{ $isActive ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                                @break
                                            @case('contents')
                                                <svg class="w-6 h-6 mr-3 {{ $isActive ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                                @break
                                            @case('categories')
                                                <svg class="w-6 h-6 mr-3 {{ $isActive ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
                                                @break
                                            @case('users')
                                                <svg class="w-6 h-6 mr-3 {{ $isActive ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 100-8 4 4 0 000 8zm8 0a4 4 0 100-8 4 4 0 000 8z" /></svg>
                                                @break
                                            @case('reports')
                                                <svg class="w-6 h-6 mr-3 {{ $isActive ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 00-2-2H5v10h4zm6 0V7h-4v10h4zm2 0h2V5h-2v12z" /></svg>
                                                @break
                                        @endswitch
                                        {{ $item['label'] }}
                                    </a>
                                @endforeach
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="flex flex-col flex-1 min-w-0 overflow-hidden">
                <!-- Top nav -->
                <div class="flex-shrink-0 border-b border-gray-200">
                    <header class="flex items-center justify-between px-4 py-4 bg-white sm:px-6 lg:px-8">
                        <button @click="sidebarOpen = true" class="px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 lg:hidden">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <div class="flex items-center">
                            <h1 class="text-2xl font-semibold text-gray-900">@yield('header')</h1>
                        </div>

                        <div class="flex items-center">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center text-sm font-medium text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ml-1">
                                            <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                               
                            </x-dropdown>
                        </div>
                    </header>
                </div>

                <main class="flex-1 overflow-y-auto focus:outline-none">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</body>
</html> 