@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Estadísticas Generales')

@section('content')
<!-- Estilos para impresión de PDF -->
<style>
    @media print {
        body {
            background-color: white !important;
            color: black !important;
        }
        aside, header, button, .no-print {
            display: none !important;
        }
        main {
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
        }
        .print-only {
            display: block !important;
        }
        .print-card {
            border: 1px solid #ccc !important;
            background: white !important;
            color: black !important;
            box-shadow: none !important;
        }
        .print-card * {
            color: black !important;
        }
    }
    .print-only {
        display: none;
    }
</style>

<!-- Cabecera de reporte exclusiva para impresión (Contabilidad en 1 Clic) -->
<div class="print-only mb-8 border-b pb-6">
    <div class="flex justify-between items-start">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('img/logo.png') }}" class="h-12 w-auto object-contain" alt="Miradent Logo">
            <div>
                <h1 class="text-2xl font-serif font-bold text-slate-900">CLÍNICA DENTAL MIRADENT</h1>
                <p class="text-xs text-slate-500">C.D. Pamela Miranda — Odontología Estética de Lujo</p>
            </div>
        </div>
        <div class="text-right text-xs text-slate-500">
            <p class="text-sm font-bold text-slate-900">AUXILIAR DE CONTABILIDAD</p>
            <p>Fecha de Emisión: {{ date('d/m/Y h:i A') }}</p>
            <p>Periodo de Reporte: {{ date('F Y') }}</p>
        </div>
    </div>
</div>

