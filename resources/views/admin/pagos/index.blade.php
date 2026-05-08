@extends('layouts.admin')

@section('title', 'Pagos')
@section('page_title', 'Registro de Pagos')

@section('content')
<div class="bg-vip-panel border border-[#cdfae9] rounded-3xl p-6 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-[#cdfae9]/50 pb-4">
        <div>
            <h4 class="text-base font-bold text-[#002f1e] font-serif">Historial de Pagos Recibidos</h4>
            <p class="text-slate-500 text-xs mt-1">Lleva un control financiero preciso de las transacciones de tus pacientes.</p>
        </div>
        @if($pacientes->isEmpty())
            <span class="text-xs text-amber-600 bg-amber-50 border border-amber-200 px-4 py-2.5 rounded-xl font-medium">
                <i class="fa-solid fa-triangle-exclamation mr-1.5"></i> Primero registra un paciente
            </span>
        @else
            <button onclick="toggleModal('modal-create', true)" class="bg-jade-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-jade-500 transition-all flex items-center justify-center space-x-2">
                <i class="fa-solid fa-file-invoice-dollar"></i> <span>Registrar Pago</span>
            </button>
        @endif
    </div>

    @if($pagos->isEmpty())
        <div class="text-center py-16 text-slate-500 space-y-4">
            <i class="fa-solid fa-receipt text-5xl text-slate-300"></i>
            <p class="text-sm">No se han registrado transacciones financieras todavía.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-400">
                <thead class="text-xs uppercase font-semibold text-slate-500 bg-[#e6fcf4] border-b border-[#cdfae9]">
                    <tr>
                        <th class="px-4 py-3">Paciente</th>
                        <th class="px-4 py-3">Monto Cancelado</th>
                        <th class="px-4 py-3">Método de Pago</th>
                        <th class="px-4 py-3">Fecha de Registro</th>
                        <th class="px-4 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e6fcf4]/50">
                    @foreach($pagos as $pago)
                        <tr class="hover:bg-[#e6fcf4]/30 transition-all">
                            <td class="px-4 py-4 font-bold text-[#002f1e]">
                                {{ $pago->paciente->nombre }}
                            </td>
                            <td class="px-4 py-4 text-xs font-bold text-[#00BB77]">
                                S/. {{ number_format($pago->monto, 2) }}
                            </td>
                            <td class="px-4 py-4 text-xs capitalize text-slate-700 font-semibold">
                                <span class="inline-flex items-center space-x-1.5">
                                    @if($pago->metodo_pago == 'efectivo')
                                        <i class="fa-solid fa-money-bill text-[#00BB77]"></i>
                                    @else
                                        <i class="fa-solid fa-building-columns text-sky-600"></i>
                                    @endif
                                    <span>{{ $pago->metodo_pago }}</span>
                                </span>
                            </td>
                            <td class="px-4 py-4 text-xs text-slate-600">
                                {{ \Carbon\Carbon::parse($pago->created_at)->format('d/m/Y h:i A') }}
                            </td>
                            <td class="px-4 py-4 text-right space-x-2">
                                <button onclick="openEditModal({{ json_encode($pago) }})" class="p-1.5 bg-slate-50 text-slate-500 hover:text-jade-500 hover:bg-jade-50 rounded-lg transition-all border border-jade-100 shadow-sm" title="Editar registro de pago">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este registro de pago permanentemente?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 bg-slate-50 text-slate-500 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all border border-rose-100 shadow-sm" title="Eliminar registro de pago">
                                        <i class="fa-solid fa-trash-can"></i>
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

<!-- MODAL REGISTRAR PAGO -->
<div id="modal-create" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-vip-panel border border-vip-border rounded-3xl w-full max-w-lg overflow-hidden shadow-2xl">
        <div class="h-16 border-b border-vip-border flex items-center justify-between px-6 bg-slate-900/50">
            <h3 class="text-white font-serif font-bold text-base">Registrar Nuevo Pago</h3>
            <button onclick="toggleModal('modal-create', false)" class="text-slate-400 hover:text-white"><i class="fa-solid fa-xmark text-lg"></i></button>
        </div>
        <form action="{{ route('pagos.store') }}" method="POST" class="p-6 space-y-4">
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
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Monto Total (S/.)</label>
                    <input type="number" step="0.01" name="monto" required min="0" class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600" placeholder="Ej. 150.00">
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Método de Pago</label>
                    <select name="metodo_pago" required class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600">
                        <option value="efectivo">Efectivo</option>
                        <option value="transferencia">Transferencia</option>
                    </select>
                </div>
            </div>
            <div class="pt-2 flex justify-end space-x-3">
                <button type="button" onclick="toggleModal('modal-create', false)" class="bg-slate-900 border border-vip-border text-slate-400 px-4 py-2 rounded-xl text-sm hover:text-white transition-all">Cancelar</button>
                <button type="submit" class="bg-jade-600 text-white px-5 py-2 rounded-xl text-sm font-semibold hover:bg-jade-500 transition-all">Registrar Pago</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDITAR PAGO -->
<div id="modal-edit" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-vip-panel border border-vip-border rounded-3xl w-full max-w-lg overflow-hidden shadow-2xl">
        <div class="h-16 border-b border-vip-border flex items-center justify-between px-6 bg-slate-900/50">
            <h3 class="text-white font-serif font-bold text-base">Editar Registro de Pago</h3>
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
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Monto Total (S/.)</label>
                    <input type="number" step="0.01" id="edit-monto" name="monto" required min="0" class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600">
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Método de Pago</label>
                    <select id="edit-metodo" name="metodo_pago" required class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600">
                        <option value="efectivo">Efectivo</option>
                        <option value="transferencia">Transferencia</option>
                    </select>
                </div>
            </div>
            <div class="pt-2 flex justify-end space-x-3">
                <button type="button" onclick="toggleModal('modal-edit', false)" class="bg-slate-900 border border-vip-border text-slate-400 px-4 py-2 rounded-xl text-sm hover:text-white transition-all">Cancelar</button>
                <button type="submit" class="bg-jade-600 text-white px-5 py-2 rounded-xl text-sm font-semibold hover:bg-jade-500 transition-all">Actualizar Pago</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleModal(id, show) {
        const modal = document.getElementById(id);
        if (show) {
            modal.classList.remove('hidden');
        } else {
            modal.classList.add('hidden');
        }
    }

    function openEditModal(pago) {
        document.getElementById('edit-paciente').value = pago.paciente_id;
        document.getElementById('edit-monto').value = pago.monto;
        document.getElementById('edit-metodo').value = pago.metodo_pago;
        
        const form = document.getElementById('form-edit');
        form.action = `/admin/pagos/${pago.id}`;

        toggleModal('modal-edit', true);
    }
</script>
@endsection
