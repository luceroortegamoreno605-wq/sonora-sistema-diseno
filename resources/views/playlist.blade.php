@extends('layouts.app')

@section('titulo', $playlistActual['titulo'] . ' · Sonora')

@section('contenido')
    {{-- Encabezado de la Playlist --}}
    <section class="mb-8 flex flex-col md:flex-row items-start md:items-end gap-6 rounded-lg bg-surface-raised p-6">
        <div class="flex size-40 shrink-0 items-end gap-2 rounded-md bg-surface-high p-4">
            @foreach ($playlistActual['barras'] as $h)
                <i class="flex-1 rounded-pill bg-accent" style="height: {{ $h }}%"></i>
            @endforeach
        </div>

        <div class="flex-1">
            <p class="text-xs font-bold uppercase tracking-[0.06em] text-ink-muted">PLAYLIST</p>
            <h1 class="mt-1 text-[32px] leading-[36px] md:text-[56px] md:leading-[58px] font-extrabold tracking-[-0.02em]">
                {{ $playlistActual['titulo'] }}
            </h1>
            <p class="mt-2 text-base text-ink-muted">{{ $playlistActual['descripcion'] }}</p>
            <p class="mt-2 font-mono text-sm text-ink-muted">
                {{ $playlistActual['artista'] }} · {{ count($pistas) }} canciones · {{ $playlistActual['duracion'] }}
            </p>

            {{-- Acciones de la Playlist (Un único botón primario accent en esta vista) --}}
            <div class="mt-6 flex flex-wrap items-center gap-3">
                <x-button variant="primary" data-accion="alternar">
                    <x-icon name="play" data-icono="play" />
                    <x-icon name="pause" data-icono="pause" class="hidden" />
                    <span data-bind="texto-play">Reproducir</span>
                </x-button>

                <x-button variant="secondary" data-accion="guardar" aria-pressed="false">
                    <x-icon name="heart" /> Guardar en tu biblioteca
                </x-button>

                {{-- Estado confirmado con token success + icono + texto --}}
                <p id="estado-biblioteca" class="hidden flex items-center gap-2 text-sm font-bold text-success" role="status">
                    <x-icon name="heart" class="size-5" />
                    <span>Guardado en tu biblioteca</span>
                </p>
            </div>
        </div>
    </section>

    {{-- Selector rápido de tus otras playlists --}}
    <div class="mb-6 flex flex-wrap gap-2">
        @foreach ($playlists as $pl)
            <a href="{{ route('playlist', ['slug' => $pl['slug']]) }}"
                class="rounded-pill px-4 py-2 text-xs font-bold uppercase tracking-[0.06em] transition duration-120 {{ $pl['slug'] === $playlistActual['slug'] ? 'bg-surface-high border-2 border-line-strong text-ink' : 'bg-surface-raised text-ink-muted hover:bg-surface-high hover:text-ink' }} focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                {{ $pl['titulo'] }}
            </a>
        @endforeach
    </div>

    {{-- Lista completa de las 8+ canciones --}}
    <section class="rounded-md bg-surface-raised p-4">
        <div class="mb-2 grid grid-cols-[24px_1fr_auto] gap-3 border-b border-line px-2 pb-2 text-xs font-bold uppercase tracking-[0.06em] text-ink-muted">
            <span>#</span>
            <span>Título</span>
            <span>Duración</span>
        </div>
        @foreach ($pistas as $i => $pista)
            <x-song-row :indice="$i" :pista="$pista" :actual="$i === 0" />
        @endforeach
    </section>
@endsection