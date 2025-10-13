<x-guest-layout>
    <div class="min-h-screen flex">
        <!-- Left Side - Image -->
        <div class="hidden lg:block lg:w-1/2 bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 relative overflow-hidden">
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
                    
                    <h1 class="text-4xl font-bold mb-4">Welcome Back!</h1>
                    <p class="text-xl text-blue-100 mb-8">Continue your learning journey with TheSkills</p>
                    
                    <!-- Features -->
                    <div class="space-y-4 text-left max-w-md">
                        <div class="flex items-center">
                            <i class="fas fa-graduation-cap text-yellow-400 text-xl mr-3"></i>
                            <span>Access to 500+ courses</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-certificate text-yellow-400 text-xl mr-3"></i>
                            <span>Earn certificates</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-users text-yellow-400 text-xl mr-3"></i>
                            <span>Join 10K+ students</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
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
                    <h2 class="text-3xl font-bold text-gray-900">Welcome Back!</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Sign in to access your personalized learning dashboard
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

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
                                autofocus 
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
                                autocomplete="current-password"
                                placeholder="Enter your password" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-blue-600 hover:text-blue-800" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            {{ __('Sign in') }}
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500">
                                Create account
                            </a>
                        </p>
                    </div>

                    <!-- Social Login -->
                    {{-- <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">Or continue with</span>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <a href="#" class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <svg class="w-5 h-5" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M47.532 24.5528C47.532 22.9214 47.3997 21.2811 47.1175 19.6761H24.48V28.9181H37.4434C36.9055 31.8988 35.177 34.5356 32.6461 36.2111V42.2078H40.3801C44.9217 38.0278 47.532 31.8547 47.532 24.5528Z" fill="#4285F4"/>
                                    <path d="M24.48 48.0016C30.9529 48.0016 36.4116 45.8764 40.3888 42.2078L32.6549 36.2111C30.5031 37.675 27.7252 38.5039 24.4888 38.5039C18.2275 38.5039 12.9187 34.2798 11.0139 28.6006H3.03296V34.7825C7.10718 42.8868 15.4056 48.0016 24.48 48.0016Z" fill="#34A853"/>
                                    <path d="M11.0051 28.6006C9.99973 25.6199 9.99973 22.3922 11.0051 19.4115V13.2296H3.03298C-0.371021 20.0112 -0.371021 28.0009 3.03298 34.7825L11.0051 28.6006Z" fill="#FBBC04"/>
                                    <path d="M24.48 9.49932C27.9016 9.44641 31.2086 10.7339 33.6866 13.0973L40.5387 6.24523C36.2 2.17101 30.4414 -0.068932 24.48 0.00161733C15.4055 0.00161733 7.10718 5.11644 3.03296 13.2296L11.005 19.4115C12.901 13.7235 18.2187 9.49932 24.48 9.49932Z" fill="#EA4335"/>
                                </svg>
                            </a>

                            <a href="#" class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <svg class="w-5 h-5" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24.001 0c-13.255 0-24 10.745-24 24 0 10.515 6.708 19.451 16.033 22.627 1.172.215 1.601-.508 1.601-1.129 0-.557-.02-2.031-.031-3.977-6.524 1.418-7.902-3.148-7.902-3.148-1.066-2.711-2.602-3.432-2.602-3.432-2.129-1.455.161-1.426.161-1.426 2.355.166 3.594 2.418 3.594 2.418 2.094 3.586 5.493 2.551 6.829 1.951.213-1.516.82-2.551 1.492-3.137-5.211-.592-10.693-2.605-10.693-11.594 0-2.562.914-4.654 2.415-6.293-.241-.593-1.047-2.979.23-6.209 0 0 1.969-.631 6.449 2.402 1.871-.521 3.877-.781 5.871-.791 1.994.01 4 .27 5.871.791 4.478-3.033 6.444-2.402 6.444-2.402 1.279 3.23.473 5.616.232 6.209 1.504 1.639 2.414 3.731 2.414 6.293 0 9.011-5.492 10.996-10.719 11.578.843.726 1.594 2.156 1.594 4.344 0 3.137-.027 5.666-.027 6.438 0 .627.424 1.357 1.613 1.127C41.299 43.445 48 34.513 48 24c0-13.255-10.745-24-24-24z" fill="currentColor"/>
                                </svg>
                            </a>
                        </div>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
</x-guest-layout> 