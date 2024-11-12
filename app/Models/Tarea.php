<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Tarea extends Model
{
    protected $fillable = ['mecanico_id', 'moto_id', 'descripcion', 'fecha_inicio', 'fecha_fin', 'tiempo_estimado', 'partes_necesarias'];

    public function mecanico()
    {
        return $this->belongsTo(User::class, 'mecanico_id');
    }

    public function moto()
    {
        return $this->belongsTo(Moto::class);
    }
}
