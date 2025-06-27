{{-- Enhanced Home Page --}}
@extends('layouts.app')
@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-blue-50 via-white to-indigo-50 overflow-hidden">
    <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                AI Chatbot for
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">CPanel</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
                Transform your hosting business with intelligent, scalable AI chatbots. 
                Automate support, boost engagement, and save time with our seamless CPanel integration. Streamline operations, reduce costs, and deliver 24/7 intelligent support with advanced NLP.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <x-button class="text-lg px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                    Start Free Trial
                </x-button>
                <a href="{{ route('features') }}" class="text-lg px-8 py-4 text-blue-600 hover:text-blue-700 font-semibold transition-colors duration-200">
                    See How It Works →
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Everything You Need to Succeed
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Powerful features designed to make your chatbot implementation seamless and effective.
            </p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="group">
                <x-card class="h-full transform hover:scale-105 transition-all duration-300 hover:shadow-xl border-0 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 ml-4">Easy CPanel Integration</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        Plug-and-play setup with your CPanel in minutes. No coding required, just copy and paste.
                    </p>
                </x-card>
            </div>
            <div class="group">
                <x-card class="h-full transform hover:scale-105 transition-all duration-300 hover:shadow-xl border-0 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center group-hover:bg-green-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 ml-4">AI-Powered Responses</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        Advanced natural language processing ensures your chatbot understands and responds to customer queries intelligently.
                    </p>
                </x-card>
            </div>
            <div class="group">
                <x-card class="h-full transform hover:scale-105 transition-all duration-300 hover:shadow-xl border-0 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center group-hover:bg-indigo-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 ml-4">24/7 Availability</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        Never miss a customer query. Your chatbot works around the clock to provide instant support.
                    </p>
                </x-card>
            </div>
            <div class="group">
                <x-card class="h-full transform hover:scale-105 transition-all duration-300 hover:shadow-xl border-0 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center group-hover:bg-yellow-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 ml-4">Human Handoff</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        Seamlessly transfer complex queries to human agents when needed, ensuring no customer is left behind.
                    </p>
                </x-card>
            </div>
            <div class="group">
                <x-card class="h-full transform hover:scale-105 transition-all duration-300 hover:shadow-xl border-0 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center group-hover:bg-pink-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 ml-4">Custom Training</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        Train your chatbot on your specific domain knowledge for more accurate and relevant responses.
                    </p>
                </x-card>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-3xl md:text-4xl font-bold text-blue-600 mb-2">10K+</div>
                <div class="text-gray-600">Active Users</div>
            </div>
            <div>
                <div class="text-3xl md:text-4xl font-bold text-blue-600 mb-2">50M+</div>
                <div class="text-gray-600">Conversations</div>
            </div>
            <div>
                <div class="text-3xl md:text-4xl font-bold text-blue-600 mb-2">99.9%</div>
                <div class="text-gray-600">Uptime</div>
            </div>
            <div>
                <div class="text-3xl md:text-4xl font-bold text-blue-600 mb-2">24/7</div>
                <div class="text-gray-600">Support</div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials Section -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Loved by Hosting Providers Worldwide
            </h2>
            <p class="text-xl text-gray-600">
                See what our customers are saying about their experience.
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg">A</div>
                    <div class="ml-4">
                        <div class="font-semibold text-gray-900">Alex Chen</div>
                        <div class="text-sm text-gray-600">Hosting Provider</div>
                    </div>
                </div>
                <p class="text-gray-700 italic leading-relaxed">
                    "The integration was seamless and our support tickets dropped by 40% in the first month. Our customers love the instant responses!"
                </p>
            </div>
            
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-8 transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-lg">P</div>
                    <div class="ml-4">
                        <div class="font-semibold text-gray-900">Priya Sharma</div>
                        <div class="text-sm text-gray-600">SaaS Founder</div>
                    </div>
                </div>
                <p class="text-gray-700 italic leading-relaxed">
                    "The analytics dashboard gives us real insight into our users' needs. We've improved our product based on chatbot conversations."
                </p>
            </div>
            
            <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-8 transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">S</div>
                    <div class="ml-4">
                        <div class="font-semibold text-gray-900">Sam Rodriguez</div>
                        <div class="text-sm text-gray-600">Web Agency</div>
                    </div>
                </div>
                <p class="text-gray-700 italic leading-relaxed">
                    "Our clients are amazed by the professional chatbot experience. It's become a key selling point for our hosting packages."
                </p>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-20 bg-gradient-to-r from-blue-600 to-indigo-700">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
            Ready to Transform Your Support?
        </h2>
        <p class="text-xl text-blue-100 mb-8">
            Join thousands of hosting providers who are already saving time and improving customer satisfaction.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <x-button class="text-lg px-8 py-4 bg-white text-blue-600 hover:bg-gray-100 transform hover:scale-105 transition-all duration-200 shadow-lg">
                Start Free Trial
            </x-button>
            <a href="{{ route('pricing') }}" class="text-lg px-8 py-4 text-white border-2 border-white hover:bg-white hover:text-blue-600 rounded-lg font-semibold transition-all duration-200">
                View Pricing
            </a>
        </div>
    </div>
</div>

<style>
.bg-grid-pattern {
    background-image: 
        linear-gradient(rgba(59, 130, 246, 0.1) 1px, transparent 1px),
        linear-gradient(90deg, rgba(59, 130, 246, 0.1) 1px, transparent 1px);
    background-size: 20px 20px;
}
</style>
@endsection 