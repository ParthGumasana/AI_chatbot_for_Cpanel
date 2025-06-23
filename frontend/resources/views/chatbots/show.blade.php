@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                    Manage Chatbot: {{ $id }}
                    

                    {{-- DELETE CHATBOT BUTTON --}}
                    <form action="{{ route('chatbots.destroy', $id) }}" method="POST" class="inline-block ml-4">
                        @csrf
                        @method('DELETE') {{-- This is crucial for Laravel to interpret this POST request as a DELETE --}}
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150"
                                onclick="return confirm('Are you sure you want to delete this chatbot? This action cannot be undone.');">
                            Delete Chatbot
                        </button>
                    </form>
                    {{-- END DELETE CHATBOT BUTTON --}}

                </h2>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">Please fix the following issues:</span>
                        <ul class="mt-3 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900">Embed Chatbot</h3>
                    <p class="mt-2 text-gray-600">Copy and paste this iframe code into your website where you want the chatbot to appear:</p>
                    <div class="mt-4 bg-gray-100 p-4 rounded-md font-mono text-sm text-gray-800 break-words">
                        &lt;iframe src="{{ $embedUrl }}" width="100%" height="600px" frameborder="0"&gt;&lt;/iframe&gt;
                    </div>

                    <h3 class="text-lg font-medium text-gray-900 mt-6">Preview</h3>
                    <div class="mt-4 border border-gray-300 rounded-md overflow-hidden" style="height: 600px;">
                        <iframe src="{{ $embedUrl }}" width="100%" height="100%" frameborder="0"></iframe>
                    </div>

                    {{-- Data Upload Section --}}
                    <h3 class="text-lg font-medium text-gray-900 mt-8">Upload More Data</h3>
                    <p class="mt-2 text-gray-600">You can upload additional files or URLs to train your chatbot further.</p>
                    <form method="POST" action="{{ route('chatbots.uploadData', $id) }}" class="space-y-4 mt-4" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="urls" class="block text-sm font-medium text-gray-700">
                                URLs (one per line)
                            </label>
                            <textarea name="urls" id="urls" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('urls') }}</textarea>
                            <p class="mt-2 text-sm text-gray-500">Enter URLs for website crawling, one per line.</p>
                        </div>

                        <div>
                            <label for="files" class="block text-sm font-medium text-gray-700">
                                Upload Files (PDF, DOCX, XLSX)
                            </label>
                            <input type="file" name="files[]" id="files" multiple
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                accept=".pdf,.doc,.docx,.xls,.xlsx">
                            <p class="mt-2 text-sm text-gray-500">Select PDF, DOC/DOCX, or XLS/XLSX files.</p>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Upload Data
                            </button>
                        </div>
                    </form>
                    {{-- End Data Upload Section --}}

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addUrlBtn = document.getElementById('add-url-btn');
        const urlInputsContainer = document.getElementById('url-inputs-container');
        let urlCount = 1;

        // This part seems to be from an older version of your URL input.
        // If you are using the textarea for URLs (as in the provided HTML),
        // you might not need this JS. Keep it if you have multiple URL input fields.
        if (addUrlBtn && urlInputsContainer) {
            addUrlBtn.addEventListener('click', function() {
                urlCount++;
                const newInput = document.createElement('input');
                newInput.type = 'url';
                newInput.name = 'urls[]';
                newInput.id = 'url_' + urlCount;
                newInput.className = 'mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50';
                newInput.placeholder = 'e.g., https://www.example.com/page-' + urlCount;
                urlInputsContainer.appendChild(newInput);
            });
        }
    });

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Embed URL copied to clipboard!');
        }, function(err) {
            console.error('Could not copy text: ', err);
            alert('Failed to copy URL. Please copy it manually.');
        });
    }
    
</script>
@endsection
