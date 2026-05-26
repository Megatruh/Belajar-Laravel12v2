@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center rounded-md px-3 py-2 text-sm my-3 font-medium text-sm leading-5 bg-gray-900 text-gray-300 focus:outline-hidden focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-3 py-2 text-sm my-3 font-medium text-sm leading-5 text-gray-300 hover:text-gray-300 hover:bg-gray-900 hover:rounded-md focus:outline-hidden focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
