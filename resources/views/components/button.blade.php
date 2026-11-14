@props(['variant' => 'primary'])
@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-pill px-6 py-3 text-sm font-bold transition duration-120 ease-out focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer';
    $variantes = [
        'primary'   => 'bg-accent text-on-accent hover:bg-accent-hover',
        'secondary' => 'border-2 border-line-strong text-ink hover:bg-surface-high',
        'ghost'     => 'text-ink-muted hover:bg-surface-high hover:text-ink',
    ];
@endphp
<button {{ $attributes->merge(['type' => 'button', 'class' => $base.' '.($variantes[$variant] ?? $variantes['primary'])]) }}>
    {{ $slot }}
</button>
