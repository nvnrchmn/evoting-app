@props([
    'type' => 'submit',
    'variant' => 'primary',
    'class' => '',
])
@php
    $baseClass = 'inline-block text-center min-w-[80px] px-4 py-2 text-sm rounded font-semibold transition duration-150 ease-in-out focus:outline-none';

    $variants = [
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700',
        'secondary' => 'bg-gray-600 text-white hover:bg-gray-700',
        'danger' => 'bg-red-600 text-white hover:bg-red-700',
        'dark' => 'bg-gray-700 text-white hover:bg-gray-800',
    ];

    $variantClass = $variants[$variant] ?? $variants['primary'];
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => "$baseClass $variantClass $class"]) }}>
    {{ $slot }}
</button>
