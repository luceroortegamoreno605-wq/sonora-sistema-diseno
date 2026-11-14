<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;

class SonoraController extends Controller
{
    private function obtenerPlaylists(): array
    {
        return [
            [
                'slug' => 'mezcla-diaria-1',
                'titulo' => 'Mezcla diaria 1',
                'artista' => 'Para ti · Actualizada hoy',
                'descripcion' => 'Canciones suaves para empezar tu jornada con buen ritmo.',
                'duracion' => '1:12:40',
                'barras' => [40, 75, 55, 90, 45],
            ],
            [
                'slug' => 'enfoque-profundo',
                'titulo' => 'Enfoque profundo',
                'artista' => 'Playlist · Instrumental',
                'descripcion' => 'Sonidos ambientales sin distracciones para programar y estudiar.',
                'duracion' => '48:05',
                'barras' => [80, 45, 65, 35, 75],
            ],
            [
                'slug' => 'ruta-nocturna',
                'titulo' => 'Ruta nocturna',
                'artista' => 'Mar Abierto · Selección',
                'descripcion' => 'Melodías tranquilas que te acompañan en el camino de regreso.',
                'duracion' => '36:21',
                'barras' => [50, 85, 40, 70, 60],
            ],
            [
                'slug' => 'pulso-urbano',
                'titulo' => 'Pulso urbano',
                'artista' => 'Playlist · Ritmos',
                'descripcion' => 'Compases sintéticos y bajos definidos para tu tarde.',
                'duracion' => '1:03:12',
                'barras' => [35, 60, 90, 50, 80],
            ],
        ];
    }

    public function inicio()
    {
        $pistas = Track::all();
        $playlists = $this->obtenerPlaylists();
        return view('inicio', compact('pistas', 'playlists'));
    }

    public function playlist(string $slug = 'mezcla-diaria-1')
    {
        $playlists = $this->obtenerPlaylists();
        $playlistActual = collect($playlists)->firstWhere('slug', $slug) ?? $playlists[0];
        $pistas = Track::all();

        return view('playlist', compact('pistas', 'playlists', 'playlistActual'));
    }

    public function reproductor()
    {
        $pistas = Track::all();
        return view('reproductor', compact('pistas'));
    }

    public function buscar(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $pistas = Track::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where('titulo', 'like', "%{$q}%")
                      ->orWhere('artista', 'like', "%{$q}%")
                      ->orWhere('album', 'like', "%{$q}%");
            })
            ->get();

        $todasLasPistas = Track::all();
        $playlists = $this->obtenerPlaylists();

        return view('buscar', [
            'pistas' => $todasLasPistas,
            'resultados' => $pistas,
            'playlists' => $playlists,
            'q' => $q,
        ]);
    }
}