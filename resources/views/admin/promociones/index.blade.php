@extends('layouts.admin')

@section('title', 'Gestionar Promociones')

@section('content')
<div class="space-y-8">
    <!-- Título y Encabezado -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-jade-100 pb-6">
        <div>
            <h1 class="text-3xl font-serif font-bold text-slate-900">Promociones Activas</h1>
            <p class="text-slate-500 text-sm mt-1">Gestiona las campañas especiales y ofertas que ven tus pacientes en la web pública.</p>
        </div>
        <div class="flex items-center space-x-2 text-xs font-semibold text-jade-600 bg-jade-50 border border-jade-200 px-3 py-1.5 rounded-full">
            <i class="fa-solid fa-gift"></i> Ofertas Activas: {{ $promociones->count() }}
        </div>
    </div>

    <!-- Grid: Formulario de Subida + Listado de Promos -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Columna Izquierda: Formulario de Agregar Nueva Promo -->
        <div class="lg:col-span-5 bg-white border border-jade-100 rounded-3xl p-6 shadow-xl shadow-jade-100/10 space-y-6">
            <div class="space-y-1">
                <h3 class="text-lg font-serif font-bold text-slate-900">Crear Nueva Promoción</h3>
                <p class="text-slate-400 text-xs">Publica descuentos por tiempo limitado para tus pacientes.</p>
            </div>

            @if ($errors->any())
                <div class="p-4 bg-rose-50 text-rose-700 text-xs rounded-xl border border-rose-100 space-y-1">
                    <p class="font-bold">Por favor corrige los siguientes errores:</p>
                    <ul class="list-disc pl-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.promociones.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="space-y-2">
                    <label for="titulo" class="text-xs font-bold text-slate-700 uppercase tracking-wider">Título de la Promoción</label>
                    <input type="text" name="titulo" id="titulo" required value="{{ old('titulo') }}" class="w-full px-4 py-2.5 rounded-xl border border-jade-100 focus:outline-none focus:border-jade-500 focus:ring-1 focus:ring-jade-500 text-sm" placeholder="Ej. Blanqueamiento Dental 2x1">
                </div>

                <div class="space-y-2">
                    <label for="descripcion" class="text-xs font-bold text-slate-700 uppercase tracking-wider">Descripción o Detalles</label>
                    <textarea name="descripcion" id="descripcion" rows="3" required class="w-full px-4 py-2.5 rounded-xl border border-jade-100 focus:outline-none focus:border-jade-500 focus:ring-1 focus:ring-jade-500 text-sm" placeholder="Ej. Ven este mes con un acompañante y..."></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="descuento" class="text-xs font-bold text-slate-700 uppercase tracking-wider">Descuento (Opcional)</label>
                        <input type="text" name="descuento" id="descuento" class="w-full px-4 py-2.5 rounded-xl border border-jade-100 focus:outline-none focus:border-jade-500 focus:ring-1 focus:ring-jade-500 text-sm" placeholder="Ej. 30% OFF">
                    </div>

                    <div class="space-y-2">
                        <label for="fecha_fin" class="text-xs font-bold text-slate-700 uppercase tracking-wider">Vence (Opcional)</label>
                        <input type="text" name="fecha_fin" id="fecha_fin" class="w-full px-4 py-2.5 rounded-xl border border-jade-100 focus:outline-none focus:border-jade-500 focus:ring-1 focus:ring-jade-500 text-sm" placeholder="Ej. Hasta fin de mes">
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="foto" class="text-xs font-bold text-slate-700 uppercase tracking-wider">Foto Promocional</label>
                    <input type="file" name="foto" id="foto" class="w-full text-xs text-slate-500 file:mr-2 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-50 file:text-slate-700 hover:file:bg-slate-100 cursor-pointer">
                </div>

                <button type="submit" class="w-full bg-jade-500 text-white font-semibold py-3 rounded-xl hover:bg-jade-600 transition-all text-sm shadow-md shadow-jade-500/10">
                    <i class="fa-solid fa-plus mr-2"></i>Publicar Promoción
                </button>
            </form>
        </div>

        <!-- Columna Derecha: Listado de Promos Actuales -->
        <div class="lg:col-span-7 bg-white border border-jade-100 rounded-3xl p-6 shadow-xl shadow-jade-100/10 space-y-6">
            <h3 class="text-lg font-serif font-bold text-slate-900">Promociones en Pantalla</h3>

            @if($promociones->isEmpty())
                <div class="text-center py-16 space-y-4">
                    <div class="w-14 h-14 bg-jade-50 rounded-full flex items-center justify-center text-jade-500 mx-auto border border-jade-100">
                        <i class="fa-solid fa-gift text-xl"></i>
                    </div>
                    <p class="text-slate-500 text-sm">No hay promociones creadas aún.</p>
                </div>
            @else
                <div class="space-y-6 max-h-[550px] overflow-y-auto pr-2">
                    @foreach($promociones as $promo)
                        <div class="flex flex-col sm:flex-row gap-4 p-4 border border-jade-50 rounded-2xl hover:bg-jade-50/20 transition-all justify-between items-start sm:items-center">
                            
                            <!-- Foto e Información -->
                            <div class="flex gap-4 items-center">
                                @if($promo->foto)
                                    <div class="w-16 h-16 rounded-xl overflow-hidden border border-jade-50 shadow-sm flex-shrink-0">
                                        <img src="{{ (str_starts_with($promo->foto, 'http')) ? $promo->foto : asset($promo->foto) }}" class="w-full h-full object-cover" alt="Promo">
                                    </div>
                                @endif
                                <div>
                                    <h4 class="font-bold text-slate-900 text-sm flex items-center gap-2">
                                        {{ $promo->titulo }}
                                        @if($promo->descuento)
                                            <span class="text-[9px] bg-jade-50 text-jade-600 px-2 py-0.5 rounded-full border border-jade-100 font-bold uppercase">{{ $promo->descuento }}</span>
                                        @endif
                                    </h4>
                                    <p class="text-slate-400 text-xs line-clamp-1 mt-0.5">{{ $promo->descripcion }}</p>
                                    @if($promo->fecha_fin)
                                        <p class="text-[10px] text-amber-600 mt-1"><i class="fa-solid fa-clock"></i> {{ $promo->fecha_fin }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Botón de Borrado -->
                            <form action="{{ route('admin.promociones.destroy', $promo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta promoción?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-9 h-9 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white flex items-center justify-center transition-colors">
                                    <i class="fa-solid fa-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
