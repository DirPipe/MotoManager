<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Factura.php
class Factura extends Model
{
    public function reparacion()
    {
        return $this->belongsTo(Reparacion::class);
    }
}
