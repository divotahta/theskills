<x-guest-layout>
    <div class="min-h-screen flex">
        <!-- Left Side - Image -->
        <div class="hidden lg:block lg:w-1/2 bg-gradient-to-br from-purple-600 via-blue-600 to-indigo-700 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0">
                <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                <svg class="absolute inset-0 w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <defs>
                        <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                            <path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                    <rect width="100" height="100" fill="url(#grid)" />
                </svg>
            </div>
            
            <div class="relative h-full flex items-center justify-center">
                <div class="text-center text-white px-8">
                    <!-- Logo -->
                    <div class="flex items-center justify-center mb-8">
                        <img src="{{ asset('images/logo.png') }}" 
                             alt="TheSkills Logo" 
                             class="w-16 h-16 object-contain mr-4">
                        <span class="text-3xl font-bold">TheSkills</span>
                    </div>
                    
                    <h1 class="text-4xl font-bold mb-4">Start Your Learning Journey</h1>
                    <p class="text-xl text-blue-100 mb-8">Join thousands of students learning on TheSkills</p>
                    
                    <!-- Features -->
                    <div class="space-y-4 text-left max-w-md">
                        <div class="flex items-center">
                            <i class="fas fa-rocket text-yellow-400 text-xl mr-3"></i>
                            <span>Start learning immediately</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-chalkboard-teacher text-yellow-400 text-xl mr-3"></i>
                            <span>Learn from expert instructors</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-trophy text-yellow-400 text-xl mr-3"></i>
                            <span>Earn certificates & badges</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Registration Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <div class="flex items-center justify-center mb-4">
                        <img src="{{ asset('images/logo.png') }}" 
                             alt="TheSkills Logo" 
                             class="w-12 h-12 object-contain mr-3">
                        <span class="text-2xl font-bold text-gray-900">TheSkills</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Create Your Account</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Join our community of learners and start your journey
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Full Name')" class="text-sm font-medium text-gray-700" />
                        <div class="mt-1">
                            <x-text-input id="name" 
                                class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                                type="text" 
                                name="name" 
                                :value="old('name')" 
                                required 
                                autofocus 
                                autocomplete="name"
                                placeholder="Enter your full name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700" />
                        <div class="mt-1">
                            <x-text-input id="email" 
                                class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                required 
                                autocomplete="username"
                                placeholder="Enter your email" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700" />
                        <div class="mt-1">
                            <x-text-input id="password" 
                                class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                type="password"
                                name="password"
                                required 
                                autocomplete="new-password"
                                placeholder="Create a password" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-sm font-medium text-gray-700" />
                        <div class="mt-1">
                            <x-text-input id="password_confirmation" 
                                class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                type="password"
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password"
                                placeholder="Confirm your password" />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-medium text-gray-700">I agree to the <a href="#" class="text-blue-600 hover:text-blue-500">Terms</a> and <a href="#" class="text-blue-600 hover:text-blue-500">Privacy Policy</a></label>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200">
                            <i class="fas fa-user-plus mr-2"></i>
                            {{ __('Create Account') }}
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Already have an account?
                            <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                                Sign in
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout> 