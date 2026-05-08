<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    /**
     * Listar todas las citas.
     */
    public function index()
    {
        $citas = Cita::with('paciente')->orderBy('fecha_hora', 'asc')->get();
        $pacientes = Paciente::all(); // Necesarios para el formulario modal de creación
        return view('admin.citas.index', compact('citas', 'pacientes'));
    }

    /**
     * Almacenar una nueva cita.
     */
    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha_hora' => 'required|date',
            'servicio' => 'required|string|max:255',
            'estado' => 'required|string|in:Pendiente,Confirmada,Cancelada',
        ]);

        Cita::create($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita agendada correctamente.');
    }

    /**
     * Actualizar una cita existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha_hora' => 'required|date',
            'servicio' => 'required|string|max:255',
            'estado' => 'required|string|in:Pendiente,Confirmada,Cancelada',
        ]);

        $cita = Cita::findOrFail($id);
        $cita->update($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente.');
    }

    /**
     * Eliminar una cita.
     */
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()->route('citas.index')->with('success', 'Cita eliminada correctamente.');
    }
}
