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
        <input type="text" id="pacientes-search" onkeyup="searchPacientes()" class="w-full bg-slate-900 border border-vip-border/60 text-slate-300 text-sm rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:border-jade-600 focus:ring-1 focus:ring-jade-600 transition-all" placeholder="Buscar por nombre...">
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
                        <th class="px-4 py-3">Alergias</th>
                        <th class="px-4 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-vip-border/20">
                    @foreach($pacientes as $paciente)
                        <tr class="hover:bg-slate-900/10 transition-all">
                            <td class="px-4 py-4 font-bold text-white max-w-[180px] truncate">
                                {{ $paciente->nombre }}
                            </td>
                            <td class="px-4 py-4 text-xs text-slate-300">
                                {{ $paciente->edad }} años
                            </td>
                            <td class="px-4 py-4 text-xs text-slate-300">
                                {{ $paciente->telefono }}
                            </td>
                            <td class="px-4 py-4 text-xs truncate max-w-[200px]">
                                {{ $paciente->direccion }}
                            </td>
                            <td class="px-4 py-4 text-xs max-w-[150px] truncate">
                                <span class="px-2 py-0.5 rounded {{ $paciente->alergias ? 'bg-red-950/30 text-red-400 border border-red-900/30' : 'bg-slate-900 text-slate-500' }}">
                                    {{ $paciente->alergias ?? 'Ninguna' }}
                                </span>
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
        <div class="bg-slate-950/40 border-b border-vip-border flex px-6 space-x-4 flex-shrink-0">
            <button id="tab-btn-evolucion" onclick="switchHistorialTab('evolucion')" class="py-3 text-xs font-bold uppercase tracking-wider border-b-2 border-jade-500 text-jade-400 focus:outline-none">
                📜 Notas de Evolución
            </button>
            <button id="tab-btn-receta" onclick="switchHistorialTab('receta')" class="py-3 text-xs font-bold uppercase tracking-wider border-b-2 border-transparent text-slate-400 hover:text-white focus:outline-none">
                🩺 Recetario Digital
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
        const btnEvolucion = document.getElementById('tab-btn-evolucion');
        const btnReceta = document.getElementById('tab-btn-receta');
        const secEvolucion = document.getElementById('historial-section-evolucion');
        const secReceta = document.getElementById('historial-section-receta');

        if (tab === 'evolucion') {
            btnEvolucion.className = "py-3 text-xs font-bold uppercase tracking-wider border-b-2 border-jade-500 text-jade-400 focus:outline-none";
            btnReceta.className = "py-3 text-xs font-bold uppercase tracking-wider border-b-2 border-transparent text-slate-400 hover:text-white focus:outline-none";
            secEvolucion.classList.remove('hidden');
            secReceta.classList.add('hidden');
        } else {
            btnReceta.className = "py-3 text-xs font-bold uppercase tracking-wider border-b-2 border-jade-500 text-jade-400 focus:outline-none";
            btnEvolucion.className = "py-3 text-xs font-bold uppercase tracking-wider border-b-2 border-transparent text-slate-400 hover:text-white focus:outline-none";
            secReceta.classList.remove('hidden');
            secEvolucion.classList.add('hidden');
        }
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
