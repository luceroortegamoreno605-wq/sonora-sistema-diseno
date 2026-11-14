@props(['indice', 'pista', 'actual' => false])
<button type="button" data-pista="{{ $indice }}" @if ($actual) aria-current="true" @endif
    class="group grid w-full grid-cols-[24px_1fr_auto] items-center gap-3 rounded-md px-2 py-3 text-left transition duration-120 ease-out hover:bg-surface-high aria-[current=true]:bg-surface-high focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus cursor-pointer">
    <span class="font-mono text-xs text-ink-muted group-aria-[current=true]:font-bold group-aria-[current=true]:text-accent">
        {{ str_pad($indice + 1, 2, '0', STR_PAD_LEFT) }}
    </span>
    <span class="min-w-0">
        <span class="block truncate text-sm font-bold text-ink">{{ $pista['titulo'] }}</span>
        <span class="block truncate text-sm font-medium text-ink-muted">{{ $pista['artista'] }} · {{ $pista['album'] ?? 'Sencillo' }}</span>
    </span>
    <span class="font-mono text-sm text-ink-muted">
        {{ sprintf('%02d:%02d', intdiv($pista['dur'], 60), $pista['dur'] % 60) }}
    </span>
</button>