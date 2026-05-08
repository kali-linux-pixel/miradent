@extends('layouts.admin')

@section('title', 'Gestionar Galería Antes/Después')

@section('content')
<div class="space-y-8">
    <!-- Título y Encabezado -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-jade-100 pb-6">
        <div>
            <h1 class="text-3xl font-serif font-bold text-slate-900">Galería de Antes y Después</h1>
            <p class="text-slate-500 text-sm mt-1">Gestiona los casos de éxito de transformaciones de sonrisas mostrados en la web pública.</p>
        </div>
        <div class="flex items-center space-x-2 text-xs font-semibold text-jade-600 bg-jade-50 border border-jade-200 px-3 py-1.5 rounded-full">
            <i class="fa-solid fa-camera"></i> Casos Activos: {{ $casos->count() }}
        </div>
    </div>

    <!-- Grid: Formulario de Subida + Listado de Casos -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Columna Izquierda: Formulario de Agregar Nuevo Caso -->
        <div class="lg:col-span-5 bg-white border border-jade-100 rounded-3xl p-6 shadow-xl shadow-jade-100/10 space-y-6">
            <div class="space-y-1">
                <h3 class="text-lg font-serif font-bold text-slate-900">Agregar Nuevo Caso</h3>
                <p class="text-slate-400 text-xs">Sube fotos reales de tus pacientes para inspirar confianza.</p>
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

            <form action="{{ route('admin.galeria.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="space-y-2">
                    <label for="titulo" class="text-xs font-bold text-slate-700 uppercase tracking-wider">Título del Caso</label>
                    <input type="text" name="titulo" id="titulo" required value="{{ old('titulo') }}" class="w-full px-4 py-2.5 rounded-xl border border-jade-100 focus:outline-none focus:border-jade-500 focus:ring-1 focus:ring-jade-500 text-sm" placeholder="Ej. Diseño de Sonrisa Completo">
                </div>

                <div class="space-y-2">
                    <label for="descripcion" class="text-xs font-bold text-slate-700 uppercase tracking-wider">Descripción (Opcional)</label>
                    <textarea name="descripcion" id="descripcion" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-jade-100 focus:outline-none focus:border-jade-500 focus:ring-1 focus:ring-jade-500 text-sm" placeholder="Ej. Caso clínico de 10 carillas de porcelana..."></textarea>
                </div>

                <div class="space-y-2">
                    <label for="tipo_carga" class="text-xs font-bold text-slate-700 uppercase tracking-wider">Tipo de Publicación</label>
                    <select id="tipo_carga" onchange="toggleFormType()" class="w-full px-4 py-2.5 rounded-xl border border-jade-100 focus:outline-none focus:border-jade-500 text-sm">
                        <option value="caso">Caso Clínico (Antes y Después)</option>
                        <option value="foto">Foto Única (Solo una foto de resultado)</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label id="label_foto_antes" for="foto_antes" class="text-xs font-bold text-slate-700 uppercase tracking-wider">Foto de Antes</label>
                    <input type="file" name="foto_antes" id="foto_antes" required class="w-full text-xs text-slate-500 file:mr-2 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-50 file:text-slate-700 hover:file:bg-slate-100 cursor-pointer">
                </div>

                <div id="wrapper_foto_despues" class="space-y-2">
                    <label for="foto_despues" class="text-xs font-bold text-slate-700 uppercase tracking-wider">Foto de Después</label>
                    <input type="file" name="foto_despues" id="foto_despues" required class="w-full text-xs text-slate-500 file:mr-2 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-jade-50 file:text-jade-700 hover:file:bg-jade-100 cursor-pointer">
                </div>

                <button type="submit" class="w-full bg-jade-500 text-white font-semibold py-3 rounded-xl hover:bg-jade-600 transition-all text-sm shadow-md shadow-jade-500/10">
                    <i class="fa-solid fa-plus mr-2"></i>Publicar en Galería
                </button>
            </form>
        </div>

        <!-- Columna Derecha: Listado de Casos Actuales -->
        <div class="lg:col-span-7 bg-white border border-jade-100 rounded-3xl p-6 shadow-xl shadow-jade-100/10 space-y-6">
            <h3 class="text-lg font-serif font-bold text-slate-900">Casos en la Web</h3>

            @if($casos->isEmpty())
                <div class="text-center py-16 space-y-4">
                    <div class="w-14 h-14 bg-jade-50 rounded-full flex items-center justify-center text-jade-500 mx-auto border border-jade-100">
                        <i class="fa-solid fa-camera-retro text-xl"></i>
                    </div>
                    <p class="text-slate-500 text-sm">No hay casos clínicos agregados aún.</p>
                </div>
            @else
                <div class="space-y-6 max-h-[550px] overflow-y-auto pr-2">
                    @foreach($casos as $caso)
                        <div class="flex flex-col sm:flex-row gap-4 p-4 border border-jade-50 rounded-2xl hover:bg-jade-50/20 transition-all justify-between items-start sm:items-center">
                            
                            <!-- Información & Fotos -->
                            <div class="flex gap-4 items-center">
                                @if($caso->foto_despues)
                                    <div class="flex -space-x-4">
                                        <div class="w-16 h-16 rounded-xl overflow-hidden border-2 border-white shadow-md relative">
                                            <img src="{{ (str_starts_with($caso->foto_antes, 'http')) ? $caso->foto_antes : asset($caso->foto_antes) }}" class="w-full h-full object-cover" alt="Antes">
                                            <span class="absolute bottom-0 right-0 bg-slate-900 text-white text-[7px] px-1 rounded uppercase font-bold">Antes</span>
                                        </div>
                                        <div class="w-16 h-16 rounded-xl overflow-hidden border-2 border-white shadow-md relative">
                                            <img src="{{ (str_starts_with($caso->foto_despues, 'http')) ? $caso->foto_despues : asset($caso->foto_despues) }}" class="w-full h-full object-cover" alt="Después">
                                            <span class="absolute bottom-0 right-0 bg-jade-500 text-white text-[7px] px-1 rounded uppercase font-bold">Desp</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="w-16 h-16 rounded-xl overflow-hidden border border-slate-100 shadow-md">
                                        <img src="{{ (str_starts_with($caso->foto_antes, 'http')) ? $caso->foto_antes : asset($caso->foto_antes) }}" class="w-full h-full object-cover" alt="Resultado">
                                    </div>
                                @endif
                                <div>
                                    <h4 class="font-bold text-slate-900 text-sm">{{ $caso->titulo }}</h4>
                                    <p class="text-slate-400 text-xs line-clamp-1 mt-0.5">{{ $caso->descripcion ?? 'Sin descripción' }}</p>
                                </div>
                            </div>

                            <!-- Formulario de Eliminación -->
                            <form action="{{ route('admin.galeria.destroy', $caso->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este caso de la galería? Las fotos se borrarán del sistema.');">
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
<script>
    function toggleFormType() {
        const select = document.getElementById('tipo_carga');
        const wrapperAfter = document.getElementById('wrapper_foto_despues');
        const inputAfter = document.getElementById('foto_despues');
        const labelBefore = document.getElementById('label_foto_antes');

        if (select.value === 'foto') {
            // Ocultar campo de Después
            wrapperAfter.classList.add('hidden');
            inputAfter.removeAttribute('required');
            labelBefore.innerText = "Selecciona tu Foto";
        } else {
            // Mostrar campo de Después
            wrapperAfter.classList.remove('hidden');
            inputAfter.setAttribute('required', 'required');
            labelBefore.innerText = "Foto de Antes";
        }
    }
</script>
@endsection
