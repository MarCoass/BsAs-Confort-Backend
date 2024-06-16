<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    use HasFactory;

    protected $table = "propiedades";
    protected $primaryKey = 'id';
    protected $fillable = ['calles', 'cant_habitaciones', 'cant_banios', 'cant_personas', 'tamanio', 'estado', 'latitud', 'longitud','tipo_alquiler', 'venta', 'barrio_id', 'nombre_imagen'];

    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'barrio_id');
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'propiedad_servicio');
    }
}
