<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    protected $table = 'partidos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nombre',
        'siglas',
        'presidente',
        'alcalde',
        'diputado',
    ];
}
