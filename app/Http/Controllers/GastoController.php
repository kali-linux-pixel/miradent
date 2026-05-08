<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    /**
     * Muestra el listado de gastos registrados.
     */
    public function index()
    {
        $gastos = Gasto::orderBy('fecha', 'desc')->get();
        return view('admin.gastos.index', compact('gastos'));
    }

    /**
     * Almacena un nuevo gasto en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0',
            'fecha' => 'required|date'
        ]);

        Gasto::create([
            'descripcion' => $request->descripcion,
            'monto' => $request->monto,
            'fecha' => $request->fecha
        ]);

        return redirect()->route('gastos.index')->with('success', 'Gasto registrado correctamente.');
    }

    /**
     * Elimina un gasto de la base de datos.
     */
    public function destroy($id)
    {
        $gasto = Gasto::findOrFail($id);
        $gasto->delete();

        return redirect()->route('gastos.index')->with('success', 'Gasto eliminado correctamente.');
    }
}
