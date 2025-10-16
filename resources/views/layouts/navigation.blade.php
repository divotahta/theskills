<nav class="bg-white shadow-lg sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}" class="flex items-center space-x-2">
                        <img src="{{ asset('images/logo.png') }}" alt="TheSkills Logo"
                            class="w-8 h-8 sm:w-10 sm:h-10 object-contain">
                        <span class="text-xl sm:text-2xl font-bold text-gray-900">TheSkills</span>
                    </a>
                </div>

            <!-- Desktop Navigation - DIBERI JARAK DENGAN lg:ml-12 -->
            <div class="hidden lg:flex lg:items-center lg:space-x-1 lg:ml-12">
                <a href="{{ route('courses.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                    <i class="fas fa-graduation-cap mr-1"></i>
                    Courses
                </a>
                
                <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                    <i class="fas fa-info-circle mr-1"></i>
                    About
                </a>
                <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                    <i class="fas fa-envelope mr-1"></i>
                    Contact
                </a>
                
                <!-- Support Dropdown -->
                <div class="relative" x-data="{ supportOpen: false }">
                    <button @click="supportOpen = !supportOpen" class="inline-flex items-center px-3 py-2 text-sm text-gray-700 hover:text-blue-600 rounded-md font-medium transition-colors">
                        <i class="fas fa-life-ring mr-1"></i>
                        Support
                        <i class="fas fa-chevron-down text-xs ml-1"></i>
                        </button>

                    <div x-show="supportOpen" 
                        @click.away="supportOpen = false"
                        class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-xl z-50"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95">
                            
                        <div class="py-2">
                            <a href="{{ route('support.help-center') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-question-circle w-4 h-4 mr-3 text-blue-600"></i>
                                <span>Help Center</span>
                            </a>
                            <a href="{{ route('support.faq') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-comments w-4 h-4 mr-3 text-blue-600"></i>
                                <span>FAQ</span>
                            </a>
                            <a href="{{ route('support.privacy-policy') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-shield-alt w-4 h-4 mr-3 text-blue-600"></i>
                                <span>Privacy Policy</span>
                            </a>
                            <a href="{{ route('support.terms-of-service') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-file-contract w-4 h-4 mr-3 text-blue-600"></i>
                                <span>Terms of Service</span>
                            </a>
                        </div>
                        </div>
                    </div>
                </div>

            <!-- Search Bar - Desktop -->
            <div class="hidden lg:flex lg:items-center lg:flex-1 lg:max-w-md lg:mx-8">
                <form action="{{ route('courses.index') }}" method="GET" class="w-full">
                            <div class="relative">
                                <input type="text" 
                                    name="search" 
                            placeholder="Search courses, instructors..." 
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"
                                >
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>
                        </form>
            </div>

            <!-- Auth Buttons - Desktop -->
            <div class="hidden lg:flex lg:items-center lg:space-x-3">
                <!-- Teach on The Skills Indonesia -->
                <a href="{{ route('instructor.register') }}" class="text-sm text-gray-700 hover:text-blue-600 font-medium transition-colors px-3 py-2 rounded-md hover:bg-gray-50">
                    <i class="fas fa-chalkboard-teacher mr-1"></i>
                    Teach
                </a>
                
                @auth
                    <div class="relative" x-data="{ userMenuOpen: false }">
                        <button @click="userMenuOpen = !userMenuOpen" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors hover:bg-gray-50">
                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                @if(Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                         alt="{{ Auth::user()->name }}"
                                         class="w-8 h-8 rounded-full object-cover">
                                @else
                                    <i class="fas fa-user text-gray-600 text-sm"></i>
                                @endif
                            </div>
                            <span class="hidden xl:block">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                            </button>
    
                        <div x-show="userMenuOpen" @click.away="userMenuOpen = false" 
                             class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-xl shadow-xl z-50">
                                
                                <!-- User Info -->
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                </div>

                                <!-- Menu Items -->
                                <div class="py-2">
                                @if(Auth::user()->role === 'student')
                                    <a href="{{ route('student.dashboard') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                        <i class="fas fa-tachometer-alt w-4 h-4 mr-3 text-blue-600"></i>
                                        <span>Dashboard</span>
                                    </a>
                                    <a href="{{ route('student.profile.show') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                        <i class="fas fa-user-cog w-4 h-4 mr-3 text-blue-600"></i>
                                        <span>Profile</span>
                                    </a>
                                @elseif(Auth::user()->role === 'instructor')
                                    <a href="{{ route('instructor.dashboard') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                        <i class="fas fa-tachometer-alt w-4 h-4 mr-3 text-blue-600"></i>
                                        <span>Dashboard</span>
                                    </a>
                                    <a href="{{ route('instructor.profile.show') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                        <i class="fas fa-user-cog w-4 h-4 mr-3 text-blue-600"></i>
                                        <span>Profile</span>
                                    </a>
                                @elseif(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                        <i class="fas fa-tachometer-alt w-4 h-4 mr-3 text-blue-600"></i>
                                        <span>Dashboard</span>
                                    </a>
                                    <a href="{{ route('admin.profile.show') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                        <i class="fas fa-user-cog w-4 h-4 mr-3 text-blue-600"></i>
                                        <span>Profile</span>
                                    </a>
                                @endif

                                    <!-- Logout Form -->
                                    <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-100">
                                        @csrf
                                    <button type="submit" class="flex w-full items-center px-4 py-2.5 text-sm text-red-700 hover:bg-red-50 transition-colors">
                                        <i class="fas fa-sign-out-alt w-4 h-4 mr-3"></i>
                                        <span>Logout</span>
                                        </button>
                                    </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors hover:bg-gray-50">
                        <i class="fas fa-sign-in-alt mr-1"></i>
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-user-plus mr-1"></i>
                        Register
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="lg:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-700 hover:text-blue-600 p-2 rounded-md hover:bg-gray-50 transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         class="lg:hidden bg-white border-t border-gray-200 shadow-lg">
        <div class="px-4 py-4 space-y-4">
            <!-- Search Bar Mobile -->
            <div>
                <form action="{{ route('courses.index') }}" method="GET">
                    <div class="relative">
                        <input type="text" 
                            name="search" 
                            placeholder="Search courses, instructors..." 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                        >
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Navigation Links -->
            <div class="space-y-1">
                <a href="{{ route('welcome') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                    <i class="fas fa-home mr-3 text-blue-600"></i>
                    Home
                </a>
                <a href="{{ route('courses.index') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                    <i class="fas fa-graduation-cap mr-3 text-blue-600"></i>
                    Courses
                </a>
                <a href="{{ route('instructor.register') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                    <i class="fas fa-chalkboard-teacher mr-3 text-blue-600"></i>
                    Teach on The Skills Indonesia
                </a>
                <a href="{{ route('about') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                    <i class="fas fa-info-circle mr-3 text-blue-600"></i>
                    About
                </a>
                <a href="{{ route('contact') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                    <i class="fas fa-envelope mr-3 text-blue-600"></i>
                    Contact
                </a>
                <a href="{{ route('support') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                    <i class="fas fa-life-ring mr-3 text-blue-600"></i>
                    Support
                </a>
        </div>

        @auth
                <div class="border-t border-gray-200 pt-4">
                    <!-- User Info -->
                    <div class="px-4 py-3 bg-gray-50 rounded-lg mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                @if(Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                         alt="{{ Auth::user()->name }}"
                                         class="w-12 h-12 rounded-full object-cover">
                                @else
                                    <i class="fas fa-user text-gray-600 text-lg"></i>
                                @endif
                            </div>
                            <div>
                                <div class="font-semibold text-base text-gray-900">{{ Auth::user()->name }}</div>
                                <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                </div>

                    <!-- User Menu -->
                    <div class="space-y-1">
                        @if(Auth::user()->role === 'student')
                            <a href="{{ route('student.dashboard') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                <i class="fas fa-tachometer-alt mr-3 text-blue-600"></i>
                                Dashboard
                            </a>
                            <a href="{{ route('student.profile.show') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                <i class="fas fa-user-cog mr-3 text-blue-600"></i>
                                Profile
                            </a>
                        @elseif(Auth::user()->role === 'instructor')
                            <a href="{{ route('instructor.dashboard') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                <i class="fas fa-tachometer-alt mr-3 text-blue-600"></i>
                                Dashboard
                            </a>
                            <a href="{{ route('instructor.profile.show') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                <i class="fas fa-user-cog mr-3 text-blue-600"></i>
                                Profile
                            </a>
                        @elseif(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                <i class="fas fa-tachometer-alt mr-3 text-blue-600"></i>
                                Dashboard
                            </a>
                            <a href="{{ route('admin.profile.show') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                <i class="fas fa-user-cog mr-3 text-blue-600"></i>
                                Profile
                            </a>
                        @endif
                        
                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center px-4 py-3 text-base font-medium text-red-700 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                Logout
                            </button>
                        </form>
                    </div>
            </div>
        @else
                <div class="border-t border-gray-200 pt-4 space-y-3">
                    <a href="{{ route('login') }}" class="flex items-center justify-center px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-colors border border-gray-300">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="flex items-center justify-center px-4 py-3 text-base font-medium bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:from-blue-700 hover:to-purple-700 rounded-lg transition-all duration-200 shadow-md">
                        <i class="fas fa-user-plus mr-2"></i>
                        Register
                    </a>
                </div>
            @endauth
            </div>
    </div>
</nav>
