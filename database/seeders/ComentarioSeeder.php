<?php

namespace Database\Seeders;

use App\Models\Comentario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComentarioSeeder extends Seeder
{

    public function run(): void
    {
        Comentario::create([
            'contenido' => 'Muy recomendable! Seguro, impecable, tal cual se ve en las fotos. Seguro y serios!',
            'ig_user' => 'gabialmagomez',
            'email' => 'example@example.com',
            'nombre' => 'Gabi',
            'estado' => 1,
            'propiedad_id' => 1
        ]);
        Comentario::create([
            'contenido' => 'Impecable todo !!! Super recomendable!!!',
            'ig_user' => 'marceloadrianaguero',
            'email' => 'example@example.com',
            'nombre' => 'Marcelo',
            'estado' => 1,
            'propiedad_id' => 1
        ]);
        Comentario::create([
            'contenido' => 'Hermoso departamento el de Armenia y Gutemala. Super comodo y eqipado, no le falta nada. La ubicacion genial, a un paso de todo. Nos quedamos 10 dias y nos sentimos como en casa. Genial!',
            'ig_user' => 'lucho_sacco4',
            'email' => 'example@example.com',
            'nombre' => 'Lucho',
            'estado' => 1,
            'propiedad_id' => 1
        ]);
        Comentario::create([
            'contenido' => 'Muy buena estadia pasamos en el departamento de Vicente Lopez y Callao, muy comodo y todo en buenas condiciones. La zona es muy segura de noche. En la cuadra hay supermecado, lavanderia y kiosco las 24h. Recomiendo 100 y agradecerle a la administradora Agustina por la excelente organizacion.',
            'ig_user' => 'ariel.mansilla09',
            'email' => 'example@example.com',
            'nombre' => 'Ariel',
            'estado' => 1,
            'propiedad_id' => 1
        ]);
    }
}
