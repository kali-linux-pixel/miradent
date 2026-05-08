@extends('layouts.admin')

@section('title', 'Citas')
@section('page_title', 'Agenda de Citas')

@section('content')
<div class="bg-vip-panel border border-[#cdfae9] rounded-3xl p-6 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-[#cdfae9]/50 pb-4">
        <div>
            <h4 class="text-base font-bold text-[#002f1e] font-serif">Listado de Citas Odontológicas</h4>
            <p class="text-slate-500 text-xs mt-1">Planifica, edita, confirma o cancela las citas de los pacientes.</p>
        </div>
        @if($pacientes->isEmpty())
            <span class="text-xs text-amber-600 bg-amber-50 border border-amber-200 px-4 py-2.5 rounded-xl font-medium">
                <i class="fa-solid fa-triangle-exclamation mr-1.5"></i> Primero registra un paciente
            </span>
        @else
            <button onclick="toggleModal('modal-create', true)" class="bg-jade-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-jade-500 transition-all flex items-center justify-center space-x-2">
                <i class="fa-solid fa-calendar-plus"></i> <span>Agendar Cita</span>
            </button>
        @endif
    </div>

    <!-- Calendario Semanal Visual -->
    <div class="print-card bg-[#e6fcf4]/30 border border-[#cdfae9] p-5 rounded-3xl space-y-4">
        <div class="flex items-center space-x-2 border-b border-[#cdfae9] pb-3">
            <div class="w-7 h-7 bg-[#e6fcf4] rounded-lg flex items-center justify-center text-[#00BB77]">
                <i class="fa-solid fa-calendar-days text-sm"></i>
            </div>
            <h4 class="text-xs font-bold text-[#002f1e] uppercase tracking-wider">Distribución Semanal de la Agenda</h4>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-7 gap-3">
            @php
                $diasSemana = [
                    1 => 'Lunes',
                    2 => 'Martes',
                    3 => 'Miércoles',
                    4 => 'Jueves',
                    5 => 'Viernes',
                    6 => 'Sábado',
                    7 => 'Domingo'
                ];
            @endphp
            
            @foreach($diasSemana as $numDia => $nombreDia)
                @php
                    $citasDia = $citas->filter(function($cita) use ($numDia) {
                        return \Carbon\Carbon::parse($cita->fecha_hora)->dayOfWeekIso === $numDia;
                    })->sortBy('fecha_hora');
                @endphp
                
                <div class="bg-white border border-[#cdfae9] p-3 rounded-2xl space-y-2 min-h-[140px] flex flex-col justify-start shadow-sm">
                    <div>
                        <p class="text-[10px] font-bold text-[#00BB77] uppercase tracking-widest border-b border-[#e6fcf4] pb-1.5 text-center">{{ $nombreDia }}</p>
                        <div class="space-y-1.5 mt-2">
                            @if($citasDia->isEmpty())
                                <p class="text-[9px] text-slate-400 italic text-center py-4">Libre</p>
                            @else
                                @foreach($citasDia as $cDia)
                                    <div class="bg-[#e6fcf4] border border-[#cdfae9] p-1.5 rounded-xl text-[9px] space-y-0.5 shadow-sm">
                                        <p class="font-bold text-[#002f1e] truncate" title="{{ $cDia->paciente->nombre }}">{{ $cDia->paciente->nombre }}</p>
                                        <p class="text-slate-600 font-medium text-[8px]">{{ \Carbon\Carbon::parse($cDia->fecha_hora)->format('h:i A') }}</p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if($citas->isEmpty())
        <div class="text-center py-16 text-slate-500 space-y-4">
            <i class="fa-solid fa-calendar-times text-5xl text-slate-300"></i>
            <p class="text-sm">No se han agendado citas todavía.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-400">
                <thead class="text-xs uppercase font-semibold text-slate-500 bg-[#e6fcf4] border-b border-[#cdfae9]">
                    <tr>
                        <th class="px-4 py-3">Paciente</th>
                        <th class="px-4 py-3">Servicio</th>
                        <th class="px-4 py-3">Fecha y Hora</th>
                        <th class="px-4 py-3 text-center">Estado</th>
                        <th class="px-4 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e6fcf4]/50">
                    @foreach($citas as $cita)
                        <tr class="hover:bg-[#e6fcf4]/30 transition-all">
                            <td class="px-4 py-4 font-bold text-[#002f1e]">
                                {{ $cita->paciente->nombre }}
                            </td>
                            <td class="px-4 py-4 text-xs text-[#005d3c] font-semibold">
                                {{ $cita->servicio }}
                            </td>
                            <td class="px-4 py-4 text-xs text-slate-600">
                                {{ \Carbon\Carbon::parse($cita->fecha_hora)->format('d/m/Y h:i A') }}
                            </td>
                            <td class="px-4 py-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold border 
                                    @if($cita->estado == 'Confirmada') bg-[#e6fcf4] text-[#00BB77] border-[#cdfae9]
                                    @elseif($cita->estado == 'Pendiente') bg-amber-50 text-amber-600 border-amber-200
                                    @else bg-rose-50 text-rose-600 border-rose-200
                                    @endif uppercase tracking-wider shadow-sm">
                                    {{ $cita->estado }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-right space-x-2">
                                @php
                                    $telefonoPaciente = $cita->paciente->telefono ?? '990353982';
                                    // Limpiar teléfono de caracteres raros y asegurar prefijo de país si no lo tiene
                                    $telefonoLimpio = preg_replace('/[^0-9]/', '', $telefonoPaciente);
                                    if (strlen($telefonoLimpio) === 9 && str_starts_with($telefonoLimpio, '9')) {
                                        $telefonoLimpio = '51' . $telefonoLimpio;
                                    }
                                    $mensajeWhatsApp = "Hola " . $cita->paciente->nombre . ", le saluda la Clínica Miradent. Le recordamos su cita para " . $cita->servicio . " programada para el " . \Carbon\Carbon::parse($cita->fecha_hora)->format('d/m/Y') . " a las " . \Carbon\Carbon::parse($cita->fecha_hora)->format('h:i A') . ". Por favor confirme su asistencia respondiendo a este mensaje. ¡Que tenga un excelente día!";
                                    $urlWhatsApp = "https://wa.me/" . $telefonoLimpio . "?text=" . urlencode($mensajeWhatsApp);
                                @endphp
                                <a href="{{ $urlWhatsApp }}" target="_blank" class="inline-flex items-center justify-center p-1.5 bg-slate-50 text-emerald-600 hover:text-white hover:bg-emerald-500 rounded-lg transition-all border border-emerald-150 shadow-sm" title="Enviar recordatorio por WhatsApp">
                                    <i class="fa-brands fa-whatsapp text-sm"></i>
                                </a>
                                <button onclick="openEditModal({{ json_encode($cita) }})" class="inline-flex items-center justify-center p-1.5 bg-slate-50 text-slate-500 hover:text-jade-500 hover:bg-jade-50 rounded-lg transition-all border border-jade-100 shadow-sm" title="Editar cita">
                                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                                </button>
                                <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar esta cita?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center p-1.5 bg-slate-50 text-slate-500 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all border border-rose-100 shadow-sm" title="Eliminar cita">
                                        <i class="fa-solid fa-trash-can text-sm"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- MODAL AGENDAR CITA -->
<div id="modal-create" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-vip-panel border border-vip-border rounded-3xl w-full max-w-lg overflow-hidden shadow-2xl">
        <div class="h-16 border-b border-vip-border flex items-center justify-between px-6 bg-slate-900/50">
            <h3 class="text-white font-serif font-bold text-base">Agendar Nueva Cita</h3>
            <button onclick="toggleModal('modal-create', false)" class="text-slate-400 hover:text-white"><i class="fa-solid fa-xmark text-lg"></i></button>
        </div>
        <form action="{{ route('citas.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Paciente</label>
                <select name="paciente_id" required class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600 bg-slate-900">
                    <option value="" disabled selected>Selecciona un paciente...</option>
                    @foreach($pacientes as $paciente)
                        <option value="{{ $paciente->id }}">{{ $paciente->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Servicio o Tratamiento</label>
                <select name="servicio" required class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600">
                    <option>Limpieza Dental Profesional</option>
                    <option>Ortodoncia Avanzada</option>
                    <option>Implantes Dentales VIP</option>
                    <option>Diseño de Sonrisa</option>
                    <option>Endodoncia</option>
                    <option>Odontopediatría</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5 col-span-2">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Fecha y Hora</label>
                    <input type="datetime-local" id="create-fecha-hora" name="fecha_hora" oninput="checkCreateCollision()" required class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600">
                </div>
                <div class="space-y-1.5 col-span-2">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Estado Inicial</label>
                    <select name="estado" required class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600">
                        <option value="Pendiente">Pendiente</option>
                        <option value="Confirmada">Confirmada</option>
                        <option value="Cancelada">Cancelada</option>
                    </select>
                </div>
                <!-- Alerta de Choque de Horarios -->
                <div id="create-collision-warning" class="hidden text-xs font-bold text-amber-400 bg-amber-950/40 border border-amber-900/40 p-3 rounded-xl flex items-center space-x-2 col-span-2 animate-pulse">
                    <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                    <span>⚠️ Alerta: Ya hay otra cita agendada en un rango cercano a esta hora.</span>
                </div>
            </div>
            <div class="pt-2 flex justify-end space-x-3">
                <button type="button" onclick="toggleModal('modal-create', false)" class="bg-slate-900 border border-vip-border text-slate-400 px-4 py-2 rounded-xl text-sm hover:text-white transition-all">Cancelar</button>
                <button type="submit" class="bg-jade-600 text-white px-5 py-2 rounded-xl text-sm font-semibold hover:bg-jade-500 transition-all">Agendar Cita</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDITAR CITA -->
<div id="modal-edit" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-vip-panel border border-vip-border rounded-3xl w-full max-w-lg overflow-hidden shadow-2xl">
        <div class="h-16 border-b border-vip-border flex items-center justify-between px-6 bg-slate-900/50">
            <h3 class="text-white font-serif font-bold text-base">Editar Cita</h3>
            <button onclick="toggleModal('modal-edit', false)" class="text-slate-400 hover:text-white"><i class="fa-solid fa-xmark text-lg"></i></button>
        </div>
        <form id="form-edit" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Paciente</label>
                <select id="edit-paciente" name="paciente_id" required class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600 bg-slate-900">
                    @foreach($pacientes as $paciente)
                        <option value="{{ $paciente->id }}">{{ $paciente->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Servicio o Tratamiento</label>
                <select id="edit-servicio" name="servicio" required class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600">
                    <option>Limpieza Dental Profesional</option>
                    <option>Ortodoncia Avanzada</option>
                    <option>Implantes Dentales VIP</option>
                    <option>Diseño de Sonrisa</option>
                    <option>Endodoncia</option>
                    <option>Odontopediatría</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5 col-span-2">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Fecha y Hora</label>
                    <input type="datetime-local" id="edit-fecha" name="fecha_hora" oninput="checkEditCollision()" required class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600">
                </div>
                <div class="space-y-1.5 col-span-2">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Estado</label>
                    <select id="edit-estado" name="estado" required class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600">
                        <option value="Pendiente">Pendiente</option>
                        <option value="Confirmada">Confirmada</option>
                        <option value="Cancelada">Cancelada</option>
                    </select>
                </div>
                <!-- Alerta de Choque de Horarios -->
                <div id="edit-collision-warning" class="hidden text-xs font-bold text-amber-400 bg-amber-950/40 border border-amber-900/40 p-3 rounded-xl flex items-center space-x-2 col-span-2 animate-pulse">
                    <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                    <span>⚠️ Alerta: Ya hay otra cita agendada en un rango cercano a esta hora.</span>
                </div>
            </div>
            <div class="pt-2 flex justify-end space-x-3">
                <button type="button" onclick="toggleModal('modal-edit', false)" class="bg-slate-900 border border-vip-border text-slate-400 px-4 py-2 rounded-xl text-sm hover:text-white transition-all">Cancelar</button>
                <button type="submit" class="bg-jade-600 text-white px-5 py-2 rounded-xl text-sm font-semibold hover:bg-jade-500 transition-all">Actualizar Cita</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Obtener todas las citas existentes en formato JSON desde el servidor
    const todasLasCitas = @json($citas);

    function toggleModal(id, show) {
        const modal = document.getElementById(id);
        if (show) {
            modal.classList.remove('hidden');
        } else {
            modal.classList.add('hidden');
        }
    }

    function openEditModal(cita) {
        document.getElementById('edit-paciente').value = cita.paciente_id;
        document.getElementById('edit-servicio').value = cita.servicio;
        
        // Convertir formato de fecha de la BD para adaptarlo a datetime-local input
        const fecha = new Date(cita.fecha_hora);
        const localISO = new Date(fecha.getTime() - fecha.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
        document.getElementById('edit-fecha').value = localISO;
        
        document.getElementById('edit-estado').value = cita.estado;
        
        const form = document.getElementById('form-edit');
        form.action = `/admin/citas/${cita.id}`;

        // Ocultar alerta de colisión al abrir
        document.getElementById('edit-collision-warning').classList.add('hidden');

        toggleModal('modal-edit', true);
    }

    // Comprobar colisión para nueva cita (Creación)
    function checkCreateCollision() {
        const inputVal = document.getElementById('create-fecha-hora').value;
        const warningDiv = document.getElementById('create-collision-warning');
        if (!inputVal) {
            warningDiv.classList.add('hidden');
            return;
        }

        const selectedTime = new Date(inputVal).getTime();
        let collisionFound = false;

        todasLasCitas.forEach(cita => {
            const citaTime = new Date(cita.fecha_hora).getTime();
            // Si hay otra cita en un rango de menos de 1 hora (3600000 ms)
            if (Math.abs(selectedTime - citaTime) < 3600000 && cita.estado !== 'Cancelada') {
                collisionFound = true;
            }
        });

        if (collisionFound) {
            warningDiv.classList.remove('hidden');
        } else {
            warningDiv.classList.add('hidden');
        }
    }

    // Comprobar colisión para cita editada
    function checkEditCollision() {
        const inputVal = document.getElementById('edit-fecha').value;
        const warningDiv = document.getElementById('edit-collision-warning');
        if (!inputVal) {
            warningDiv.classList.add('hidden');
            return;
        }

        const selectedTime = new Date(inputVal).getTime();
        let collisionFound = false;

        // Obtener ID de la cita que se está editando para no auto-chocar
        const formAction = document.getElementById('form-edit').action;
        const currentCitaId = formAction.substring(formAction.lastIndexOf('/') + 1);

        todasLasCitas.forEach(cita => {
            // Ignorar la propia cita que estamos editando
            if (cita.id.toString() !== currentCitaId) {
                const citaTime = new Date(cita.fecha_hora).getTime();
                if (Math.abs(selectedTime - citaTime) < 3600000 && cita.estado !== 'Cancelada') {
                    collisionFound = true;
                }
            }
        });

        if (collisionFound) {
            warningDiv.classList.remove('hidden');
        } else {
            warningDiv.classList.add('hidden');
        }
    }
</script>
@endsection
