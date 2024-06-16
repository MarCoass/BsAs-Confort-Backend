<?php

namespace Database\Seeders;

use App\Models\parametro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParametroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        parametro::create([
            'clave'=> '',
            'valor' => '',
        ]);
    }
}
