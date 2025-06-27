{{-- Enhanced About Page --}}
@extends('layouts.app')
@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
            About Our Mission
        </h1>
        <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
            We're revolutionizing customer support for hosting providers by making AI chatbots accessible, powerful, and easy to integrate.
        </p>
    </div>
</div>

<!-- Mission Section -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    Our Mission
                </h2>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    We believe that every hosting provider deserves access to enterprise-grade AI technology. Our mission is to democratize AI-powered customer support, making it accessible to businesses of all sizes.
                </p>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    By combining cutting-edge natural language processing with seamless CPanel integration, we're helping hosting companies reduce support costs, improve customer satisfaction, and scale their operations efficiently.
                </p>
                
                <div class="grid grid-cols-2 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-600 mb-2">10K+</div>
                        <div class="text-gray-600">Happy Customers</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-600 mb-2">50M+</div>
                        <div class="text-gray-600">Conversations</div>
                    </div>
                </div>
            </div>
            
            <div class="relative">
                <div class="bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl p-8 transform rotate-2 hover:rotate-0 transition-transform duration-300">
                    <div class="bg-white rounded-xl p-6 shadow-lg">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Our Vision</h3>
                                <p class="text-gray-600">To be the leading AI chatbot platform for hosting providers worldwide.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Values Section -->
<div class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Our Values
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                The principles that guide everything we do.
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Innovation</h3>
                <p class="text-gray-600 leading-relaxed">
                    We constantly push the boundaries of what's possible with AI technology, always looking for new ways to improve customer experiences.
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Customer Success</h3>
                <p class="text-gray-600 leading-relaxed">
                    Your success is our success. We're committed to providing exceptional support and ensuring our platform helps you achieve your goals.
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Simplicity</h3>
                <p class="text-gray-600 leading-relaxed">
                    We believe powerful technology should be simple to use. Our platform is designed to be intuitive and accessible to everyone.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Team Section -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Meet Our Team
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                The passionate people behind our AI chatbot platform.
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center group">
                <div class="relative mb-6">
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-full mx-auto flex items-center justify-center text-white text-3xl font-bold">
                        AS
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-white"></div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Alex Smith</h3>
                <p class="text-blue-600 mb-4">CEO & Founder</p>
                <p class="text-gray-600 leading-relaxed">
                    Former senior engineer at Google with 10+ years of experience in AI and machine learning.
                </p>
            </div>
            
            <div class="text-center group">
                <div class="relative mb-6">
                    <div class="w-32 h-32 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full mx-auto flex items-center justify-center text-white text-3xl font-bold">
                        MJ
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-white"></div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Maria Johnson</h3>
                <p class="text-blue-600 mb-4">CTO</p>
                <p class="text-gray-600 leading-relaxed">
                    Expert in natural language processing and scalable cloud architectures.
                </p>
            </div>
            
            <div class="text-center group">
                <div class="relative mb-6">
                    <div class="w-32 h-32 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full mx-auto flex items-center justify-center text-white text-3xl font-bold">
                        DL
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-white"></div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">David Lee</h3>
                <p class="text-blue-600 mb-4">Head of Product</p>
                <p class="text-gray-600 leading-relaxed">
                    Passionate about creating user-friendly products that solve real business problems.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Story Section -->
<div class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="relative">
                <div class="bg-white rounded-2xl shadow-xl p-8 transform -rotate-2 hover:rotate-0 transition-transform duration-300">
                    <div class="text-6xl text-blue-600 mb-4">"</div>
                    <p class="text-lg text-gray-700 italic mb-6 leading-relaxed">
                        We started this company because we saw hosting providers struggling with support scalability. Traditional solutions were either too expensive or too complex. We wanted to change that.
                    </p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">AS</div>
                        <div class="ml-4">
                            <div class="font-semibold text-gray-900">Alex Smith</div>
                            <div class="text-gray-600">CEO & Founder</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    Our Story
                </h2>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Founded in 2023, our company was born from a simple observation: hosting providers were spending countless hours answering the same customer questions over and over again.
                </p>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    We realized that AI technology had advanced enough to handle most of these routine inquiries, but existing solutions were either too expensive for small businesses or too complex to implement.
                </p>
                <p class="text-lg text-gray-600 leading-relaxed">
                    So we built a platform that combines the power of modern AI with the simplicity that hosting providers need. The result? A chatbot that actually works, is easy to set up, and doesn't break the bank. Our platform leverages advanced NLP, seamless CPanel integration, and real-time analytics to deliver measurable business outcomes.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-20 bg-gradient-to-r from-blue-600 to-indigo-700">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-white mb-6">
            Join Us in Revolutionizing Customer Support
        </h2>
        <p class="text-xl text-blue-100 mb-8">
            Be part of the future of AI-powered customer service.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <x-button class="text-lg px-8 py-4 bg-white text-blue-600 hover:bg-gray-100">
                Start Free Trial
            </x-button>
            <a href="{{ route('contact') }}" class="text-lg px-8 py-4 text-white border-2 border-white hover:bg-white hover:text-blue-600 rounded-lg font-semibold transition-all duration-200">
                Get in Touch
            </a>
        </div>
    </div>
</div>
@endsection 