@props(['titulo', 'artista', 'duracion', 'slug' => 'mezcla-diaria-1', 'barras' => [50, 80, 60, 90, 40]])
<a href="{{ route('playlist', ['slug' => $slug]) }}"
    class="group block rounded-md bg-surface-raised p-4 transition duration-120 ease-out hover:bg-surface-high hover:shadow-raise focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
    <div class="mb-4 flex aspect-square items-end gap-1 rounded-md bg-surface-high p-4 transition duration-120 group-hover:bg-surface-base">
        @foreach ($barras as $h)
            <i class="flex-1 rounded-pill bg-accent" style="height: {{ $h }}%"></i>
        @endforeach
    </div>
    <p class="text-[20px] leading-[26px] font-bold text-ink">{{ $titulo }}</p>
    <p class="mt-1 text-sm font-medium text-ink-muted">{{ $artista }}</p>
    <p class="mt-2 font-mono text-xs text-ink-muted">{{ $duracion }}</p>
</a>