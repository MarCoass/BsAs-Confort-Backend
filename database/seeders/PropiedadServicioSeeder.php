<?php

namespace Database\Seeders;

use App\Models\propiedad_servicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropiedadServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        propiedad_servicio::create([
            'propiedad_id' => 1,
            'servicio_id' => 1,
        ]);
        propiedad_servicio::create([
            'propiedad_id' => 1,
            'servicio_id' => 2,
        ]);
        propiedad_servicio::create([
            'propiedad_id' => 1,
            'servicio_id' => 3,
        ]);
    }
}
