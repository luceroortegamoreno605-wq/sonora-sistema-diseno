@extends('layouts.app')

@section('titulo', 'Buscar · Sonora')

@section('contenido')
    <section class="mb-8 max-w-2xl">
        <h1 class="mb-4 text-[32px] leading-[36px] font-extrabold tracking-[-0.01em]">Buscar</h1>

        <form action="{{ route('buscar') }}" method="GET" class="relative flex items-center gap-3">
            <div class="relative flex-1">
                <input type="search" name="q" value="{{ $q }}"
                    placeholder="¿Qué quieres escuchar?"
                    aria-label="Buscar canciones, artistas o álbumes"
                    class="w-full rounded-pill border-2 border-line-strong bg-surface-high px-4 py-3 pl-11 text-sm text-ink placeholder:text-ink-muted focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus" />
                <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-ink-muted">
                    <x-icon name="search" class="size-5" />
                </span>
            </div>
            <x-button variant="secondary" type="submit">Buscar</x-button>
        </form>
    </section>

    <section class="mb-8">
        <h2 class="mb-4 text-[20px] leading-[26px] font-bold">
            {{ $q !== '' ? 'Resultados para "' . $q . '"' : 'Explora todas las canciones' }}
        </h2>

        @if ($resultados->isEmpty())
            {{-- Uso del token danger acompañado de icono y texto --}}
            <div class="flex items-center gap-3 rounded-md bg-surface-raised p-4 text-danger" role="alert">
                <x-icon name="search" />
                <p class="text-sm font-bold">No encontramos canciones para tu búsqueda. Intenta con otro término.</p>
            </div>
        @else
            <div class="rounded-md bg-surface-raised p-4">
                @foreach ($resultados as $i => $pista)
                    <x-song-row :indice="$i" :pista="$pista" :actual="$i === 0" />
                @endforeach
            </div>
        @endif
    </section>

    <section>
        <h2 class="mb-4 text-[20px] leading-[26px] font-bold">Tus mezclas recomendadas</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($playlists as $p)
                <x-media-card
                    :slug="$p['slug']"
                    :titulo="$p['titulo']"
                    :artista="$p['artista']"
                    :duracion="$p['duracion']"
                    :barras="$p['barras']" />
            @endforeach
        </div>
    </section>
@endsection