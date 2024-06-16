<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    use HasFactory;

    protected $table = "barrios";
    protected $primaryKey = 'id';
    protected $fillable = ['prioridad','nombre', 'estado'];

    public function propiedades(){
        return $this->hasMany(Propiedad::class, 'barrio_id');
    }
}
