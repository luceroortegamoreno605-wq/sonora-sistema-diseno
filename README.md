# Sonora — Sistema de diseño y aplicación web

Implementación del sistema de diseño **Sonora** desarrollado en Laravel, SQLite y Tailwind CSS (incluyendo vistas Blade, base de datos con Seeder, tema oscuro/claro y diseño responsivo).

## Cómo ejecutar el proyecto

1. Clonar este repositorio e instalar dependencias:

   composer install
   npm install

2. Preparar el archivo de entorno y poblar la base de datos SQLite con las 9 canciones y 4 playlists:

   cp .env.example .env
   php artisan key:generate
   php artisan migrate:fresh --seed

3. Compilar los estilos y ejecutar el servidor:

   npm run dev
   php artisan serve

   *(Si utilizas Laravel Herd, basta con mantener corriendo `npm run dev` y abrir `http://sonora.test`).*

## Decisiones de diseño y arquitectura

### Componentes reutilizados
- **`<x-button>`:** Utilizado en todas las vistas con sus variantes `primary`, `secondary` y `ghost`, respetando la regla de mantener un único botón primario ámbar (`bg-accent` con texto `on-accent`) por pantalla.
- **`<x-chip>`:** Utilizado en la cabecera de Inicio para filtrar categorías con estado accesible `aria-pressed`.
- **`<x-media-card>`:** Reutilizado en Inicio y Buscar para renderizar las 4 playlists con portadas generadas mediante barras ecualizadoras y elevación `shadow-raise`.
- **`<x-song-row>`:** Reutilizado en Inicio, Playlist, Reproductor y Buscar para unificar la jerarquía tipográfica (`Manrope` y `JetBrains Mono`) y el estado activo con `aria-current="true"`.
- **`<x-icon>`:** Centraliza los 10 iconos SVG de 24px del sistema utilizando `currentColor`.

### Qué cambiaría o mejoraría
- Conectar el temporizador simulado de JavaScript a un elemento `<audio>` real para reproducir pistas en formato MP3/OGG y animar las barras del ecualizador según las frecuencias.