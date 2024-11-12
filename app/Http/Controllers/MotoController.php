<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// app/Http/Controllers/MotoController.php
namespace App\Http\Controllers;

use App\Models\Moto;
use App\Models\User;
use Illuminate\Http\Request;

class MotoController extends Controller
{
    public function index()
    {
        $motos = Moto::with('usuario')->get();
        return view('motos.index', compact('motos'));
    }

    public function create()
    {
        $usuarios = User::all();
        return view('motos.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'ano' => 'required|integer',
            'placa' => 'required|string|max:10',
        ]);

        Moto::create($data);

        return redirect()->route('motos.index');
    }

    public function show(Moto $moto)
    {
        return view('motos.show', compact('moto'));
    }

    public function edit(Moto $moto)
    {
        $usuarios = User::all();
        return view('motos.edit', compact('moto', 'usuarios'));
    }

    public function update(Request $request, Moto $moto)
    {
        $data = $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'ano' => 'required|integer',
            'placa' => 'required|string|max:10',
        ]);

        $moto->update($data);

        return redirect()->route('motos.index');
    }

    public function destroy(Moto $moto)
    {
        $moto->delete();
        return redirect()->route('motos.index');
    }
}

