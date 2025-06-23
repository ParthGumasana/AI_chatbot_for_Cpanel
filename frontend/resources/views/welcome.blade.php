@extends('layouts.app')

@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <h1 class="text-4xl font-bold text-gray-800">Welcome to AI Chatbot Builder        
            </h1>
        </div>

        <div class="mt-8 bg-white overflow-hidden shadow sm:rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="p-6">
                    <div class="flex items-center">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"></path></svg>
                        <div class="ml-4 text-lg leading-7 font-semibold"><a href="{{ route('login') }}" class="underline text-gray-900 dark:text-white">Login</a></div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                            Access your dashboard to manage your chatbots.
                            <ul class="list-disc pl-5 mt-2 text-gray-600">
                    <li>Login to your account or register if you don't have one.</li>
                    <li>Once logged in, you can create a new chatbot by clicking on the "Create Chatbot" button.</li>
                    <li>Fill in the required details for your chatbot, such as name, description, and any specific instructions.</li>
                    <li>After creating your chatbot, you can customize its behavior by adding intents and entities.</li>
                    <li>Test your chatbot by interacting with it in the provided interface.</li>
                    <li>Once satisfied with your chatbot, you can deploy it to make it available for users.</li>
                    <li>Monitor your chatbot's performance and make adjustments as needed.</li>
                </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
            <div class="text-center text-sm text-gray-500 sm:text-left">
                <div class="flex items-center">
                    Enjoy building your AI chatbots with our platform!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
