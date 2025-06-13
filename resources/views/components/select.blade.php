@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'px-4 py-2 w-full border rounded-lg text-gray-900 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500 disabled:opacity-50 disabled:cursor-not-allowed']) !!}>
    {{ $slot }}
</select> 