<div class="print-only space-y-8 mb-8">
    <!-- Resumen de Balance Contable -->
    <div class="grid grid-cols-3 gap-6">
        <div class="border p-4 rounded-2xl text-center">
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Ingresos Brutos (Recep.)</p>
            <h3 class="text-xl font-bold text-emerald-600 mt-1">S/. {{ number_format($totalRecaudado, 2) }}</h3>
        </div>
        <div class="border p-4 rounded-2xl text-center">
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Gastos Realizados (Egres.)</p>
            <h3 class="text-xl font-bold text-amber-600 mt-1">S/. {{ number_format($totalGastos, 2) }}</h3>
        </div>
        <div class="border p-4 rounded-2xl text-center">
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Utilidad Neta del Periodo</p>
            <h3 class="text-xl font-bold text-indigo-600 mt-1">S/. {{ number_format($totalRecaudado - $totalGastos, 2) }}</h3>
        </div>
    </div>

    <!-- Desglose de Operaciones (Tabla de Ingresos vs Egresos) -->
    <div class="grid grid-cols-2 gap-8">
        <!-- Detalle de Ingresos (Pagos de Pacientes) -->
        <div class="space-y-3">
            <h4 class="text-xs font-bold text-slate-900 uppercase tracking-widest border-b pb-2"><i class="fa-solid fa-arrow-trend-up text-emerald-500 mr-1.5"></i> Resumen de Ingresos</h4>
            <table class="w-full text-[11px] text-left">
                <thead>
                    <tr class="border-b text-slate-500">
                        <th class="py-2">Paciente</th>
                        <th class="py-2">Fecha</th>
                        <th class="py-2 text-right">Monto</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($pagosMes as $pago)
                        <tr>
                            <td class="py-2 font-medium text-slate-800">{{ $pago->paciente->nombre }}</td>
                            <td class="py-2 text-slate-500">{{ \Carbon\Carbon::parse($pago->fecha)->format('d/m/Y') }}</td>
                            <td class="py-2 text-right font-semibold text-emerald-600">S/. {{ number_format($pago->monto, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 text-center text-slate-400">Sin ingresos en este periodo.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Detalle de Gastos (Egresos Operativos) -->
        <div class="space-y-3">
            <h4 class="text-xs font-bold text-slate-900 uppercase tracking-widest border-b pb-2"><i class="fa-solid fa-arrow-trend-down text-amber-500 mr-1.5"></i> Resumen de Gastos</h4>
            <table class="w-full text-[11px] text-left">
                <thead>
                    <tr class="border-b text-slate-500">
                        <th class="py-2">Concepto</th>
                        <th class="py-2">Fecha</th>
                        <th class="py-2 text-right">Monto</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($gastosMes as $gasto)
                        <tr>
                            <td class="py-2 font-medium text-slate-800">{{ $gasto->concepto }}</td>
                            <td class="py-2 text-slate-500">{{ \Carbon\Carbon::parse($gasto->fecha)->format('d/m/Y') }}</td>
                            <td class="py-2 text-right font-semibold text-amber-600">S/. {{ number_format($gasto->monto, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 text-center text-slate-400">Sin egresos en este periodo.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Firma de Autorización -->
    <div class="pt-16 flex justify-between items-center text-center text-xs text-slate-500">
        <div>
            <div class="border-t border-slate-300 w-48 mx-auto pt-2">Administración</div>
        </div>
        <div>
            <div class="border-t border-slate-300 w-48 mx-auto pt-2">Dra. Pamela Miranda</div>
            <p class="text-[10px] text-slate-400 mt-0.5">C.D. Reg. COP 31415</p>
        </div>
    </div>
</div>

<!-- Barra de Acción (No se imprime) -->
<div class="no-print flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 bg-white border border-jade-100 p-6 rounded-3xl shadow-xl shadow-jade-100/10">
    <div>
        <h4 class="text-base font-bold text-slate-900 font-serif">Contabilidad y Reportes</h4>
        <p class="text-slate-500 text-xs mt-1">Genera y descarga reportes formales de ingresos, egresos y balance neto en formato PDF membretado en un clic.</p>
    </div>
    <button onclick="window.print()" class="bg-jade-500 hover:bg-jade-600 text-white font-bold py-2.5 px-5 rounded-xl text-xs flex items-center space-x-2 transition-all shadow-md shadow-jade-500/10">
        <i class="fa-solid fa-file-invoice-dollar text-base"></i> <span>Descargar Balance Mensual</span>
    </button>
</div>

<!-- Alertas de Citas del Día (No se imprime) -->
<div class="no-print mb-8">
    <div class="bg-white border border-jade-100 rounded-3xl p-6 shadow-xl shadow-jade-100/10 space-y-4">
        <div class="flex items-center space-x-3 border-b border-jade-50 pb-3">
            <div class="w-10 h-10 bg-jade-50 rounded-xl flex items-center justify-center text-jade-500 border border-jade-100">
                <i class="fa-solid fa-bell text-lg"></i>
            </div>
            <div>
                <h4 class="text-base font-bold text-slate-900 font-serif">Alertas de Citas de Hoy</h4>
                <p class="text-xs text-slate-500">Confirma asistencia con tus pacientes programados para el día de hoy con un solo clic por WhatsApp.</p>
            </div>
        </div>

        @if($citasHoy->isEmpty())
            <div class="flex items-center space-x-4 bg-jade-50/50 border border-jade-100 p-4 rounded-2xl">
                <div class="text-2xl">🎉</div>
                <p class="text-xs text-jade-800 font-medium">¡Día libre de citas programadas para hoy! Aprovecha para revisar el balance contable o descansar.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($citasHoy as $cita)
                    @php
                        $horaCita = \Carbon\Carbon::parse($cita->fecha_hora)->format('h:i A');
                        $telefonoLimpio = preg_replace('/[^0-9]/', '', $cita->paciente->telefono ?? '948097148');
                        if (strlen($telefonoLimpio) == 9) {
                            $telefonoLimpio = '51' . $telefonoLimpio;
                        }
                        $mensajePrefiltrado = "Hola " . $cita->paciente->nombre . ", le saludamos de la Clínica Dental Miradent. Le recordamos su cita de hoy a las " . $horaCita . " para su tratamiento de " . $cita->servicio . " con la Dra. Pamela Miranda. ¿Nos confirma su asistencia? ✨";
                        $whatsappUrl = "https://wa.me/" . $telefonoLimpio . "?text=" . rawurlencode($mensajePrefiltrado);
                    @endphp
                    <div class="bg-jade-50/20 border border-jade-100 rounded-2xl p-4 flex flex-col justify-between space-y-3 hover:border-jade-200 hover:shadow-lg hover:shadow-jade-100/30 transition-all">
                        <div class="flex justify-between items-start">
                            <div>
                                <h5 class="text-sm font-bold text-slate-900">{{ $cita->paciente->nombre }}</h5>
                                <p class="text-[11px] text-slate-500 mt-0.5"><i class="fa-solid fa-tooth text-[9px] text-jade-500 mr-1"></i> {{ $cita->servicio }}</p>
                            </div>
                            <span class="bg-jade-500 text-white font-mono text-xs font-bold px-2.5 py-1 rounded-full border border-jade-600/10">
                                {{ $horaCita }}
                            </span>
                        </div>
                        <a href="{{ $whatsappUrl }}" target="_blank" class="flex items-center justify-center space-x-1.5 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-bold py-2 px-4 rounded-xl transition-all shadow-md shadow-emerald-500/10">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            <span>Confirmar Asistencia</span>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- Grid de Tarjetas Estadísticas -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    
    <!-- Tarjeta 1: Total Pacientes -->
    <div class="print-card bg-vip-panel border border-vip-border p-6 rounded-3xl relative overflow-hidden flex items-center justify-between">
        <div class="space-y-2">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Pacientes Nuevos</p>
            <h3 class="text-3xl font-bold text-white font-serif">{{ $totalPacientes }}</h3>
            <p class="text-[10px] text-jade-500 font-medium"><i class="fa-solid fa-arrow-trend-up mr-1"></i> Registrados en la clínica</p>
        </div>
        <div class="no-print w-12 h-12 bg-jade-950 rounded-2xl flex items-center justify-center text-jade-400 border border-jade-900/40 flex-shrink-0">
            <i class="fa-solid fa-user-injured text-xl"></i>
        </div>
        <!-- Decoración -->
        <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-jade-500/5 rounded-full blur-xl pointer-events-none"></div>
    </div>

    <!-- Tarjeta 2: Total Citas -->
    <div class="print-card bg-vip-panel border border-vip-border p-6 rounded-3xl relative overflow-hidden flex items-center justify-between">
        <div class="space-y-2">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Citas Agendadas</p>
            <h3 class="text-3xl font-bold text-white font-serif">{{ $totalCitas }}</h3>
            <p class="text-[10px] text-jade-500 font-medium"><i class="fa-solid fa-clock mr-1"></i> Total de consultas</p>
        </div>
        <div class="no-print w-12 h-12 bg-jade-950 rounded-2xl flex items-center justify-center text-jade-400 border border-jade-900/40 flex-shrink-0">
            <i class="fa-solid fa-calendar-check text-xl"></i>
        </div>
        <!-- Decoración -->
        <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-jade-500/5 rounded-full blur-xl pointer-events-none"></div>
    </div>

    <!-- Tarjeta 3: Total Recaudado -->
    <div class="print-card bg-vip-panel border border-vip-border p-6 rounded-3xl relative overflow-hidden flex items-center justify-between">
        <div class="space-y-2">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest text-jade-400">Ingresos Brutos</p>
            <h3 class="text-2xl font-bold text-white font-serif">S/. {{ number_format($totalRecaudado, 2) }}</h3>
            <p class="text-[10px] text-jade-500 font-medium"><i class="fa-solid fa-sack-dollar mr-1"></i> Pagos Registrados</p>
        </div>
        <div class="no-print w-12 h-12 bg-jade-950 rounded-2xl flex items-center justify-center text-jade-400 border border-jade-900/40 flex-shrink-0">
            <i class="fa-solid fa-file-invoice-dollar text-xl"></i>
        </div>
        <!-- Decoración -->
        <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-jade-500/5 rounded-full blur-xl pointer-events-none"></div>
    </div>

    <!-- Tarjeta 4: Total Gastos -->
    <div class="print-card bg-vip-panel border border-vip-border p-6 rounded-3xl relative overflow-hidden flex items-center justify-between">
        <div class="space-y-2">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest text-amber-500">Gastos Realizados</p>
            <h3 class="text-2xl font-bold text-white font-serif">S/. {{ number_format($totalGastos, 2) }}</h3>
            <p class="text-[10px] text-amber-500 font-medium"><i class="fa-solid fa-receipt mr-1"></i> Egresos Registrados</p>
        </div>
        <div class="no-print w-12 h-12 bg-amber-950/60 rounded-2xl flex items-center justify-center text-amber-400 border border-amber-900/40 flex-shrink-0">
            <i class="fa-solid fa-receipt text-xl"></i>
        </div>
        <!-- Decoración -->
        <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-amber-500/5 rounded-full blur-xl pointer-events-none"></div>
    </div>

</div>

<!-- Gráfica de Balance de Caja (Ingresos vs. Gastos) -->
<div class="print-card mb-8 bg-white border border-jade-100 rounded-3xl p-6 shadow-xl shadow-jade-100/10 space-y-4">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 border-b border-jade-50 pb-4">
        <div>
            <h4 class="text-base font-bold text-slate-900 font-serif">Balance Financiero Mensual</h4>
            <p class="text-slate-500 text-xs mt-0.5">Muestra la comparativa de ingresos brutos, gastos fijos/operativos estimados y la utilidad neta de la clínica.</p>
        </div>
        <div class="flex items-center space-x-2 text-xs font-semibold text-jade-600 bg-jade-50 border border-jade-200 px-3 py-1.5 rounded-full">
            <span class="w-2 h-2 bg-jade-500 rounded-full {{ ($totalRecaudado > 0) ? 'animate-ping' : '' }}"></span>
            <span>Utilidad Neta Real: {{ ($totalRecaudado > 0) ? round((($totalRecaudado - $totalGastos) / $totalRecaudado) * 100) : 0 }}%</span>
        </div>
    </div>
    <div class="h-80 relative">
        <canvas id="balanceChart" class="w-full h-full"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('balanceChart').getContext('2d');
        
        // Obtener ingresos y gastos reales desde la base de datos
        const ingresosActual = {{ $totalRecaudado }};
        const gastosActual = {{ $totalGastos }};
        const gananciaActual = ingresosActual - gastosActual;

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo (Actual)', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                datasets: [
                    {
                        label: 'Ingresos Brutos (S/.)',
                        data: [0, 0, 0, 0, ingresosActual, 0, 0, 0, 0, 0, 0, 0],
                        backgroundColor: '#00BB77',
                        borderRadius: 6,
                        borderWidth: 0,
                        barPercentage: 0.6
                    },
                    {
                        label: 'Gastos de la Clínica (S/.)',
                        data: [0, 0, 0, 0, gastosActual, 0, 0, 0, 0, 0, 0, 0],
                        backgroundColor: '#f59e0b',
                        borderRadius: 6,
                        borderWidth: 0,
                        barPercentage: 0.6
                    },
                    {
                        label: 'Utilidad Neta (S/.)',
                        data: [0, 0, 0, 0, gananciaActual, 0, 0, 0, 0, 0, 0, 0],
                        type: 'line',
                        borderColor: '#008c5a',
                        borderWidth: 3,
                        pointBackgroundColor: '#005d3c',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        tension: 0.3,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                family: "'Plus Jakarta Sans', sans-serif",
                                size: 11,
                                weight: '600'
                            },
                            color: '#334155'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'S/. ' + value;
                            },
                            font: {
                                family: "'Plus Jakarta Sans', sans-serif",
                                size: 10
                            }
                        },
                        grid: {
                            color: '#f1f5f9'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: "'Plus Jakarta Sans', sans-serif",
                                size: 10
                            }
                        }
                    }
                }
            }
        });
    });
