<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class propiedad_servicio extends Model
{
    use HasFactory;

    protected $table = 'propiedad_servicio';
    protected $primaryKey = 'id';
    protected $fillable = ['propiedad_id', 'servicio_id'];

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'propiedad_id');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }
}
