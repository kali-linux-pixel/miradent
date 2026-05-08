<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use App\Models\Paciente;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    /**
     * Devuelve el historial clínico de un paciente en formato JSON.
     */
    public function getHistorial($pacienteId)
    {
        $historiales = Historial::where('paciente_id', $pacienteId)
            ->orderBy('fecha', 'desc')
            ->get();

        return response()->json($historiales);
    }

    /**
     * Guarda una nueva nota en el historial clínico del paciente.
     */
    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'detalle' => 'required|string',
            'fecha' => 'required|date'
        ]);

        $historial = Historial::create([
            'paciente_id' => $request->paciente_id,
            'detalle' => $request->detalle,
            'fecha' => $request->fecha
        ]);

        return response()->json([
            'success' => true,
            'historial' => $historial
        ]);
    }

    /**
     * Muestra una vista premium e imprimible de la receta médica.
     */
    public function generarReceta(Request $request)
    {
        $paciente = $request->input('paciente');
        $medicamentos = $request->input('medicamentos');
        $indicaciones = $request->input('indicaciones', 'Ninguna');
        $fecha = date('d/m/Y');

        return view('admin.pacientes.receta', compact('paciente', 'medicamentos', 'indicaciones', 'fecha'));
    }
}
