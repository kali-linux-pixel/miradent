@extends('layouts.admin')

@section('title', 'Gastos')
@section('page_title', 'Registro de Gastos')

@section('content')
<div class="bg-vip-panel border border-vip-border rounded-3xl p-6 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-vip-border/50 pb-4">
        <div>
            <h4 class="text-base font-bold text-white font-serif">Listado de Gastos de la Clínica</h4>
            <p class="text-slate-500 text-xs mt-1">Registra y administra los egresos, materiales comprados y costos operativos.</p>
        </div>
        <button onclick="toggleModal('modal-create', true)" class="bg-jade-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-jade-500 transition-all flex items-center justify-center space-x-2">
            <i class="fa-solid fa-plus"></i> <span>Registrar Gasto</span>
        </button>
    </div>

    @if($gastos->isEmpty())
        <div class="text-center py-16 text-slate-500 space-y-4">
            <i class="fa-solid fa-file-invoice text-5xl text-slate-800"></i>
            <p class="text-sm">Aún no se han registrado gastos. Haz clic arriba para registrar el primero.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-400">
                <thead class="text-xs uppercase font-semibold text-slate-500 bg-slate-900/40 border-b border-vip-border/50">
                    <tr>
                        <th class="px-4 py-3">Descripción / Detalle</th>
                        <th class="px-4 py-3">Fecha de Pago</th>
                        <th class="px-4 py-3 text-right">Monto</th>
                        <th class="px-4 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-vip-border/20">
                    @foreach($gastos as $gasto)
                        <tr class="hover:bg-slate-900/10 transition-all">
                            <td class="px-4 py-4 font-bold text-white">
                                {{ $gasto->descripcion }}
                            </td>
                            <td class="px-4 py-4 text-xs text-slate-300">
                                {{ \Carbon\Carbon::parse($gasto->fecha)->format('d/m/Y') }}
                            </td>
                            <td class="px-4 py-4 text-right text-xs font-semibold text-amber-500">
                                S/. {{ number_format($gasto->monto, 2) }}
                            </td>
                            <td class="px-4 py-4 text-right">
                                <form action="{{ route('gastos.destroy', $gasto->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este registro de gasto?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center p-1.5 bg-slate-50 text-slate-500 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all border border-rose-100 shadow-sm" title="Eliminar gasto">
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

<!-- MODAL REGISTRAR GASTO -->
<div id="modal-create" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-vip-panel border border-vip-border rounded-3xl w-full max-w-lg overflow-hidden shadow-2xl">
        <div class="h-16 border-b border-vip-border flex items-center justify-between px-6 bg-slate-900/50">
            <h3 class="text-white font-serif font-bold text-base">Registrar Nuevo Gasto</h3>
            <button onclick="toggleModal('modal-create', false)" class="text-slate-400 hover:text-white"><i class="fa-solid fa-xmark text-lg"></i></button>
        </div>
        <form action="{{ route('gastos.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Descripción del Gasto</label>
                <input type="text" name="descripcion" required class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600" placeholder="Ej. Compra de guantes y resinas, Alquiler del consultorio...">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Monto (S/.)</label>
                    <input type="number" step="0.01" min="0" name="monto" required class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600" placeholder="Ej. 150.00">
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Fecha</label>
                    <input type="date" name="fecha" required value="{{ date('Y-m-d') }}" class="w-full bg-slate-900 border border-vip-border text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-jade-600">
                </div>
            </div>
            <div class="pt-2 flex justify-end space-x-3">
                <button type="button" onclick="toggleModal('modal-create', false)" class="bg-slate-900 border border-vip-border text-slate-400 px-4 py-2 rounded-xl text-sm hover:text-white transition-all">Cancelar</button>
                <button type="submit" class="bg-jade-600 text-white px-5 py-2 rounded-xl text-sm font-semibold hover:bg-jade-500 transition-all">Registrar Gasto</button>
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
</script>
@endsection
