@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md p-2 focus:outline-none ring-2 ring-blue-900']) !!}>
