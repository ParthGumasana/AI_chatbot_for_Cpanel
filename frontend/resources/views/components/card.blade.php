{{-- Card Component --}}
<div {{ $attributes->merge(['class' => 'bg-white shadow rounded-lg p-6']) }}>
    {{ $slot }}
</div> 