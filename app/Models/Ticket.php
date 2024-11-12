<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function moto()
    {
        return $this->belongsTo(Moto::class);
    }

    public function reparaciones()
    {
        return $this->hasMany(Reparacion::class);
    }
}
