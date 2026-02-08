@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center gap-2 px-4 py-2.5 rounded-lg bg-yellow-100 text-yellow-800 font-bold transition-all duration-150'
            : 'flex items-center gap-2 px-4 py-2.5 rounded-lg text-gray-600 hover:bg-yellow-50 hover:text-yellow-700 transition-all duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>