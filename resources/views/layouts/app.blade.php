<!doctype html>
<html lang="es" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo', 'Sonora')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400&family=Manrope:wght@400;500;700;800&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface-base font-sans text-ink">
    <script>window.pistas = @json($pistas ?? []);</script>

    <div class="grid h-screen grid-cols-1 md:grid-cols-[220px_1fr] grid-rows-[1fr_auto]">

        {{-- Navegación lateral (Escritorio) --}}
        <nav class="hidden md:flex flex-col gap-2 bg-surface-raised px-4 py-6" aria-label="Principal">
            <a href="{{ route('inicio') }}" class="mb-6 flex items-center gap-2 text-[20px] leading-[26px] font-bold tracking-tight focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus rounded-md">
                <svg class="size-7 text-accent" viewBox="0 0 64 64" aria-hidden="true">
                    <g fill="currentColor">
                        <rect x="4" y="32" width="8" height="28" rx="4"/>
                        <rect x="16" y="12" width="8" height="48" rx="4"/>
                        <rect x="28" y="24" width="8" height="36" rx="4"/>
                        <rect x="40" y="4" width="8" height="56" rx="4"/>
                        <rect x="52" y="36" width="8" height="24" rx="4"/>
                    </g>
                </svg>
                <span>Sonora</span>
            </a>

            <a href="{{ route('inicio') }}" @if(request()->routeIs('inicio')) aria-current="page" @endif
                class="flex items-center gap-3 rounded-md p-3 text-sm font-bold transition duration-120 ease-out {{ request()->routeIs('inicio') ? 'bg-surface-high text-ink' : 'text-ink-muted hover:bg-surface-high hover:text-ink' }} focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                <x-icon name="home" /> Inicio
            </a>

            <a href="{{ route('buscar') }}" @if(request()->routeIs('buscar')) aria-current="page" @endif
                class="flex items-center gap-3 rounded-md p-3 text-sm font-bold transition duration-120 ease-out {{ request()->routeIs('buscar') ? 'bg-surface-high text-ink' : 'text-ink-muted hover:bg-surface-high hover:text-ink' }} focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                <x-icon name="search" /> Buscar
            </a>

            <a href="{{ route('playlist') }}" @if(request()->routeIs('playlist')) aria-current="page" @endif
                class="flex items-center gap-3 rounded-md p-3 text-sm font-bold transition duration-120 ease-out {{ request()->routeIs('playlist') ? 'bg-surface-high text-ink' : 'text-ink-muted hover:bg-surface-high hover:text-ink' }} focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                <x-icon name="library" /> Tu biblioteca
            </a>

            <a href="{{ route('reproductor') }}" @if(request()->routeIs('reproductor')) aria-current="page" @endif
                class="flex items-center gap-3 rounded-md p-3 text-sm font-bold transition duration-120 ease-out {{ request()->routeIs('reproductor') ? 'bg-surface-high text-ink' : 'text-ink-muted hover:bg-surface-high hover:text-ink' }} focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                <x-icon name="play" /> Reproductor
            </a>

            <div class="mt-auto pt-4 border-t border-line">
                <x-button variant="ghost" data-accion="tema" class="w-full justify-start">
                    Cambiar tema
                </x-button>
            </div>
        </nav>

        {{-- Contenido de cada vista --}}
        <main class="overflow-y-auto px-4 py-6 md:px-8">
            {{-- Encabezado compacto para móvil (390px) --}}
            <div class="mb-6 flex items-center justify-between md:hidden">
                <a href="{{ route('inicio') }}" class="flex items-center gap-2 text-[20px] font-bold">
                    <svg class="size-6 text-accent" viewBox="0 0 64 64" aria-hidden="true">
                        <g fill="currentColor">
                            <rect x="4" y="32" width="8" height="28" rx="4"/>
                            <rect x="16" y="12" width="8" height="48" rx="4"/>
                            <rect x="28" y="24" width="8" height="36" rx="4"/>
                            <rect x="40" y="4" width="8" height="56" rx="4"/>
                            <rect x="52" y="36" width="8" height="24" rx="4"/>
                        </g>
                    </svg>
                    <span>Sonora</span>
                </a>
                <x-button variant="secondary" data-accion="tema" class="px-4 py-2 text-xs">
                    Cambiar tema
                </x-button>
            </div>

            @yield('contenido')
        </main>

        {{-- Barra inferior del reproductor siempre visible --}}
        <footer class="col-span-full border-t border-line bg-surface-raised px-4 py-3">
            <div class="grid grid-cols-1 md:grid-cols-[1fr_2fr_1fr] items-center gap-4">
                {{-- Info de canción actual --}}
                <div class="flex items-center justify-between md:justify-start gap-3">
                    <a href="{{ route('reproductor') }}" aria-label="Abrir vista del reproductor"
                        class="flex size-12 shrink-0 items-end gap-0.5 rounded-sm bg-surface-high p-2 focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                        <i class="flex-1 rounded-pill bg-accent h-2/5"></i>
                        <i class="flex-1 rounded-pill bg-accent h-4/5"></i>
                        <i class="flex-1 rounded-pill bg-accent h-3/5"></i>
                        <i class="flex-1 rounded-pill bg-accent h-full"></i>
                        <i class="flex-1 rounded-pill bg-accent h-1/2"></i>
                    </a>
                    <div class="min-w-0 flex-1">
                        <p data-bind="titulo" class="truncate text-sm font-bold text-ink">Noches de lluvia</p>
                        <p data-bind="artista" class="truncate text-xs font-medium text-ink-muted">Mar Abierto</p>
                    </div>
                </div>

                {{-- Controles de reproducción y barra de progreso --}}
                <div class="flex flex-col items-center gap-2">
                    <div class="flex items-center gap-6">
                        <button type="button" data-accion="aleatorio" aria-label="Activar orden aleatorio" aria-pressed="false"
                            class="rounded-pill p-1 text-ink-muted hover:text-ink aria-pressed:text-accent focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus cursor-pointer">
                            <x-icon name="shuffle" />
                        </button>
                        <button type="button" data-accion="anterior" aria-label="Canción anterior"
                            class="rounded-pill p-1 text-ink hover:bg-surface-high focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus cursor-pointer">
                            <x-icon name="prev" />
                        </button>
                        @if(request()->routeIs('inicio', 'buscar'))
                            {{-- En Inicio y Buscar este es el único botón primario accent --}}
                            <button type="button" data-accion="alternar" aria-label="Reproducir"
                                class="flex size-10 items-center justify-center rounded-pill bg-accent text-on-accent transition duration-120 hover:bg-accent-hover focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus cursor-pointer">
                                <x-icon name="play" data-icono="play" />
                                <x-icon name="pause" data-icono="pause" class="hidden" />
                            </button>
                        @else
                            {{-- En Playlist el botón primario está en el encabezado de la lista; aquí usamos borde secundario para respetar "un solo botón accent por vista" --}}
                            <button type="button" data-accion="alternar" aria-label="Reproducir"
                                class="flex size-10 items-center justify-center rounded-pill border-2 border-line-strong text-ink transition duration-120 hover:bg-surface-high focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus cursor-pointer">
                                <x-icon name="play" data-icono="play" />
                                <x-icon name="pause" data-icono="pause" class="hidden" />
                            </button>
                        @endif
                        <button type="button" data-accion="siguiente" aria-label="Siguiente canción"
                            class="rounded-pill p-1 text-ink hover:bg-surface-high focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus cursor-pointer">
                            <x-icon name="next" />
                        </button>
                    </div>

                    <div class="flex w-full max-w-xl items-center gap-2 font-mono text-xs text-ink-muted">
                        <span data-bind="tiempo">00:00</span>
                        <div data-bind="barra" tabindex="0" role="slider" aria-label="Progreso de la canción (usa las flechas izquierda y derecha)"
                            aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"
                            class="h-1 flex-1 cursor-pointer rounded-pill bg-surface-high focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                            <div data-bind="relleno" class="h-1 rounded-pill bg-accent" style="width: 0%"></div>
                        </div>
                        <span data-bind="duracion">04:18</span>
                    </div>
                </div>

                {{-- Volumen y calidad técnica --}}
                <div class="hidden md:flex items-center justify-end gap-3">
                    <span data-bind="kbps" class="font-mono text-xs text-ink-muted">320 kbps</span>
                    <button type="button" aria-label="Silenciar volumen"
                        class="rounded-pill p-1 text-ink-muted hover:text-ink focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                        <x-icon name="volume" />
                    </button>
                    <div class="h-1 w-24 rounded-pill bg-surface-high" role="slider" aria-label="Nivel de volumen" aria-valuemin="0" aria-valuemax="100" aria-valuenow="75">
                        <div class="h-1 w-3/4 rounded-pill bg-accent"></div>
                    </div>
                </div>
            </div>

            {{-- Barra de navegación móvil (390px) --}}
            <nav class="mt-3 flex justify-around border-t border-line pt-2 md:hidden" aria-label="Móvil">
                <a href="{{ route('inicio') }}" class="flex flex-col items-center gap-1 p-1 text-xs font-bold {{ request()->routeIs('inicio') ? 'text-ink' : 'text-ink-muted' }}">
                    <x-icon name="home" /> Inicio
                </a>
                <a href="{{ route('buscar') }}" class="flex flex-col items-center gap-1 p-1 text-xs font-bold {{ request()->routeIs('buscar') ? 'text-ink' : 'text-ink-muted' }}">
                    <x-icon name="search" /> Buscar
                </a>
                <a href="{{ route('playlist') }}" class="flex flex-col items-center gap-1 p-1 text-xs font-bold {{ request()->routeIs('playlist') ? 'text-ink' : 'text-ink-muted' }}">
                    <x-icon name="library" /> Tu biblioteca
                </a>
                <a href="{{ route('reproductor') }}" class="flex flex-col items-center gap-1 p-1 text-xs font-bold {{ request()->routeIs('reproductor') ? 'text-ink' : 'text-ink-muted' }}">
                    <x-icon name="play" /> Reproductor
                </a>
            </nav>
        </footer>
    </div>
</body>
</html>