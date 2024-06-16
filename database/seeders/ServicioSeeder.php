<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{

    public function run(): void
    {
        Servicio::create([
            'nombre'=>'WiFi'
        ]);
        Servicio::create([
            'nombre'=>'A/C'
        ]);
        Servicio::create([
            'nombre'=>'Secador'
        ]);
        Servicio::create([
            'nombre'=>'Piscina'
        ]);
        Servicio::create([
            'nombre'=>'Washer'
        ]);
    }
}
