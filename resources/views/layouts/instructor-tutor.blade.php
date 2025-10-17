<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TheSkills') }} - Instructor</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @stack('styles')
</head>

<body class="font-sans antialiased bg-gray-50" x-data="{ mobileMenuOpen: false }">
    <div class="min-h-screen bg-gray-50">
        <!-- Top Navigation -->
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo and Navigation -->
                    <div class="flex">
                        <!-- Logo -->
                        <a href="{{ route('instructor.dashboard') }}" class="flex-shrink-0 flex items-center">

                            <img src="{{ asset('images/logo.png') }}" alt="TheSkills" class="h-8 w-8">
                            <span class="ml-2 text-xl font-bold text-gray-900">TheSkills</span>

                        </a>
                        <!-- Desktop Navigation -->
                        <div class="hidden md:ml-8 md:flex md:space-x-8">
                            <a href="{{ route('instructor.dashboard') }}"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('instructor.dashboard') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }} border-b-2 border-transparent">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                                </svg>
                                Dashboard
                            </a>

                            <a href="{{ route('instructor.courses.index') }}"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('instructor.courses.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }} border-b-2 border-transparent">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                                My Courses
                            </a>

                            <a href="{{ route('instructor.students.index') }}"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('instructor.students.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }} border-b-2 border-transparent">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 100-8 4 4 0 000 8zm8 0a4 4 0 100-8 4 4 0 000 8z">
                                    </path>
                                </svg>
                                Students
                            </a>

                            <a href="{{ route('instructor.analytics.index') }}"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('instructor.analytics.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }} border-b-2 border-transparent">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                                Analytics
                            </a>

                            {{-- <a href="{{ route('instructor.notifications.index') }}"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('instructor.notifications.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }} border-b-2 border-transparent">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-5 5v-5zM4.828 7l2.586 2.586a2 2 0 002.828 0L16 7m-5 5h.01M5 20h6a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Notifikasi
                                @if (auth()->user()->unread_notifications_count > 0)
                                    <span
                                        class="ml-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                                        {{ auth()->user()->unread_notifications_count > 99 ? '99+' : auth()->user()->unread_notifications_count }}
                                    </span>
                                @endif
                            </a> --}}
                        </div>
                    </div>

                    <!-- Right side - Notifications and Profile -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <div class="relative" x-data="{
                            notificationsOpen: false,
                            unreadCount: {{ auth()->user()->unread_notifications_count ?? 0 }},
                            init() {
                                // Auto-refresh unread count every 30 seconds
                                setInterval(() => {
                                    this.fetchUnreadCount();
                                }, 30000);
                            },
                            fetchUnreadCount() {
                                fetch('/instructor/notifications/unread-count', {
                                        method: 'GET',
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest',
                                            'Accept': 'application/json',
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                                        },
                                        credentials: 'same-origin'
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Network response was not ok: ' + response.status);
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        if (data && typeof data.unread_count !== 'undefined') {
                                            this.unreadCount = data.unread_count;
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error fetching unread count:', error);
                                    });
                            }
                        }">
                            <button @click="notificationsOpen = !notificationsOpen"
                                class="relative p-2 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded-full">
                                <span class="sr-only">View notifications</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                </svg>
                                <!-- Unread count badge -->
                                <span x-show="unreadCount > 0" x-text="unreadCount > 99 ? '99+' : unreadCount"
                                    class="absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full min-w-[20px] h-5">
                                </span>
                            </button>

                            <!-- Notifications dropdown -->
                            <div x-show="notificationsOpen" @click.away="notificationsOpen = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-95"
                                class="absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-lg shadow-xl z-50">

                                <!-- Header -->
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-lg font-semibold text-gray-900">Notifikasi</h3>
                                        <a href="{{ route('instructor.notifications.index') }}"
                                            class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                            Lihat Semua
                                        </a>
                                    </div>
                                </div>

                                <!-- Notifications list -->
                                <div class="max-h-96 overflow-y-auto" x-data="{
                                    notifications: [],
                                    loadNotifications() {
                                        fetch('/instructor/notifications/recent', {
                                                method: 'GET',
                                                headers: {
                                                    'X-Requested-With': 'XMLHttpRequest',
                                                    'Accept': 'application/json',
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                                                },
                                                credentials: 'same-origin'
                                            })
                                            .then(response => {
                                                if (!response.ok) {
                                                    throw new Error('Network response was not ok: ' + response.status);
                                                }
                                                return response.json();
                                            })
                                            .then(data => {
                                                if (data && Array.isArray(data.notifications)) {
                                                    this.notifications = data.notifications;
                                                } else {
                                                    this.notifications = [];
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error loading notifications:', error);
                                                this.notifications = [];
                                            });
                                    }
                                }" x-init="loadNotifications()">
                                    <template x-for="notification in notifications" :key="notification.id">
                                        <div class="px-4 py-3 border-b border-gray-100 hover:bg-gray-50 cursor-pointer"
                                            @click="window.location.href = notification.url">
                                            <div class="flex items-start space-x-3">
                                                <div class="flex-shrink-0">
                                                    <div class="w-8 h-8 rounded-full flex items-center justify-center"
                                                        :class="notification.is_read ? 'bg-gray-100' : 'bg-blue-100'">
                                                        <i
                                                            :class="notification.icon + ' ' + notification.color + ' text-sm'"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900"
                                                        :class="notification.is_read ? '' : 'font-bold'"
                                                        x-text="notification.title"></p>
                                                    <p class="text-sm text-gray-600 mt-1"
                                                        x-text="notification.message"></p>
                                                    <p class="text-xs text-gray-500 mt-1"
                                                        x-text="notification.created_at"></p>
                                                </div>
                                                <div x-show="!notification.is_read" class="flex-shrink-0">
                                                    <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>

                                    <!-- Empty state -->
                                    <div x-show="notifications.length === 0" class="px-4 py-8 text-center">
                                        <div
                                            class="mx-auto w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                            <i class="fas fa-bell-slash text-gray-400 text-xl"></i>
                                        </div>
                                        <p class="text-sm text-gray-600">Tidak ada notifikasi</p>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="px-4 py-3 border-t border-gray-200">
                                    <a href="{{ route('instructor.notifications.index') }}"
                                        class="block w-full text-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                        Lihat Semua Notifikasi
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Profile dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full"
                                    src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&color=7F9CF5&background=EBF4FF' }}"
                                    alt="{{ auth()->user()->name }}">
                                <span
                                    class="ml-2 text-sm font-medium text-gray-700 hidden md:block">{{ auth()->user()->name }}</span>
                                <svg class="ml-1 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                @click.away="open = false">
                                <a href="{{ route('instructor.profile.show', auth()->user()) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                        Profile
                                    </div>
                                </a>
                                <a href="{{ route('instructor.profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Settings
                                    </div>
                                </a>
                                <div class="border-t border-gray-100"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                                </path>
                                            </svg>
                                            Sign out
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Mobile menu button -->
                        <div class="md:hidden">
                            <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                                <span class="sr-only">Open main menu</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu -->
                <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95" class="md:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <a href="{{ route('instructor.dashboard') }}"
                            class="block pl-3 pr-4 py-2 text-base font-medium {{ request()->routeIs('instructor.dashboard') ? 'text-blue-600 bg-blue-50 border-blue-500' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} border-l-4 border-transparent">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                                </svg>
                                Dashboard
                            </div>
                        </a>

                        <a href="{{ route('instructor.courses.index') }}"
                            class="block pl-3 pr-4 py-2 text-base font-medium {{ request()->routeIs('instructor.courses.*') ? 'text-blue-600 bg-blue-50 border-blue-500' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} border-l-4 border-transparent">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                                My Courses
                            </div>
                        </a>

                        <a href="{{ route('instructor.students.index') }}"
                            class="block pl-3 pr-4 py-2 text-base font-medium {{ request()->routeIs('instructor.students.*') ? 'text-blue-600 bg-blue-50 border-blue-500' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} border-l-4 border-transparent">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 100-8 4 4 0 000 8zm8 0a4 4 0 100-8 4 4 0 000 8z">
                                    </path>
                                </svg>
                                Students
                            </div>
                        </a>

                        <a href="{{ route('instructor.analytics.index') }}"
                            class="block pl-3 pr-4 py-2 text-base font-medium {{ request()->routeIs('instructor.analytics.*') ? 'text-blue-600 bg-blue-50 border-blue-500' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} border-l-4 border-transparent">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                                Analytics
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @yield('content')
        </main>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>

</html>
