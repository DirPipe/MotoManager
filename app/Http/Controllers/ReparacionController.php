<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// app/Http/Controllers/ReparacionController.php
namespace App\Http\Controllers;

use App\Models\Reparacion;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class ReparacionController extends Controller
{
    public function index()
    {
        $reparaciones = Reparacion::with('ticket', 'mecanico')->get();
        return view('reparaciones.index', compact('reparaciones'));
    }

    public function create()
    {
        $tickets = Ticket::all();
        $mecanicos = User::where('rol', 'mecanico')->get();
        return view('reparaciones.create', compact('tickets', 'mecanicos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'mecanico_id' => 'required|exists:users,id',
            'descripcion' => 'required|string',
            'costo' => 'required|numeric',
        ]);

        Reparacion::create($data);

        return redirect()->route('reparaciones.index');
    }

    public function show(Reparacion $reparacion)
    {
        return view('reparaciones.show', compact('reparacion'));
    }

    public function edit(Reparacion $reparacion)
    {
        $tickets = Ticket::all();
        $mecanicos = User::where('rol', 'mecanico')->get();
        return view('reparaciones.edit', compact('reparacion', 'tickets', 'mecanicos'));
    }

    public function update(Request $request, Reparacion $reparacion)
    {
        $data = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'mecanico_id' => 'required|exists:users,id',
            'descripcion' => 'required|string',
            'costo' => 'required|numeric',
        ]);

        $reparacion->update($data);

        return redirect()->route('reparaciones.index');
    }

    public function destroy(Reparacion $reparacion)
    {
        $reparacion->delete();
        return redirect()->route('reparaciones.index');
    }
}

