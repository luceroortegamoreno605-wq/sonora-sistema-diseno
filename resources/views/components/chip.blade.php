@props(['activo' => false])
<button type="button" data-chip aria-pressed="{{ $activo ? 'true' : 'false' }}"
    {{ $attributes->merge(['class' => 'rounded-pill border-2 border-transparent bg-surface-high px-4 py-2 text-xs font-bold uppercase tracking-[0.06em] text-ink transition duration-120 ease-out hover:border-line-strong aria-pressed:bg-accent aria-pressed:text-on-accent focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus cursor-pointer']) }}>
    {{ $slot }}
</button>