<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// app/Http/Controllers/FacturaController.php
namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Reparacion;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::with('reparacion')->get();
        return view('facturas.index', compact('facturas'));
    }

    public function create()
    {
        $reparaciones = Reparacion::all();
        return view('facturas.create', compact('reparaciones'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'reparacion_id' => 'required|exists:reparaciones,id',
            'monto_total' => 'required|numeric',
            'fecha' => 'required|date',
        ]);

        Factura::create($data);

        return redirect()->route('facturas.index');
    }

    public function show(Factura $factura)
    {
        return view('facturas.show', compact('factura'));
    }

    public function edit(Factura $factura)
    {
        $reparaciones = Reparacion::all();
        return view('facturas.edit', compact('factura', 'reparaciones'));
    }

    public function update(Request $request, Factura $factura)
    {
        $data = $request->validate([
            'reparacion_id' => 'required|exists:reparaciones,id',
            'monto_total' => 'required|numeric',
            'fecha' => 'required|date',
        ]);

        $factura->update($data);

        return redirect()->route('facturas.index');
    }

    public function destroy(Factura $factura)
    {
        $factura->delete();
        return redirect()->route('facturas.index');
    }
}

