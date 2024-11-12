<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Reparacion extends Model
{
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function mecanico()
    {
        return $this->belongsTo(User::class, 'mecanico_id');
    }
}
