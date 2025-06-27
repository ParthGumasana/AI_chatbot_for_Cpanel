<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Welcome</h1>
                <p class="text-lg text-gray-600">Sign in to your account or create a new one</p>
            </div>

            <!-- Main Container -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden" x-data="{ activeTab: 'signin' }">
                <!-- Tab Navigation -->
                <div class="flex bg-gray-50">
                    <button 
                        @click="activeTab = 'signin'" 
                        :class="activeTab === 'signin' ? 'bg-white text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-gray-900'"
                        class="flex-1 px-6 py-4 text-sm font-medium transition-all duration-200"
                    >
                        Sign In
                    </button>
                    <button 
                        @click="activeTab = 'signup'" 
                        :class="activeTab === 'signup' ? 'bg-white text-blue-600 border-b-2 border-blue-600' : 'text-gray-600 hover:text-gray-900'"
                        class="flex-1 px-6 py-4 text-sm font-medium transition-all duration-200"
                    >
                        Sign Up
                    </button>
                </div>

                <!-- Tab Content -->
                <div class="p-8">
                    <!-- Sign In Tab -->
                    <div x-show="activeTab === 'signin'" x-transition class="space-y-6">
                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                                <p class="text-green-800">{{ session('status') }}</p>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                                <p class="text-red-800">{{ session('error') }}</p>
                            </div>
                        @endif

                        <!-- Google OAuth Button -->
                        <div>
                            <a href="{{ route('google.redirect') }}" class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg shadow-sm bg-white text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                </svg>
                                Continue with Google
                            </a>
                        </div>

                        <!-- Divider -->
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">Or continue with email</span>
                            </div>
                        </div>

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}" class="space-y-4">
                            @csrf

                            <!-- Email -->
                            <div>
                                <label for="login_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input id="login_email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="login_password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input id="login_password" type="password" name="password" required autocomplete="current-password"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 @error('password') border-red-500 @enderror">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between">
                                <label class="flex items-center">
                                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                                </label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-500">Forgot password?</a>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 font-medium">
                                Sign In
                            </button>
                        </form>
                    </div>

                    <!-- Sign Up Tab -->
                    <div x-show="activeTab === 'signup'" x-transition class="space-y-6">
                        <!-- Google OAuth Button for Sign Up -->
                        <div>
                            <a href="{{ route('google.redirect') }}" class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg shadow-sm bg-white text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                </svg>
                                Sign up with Google
                            </a>
                        </div>

                        <!-- Divider -->
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">Or sign up with email</span>
                            </div>
                        </div>

                        <!-- Sign Up Form -->
                        <form method="POST" action="{{ route('register') }}" class="space-y-4">
                            @csrf

                            <!-- Name -->
                            <div>
                                <label for="register_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input id="register_name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 @error('name') border-red-500 @enderror"
                                       placeholder="Enter your full name">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="register_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input id="register_email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 @error('email') border-red-500 @enderror"
                                       placeholder="Enter your email">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="register_password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input id="register_password" type="password" name="password" required autocomplete="new-password"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 @error('password') border-red-500 @enderror"
                                       placeholder="Create a password">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                                       placeholder="Confirm your password">
                            </div>

                            <!-- Terms -->
                            <div class="flex items-start">
                                <input type="checkbox" required class="mt-1 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-600">
                                    I agree to the 
                                    <a href="#" class="text-blue-600 hover:text-blue-500 underline">Terms of Service</a> 
                                    and 
                                    <a href="#" class="text-blue-600 hover:text-blue-500 underline">Privacy Policy</a>
                                </span>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 font-medium">
                                Create Account
                            </button>
                        </form>

                        <!-- Features List -->
                        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                            <h3 class="text-sm font-medium text-blue-900 mb-3">What you get:</h3>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-sm text-blue-800">Free 14-day trial</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-sm text-blue-800">No credit card required</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-sm text-blue-800">Cancel anytime</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center text-gray-600">
                <p>&copy; {{ date('Y') }} AI Chatbot Platform. All rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- Alpine.js for tab functionality -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('authTabs', () => ({
                activeTab: 'signin'
            }))
        })
    </script>
</x-guest-layout>

<!-- Mobile Toggle Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add mobile toggle functionality if needed
    const toggleButtons = document.querySelectorAll('[data-toggle]');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const target = this.getAttribute('data-toggle');
            const targetElement = document.querySelector(target);
            
            if (targetElement) {
                targetElement.classList.toggle('hidden');
            }
        });
    });
});
</script> 