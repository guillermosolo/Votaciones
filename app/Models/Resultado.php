<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    protected $table = 'resultados';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'centro_id',
        'mesa',
        'partido_id',
        'cantidad',
        'cerrado',
        'validado'
    ];

    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }

    public function centroVotacion()
    {
        return $this->belongsTo(CentroVotacion::class, 'centro_id');
    }
}
