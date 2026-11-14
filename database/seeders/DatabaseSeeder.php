<?php

namespace Database\Seeders;

use App\Models\Track;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $canciones = [
            [
                'titulo' => 'Noches de lluvia',
                'artista' => 'Mar Abierto',
                'album' => 'Costas lejanas',
                'playlist' => 'Mezcla diaria 1',
                'dur' => 258,
                'kbps' => '320 kbps',
                'barras' => [40, 75, 55, 90, 60],
            ],
            [
                'titulo' => 'Hora azul',
                'artista' => 'Luz de Norte',
                'album' => 'Horizonte polar',
                'playlist' => 'Mezcla diaria 1',
                'dur' => 232,
                'kbps' => '256 kbps',
                'barras' => [65, 45, 80, 50, 70],
            ],
            [
                'titulo' => 'Cuerdas de otoño',
                'artista' => 'Estudio Cinco',
                'album' => 'Sesiones de madera',
                'playlist' => 'Enfoque profundo',
                'dur' => 307,
                'kbps' => '320 kbps',
                'barras' => [30, 60, 95, 40, 55],
            ],
            [
                'titulo' => 'Caminos de tierra',
                'artista' => 'Mar Abierto',
                'album' => 'Costas lejanas',
                'playlist' => 'Ruta nocturna',
                'dur' => 209,
                'kbps' => '192 kbps',
                'barras' => [50, 85, 45, 70, 35],
            ],
            [
                'titulo' => 'Sin prisa',
                'artista' => 'Luz de Norte',
                'album' => 'Calma interior',
                'playlist' => 'Enfoque profundo',
                'dur' => 284,
                'kbps' => '320 kbps',
                'barras' => [70, 50, 65, 85, 45],
            ],
            [
                'titulo' => 'Bruma matinal',
                'artista' => 'Valle Sonoro',
                'album' => 'Eco de montaña',
                'playlist' => 'Pulso urbano',
                'dur' => 195,
                'kbps' => '256 kbps',
                'barras' => [45, 90, 35, 65, 80],
            ],
            [
                'titulo' => 'Faros en la niebla',
                'artista' => 'Puerto Gris',
                'album' => 'Marea baja',
                'playlist' => 'Ruta nocturna',
                'dur' => 246,
                'kbps' => '320 kbps',
                'barras' => [80, 40, 75, 55, 60],
            ],
            [
                'titulo' => 'Reflejos de cristal',
                'artista' => 'Estudio Cinco',
                'album' => 'Sesiones de madera',
                'playlist' => 'Pulso urbano',
                'dur' => 271,
                'kbps' => '320 kbps',
                'barras' => [55, 70, 50, 95, 40],
            ],
            [
                'titulo' => 'Viento del sur',
                'artista' => 'Valle Sonoro',
                'album' => 'Eco de montaña',
                'playlist' => 'Mezcla diaria 1',
                'dur' => 220,
                'kbps' => '256 kbps',
                'barras' => [60, 35, 85, 45, 75],
            ],
        ];

        foreach ($canciones as $cancion) {
            Track::create($cancion);
        }
    }
}