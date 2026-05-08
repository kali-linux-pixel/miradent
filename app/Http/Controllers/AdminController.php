<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Cita;
use App\Models\Pago;
use App\Models\Gasto;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Muestra el panel de administración con estadísticas reales.
     */
    public function dashboard()
    {
        $totalPacientes = Paciente::count();
        $totalCitas = Cita::count();
        $totalRecaudado = Pago::sum('monto');
        $totalGastos = Gasto::sum('monto');
        
        // Obtener citas del día de hoy
        $hoy = date('Y-m-d');
        $citasHoy = Cita::with('paciente')
            ->where('fecha_hora', 'like', $hoy . '%')
            ->orderBy('fecha_hora', 'asc')
            ->get();

        // Obtener citas recientes con la información del paciente
        $citasRecientes = Cita::with('paciente')
            ->orderBy('fecha_hora', 'desc')
            ->take(5)
            ->get();

        // Obtener detalles de pagos y gastos para el balance de contabilidad
        $pagosMes = Pago::with('paciente')->orderBy('fecha', 'desc')->take(10)->get();
        $gastosMes = Gasto::orderBy('fecha', 'desc')->take(10)->get();

        return view('admin.dashboard', compact('totalPacientes', 'totalCitas', 'totalRecaudado', 'totalGastos', 'citasRecientes', 'citasHoy', 'pagosMes', 'gastosMes'));
    }
}
