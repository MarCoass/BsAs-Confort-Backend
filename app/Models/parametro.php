<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parametro extends Model
{
    use HasFactory;

    protected $table ='parametros';
    protected $fillable = ['clave', 'valor'];
    protected $primaryKey = 'clave';
}
