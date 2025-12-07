@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center gap-2 px-4 py-2.5 rounded-lg bg-indigo-100 text-indigo-700 font-medium transition-all duration-150'
            : 'flex items-center gap-2 px-4 py-2.5 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-800 transition-all duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
