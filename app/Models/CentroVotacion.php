<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class CentroVotacion extends Model
{
    use HasTimestamps;
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

    public function resultados()
    {
        return $this->hasMany(Resultado::class, 'centro_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_centro_votacion')->withTimestamps();
    }
}
