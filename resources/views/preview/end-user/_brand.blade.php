@php
    $brand = ($color ?? null) && preg_match('/^#[A-Fa-f0-9]{6}$/', $color) ? $color : '#f39c12';
@endphp
<style>
    :root {
        --brand: {{ $brand }};
        --brand-dark: color-mix(in srgb, {{ $brand }} 82%, black);
        --brand-soft: color-mix(in srgb, {{ $brand }} 12%, white);
        --dark-orange: {{ $brand }};
    }
</style>
<link rel="stylesheet" href="{{ Vite::asset('resources/css/enduser/brand-accents.css') }}">
