{{-- Enhanced Pricing Page --}}
@extends('layouts.app')
@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
            Simple, Transparent Pricing
        </h1>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            Choose the plan that fits your business needs. All plans include our core features with no hidden fees.
        </p>
        
        <!-- Billing Toggle -->
        <div class="flex justify-center mb-12">
            <div class="bg-white rounded-2xl shadow-lg p-1 inline-flex">
                <button id="monthlyBtn" class="px-6 py-3 rounded-xl text-blue-700 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500 bg-blue-100 transition-all duration-200">
                    Monthly
                </button>
                <button id="yearlyBtn" class="px-6 py-3 rounded-xl text-gray-700 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500 hover:bg-gray-100 transition-all duration-200">
                    Yearly
                    <span class="ml-2 text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Save 20%</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Pricing Cards -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Free Plan -->
            <div class="relative">
                <x-card class="h-full border-2 border-gray-200 hover:border-blue-300 transition-all duration-300 transform hover:scale-105">
                    <div class="text-center">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Free</h3>
                        <p class="text-gray-600 mb-6">Perfect for getting started</p>
                        
                        <div class="mb-8">
                            <div class="text-4xl font-bold text-gray-900">$0</div>
                            <div class="text-gray-600">forever</div>
                        </div>
                        
                        <ul class="space-y-4 mb-8 text-left">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">1 Chatbot</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">100 conversations/month</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Basic analytics</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Email support</span>
                            </li>
                        </ul>
                        
                        <x-button class="w-full bg-gray-600 hover:bg-gray-700">
                            Get Started Free
                        </x-button>
                    </div>
                </x-card>
            </div>

            <!-- Pro Plan -->
            <div class="relative">
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                    <span class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-semibold">Most Popular</span>
                </div>
                <x-card class="h-full border-2 border-blue-600 shadow-xl transform hover:scale-105 transition-all duration-300">
                    <div class="text-center">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Pro</h3>
                        <p class="text-gray-600 mb-6">For growing businesses</p>
                        
                        <div class="mb-8">
                            <div class="text-4xl font-bold text-gray-900">$29</div>
                            <div class="text-gray-600">per month</div>
                        </div>
                        
                        <ul class="space-y-4 mb-8 text-left">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">5 Chatbots</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Unlimited conversations</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Advanced analytics</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Priority support</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Custom branding</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">API access</span>
                            </li>
                        </ul>
                        
                        <x-button class="w-full bg-blue-600 hover:bg-blue-700">
                            Start Pro Trial
                        </x-button>
                    </div>
                </x-card>
            </div>

            <!-- Enterprise Plan -->
            <div class="relative">
                <x-card class="h-full border-2 border-gray-200 hover:border-purple-300 transition-all duration-300 transform hover:scale-105">
                    <div class="text-center">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Enterprise</h3>
                        <p class="text-gray-600 mb-6">For large organizations</p>
                        
                        <div class="mb-8">
                            <div class="text-4xl font-bold text-gray-900">$99</div>
                            <div class="text-gray-600">per month</div>
                        </div>
                        
                        <ul class="space-y-4 mb-8 text-left">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Unlimited Chatbots</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Unlimited conversations</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Advanced analytics</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">24/7 phone support</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Dedicated account manager</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Custom integrations</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">SLA guarantee</span>
                            </li>
                        </ul>
                        
                        <x-button class="w-full bg-purple-600 hover:bg-purple-700">
                            Contact Sales
                        </x-button>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
            <p class="text-xl text-gray-600">Everything you need to know about our pricing and plans.</p>
        </div>
        
        <div class="space-y-8">
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Can I change plans anytime?</h3>
                <p class="text-gray-600">Yes, you can upgrade or downgrade your plan at any time. Changes take effect immediately.</p>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Is there a setup fee?</h3>
                <p class="text-gray-600">No setup fees. You only pay for the plan you choose, and you can start using our service immediately.</p>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Do you offer refunds?</h3>
                <p class="text-gray-600">We offer a 30-day money-back guarantee. If you're not satisfied, we'll refund your payment.</p>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-20 bg-gradient-to-r from-blue-600 to-indigo-700">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-white mb-6">Ready to Get Started?</h2>
        <p class="text-xl text-blue-100 mb-8">Join thousands of businesses using our AI chatbot platform.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <x-button class="text-lg px-8 py-4 bg-white text-blue-600 hover:bg-gray-100">
                Start Free Trial
            </x-button>
            <a href="{{ route('contact') }}" class="text-lg px-8 py-4 text-white border-2 border-white hover:bg-white hover:text-blue-600 rounded-lg font-semibold transition-all duration-200">
                Contact Sales
            </a>
        </div>
    </div>
</div>

<script>
    // Enhanced pricing toggle with yearly pricing
    document.addEventListener('DOMContentLoaded', function() {
        const monthlyBtn = document.getElementById('monthlyBtn');
        const yearlyBtn = document.getElementById('yearlyBtn');
        
        const prices = {
            monthly: { pro: 29, enterprise: 99 },
            yearly: { pro: 23, enterprise: 79 } // 20% discount
        };
        
        function updatePricing(period) {
            const proPrice = document.querySelector('.text-4xl.font-bold');
            const enterprisePrice = document.querySelectorAll('.text-4xl.font-bold')[2];
            
            if (period === 'monthly') {
                proPrice.textContent = `$${prices.monthly.pro}`;
                enterprisePrice.textContent = `$${prices.monthly.enterprise}`;
                monthlyBtn.classList.add('bg-blue-100', 'text-blue-700');
                yearlyBtn.classList.remove('bg-blue-100', 'text-blue-700');
            } else {
                proPrice.textContent = `$${prices.yearly.pro}`;
                enterprisePrice.textContent = `$${prices.yearly.enterprise}`;
                yearlyBtn.classList.add('bg-blue-100', 'text-blue-700');
                monthlyBtn.classList.remove('bg-blue-100', 'text-blue-700');
            }
        }
        
        monthlyBtn.addEventListener('click', () => updatePricing('monthly'));
        yearlyBtn.addEventListener('click', () => updatePricing('yearly'));
    });
</script>
@endsection 