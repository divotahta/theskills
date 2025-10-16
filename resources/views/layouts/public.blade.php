<x-guest-layout>
<body class="font-sans antialiased bg-gray-50">
    <div id="app">
        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Logo & Description -->
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center space-x-2 mb-4">
                            <img src="{{ asset('images/logo.png') }}" alt="TheSkills Logo"
                                class="w-10 h-10 object-contain">
                            <span class="text-2xl font-bold">TheSkills</span>
                        </div>
                        <p class="text-gray-400 mb-4">
                            Platform pembelajaran online terbaik untuk mengembangkan skill dan pengetahuan Anda.
                            Belajar dari instruktur berpengalaman dan raih impian Anda.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-linkedin-in text-xl"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('welcome') }}"
                                    class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                            <li><a href="{{ route('courses.index') }}"
                                    class="text-gray-400 hover:text-white transition-colors">Courses</a></li>
                            <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition-colors">About
                                    Us</a></li>
                            <li><a href="{{ route('contact') }}"
                                    class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                        </ul>
                    </div>

                    <!-- Support -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Support</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('support.help-center') }}" class="text-gray-400 hover:text-white transition-colors">Help
                                    Center</a></li>
                            <li><a href="{{ route('support.privacy-policy') }}" class="text-gray-400 hover:text-white transition-colors">Privacy
                                    Policy</a></li>
                            <li><a href="{{ route('support.terms-of-service') }}" class="text-gray-400 hover:text-white transition-colors">Terms of
                                    Service</a></li>
                            <li><a href="{{ route('support.faq') }}" class="text-gray-400 hover:text-white transition-colors">FAQ</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                    <p class="text-gray-400">&copy; 2025 TheSkills. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>

</x-guest-layout>
