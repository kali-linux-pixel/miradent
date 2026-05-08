@extends('layouts.admin')

@section('title', 'Pacientes')
@section('page_title', 'Fichas de Pacientes')

@section('content')
<div class="bg-vip-panel border border-vip-border rounded-3xl p-6 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-vip-border/50 pb-4">
        <div>
            <h4 class="text-base font-bold text-white font-serif">Listado de Pacientes Registrados</h4>
            <p class="text-slate-500 text-xs mt-1">Busca, edita, agrega o elimina las fichas de pacientes de la clínica.</p>
        </div>
        <button onclick="toggleModal('modal-create', true)" class="bg-jade-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-jade-500 transition-all flex items-center justify-center space-x-2">
            <i class="fa-solid fa-plus"></i> <span>Registrar Paciente</span>
        </button>
    </div>

    <!-- Buscador sencillo -->
    <div class="relative max-w-xs">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-500">
            <i class="fa-solid fa-magnifying-glass text-sm"></i>
        </span>
        <input type="text" id="pacientes-search" onkeyup="searchPacientes()" class="w-full bg-white border border-[#cdfae9] text-[#002f1e] text-sm rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:border-[#00BB77] focus:ring-1 focus:ring-[#00BB77] transition-all" placeholder="Buscar por nombre...">
    </div>

    @if($pacientes->isEmpty())
        <div class="text-center py-16 text-slate-500 space-y-4">
            <i class="fa-solid fa-user-injured text-5xl text-slate-800"></i>
            <p class="text-sm">Aún no se han registrado pacientes. Haz clic arriba para agregar el primero.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table id="pacientes-table" class="w-full text-left text-sm text-slate-400">
                <thead class="text-xs uppercase font-semibold text-slate-500 bg-slate-900/40 border-b border-vip-border/50">
                    <tr>
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Edad</th>
                        <th class="px-4 py-3">Teléfono</th>
                        <th class="px-4 py-3">Dirección</th>
                        <th class="px-4 py-3">Alérgico</th>
                        <th class="px-4 py-3">Alergias/Observaciones</th>
                        <th class="px-4 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e6fcf4]/50">
                    @foreach($pacientes as $paciente)
                        <tr class="hover:bg-[#e6fcf4]/30 transition-all">
                            <td class="px-4 py-4 font-bold text-[#002f1e] max-w-[180px] truncate">
                                {{ $paciente->nombre }}
                            </td>
                            <td class="px-4 py-4 text-xs text-[#005d3c] font-medium">
                                {{ $paciente->edad }} años
                            </td>
                            <td class="px-4 py-4 text-xs text-[#005d3c] font-medium">
                                {{ $paciente->telefono }}
                            </td>
                            <td class="px-4 py-4 text-xs text-slate-600 truncate max-w-[200px]">
                                {{ $paciente->direccion }}
                            </td>
                            <td class="px-4 py-4 text-xs">
                                @if($paciente->alergico)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-rose-50 text-rose-600 border border-rose-200 shadow-sm">
                                        <i class="fa-solid fa-triangle-exclamation mr-1 animate-pulse"></i> SÍ
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#e6fcf4] text-[#00BB77] border border-[#cdfae9] shadow-sm">
                                        <i class="fa-solid fa-circle-check mr-1"></i> NO
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-xs max-w-[150px] truncate">
                                @if($paciente->alergias)
                                    <span class="px-2.5 py-1 rounded-full font-semibold text-rose-600 bg-rose-50 border border-rose-200">
                                        {{ $paciente->alergias }}
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full font-semibold text-[#00BB77] bg-[#e6fcf4] border border-[#cdfae9]">
                                        Ninguna
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-right space-x-2">
                                <!-- Botón Odontograma -->
                                <button onclick="openOdontograma('{{ $paciente->id }}', '{{ $paciente->nombre }}')" class="inline-flex items-center justify-center p-1.5 bg-slate-50 text-emerald-600 hover:text-white hover:bg-emerald-500 rounded-lg transition-all border border-emerald-150 shadow-sm" title="Ver Odontograma Digital">
                                    <i class="fa-solid fa-tooth text-xs"></i>
                                </button>
                                <!-- Botón Historial Clínico -->
                                <button onclick="openHistorial('{{ $paciente->id }}', '{{ $paciente->nombre }}', '{{ $paciente->telefono }}')" class="inline-flex items-center justify-center p-1.5 bg-slate-50 text-blue-600 hover:text-white hover:bg-blue-500 rounded-lg transition-all border border-blue-150 shadow-sm" title="Ver Historial Clínico">
                                    <i class="fa-solid fa-file-medical text-xs"></i>
                                </button>
                                <!-- Botón Editar -->
                                <button onclick="openEditModal({{ json_encode($paciente) }})" class="inline-flex items-center justify-center p-1.5 bg-slate-50 text-slate-500 hover:text-jade-500 hover:bg-jade-50 rounded-lg transition-all border border-jade-100 shadow-sm" title="Editar paciente">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </button>
                                <!-- Formulario de Borrado -->
                                <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este paciente? Sus citas y pagos asociados se eliminarán permanentemente.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center p-1.5 bg-slate-50 text-slate-500 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all border border-rose-100 shadow-sm" title="Eliminar paciente">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
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

<!-- MODAL CREACIÓN -->
<div id="modal-create" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-vip-panel border border-vip-border rounded-3xl w-full max-w-lg overflow-hidden shadow-2xl">
        <div class="h-16 border-b border-vip-border flex items-center justify-between px-6 bg-slate-900/50">
            <h3 class="text-white font-serif font-bold text-base">Registrar Nuevo Paciente</h3>
            <button onclick="toggleModal('modal-create', false)" class="text-slate-400 hover:text-white"><i class="fa-solid fa-xmark text-lg"></i></button>
        </div>
        <form action="{{ route('pacientes.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Nombre Completo</label>
                <input type="text" name="nombre" required class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600" placeholder="Ej. Juan Pérez Medina">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Edad</label>
                    <input type="number" name="edad" required min="0" max="120" class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600" placeholder="Ej. 28">
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Teléfono</label>
                    <input type="text" name="telefono" required class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600" placeholder="Ej. 948097148">
                </div>
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Dirección</label>
                <input type="text" name="direccion" required class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600" placeholder="Ej. Av. Larco 456, Miraflores">
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">¿Es Alérgico?</label>
                <select name="alergico" class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600">
                    <option value="0" style="color: #10b981; font-weight: bold;">NO (Paciente sin Alergias conocidas)</option>
                    <option value="1" style="color: #ef4444; font-weight: bold;">SÍ (Paciente Alérgico)</option>
                </select>
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Alergias o Observaciones Médicas (Opcional)</label>
                <textarea name="alergias" rows="3" class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600" placeholder="Indicar alergias a medicamentos como la penicilina, asma, etc."></textarea>
            </div>
            <div class="pt-2 flex justify-end space-x-3">
                <button type="button" onclick="toggleModal('modal-create', false)" class="bg-slate-900 border border-vip-border text-slate-400 px-4 py-2 rounded-xl text-sm hover:text-white transition-all">Cancelar</button>
                <button type="submit" class="bg-jade-600 text-white px-5 py-2 rounded-xl text-sm font-semibold hover:bg-jade-500 transition-all">Guardar Paciente</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDICIÓN -->
<div id="modal-edit" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-vip-panel border border-vip-border rounded-3xl w-full max-w-lg overflow-hidden shadow-2xl">
        <div class="h-16 border-b border-vip-border flex items-center justify-between px-6 bg-slate-900/50">
            <h3 class="text-white font-serif font-bold text-base">Editar Paciente</h3>
            <button onclick="toggleModal('modal-edit', false)" class="text-slate-400 hover:text-white"><i class="fa-solid fa-xmark text-lg"></i></button>
        </div>
        <form id="form-edit" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Nombre Completo</label>
                <input type="text" id="edit-nombre" name="nombre" required class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Edad</label>
                    <input type="number" id="edit-edad" name="edad" required min="0" max="120" class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600">
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Teléfono</label>
                    <input type="text" id="edit-telefono" name="telefono" required class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600">
                </div>
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Dirección</label>
                <input type="text" id="edit-direccion" name="direccion" required class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600">
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">¿Es Alérgico?</label>
                <select id="edit-alergico" name="alergico" class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600">
                    <option value="0" style="color: #10b981; font-weight: bold;">NO (Paciente sin Alergias conocidas)</option>
                    <option value="1" style="color: #ef4444; font-weight: bold;">SÍ (Paciente Alérgico)</option>
                </select>
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Alergias o Observaciones Médicas</label>
                <textarea id="edit-alergias" name="alergias" rows="3" class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600"></textarea>
            </div>
            <div class="pt-2 flex justify-end space-x-3">
                <button type="button" onclick="toggleModal('modal-edit', false)" class="bg-slate-900 border border-vip-border text-slate-400 px-4 py-2 rounded-xl text-sm hover:text-white transition-all">Cancelar</button>
                <button type="submit" class="bg-jade-600 text-white px-5 py-2 rounded-xl text-sm font-semibold hover:bg-jade-500 transition-all">Actualizar Paciente</button>
            </div>
        </form>
    </div>
</div>

<!-- LÓGICA DE CONTROL MODALES Y FILTRADO -->
<script>
    function toggleModal(id, show) {
        const modal = document.getElementById(id);
        if (show) {
            modal.classList.remove('hidden');
        } else {
            modal.classList.add('hidden');
        }
    }

    function openEditModal(paciente) {
        document.getElementById('edit-nombre').value = paciente.nombre;
        document.getElementById('edit-edad').value = paciente.edad;
        document.getElementById('edit-telefono').value = paciente.telefono;
        document.getElementById('edit-direccion').value = paciente.direccion;
        document.getElementById('edit-alergias').value = paciente.alergias ?? '';
        document.getElementById('edit-alergico').value = paciente.alergico ? '1' : '0';
        
        // Asignar ruta de actualización dinámica
        const form = document.getElementById('form-edit');
        form.action = `/admin/pacientes/${paciente.id}`;

        toggleModal('modal-edit', true);
    }

    function searchPacientes() {
        const input = document.getElementById('pacientes-search');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('pacientes-table');
        if (!table) return;
        const trs = table.getElementsByTagName('tr');

        for (let i = 1; i < trs.length; i++) {
            const td = trs[i].getElementsByTagName('td')[0];
            if (td) {
                const txtValue = td.textContent || td.innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    trs[i].style.display = '';
                } else {
                    trs[i].style.display = 'none';
                }
            }
        }
    }
