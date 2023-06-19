<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    use HasTimestamps, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'tipo',
        'mesa',
        'papeletas',
        'mesaCerrada',
        'mesaImpugnada',
        'mesaValidadaPres',
        'mesaValidadaDip',
        'mesaValidadaAl',
        'activo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRolAttribute()
    {
        $tipo = $this->attributes['tipo'];

        if ($tipo == 1) {
            return 'Administrador';
        } elseif ($tipo == 2) {
            return 'Fiscal';
        } elseif ($tipo == 3) {
            return 'Supervisor';
        }

        return null;
    }

    public function centroVotaciones()
    {
        return $this->belongsToMany(CentroVotacion::class, 'user_centro_votacion')->withTimestamps();
    }

    public function todosDatos()
    {
        $mesa = $this->attributes['mesa'];
        $boletas = Resultado::select(DB::raw('COUNT(DISTINCT boleta) as conteo'))->where('mesa',$mesa)->first();
        $conteo = $boletas->conteo;
        if ($conteo == 3) {
            return true;
        } else {
            return false;
        }
    }
}
