<?php

namespace Database\Seeders;

use App\Models\Propiedad;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PropiedadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ruta del archivo JSON
        $jsonPath = database_path('seeders/data/propiedades.json');

        // Verificar si el archivo existe
        if (File::exists($jsonPath)) {
            // Leer el contenido del archivo
            $json = File::get($jsonPath);

            // Decodificar el JSON a un array asociativo
            $propiedades = json_decode($json, true);

            // Iterar sobre cada propiedad en el JSON
            foreach ($propiedades as $propiedad) {
                // Crear la instancia del modelo Propiedad con valores, asignando null a los no definidos
                Propiedad::create([
                    'calles' => $propiedad['calles'] ?? null,
                    'cant_habitaciones' => $propiedad['canthabitaciones'] ?? null,
                    'cant_banios' => $propiedad['cantbanios'] ?? null,
                    'cant_personas' => $propiedad['cantpersonas'] ?? null,
                    'estado' => $propiedad['estado'] ?? 0,
                    'latitud' => $propiedad['latitud'] ?? null,
                    'longitud' => $propiedad['longitud'] ?? null,
                    'tipo_alquiler' => $propiedad['tipo'] ?? 1,
                    'venta' => $propiedad['venta'] ?? false,

                    'barrio_id' => $propiedad['barrio_id'] ?? 8,
                ]);
            }
        } else {
            // Manejo del caso en que el archivo no exista (opcional)
            $this->command->error('El archivo data/propiedades.json no existe.');
        }
    }
}
