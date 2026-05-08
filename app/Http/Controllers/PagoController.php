<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Listar todos los pagos.
     */
    public function index()
    {
        $pagos = Pago::with('paciente')->orderBy('created_at', 'desc')->get();
        $pacientes = Paciente::all(); // Necesarios para el formulario modal de registro de pagos
        return view('admin.pagos.index', compact('pagos', 'pacientes'));
    }

    /**
     * Registrar un nuevo pago.
     */
    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'monto' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string|in:efectivo,transferencia',
        ]);

        Pago::create($request->all());

        return redirect()->route('pagos.index')->with('success', 'Pago registrado correctamente.');
    }

    /**
     * Actualizar un pago existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'monto' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string|in:efectivo,transferencia',
        ]);

        $pago = Pago::findOrFail($id);
        $pago->update($request->all());

        return redirect()->route('pagos.index')->with('success', 'Pago actualizado correctamente.');
    }

    /**
     * Eliminar un registro de pago.
     */
    public function destroy($id)
    {
        $pago = Pago::findOrFail($id);
        $pago->delete();

        return redirect()->route('pagos.index')->with('success', 'Registro de pago eliminado correctamente.');
    }
}
