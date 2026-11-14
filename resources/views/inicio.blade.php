@extends('layouts.app')

@section('titulo', 'Inicio · Sonora')

@section('contenido')
    {{-- Chips de filtro --}}
    <div class="mb-6 flex flex-wrap gap-2">
        <x-chip :activo="true">Todo</x-chip>
        <x-chip>Música</x-chip>
        <x-chip>Podcasts</x-chip>
        <x-chip>Playlists</x-chip>
    </div>

    {{-- Sección de Playlists --}}
    <section class="mb-8">
        <p class="mb-1 text-xs font-bold uppercase tracking-[0.06em] text-ink-muted">PARA TI</p>
        <h1 class="mb-4 text-[32px] leading-[36px] font-extrabold tracking-[-0.01em]">Buenas tardes</h1>
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

    {{-- Sección de Recién escuchado / En cola --}}
    <section class="grid grid-cols-1 lg:grid-cols-[1fr_380px] gap-8">
        <div>
            <h2 class="mb-4 text-[20px] leading-[26px] font-bold">Recién escuchado</h2>
            <div class="rounded-md bg-surface-raised p-4">
                @foreach ($pistas->take(5) as $i => $pista)
                    <x-song-row :indice="$i" :pista="$pista" :actual="$i === 0" />
                @endforeach
            </div>
        </div>

        <div>
            <h2 class="mb-4 text-[20px] leading-[26px] font-bold">En cola</h2>
            <div class="rounded-md bg-surface-raised p-4">
                @foreach ($pistas->slice(5)->values() as $idx => $pista)
                    <x-song-row :indice="$idx + 5" :pista="$pista" :actual="false" />
                @endforeach
            </div>
        </div>
    </section>
@endsection