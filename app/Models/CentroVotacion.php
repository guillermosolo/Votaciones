<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentroVotacion extends Model
{
    protected $table = 'centro_votacion';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'municipio_id',
        'nombre',
        'JRV',
        'empadronados',
        'sector',
    ];

   public static function getCentros()
    {
        $centros = new CentroVotacion();
        return $centros->orderBy('nombre')->get();
    } 
}