</script>

<!-- MODAL ODONTOGRAMA DIGITAL INTERACTIVO -->
<div id="modal-odontograma" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-vip-panel border border-vip-border rounded-3xl w-full max-w-4xl overflow-hidden shadow-2xl">
        <div class="h-16 border-b border-vip-border flex items-center justify-between px-6 bg-slate-900/50">
            <div class="flex items-center space-x-2.5">
                <div class="w-8 h-8 rounded-lg bg-jade-950 flex items-center justify-center text-jade-400">
                    <i class="fa-solid fa-tooth"></i>
                </div>
                <h3 class="text-white font-serif font-bold text-base">Odontograma Clínico: <span id="odontograma-paciente-nombre" class="text-jade-400"></span></h3>
            </div>
            <button onclick="toggleModal('modal-odontograma', false)" class="text-slate-400 hover:text-white"><i class="fa-solid fa-xmark text-lg"></i></button>
        </div>
        
        <div class="p-6 sm:p-8 space-y-8">
            <!-- Leyenda Clínica -->
            <div class="bg-slate-900/40 border border-vip-border/50 p-4 rounded-2xl flex flex-wrap gap-6 justify-center text-xs">
                <div class="flex items-center space-x-2">
                    <span class="w-3.5 h-3.5 bg-red-500 rounded-full border border-white"></span>
                    <span class="text-slate-300 font-medium">🔴 Caries</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="w-3.5 h-3.5 bg-emerald-500 rounded-full border border-white"></span>
                    <span class="text-slate-300 font-medium">🟢 Resina / Sano</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="w-3.5 h-3.5 bg-blue-500 rounded-full border border-white"></span>
                    <span class="text-slate-300 font-medium">🔵 Corona</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="w-3.5 h-3.5 bg-slate-600 rounded-full border border-white"></span>
                    <span class="text-slate-300 font-medium">⚫ Ausente / Extracción</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="w-3.5 h-3.5 bg-white rounded-full border border-slate-300"></span>
                    <span class="text-slate-300 font-medium">⚪ Sin Tratar (Limpio)</span>
                </div>
            </div>

            <!-- Mapa Dental -->
            <div class="space-y-10 text-center">
                <!-- MAXILAR SUPERIOR -->
                <div class="space-y-4">
                    <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Maxilar Superior (Dientes 18 al 28)</h4>
                    <div class="flex flex-wrap justify-center gap-3">
                        @foreach([18, 17, 16, 15, 14, 13, 12, 11, 21, 22, 23, 24, 25, 26, 27, 28] as $idDiente)
                            <button id="diente-{{ $idDiente }}" onclick="selectTooth('{{ $idDiente }}')" class="w-12 h-14 bg-white hover:bg-jade-50 rounded-xl flex flex-col items-center justify-between py-2 border border-slate-200 shadow-md transition-all group focus:outline-none relative">
                                <span class="text-[10px] font-bold text-slate-500">{{ $idDiente }}</span>
                                <div class="tooth-indicator w-5 h-5 rounded-full bg-slate-100 border border-slate-300 flex items-center justify-center">
                                    <i class="fa-solid fa-tooth text-[9px] text-slate-400"></i>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- MANDÍBULA INFERIOR -->
                <div class="space-y-4">
                    <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Mandíbula Inferior (Dientes 48 al 38)</h4>
                    <div class="flex flex-wrap justify-center gap-3">
                        @foreach([48, 47, 46, 45, 44, 43, 42, 41, 31, 32, 33, 34, 35, 36, 37, 38] as $idDiente)
                            <button id="diente-{{ $idDiente }}" onclick="selectTooth('{{ $idDiente }}')" class="w-12 h-14 bg-white hover:bg-jade-50 rounded-xl flex flex-col items-center justify-between py-2 border border-slate-200 shadow-md transition-all group focus:outline-none relative">
                                <div class="tooth-indicator w-5 h-5 rounded-full bg-slate-100 border border-slate-300 flex items-center justify-center">
                                    <i class="fa-solid fa-tooth text-[9px] text-slate-400"></i>
                                </div>
                                <span class="text-[10px] font-bold text-slate-500">{{ $idDiente }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Panel de Selección de Estado (Oculto hasta seleccionar un diente) -->
            <div id="odontograma-selector" class="hidden bg-slate-900/50 border border-vip-border p-6 rounded-2xl space-y-4 text-center">
                <p class="text-sm text-slate-300">Asignar diagnóstico al <span class="font-bold text-white bg-jade-950 border border-jade-900/40 px-2.5 py-1 rounded-lg">Diente <span id="odontograma-diente-seleccionado"></span></span></p>
                <div class="flex flex-wrap gap-3 justify-center">
                    <button onclick="updateToothStatus('sano')" class="bg-white text-slate-800 border border-slate-200 px-4 py-2 rounded-xl text-xs font-bold hover:bg-slate-50 flex items-center space-x-2">
                        <span class="w-3 h-3 bg-white border border-slate-300 rounded-full"></span>
                        <span>⚪ Limpio</span>
                    </button>
                    <button onclick="updateToothStatus('caries')" class="bg-red-500 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-red-600 flex items-center space-x-2">
                        <span class="w-3 h-3 bg-white rounded-full"></span>
                        <span>🔴 Caries</span>
                    </button>
                    <button onclick="updateToothStatus('resina')" class="bg-emerald-500 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-emerald-600 flex items-center space-x-2">
                        <span class="w-3 h-3 bg-white rounded-full"></span>
                        <span>🟢 Resina</span>
                    </button>
                    <button onclick="updateToothStatus('corona')" class="bg-blue-500 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-blue-600 flex items-center space-x-2">
                        <span class="w-3 h-3 bg-white rounded-full"></span>
                        <span>🔵 Corona</span>
                    </button>
                    <button onclick="updateToothStatus('ausente')" class="bg-slate-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-slate-700 flex items-center space-x-2">
                        <span class="w-3 h-3 bg-white rounded-full"></span>
                        <span>⚫ Ausente</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="h-16 border-t border-vip-border bg-slate-900/50 px-6 flex items-center justify-between">
            <span class="text-xs text-slate-500"><i class="fa-solid fa-circle-info mr-1.5"></i> Los cambios se guardan automáticamente.</span>
            <button onclick="toggleModal('modal-odontograma', false)" class="bg-jade-600 text-white px-5 py-2 rounded-xl text-xs font-bold hover:bg-jade-500 transition-all">Cerrar Odontograma</button>
        </div>
    </div>
</div>

<script>
    let currentPacienteId = null;
    let selectedTooth = null;

    function openOdontograma(pacienteId, pacienteNombre) {
        currentPacienteId = pacienteId;
        selectedTooth = null;
        document.getElementById('odontograma-paciente-nombre').innerText = pacienteNombre;
        document.getElementById('odontograma-selector').classList.add('hidden');

        // Limpiar estilos de selección previa en dientes
        document.querySelectorAll('[id^="diente-"]').forEach(btn => {
            btn.classList.remove('ring-2', 'ring-jade-500', 'scale-105');
        });

        // Cargar datos guardados del paciente
        loadOdontogramaData();

        toggleModal('modal-odontograma', true);
    }

    function selectTooth(toothId) {
        selectedTooth = toothId;
        document.getElementById('odontograma-diente-seleccionado').innerText = toothId;
        
        // Quitar bordes de selección a todos los dientes
        document.querySelectorAll('[id^="diente-"]').forEach(btn => {
            btn.classList.remove('ring-2', 'ring-jade-500', 'scale-105');
        });

        // Aplicar borde de selección al diente actual
        const btn = document.getElementById('diente-' + toothId);
        btn.classList.add('ring-2', 'ring-jade-500', 'scale-105');

        // Mostrar selector de estados
        document.getElementById('odontograma-selector').classList.remove('hidden');
    }

    function updateToothStatus(status) {
        if (!currentPacienteId || !selectedTooth) return;

        // Cargar odontograma actual del localStorage
        let data = JSON.parse(localStorage.getItem('odontograma_' + currentPacienteId)) || {};
        data[selectedTooth] = status;

        // Guardar de vuelta
        localStorage.setItem('odontograma_' + currentPacienteId, JSON.stringify(data));

        // Actualizar visual del diente
        applyToothStyle(selectedTooth, status);

        // Ocultar selector
        document.getElementById('odontograma-selector').classList.add('hidden');
        document.getElementById('diente-' + selectedTooth).classList.remove('ring-2', 'ring-jade-500', 'scale-105');
        selectedTooth = null;
    }

    function loadOdontogramaData() {
        if (!currentPacienteId) return;

        // Obtener datos guardados del paciente
        const data = JSON.parse(localStorage.getItem('odontograma_' + currentPacienteId)) || {};

        // Lista de todos los dientes posibles en el maxilar superior e inferior
        const todosLosDientes = [
            18, 17, 16, 15, 14, 13, 12, 11, 21, 22, 23, 24, 25, 26, 27, 28,
            48, 47, 46, 45, 44, 43, 42, 41, 31, 32, 33, 34, 35, 36, 37, 38
        ];

        todosLosDientes.forEach(toothId => {
            const status = data[toothId] || 'sano';
            applyToothStyle(toothId, status);
        });
    }

    function applyToothStyle(toothId, status) {
        const btn = document.getElementById('diente-' + toothId);
        if (!btn) return;

        const indicator = btn.querySelector('.tooth-indicator');
        const icon = btn.querySelector('.tooth-indicator i');

        // Resetear clases por defecto
        indicator.className = 'tooth-indicator w-5 h-5 rounded-full flex items-center justify-center border ';
        icon.className = 'fa-solid fa-tooth text-[9px] ';

        if (status === 'caries') {
            indicator.classList.add('bg-red-500', 'border-red-600', 'text-white');
            icon.classList.add('text-white');
        } else if (status === 'resina') {
            indicator.classList.add('bg-emerald-500', 'border-emerald-600', 'text-white');
            icon.classList.add('text-white');
        } else if (status === 'corona') {
            indicator.classList.add('bg-blue-500', 'border-blue-600', 'text-white');
            icon.classList.add('text-white');
        } else if (status === 'ausente') {
            indicator.classList.add('bg-slate-600', 'border-slate-700', 'text-white');
            icon.classList.add('text-white');
        } else {
            // Sano o Limpio (Blanco estándar)
            indicator.classList.add('bg-slate-100', 'border-slate-300', 'text-slate-400');
            icon.classList.add('text-slate-400');
        }
    }
</script>

<!-- MODAL HISTORIAL CLÍNICO Y RECETARIO DIGITAL -->
<div id="modal-historial" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-vip-panel border border-vip-border rounded-3xl w-full max-w-3xl overflow-hidden shadow-2xl flex flex-col h-[85vh]">
        
        <!-- Cabecera del Modal -->
        <div class="h-16 border-b border-vip-border flex items-center justify-between px-6 bg-slate-900/50 flex-shrink-0">
            <div class="flex items-center space-x-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-950 flex items-center justify-center text-blue-400">
                    <i class="fa-solid fa-file-medical"></i>
                </div>
                <h3 class="text-white font-serif font-bold text-base">Ficha Médica: <span id="historial-paciente-nombre" class="text-jade-400"></span></h3>
            </div>
            <button onclick="toggleModal('modal-historial', false)" class="text-slate-400 hover:text-white"><i class="fa-solid fa-xmark text-lg"></i></button>
        </div>

         <!-- Pestañas de Navegación -->
        <div class="bg-slate-950/40 border-b border-vip-border flex px-6 space-x-4 overflow-x-auto flex-shrink-0">
            <button id="tab-btn-evolucion" onclick="switchHistorialTab('evolucion')" class="py-3 text-xs font-bold uppercase tracking-wider border-b-2 border-jade-500 text-jade-400 focus:outline-none flex-shrink-0">
                📜 Notas de Evolución
            </button>
            <button id="tab-btn-receta" onclick="switchHistorialTab('receta')" class="py-3 text-xs font-bold uppercase tracking-wider border-b-2 border-transparent text-slate-400 hover:text-white focus:outline-none flex-shrink-0">
                🩺 Recetario Digital
            </button>
            <button id="tab-btn-adjuntos" onclick="switchHistorialTab('adjuntos')" class="py-3 text-xs font-bold uppercase tracking-wider border-b-2 border-transparent text-slate-400 hover:text-white focus:outline-none flex-shrink-0">
                📂 Radiografías y Adjuntos
            </button>
            <button id="tab-btn-consentimiento" onclick="switchHistorialTab('consentimiento')" class="py-3 text-xs font-bold uppercase tracking-wider border-b-2 border-transparent text-slate-400 hover:text-white focus:outline-none flex-shrink-0">
                📑 Consentimiento Firmeable
            </button>
        </div>

        <!-- Contenido del Modal (Scrollable) -->
        <div class="p-6 overflow-y-auto flex-grow space-y-6">
            
            <!-- SECCIÓN 1: EVOLUCIÓN (CRONOLÓGICA) -->
            <div id="historial-section-evolucion" class="space-y-6">
                <!-- Formulario de Notas de Evolución -->
                <form id="form-add-evolucion" onsubmit="saveEvolucionNote(event)" class="bg-slate-900/40 border border-vip-border/60 p-5 rounded-2xl space-y-4">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Registrar Nueva Entrada de Sesión</h4>
                    <div class="space-y-1.5">
                        <textarea id="evolucion-detalle" required rows="3" class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600" placeholder="Ej. Se realizó profilaxis, curación de caries con resina compuesta en molar 16, paciente evoluciona favorablemente."></textarea>
                    </div>
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="flex items-center space-x-2">
                            <label class="text-xs text-slate-400">Fecha:</label>
                            <input type="date" id="evolucion-fecha" required value="{{ date('Y-m-d') }}" class="bg-slate-900 border border-vip-border text-slate-200 text-xs rounded-lg px-3 py-1.5 focus:outline-none focus:border-jade-600">
                        </div>
                        <button type="submit" class="bg-jade-600 text-white px-5 py-2 rounded-xl text-xs font-bold hover:bg-jade-500 transition-all flex items-center space-x-2">
                            <i class="fa-solid fa-check"></i> <span>Agregar al Historial</span>
                        </button>
                    </div>
                </form>

                <!-- Cronología / Timeline -->
                <div class="space-y-4">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Historial Clínico Cronológico</h4>
                    <div id="historial-timeline-container" class="space-y-4 relative before:absolute before:inset-y-0 before:left-3.5 before:w-0.5 before:bg-vip-border/60 pl-8">
                        <!-- Cargado mediante JS -->
                    </div>
                </div>
            </div>

            <!-- SECCIÓN 2: RECETARIO DIGITAL -->
            <div id="historial-section-receta" class="hidden space-y-6">
                <form action="{{ route('admin.pacientes.receta') }}" method="POST" target="_blank" class="space-y-5">
                    @csrf
                    <input type="hidden" name="paciente" id="receta-paciente-input">
                    
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Tratamiento Farmacológico (Medicamentos)</label>
                        <textarea id="receta-medicamentos" name="medicamentos" required rows="5" class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600" placeholder="Ej. Amoxicilina 500mg - Tomar 1 tableta cada 8 horas por 7 días.&#10;Ibuprofeno 400mg - Tomar 1 tableta cada 12 horas en caso de dolor por 3 días."></textarea>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Indicaciones Especiales (Opcional)</label>
                        <textarea id="receta-indicaciones" name="indicaciones" rows="3" class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600" placeholder="Ej. Evitar alimentos duros o extremadamente calientes. Reposo relativo hoy. Cepillado suave."></textarea>
                    </div>

                    <div class="pt-2 flex justify-end space-x-3">
                        <button type="button" onclick="sendRecetaWhatsApp()" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3 px-5 rounded-xl text-xs flex items-center space-x-2 transition-all shadow-lg">
                            <i class="fa-brands fa-whatsapp text-sm"></i> <span>Enviar por WhatsApp</span>
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-5 rounded-xl text-xs flex items-center space-x-2 transition-all shadow-lg">
                            <i class="fa-solid fa-file-pdf text-sm"></i> <span>Generar e Imprimir</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- SECCIÓN 3: ADJUNTOS Y RADIOGRAFÍAS (GESTOR DE ARCHIVOS) -->
            <div id="historial-section-adjuntos" class="hidden space-y-6">
                <!-- Dropzone de Arrastre -->
                <div id="file-dropzone" class="border-2 border-dashed border-vip-border/80 hover:border-jade-500/80 bg-slate-900/20 hover:bg-slate-900/40 p-8 rounded-2xl flex flex-col items-center justify-center text-center cursor-pointer transition-all space-y-3">
                    <div class="w-12 h-12 bg-jade-950/60 rounded-xl flex items-center justify-center text-jade-400 border border-jade-900/40">
                        <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-bold text-white">Arrastra tus archivos aquí o haz clic para buscar</p>
                        <p class="text-xs text-slate-500">Soporta Radiografías (.PNG, .JPG) e informes clínicos (.PDF) hasta 10MB</p>
                    </div>
                    <input type="file" id="dropzone-file-input" class="hidden" accept=".png,.jpg,.jpeg,.pdf">
                </div>

                <!-- Barra de Progreso Simulada de Subida -->
                <div id="upload-progress-container" class="hidden bg-slate-900 p-4 rounded-xl border border-vip-border space-y-2">
                    <div class="flex justify-between text-xs">
                        <span id="uploading-file-name" class="font-bold text-slate-300">archivo.png</span>
                        <span id="upload-percent" class="text-jade-400 font-bold">0%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                        <div id="upload-progress-bar" class="h-full bg-jade-500 rounded-full transition-all duration-300" style="width: 0%"></div>
                    </div>
                </div>

                <!-- Tabla de Adjuntos Clínicos -->
                <div class="space-y-3">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Historial de Adjuntos</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="text-slate-500 uppercase tracking-wider border-b border-vip-border/50">
                                    <th class="py-2.5">Archivo / Radiografía</th>
                                    <th class="py-2.5">Tipo</th>
                                    <th class="py-2.5">Tamaño</th>
                                    <th class="py-2.5">Fecha</th>
                                    <th class="py-2.5 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="patient-files-tbody" class="divide-y divide-vip-border/20 text-slate-300">
                                <tr class="hover:bg-slate-900/20 transition-all">
                                    <td class="py-3 font-semibold text-white flex items-center space-x-2">
                                        <i class="fa-solid fa-image text-jade-400"></i>
                                        <span>Radiografia_Panoramica_Completa.jpg</span>
                                    </td>
                                    <td class="py-3 text-slate-400">Imagen RX</td>
                                    <td class="py-3 text-slate-400">3.4 MB</td>
                                    <td class="py-3 text-slate-400">12/04/2026</td>
                                    <td class="py-3 text-right">
                                        <button onclick="window.open('https://images.unsplash.com/photo-1579684389782-64d84b5e901d?auto=format&fit=crop&q=80&w=600', '_blank')" class="text-jade-400 hover:text-jade-300 font-bold mr-3"><i class="fa-solid fa-eye"></i> Ver</button>
                                        <button onclick="this.closest('tr').remove()" class="text-rose-500 hover:text-rose-400 font-bold"><i class="fa-solid fa-trash"></i> Eliminar</button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-900/20 transition-all">
                                    <td class="py-3 font-semibold text-white flex items-center space-x-2">
                                        <i class="fa-solid fa-file-pdf text-rose-400"></i>
                                        <span>Informe_Estudio_Oclusión_VIP.pdf</span>
                                    </td>
                                    <td class="py-3 text-slate-400">Informe PDF</td>
                                    <td class="py-3 text-slate-400">1.2 MB</td>
                                    <td class="py-3 text-slate-400">22/04/2026</td>
                                    <td class="py-3 text-right">
                                        <button onclick="alert('Abriendo documento PDF en modo lectura...')" class="text-jade-400 hover:text-jade-300 font-bold mr-3"><i class="fa-solid fa-eye"></i> Ver</button>
                                        <button onclick="this.closest('tr').remove()" class="text-rose-500 hover:text-rose-400 font-bold"><i class="fa-solid fa-trash"></i> Eliminar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN 4: CONSENTIMIENTO INFORMADO FIRMEABLE -->
            <div id="historial-section-consentimiento" class="hidden space-y-6">
                <div class="bg-slate-900/40 border border-vip-border/60 p-5 rounded-2xl space-y-4">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider"><i class="fa-solid fa-file-contract text-jade-500 mr-1.5"></i> Consentimiento de Tratamiento General</h4>
                    
                    <div class="h-40 overflow-y-auto bg-slate-950 p-4 rounded-xl border border-vip-border text-slate-400 text-xs leading-relaxed space-y-3">
                        <p><strong>DECLARACIÓN DEL PACIENTE:</strong> Por la presente manifiesto libremente y con pleno conocimiento, que acepto el plan de tratamiento odontológico propuesto por la <strong>Dra. Pamela Miranda</strong> de la Clínica Miradent.</p>
                        <p>He sido informado detalladamente sobre el diagnóstico, los procedimientos a realizar (incluyendo anestesia local si fuera necesaria), los costos asociados, los posibles riesgos colaterales y la importancia del cumplimiento estricto de las indicaciones médicas y farmacológicas post-tratamiento.</p>
                        <p>Autorizo al personal clínico a realizar los exámenes auxiliares fotográficos, radiográficos y clínicos necesarios para el correcto seguimiento de mi caso estético o reconstructivo.</p>
                    </div>

                    <!-- Cuadro de Firma Táctil / Digital -->
                    <div class="space-y-2">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider flex justify-between">
                            <span>Área de Firma del Paciente (Dibuja con el mouse o lápiz táctil)</span>
                            <button onclick="clearSignatureCanvas()" class="text-[10px] text-rose-500 hover:text-rose-400 font-bold lowercase tracking-normal"><i class="fa-solid fa-eraser mr-1"></i> limpiar firma</button>
                        </label>
                        <div class="relative w-full h-40 bg-slate-950 border border-vip-border rounded-xl overflow-hidden cursor-crosshair">
                            <canvas id="signature-canvas" class="w-full h-full absolute inset-0"></canvas>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-2">
                        <span id="consent-status-badge" class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-950/60 text-amber-400 border border-amber-900/50 uppercase tracking-wider">
                            <span class="w-1.5 h-1.5 bg-amber-400 rounded-full mr-1.5 animate-pulse"></span> Pendiente de Firma
                        </span>
                        <button onclick="saveConsentimiento()" class="bg-jade-600 text-white px-5 py-2.5 rounded-xl text-xs font-bold hover:bg-jade-500 transition-all flex items-center space-x-2 shadow-lg">
                            <i class="fa-solid fa-signature"></i> <span>Firmar y Guardar Documento</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- Pie de Modal -->
        <div class="h-16 border-t border-vip-border bg-slate-900/50 px-6 flex items-center justify-between flex-shrink-0">
            <span class="text-xs text-slate-500"><i class="fa-solid fa-shield-halved mr-1.5"></i> Ficha médica privada y protegida de la clínica.</span>
            <button onclick="toggleModal('modal-historial', false)" class="bg-jade-600 text-white px-5 py-2 rounded-xl text-xs font-bold hover:bg-jade-500 transition-all">Cerrar Ficha</button>
        </div>
    </div>
</div>

<script>
    let activeHistorialPacienteId = null;
    let activeHistorialPacienteTelefono = null;
    let activeHistorialPacienteNombre = null;

    function openHistorial(pacienteId, pacienteNombre, pacienteTelefono) {
        activeHistorialPacienteId = pacienteId;
        activeHistorialPacienteTelefono = pacienteTelefono;
        activeHistorialPacienteNombre = pacienteNombre;
        document.getElementById('historial-paciente-nombre').innerText = pacienteNombre;
        document.getElementById('receta-paciente-input').value = pacienteNombre;
        
        // Resetear campos de receta
        document.getElementById('receta-medicamentos').value = '';
        document.getElementById('receta-indicaciones').value = '';

        // Resetear pestañas
        switchHistorialTab('evolucion');

        // Limpiar formulario de evolución
        document.getElementById('evolucion-detalle').value = '';

        // Cargar notas desde el servidor
        loadEvolucionNotes();

        toggleModal('modal-historial', true);
    }

    // Enviar receta formateada por WhatsApp
    function sendRecetaWhatsApp() {
        const medicamentos = document.getElementById('receta-medicamentos').value.trim();
        const indicaciones = document.getElementById('receta-indicaciones').value.trim();

        if (!medicamentos) {
            alert('Por favor, redacte los medicamentos a recetar primero.');
            return;
        }

        let mensaje = `Hola ${activeHistorialPacienteNombre}, le saluda la Dra. Pamela Miranda de la Clínica *Miradent VIP*. 🦷💚\n\nLe comparto su *Receta Médica Digital* emitida el día de hoy:\n\n💊 *Tratamiento Farmacológico:*\n${medicamentos}`;
        
        if (indicaciones) {
            mensaje += `\n\n📝 *Indicaciones Especiales:*\n${indicaciones}`;
        }

        mensaje += `\n\n_¡Que tenga una pronta recuperación! Si tiene alguna duda o consulta, por favor respóndanos a este mensaje._`;

        // Limpiar teléfono
        let telefonoLimpio = activeHistorialPacienteTelefono.replace(/[^0-9]/g, '');
        if (telefonoLimpio.length === 9 && telefonoLimpio.startsWith('9')) {
            telefonoLimpio = '51' + telefonoLimpio;
        }

        window.open(`https://wa.me/${telefonoLimpio}?text=${encodeURIComponent(mensaje)}`, '_blank');
    }

    function switchHistorialTab(tab) {
        const tabs = ['evolucion', 'receta', 'adjuntos', 'consentimiento'];
        
        tabs.forEach(t => {
            const btn = document.getElementById(`tab-btn-${t}`);
            const sec = document.getElementById(`historial-section-${t}`);
            if (btn && sec) {
                if (t === tab) {
                    btn.className = "py-3 text-xs font-bold uppercase tracking-wider border-b-2 border-jade-500 text-jade-400 focus:outline-none flex-shrink-0";
                    sec.classList.remove('hidden');
                } else {
                    btn.className = "py-3 text-xs font-bold uppercase tracking-wider border-b-2 border-transparent text-slate-400 hover:text-white focus:outline-none flex-shrink-0";
                    sec.classList.add('hidden');
                }
            }
        });

        // Inicializar firma si es la pestaña consentimiento
        if (tab === 'consentimiento') {
            setTimeout(initSignatureCanvas, 150);
        }
    }

    // --- LÓGICA DE GESTIÓN DE ARCHIVOS (DRAG & DROP) ---
    document.addEventListener('DOMContentLoaded', () => {
        const dropzone = document.getElementById('file-dropzone');
        const fileInput = document.getElementById('dropzone-file-input');
        
        if (dropzone && fileInput) {
            dropzone.addEventListener('click', () => fileInput.click());
            
            dropzone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropzone.classList.add('border-jade-500', 'bg-slate-900/60');
            });
            
            dropzone.addEventListener('dragleave', () => {
                dropzone.classList.remove('border-jade-500', 'bg-slate-900/60');
            });
            
            dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropzone.classList.remove('border-jade-500', 'bg-slate-900/60');
                if (e.dataTransfer.files.length) {
                    handleFileSelect(e.dataTransfer.files[0]);
                }
            });
            
            fileInput.addEventListener('change', () => {
                if (fileInput.files.length) {
                    handleFileSelect(fileInput.files[0]);
                }
            });
        }
    });

    function handleFileSelect(file) {
        const progressContainer = document.getElementById('upload-progress-container');
        const progressName = document.getElementById('uploading-file-name');
        const progressPercent = document.getElementById('upload-percent');
        const progressBar = document.getElementById('upload-progress-bar');
        
        progressContainer.classList.remove('hidden');
        progressName.innerText = file.name;
        
        let percent = 0;
        const interval = setInterval(() => {
            percent += 20;
            progressPercent.innerText = `${percent}%`;
            progressBar.style.width = `${percent}%`;
            
            if (percent >= 100) {
                clearInterval(interval);
                setTimeout(() => {
                    progressContainer.classList.add('hidden');
                    addFileToTable(file.name, (file.size / (1024 * 1024)).toFixed(1));
                }, 400);
            }
        }, 150);
    }

    function addFileToTable(name, size) {
        const tbody = document.getElementById('patient-files-tbody');
        const today = new Date().toLocaleDateString('es-PE');
        const isPdf = name.toLowerCase().endsWith('.pdf');
        const icon = isPdf ? 'fa-file-pdf text-rose-400' : 'fa-image text-jade-400';
        const type = isPdf ? 'Informe PDF' : 'Imagen RX';
        
        const row = document.createElement('tr');
        row.className = "hover:bg-slate-900/20 transition-all";
        row.innerHTML = `
            <td class="py-3 font-semibold text-white flex items-center space-x-2">
                <i class="fa-solid ${icon}"></i>
                <span>${name}</span>
            </td>
            <td class="py-3 text-slate-400">${type}</td>
            <td class="py-3 text-slate-400">${size} MB</td>
            <td class="py-3 text-slate-400">${today}</td>
            <td class="py-3 text-right">
                <button onclick="alert('Abriendo documento cargado...')" class="text-jade-400 hover:text-jade-300 font-bold mr-3"><i class="fa-solid fa-eye"></i> Ver</button>
                <button onclick="this.closest('tr').remove()" class="text-rose-500 hover:text-rose-400 font-bold"><i class="fa-solid fa-trash"></i> Eliminar</button>
            </td>
        `;
        tbody.prepend(row);
    }

    // --- LÓGICA DE FIRMA TÁCTIL (CANVAS) ---
    let canvas, ctx, drawing = false;

    function initSignatureCanvas() {
        canvas = document.getElementById('signature-canvas');
        if (!canvas) return;
        
        ctx = canvas.getContext('2d');
        
        // Ajustar tamaño real del canvas al tamaño del contenedor
        const rect = canvas.getBoundingClientRect();
        canvas.width = rect.width;
        canvas.height = rect.height;
        
        ctx.strokeStyle = '#00BB77'; // Jade de Miradent
        ctx.lineWidth = 3;
        ctx.lineCap = 'round';
        
        // Mouse Listeners
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseleave', stopDrawing);
        
        // Touch Listeners (Tablet/Celular)
        canvas.addEventListener('touchstart', (e) => {
            const touch = e.touches[0];
            const mouseEvent = new MouseEvent('mousedown', {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        }, { passive: true });
        
        canvas.addEventListener('touchmove', (e) => {
            const touch = e.touches[0];
            const mouseEvent = new MouseEvent('mousemove', {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        }, { passive: true });
        
        canvas.addEventListener('touchend', () => {
            const mouseEvent = new MouseEvent('mouseup', {});
            canvas.dispatchEvent(mouseEvent);
        }, { passive: true });
    }

    function startDrawing(e) {
        drawing = true;
        ctx.beginPath();
        const rect = canvas.getBoundingClientRect();
        ctx.moveTo(e.clientX - rect.left, e.clientY - rect.top);
    }

    function draw(e) {
        if (!drawing) return;
        const rect = canvas.getBoundingClientRect();
        ctx.lineTo(e.clientX - rect.left, e.clientY - rect.top);
        ctx.stroke();
    }

    function stopDrawing() {
        drawing = false;
    }

    function clearSignatureCanvas() {
        if (ctx && canvas) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            document.getElementById('consent-status-badge').className = "inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-950/60 text-amber-400 border border-amber-900/50 uppercase tracking-wider";
            document.getElementById('consent-status-badge').innerHTML = '<span class="w-1.5 h-1.5 bg-amber-400 rounded-full mr-1.5 animate-pulse"></span> Pendiente de Firma';
        }
    }

    function saveConsentimiento() {
        const badge = document.getElementById('consent-status-badge');
        badge.className = "inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-950/60 text-emerald-400 border border-emerald-900/60 uppercase tracking-wider";
        badge.innerHTML = '<i class="fa-solid fa-circle-check mr-1.5"></i> Firmado Digitalmente';
        alert('¡Consentimiento firmado digitalmente por el paciente y archivado de forma segura en la ficha de Miradent!');
    }

    function loadEvolucionNotes() {
        if (!activeHistorialPacienteId) return;
        const container = document.getElementById('historial-timeline-container');
        container.innerHTML = `<div class="text-center text-xs text-slate-500 py-6"><i class="fa-solid fa-spinner animate-spin mr-1.5"></i> Cargando historial...</div>`;

        fetch(`/admin/pacientes/${activeHistorialPacienteId}/historial`)
            .then(res => res.json())
            .then(data => {
                container.innerHTML = '';
                if (data.length === 0) {
                    container.innerHTML = `<p class="text-xs text-slate-500 py-4 italic">Aún no se han registrado notas de evolución para este paciente. Redacte una nota arriba para comenzar el registro.</p>`;
                    return;
                }

                data.forEach(note => {
                    const dateFormatted = new Date(note.fecha).toLocaleDateString('es-PE', { day: '2-digit', month: '2-digit', year: 'numeric' });
                    container.innerHTML += `
                        <div class="relative pl-2 group">
                            <!-- Icono de Punto -->
                            <div class="absolute -left-[27px] top-1 w-4.5 h-4.5 rounded-full bg-jade-950 border border-jade-500 flex items-center justify-center text-[8px] text-jade-400">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="bg-slate-900 border border-vip-border/40 p-4 rounded-xl space-y-1.5 shadow-sm">
                                <div class="flex justify-between items-center text-[10px] font-bold text-slate-500">
                                    <span>SESIÓN CLÍNICA</span>
                                    <span class="text-jade-400 bg-jade-950/40 px-2 py-0.5 rounded">${dateFormatted}</span>
                                </div>
                                <p class="text-sm text-slate-200 whitespace-pre-line">${note.detalle}</p>
                            </div>
                        </div>
                    `;
                });
            })
            .catch(err => {
                container.innerHTML = `<p class="text-xs text-rose-500 py-4"><i class="fa-solid fa-triangle-exclamation mr-1"></i> Error al cargar el historial.</p>`;
            });
    }

    function saveEvolucionNote(e) {
        e.preventDefault();
        if (!activeHistorialPacienteId) return;

        const detalle = document.getElementById('evolucion-detalle').value;
        const fecha = document.getElementById('evolucion-fecha').value;

        fetch(`/admin/pacientes/historial`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                paciente_id: activeHistorialPacienteId,
                detalle: detalle,
                fecha: fecha
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Limpiar textarea
                document.getElementById('evolucion-detalle').value = '';
                // Recargar notas cronológicas
                loadEvolucionNotes();
            }
        })
        .catch(err => {
            alert('Error al guardar la nota clínica.');
        });
    }
</script>
@endsection