</script>

<!-- Sección de Citas Recientes y Accesos Rápidos -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- Tabla de Citas Recientes -->
    <div class="print-card lg:col-span-8 bg-vip-panel border border-vip-border rounded-3xl p-6 space-y-6">
        <div class="flex items-center justify-between border-b border-vip-border/50 pb-4">
            <h4 class="text-base font-bold text-white font-serif">Últimas Citas Clínicas</h4>
            <a href="{{ route('citas.index') }}" class="no-print text-xs text-jade-400 hover:text-jade-300 font-semibold flex items-center">
                Ver toda la agenda <i class="fa-solid fa-arrow-right ml-1 text-[10px]"></i>
            </a>
        </div>

        @if($citasRecientes->isEmpty())
            <div class="text-center py-12 text-slate-500 space-y-3">
                <i class="fa-solid fa-calendar-times text-4xl text-slate-700"></i>
                <p class="text-sm">No se han registrado citas todavía.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-400">
                    <thead class="text-xs uppercase font-semibold text-slate-500 bg-slate-900/40 border-b border-vip-border/50">
                        <tr>
                            <th class="px-4 py-3">Paciente</th>
                            <th class="px-4 py-3">Servicio</th>
                            <th class="px-4 py-3">Fecha y Hora</th>
                            <th class="px-4 py-3 text-right">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-vip-border/20">
                        @foreach($citasRecientes as $cita)
                            <tr class="hover:bg-slate-900/20 transition-all">
                                <td class="px-4 py-4 font-medium text-white">
                                    {{ $cita->paciente->nombre }}
                                </td>
                                <td class="px-4 py-4 text-xs">
                                    {{ $cita->servicio }}
                                </td>
                                <td class="px-4 py-4 text-xs">
                                    {{ \Carbon\Carbon::parse($cita->fecha_hora)->format('d/m/Y h:i A') }}
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold border 
                                        @if($cita->estado == 'Confirmada') bg-emerald-950/60 text-emerald-400 border-emerald-900/60
                                        @elseif($cita->estado == 'Pendiente') bg-amber-950/60 text-amber-400 border-amber-900/60
                                        @else bg-red-950/60 text-red-400 border-red-900/60
                                        @endif uppercase tracking-wider">
                                        {{ $cita->estado }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Panel de Accesos Rápidos -->
    <div class="no-print lg:col-span-4 bg-vip-panel border border-vip-border rounded-3xl p-6 space-y-6">
        <h4 class="text-base font-bold text-white font-serif border-b border-vip-border/50 pb-4">Acciones Rápidas</h4>
        
        <div class="space-y-3.5">
            <a href="{{ route('pacientes.index') }}" class="flex items-center space-x-3 p-4 bg-slate-900/50 rounded-2xl hover:bg-slate-900 hover:scale-[1.01] transition-all border border-vip-border/30">
                <div class="w-10 h-10 bg-jade-950 rounded-xl flex items-center justify-center text-jade-400">
                    <i class="fa-solid fa-plus text-base"></i>
                </div>
                <div>
                    <h5 class="text-sm font-bold text-white">Registrar Paciente</h5>
                    <p class="text-[10px] text-slate-500 mt-0.5">Crear ficha médica e historial</p>
                </div>
            </a>

            <a href="{{ route('citas.index') }}" class="flex items-center space-x-3 p-4 bg-slate-900/50 rounded-2xl hover:bg-slate-900 hover:scale-[1.01] transition-all border border-vip-border/30">
                <div class="w-10 h-10 bg-jade-950 rounded-xl flex items-center justify-center text-jade-400">
                    <i class="fa-solid fa-calendar-plus text-base"></i>
                </div>
                <div>
                    <h5 class="text-sm font-bold text-white">Agendar Nueva Cita</h5>
                    <p class="text-[10px] text-slate-500 mt-0.5">Reservar día y hora de consulta</p>
                </div>
            </a>

            <a href="{{ route('pagos.index') }}" class="flex items-center space-x-3 p-4 bg-slate-900/50 rounded-2xl hover:bg-slate-900 hover:scale-[1.01] transition-all border border-vip-border/30">
                <div class="w-10 h-10 bg-jade-950 rounded-xl flex items-center justify-center text-jade-400">
                    <i class="fa-solid fa-receipt text-base"></i>
                </div>
                <div>
                    <h5 class="text-sm font-bold text-white">Registrar Pago</h5>
                    <p class="text-[10px] text-slate-500 mt-0.5">Ingresar abonos de tratamientos</p>
                </div>
            </a>
        </div>
    </div>

</div>
@endsection
