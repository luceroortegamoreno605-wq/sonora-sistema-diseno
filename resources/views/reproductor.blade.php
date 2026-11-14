@extends('layouts.app')

@section('titulo', 'Reproductor · Sonora')

@section('contenido')
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_380px] gap-8 items-start">
        {{-- Panel central NowPlaying --}}
        <section class="flex flex-col items-center rounded-lg bg-surface-raised p-8 text-center">
            <p class="mb-4 text-xs font-bold uppercase tracking-[0.06em] text-ink-muted">SONANDO AHORA</p>

            {{-- Portada grande con barras ecualizadoras --}}
            <div class="mb-6 flex size-64 sm:size-72 items-end gap-3 rounded-md bg-surface-high p-6">
                <i class="flex-1 rounded-pill bg-accent h-2/5"></i>
                <i class="flex-1 rounded-pill bg-accent h-4/5"></i>
                <i class="flex-1 rounded-pill bg-accent h-3/5"></i>
                <i class="flex-1 rounded-pill bg-accent h-full"></i>
                <i class="flex-1 rounded-pill bg-accent h-1/2"></i>
                <i class="flex-1 rounded-pill bg-accent h-3/4"></i>
            </div>

            <h1 data-bind="titulo" class="text-[32px] leading-[36px] font-extrabold tracking-[-0.01em]">Noches de lluvia</h1>
            <p data-bind="album" class="mt-1 text-sm font-medium text-ink-muted">Mar Abierto · Costas lejanas</p>
            <p data-bind="kbps" class="mt-1 font-mono text-xs text-ink-muted">320 kbps</p>

            {{-- Barra de progreso principal --}}
            <div class="mt-6 flex w-full max-w-md items-center gap-3 font-mono text-sm text-ink-muted">
                <span data-bind="tiempo">00:00</span>
                <div data-bind="barra" tabindex="0" role="slider" aria-label="Progreso de reproducción"
                    aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"
                    class="h-1.5 flex-1 cursor-pointer rounded-pill bg-surface-high focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                    <div data-bind="relleno" class="h-1.5 rounded-pill bg-accent" style="width: 0%"></div>
                </div>
                <span data-bind="duracion">04:18</span>
            </div>

            {{-- Controles principales (Un solo botón accent en esta vista) --}}
            <div class="mt-6 flex items-center gap-6">
                <button type="button" data-accion="aleatorio" aria-label="Modo aleatorio" aria-pressed="false"
                    class="rounded-pill p-2 text-ink-muted hover:bg-surface-high hover:text-ink aria-pressed:text-accent focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus cursor-pointer">
                    <x-icon name="shuffle" />
                </button>
                <button type="button" data-accion="anterior" aria-label="Canción anterior"
                    class="rounded-pill p-2 text-ink hover:bg-surface-high focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus cursor-pointer">
                    <x-icon name="prev" />
                </button>
                <button type="button" data-accion="alternar" aria-label="Reproducir"
                    class="flex size-14 items-center justify-center rounded-pill bg-accent text-on-accent transition duration-120 hover:bg-accent-hover focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus cursor-pointer">
                    <x-icon name="play" data-icono="play" class="size-7" />
                    <x-icon name="pause" data-icono="pause" class="hidden size-7" />
                </button>
                <button type="button" data-accion="siguiente" aria-label="Siguiente canción"
                    class="rounded-pill p-2 text-ink hover:bg-surface-high focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus cursor-pointer">
                    <x-icon name="next" />
                </button>
                <button type="button" data-accion="guardar" aria-label="Guardar en tu biblioteca" aria-pressed="false"
                    class="rounded-pill p-2 text-ink-muted hover:bg-surface-high hover:text-ink aria-pressed:text-accent focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus cursor-pointer">
                    <x-icon name="heart" />
                </button>
            </div>
        </section>

        {{-- Cola de reproducción lateral --}}
        <aside class="rounded-lg bg-surface-raised p-6">
            <h2 class="mb-4 text-[20px] leading-[26px] font-bold">En cola</h2>
            <div class="flex flex-col gap-1">
                @foreach ($pistas as $i => $pista)
                    <x-song-row :indice="$i" :pista="$pista" :actual="$i === 0" />
                @endforeach
            </div>
        </aside>
    </div>
@endsection