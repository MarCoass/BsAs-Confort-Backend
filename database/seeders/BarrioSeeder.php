<?php

namespace Database\Seeders;

use App\Models\Barrio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarrioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barrio::create([
            'nombre' => 'Palermo',
            'estado' => 1
        ]);
        Barrio::create([
            'nombre' => 'Recoleta',
            'estado' => 1
        ]);
        Barrio::create([
            'nombre' => 'Barrio Norte',
            'estado' => 2
        ]);
        Barrio::create([
            'nombre' => 'Almagro',
            'estado' => 2
        ]);
        Barrio::create([
            'nombre' => 'San Telmo',
            'estado' => 2
        ]);
        Barrio::create([
            'nombre' => 'Abasto',
            'estado' => 2
        ]);
        Barrio::create([
            'nombre' => 'Belgrano',
            'estado' => 2
        ]);
        Barrio::create([
            'nombre' => 'Otro',
            'estado' => 2
        ]);
    }
}
