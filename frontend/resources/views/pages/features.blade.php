{{-- Enhanced Features Page --}}
@extends('layouts.app')
@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
            Powerful Features for Modern Hosting
        </h1>
        <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
            Everything you need to create intelligent, engaging chatbots that transform your customer support and boost your business. Built for CPanel and beyond.
        </p>
    </div>
</div>

<!-- Core Features -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Core Features
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Built with modern AI technology to deliver exceptional customer experiences.
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- AI-Powered Responses -->
            <div class="group">
                <x-card class="h-full transform hover:scale-105 transition-all duration-300 hover:shadow-xl border-0 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            
            <!-- Easy Integration -->
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
            
            <!-- Real-time Analytics -->
            <div class="group">
                <x-card class="h-full transform hover:scale-105 transition-all duration-300 hover:shadow-xl border-0 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center group-hover:bg-yellow-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 ml-4">Easy Integration</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        Plug-and-play setup with your CPanel or website. No coding required, just copy and paste.
                    </p>
                </x-card>
            </div>
            
            <!-- Multi-language Support -->
            <div class="group">
                <x-card class="h-full transform hover:scale-105 transition-all duration-300 hover:shadow-xl border-0 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center group-hover:bg-yellow-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 ml-4">Multi-language Support</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        Support customers in their preferred language with automatic translation and localization features.
                    </p>
                </x-card>
            </div>
            
            <!-- Custom Branding -->
            <div class="group">
                <x-card class="h-full transform hover:scale-105 transition-all duration-300 hover:shadow-xl border-0 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center group-hover:bg-pink-200 transition-colors duration-200">
                            <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17v.01"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 ml-4">Custom Branding</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        Match your brand colors, logo, and styling to create a seamless customer experience.
                    </p>
                </x-card>
            </div>
            
            <!-- 24/7 Availability -->
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
        </div>
    </div>
</div>

<!-- Advanced Features -->
<div class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Advanced Features
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Take your chatbot to the next level with enterprise-grade features.
            </p>
        </div>
        
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="space-y-8">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Human Handoff</h3>
                            <p class="text-gray-600">Seamlessly transfer complex queries to human agents when needed, ensuring no customer is left behind.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-yellow-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Custom Training</h3>
                            <p class="text-gray-600">Train your chatbot on your specific domain knowledge for more accurate and relevant responses.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Analytics Dashboard</h3>
                            <p class="text-gray-600">Monitor chatbot usage, performance, and handoff rates with real-time analytics.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">NLP Engine Integration</h3>
                            <p class="text-gray-600">Boost your chatbot's capabilities with advanced natural language processing for deeper understanding and personalized user interactions.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Conversation UI Design</h3>
                            <p class="text-gray-600">Craft intuitive and user-friendly interfaces that foster natural conversations and provide smooth, effortless navigation.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-gray-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Seamless Integrations</h3>
                            <p class="text-gray-600">Integrate your chatbot with CPanel, enterprise systems, and more to maximize its capabilities and streamline business workflows.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Comprehensive Support</h3>
                            <p class="text-gray-600">Maintain optimal chatbot performance with continuous support, regular monitoring, and expert guidance to ensure maximum ROI.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div>
                <img src="/images/ai-chatbot-dashboard.png" alt="AI Chatbot Dashboard" class="rounded-xl shadow-xl w-full max-w-md mx-auto">
            </div>
        </div>
    </div>
</div>

<!-- Integration Section -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Seamless Integrations
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Works with your favorite tools and platforms.
            </p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
            <div class="flex flex-col items-center group">
                <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors duration-200 mb-3">
                    <svg class="w-8 h-8 text-gray-600 group-hover:text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-700">cPanel</span>
            </div>
            
            <div class="flex flex-col items-center group">
                <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors duration-200 mb-3">
                    <svg class="w-8 h-8 text-gray-600 group-hover:text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-700">Email</span>
            </div>
            
            <div class="flex flex-col items-center group">
                <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors duration-200 mb-3">
                    <svg class="w-8 h-8 text-gray-600 group-hover:text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-700">Slack</span>
            </div>
            
            <div class="flex flex-col items-center group">
                <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors duration-200 mb-3">
                    <svg class="w-8 h-8 text-gray-600 group-hover:text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-700">Zendesk</span>
            </div>
            
            <div class="flex flex-col items-center group">
                <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors duration-200 mb-3">
                    <svg class="w-8 h-8 text-gray-600 group-hover:text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-700">API</span>
            </div>
            
            <div class="flex flex-col items-center group">
                <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors duration-200 mb-3">
                    <svg class="w-8 h-8 text-gray-600 group-hover:text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-700">Webhook</span>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-20 bg-gradient-to-r from-blue-600 to-indigo-700">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-white mb-6">
            Ready to Transform Your Customer Support?
        </h2>
        <p class="text-xl text-blue-100 mb-8">
            Start building your intelligent chatbot today and see the difference AI can make.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <x-button class="text-lg px-8 py-4 bg-white text-blue-600 hover:bg-gray-100">
                Start Free Trial
            </x-button>
            <a href="{{ route('pricing') }}" class="text-lg px-8 py-4 text-white border-2 border-white hover:bg-white hover:text-blue-600 rounded-lg font-semibold transition-all duration-200">
                View Pricing
            </a>
        </div>
    </div>
</div>
@endsection 