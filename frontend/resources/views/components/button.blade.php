{{-- Button Component --}}
<button {{ $attributes->merge(['class' => 'px-5 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 transition font-semibold']) }}>
    {{ $slot }}
</button> 