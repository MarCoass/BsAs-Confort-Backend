<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Barrio;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $this->call(BarrioSeeder::class);
      $this->call(ServicioSeeder::class);
      $this->call(ComentarioSeeder::class);
      $this->call(PropiedadSeeder::class);
      $this->call(PropiedadServicioSeeder::class);
      $this->call(UserSeeder::class);
      


    }
}
