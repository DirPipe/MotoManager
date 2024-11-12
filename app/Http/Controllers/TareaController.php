<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// app/Http/Controllers/TareaController.php
namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Moto;
use App\Models\User;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        $tareas = Tarea::with('mecanico', 'moto')->get();
        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        $mecanicos = User::where('rol', 'mecanico')->get();
        $motos = Moto::all();
        return view('tareas.create', compact('mecanicos', 'motos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mecanico_id' => 'required|exists:users,id',
            'moto_id' => 'required|exists:motos,id',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
            'tiempo_estimado' => 'required|integer',
            'partes_necesarias' => 'nullable|string',
        ]);

        Tarea::create($data);

        return redirect()->route('tareas.index');
    }

    public function show(Tarea $tarea)
    {
        return view('tareas.show', compact('tarea'));
    }

    public function edit(Tarea $tarea)
    {
        $mecanicos = User::where('rol', 'mecanico')->get();
        $motos = Moto::all();
        return view('tareas.edit', compact('tarea', 'mecanicos', 'motos'));
    }

    public function update(Request $request, Tarea $tarea)
    {
        $data = $request->validate([
            'mecanico_id' => 'required|exists:users,id',
            'moto_id' => 'required|exists:motos,id',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
            'tiempo_estimado' => 'required|integer',
            'partes_necesarias' => 'nullable|string',
        ]);

        $tarea->update($data);

        return redirect()->route('tareas.index');
    }

    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return redirect()->route('tareas.index');
    }
}

