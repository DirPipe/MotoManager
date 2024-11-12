<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// app/Http/Controllers/TicketController.php
namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Moto;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('moto')->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $motos = Moto::all();
        return view('tickets.create', compact('motos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'moto_id' => 'required|exists:motos,id',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'nullable|date',
            'descripcion' => 'nullable|string',
        ]);

        Ticket::create($data);

        return redirect()->route('tickets.index');
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $motos = Moto::all();
        return view('tickets.edit', compact('ticket', 'motos'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'moto_id' => 'required|exists:motos,id',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'nullable|date',
            'descripcion' => 'nullable|string',
        ]);

        $ticket->update($data);

        return redirect()->route('tickets.index');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index');
    }
}
