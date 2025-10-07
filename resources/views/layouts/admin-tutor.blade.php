<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TheSkills') }} - Admin</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50" x-data="{ mobileMenuOpen: false }">
    <div class="min-h-screen bg-gray-50">
        <!-- Top Navigation -->
        <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.482 0l5.58-2.392a1 1 0 00-.818-1.838l-5.58 2.392a1 1 0 01-.828 0L7 8.5V5.562a8.969 8.969 0 00-1.05.174 1 1 0 01-.89.89 11.115 11.115 0 00.25 3.762l-1.66.712a1 1 0 00-.818 1.838l7 3a1 1 0 00.787 0l7-3a1 1 0 00-.818-1.838l-1.66-.712a11.115 11.115 0 00.25-3.762 1 1 0 01-.89-.89 8.968 8.968 0 00-1.05-.174V8.5l-1.818-.78a3 3 0 00-2.482 0L9.3 16.573z"/>
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900">TheSkills Admin</span>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} transition-colors">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.courses.index') }}" 
                           class="text-sm font-medium {{ request()->routeIs('admin.courses.*') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} transition-colors">
                            Courses
                        </a>
                        <a href="{{ route('admin.categories.index') }}" 
                           class="text-sm font-medium {{ request()->routeIs('admin.categories.*') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} transition-colors">
                            Categories
                        </a>
                        <a href="{{ route('admin.course-levels.index') }}" 
                           class="text-sm font-medium {{ request()->routeIs('admin.course-levels.*') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} transition-colors">
                            Course Levels
                        </a>
                        <a href="{{ route('admin.users.index') }}" 
                           class="text-sm font-medium {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.students.*') || request()->routeIs('admin.instructors.*') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} transition-colors">
                            Users
                        </a>
                        <a href="{{ route('admin.profile.show') }}" 
                           class="text-sm font-medium {{ request()->routeIs('admin.profile.*') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} transition-colors">
                            Profile
                        </a>
                    </div>

                    <!-- User Menu -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <button class="p-2 text-gray-400 hover:text-gray-600 relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.5 19.5a1.5 1.5 0 01-1.5-1.5V6a1.5 1.5 0 011.5-1.5h15A1.5 1.5 0 0121 6v12a1.5 1.5 0 01-1.5 1.5h-15z"/>
                            </svg>
                            <span class="absolute -top-1 -right-1 h-3 w-3 bg-red-500 rounded-full"></span>
                        </button>

                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" 
                                    class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none">
                                @if(Auth::user()->avatar)
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                @else
                                    <div class="h-8 w-8 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <span class="ml-2 hidden md:block">{{ Auth::user()->name }}</span>
                                <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false" x-transition
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                                <a href="{{ route('admin.profile.show') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Profile
                                </a>
                                <a href="{{ route('admin.profile.edit') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Settings
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" 
                                class="p-2 text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Navigation -->
                <div x-show="mobileMenuOpen" x-transition class="md:hidden border-t border-gray-200 py-4">
                    <div class="space-y-2">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="block px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600' }} rounded-md">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.courses.index') }}" 
                           class="block px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.courses.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600' }} rounded-md">
                            Courses
                        </a>
                        <a href="{{ route('admin.categories.index') }}" 
                           class="block px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.categories.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600' }} rounded-md">
                            Categories
                        </a>
                        <a href="{{ route('admin.course-levels.index') }}" 
                           class="block px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.course-levels.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600' }} rounded-md">
                            Course Levels
                        </a>
                        <a href="{{ route('admin.users.index') }}" 
                           class="block px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.students.*') || request()->routeIs('admin.instructors.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600' }} rounded-md">
                            Users
                        </a>
                        <a href="{{ route('admin.profile.show') }}" 
                           class="block px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.profile.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600' }} rounded-md">
                            Profile
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
