@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                    Create New Chatbot
                </h2>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Validation Error!</strong>
                        <span class="block sm:inline">Please fix the following issues:</span>
                        <ul class="mt-3 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('chatbots.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Chatbot Name</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('name') }}" required autofocus>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description (Optional)</label>
                        <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label for="llm_type" class="block text-sm font-medium text-gray-700">LLM Type</label>
                        <select name="llm_type" id="llm_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            <option value="LM_STUDIO" {{ old('llm_type') == 'LM_STUDIO' ? 'selected' : '' }}>LM Studio (Local)</option>
                            <option value="OPENAI" {{ old('llm_type') == 'OPENAI' ? 'selected' : '' }}>OpenAI (Requires API Key)</option>
                        </select>
                    </div>

                    <div id="openai_key_field" style="display: {{ old('llm_type') == 'OPENAI' ? 'block' : 'none' }};">
                        <label for="openai_api_key" class="block text-sm font-medium text-gray-700">OpenAI API Key</label>
                        <input type="password" name="openai_api_key" id="openai_api_key" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('openai_api_key') }}">
                        <p class="mt-2 text-sm text-gray-500">Required if you select OpenAI LLM type.</p>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Create Chatbot
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const llmTypeSelect = document.getElementById('llm_type');
        const openaiKeyField = document.getElementById('openai_key_field');

        function toggleOpenAIKeyField() {
            if (llmTypeSelect.value === 'OPENAI') {
                openaiKeyField.style.display = 'block';
            } else {
                openaiKeyField.style.display = 'none';
            }
        }

        llmTypeSelect.addEventListener('change', toggleOpenAIKeyField);

        // Initial check on page load
        toggleOpenAIKeyField();
    });
</script>
@endsection
