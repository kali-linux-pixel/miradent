@extends('layouts.app')

@section('title', 'Galería de Sonrisas')

@section('content')
<!-- Header de Página - Blanco y Verde Jade -->
<section class="bg-white py-20 border-b border-jade-50 relative overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-10">
        <img src="{{ asset('img/fondo.png') }}" onerror="this.style.display='none'" class="w-full h-full object-cover" alt="Fondo Clínica Miradent">
    </div>
    <div class="absolute right-0 bottom-0 w-96 h-96 bg-jade-100/30 rounded-full blur-3xl"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
        <span class="text-xs font-semibold uppercase tracking-widest text-jade-600 bg-jade-50 px-4 py-1.5 rounded-full border border-jade-100">Casos Clínicos Exitosos</span>
        <h1 class="text-4xl sm:text-5xl font-serif font-bold text-slate-900">Transformaciones de Sonrisas</h1>
        <p class="text-slate-600 text-sm sm:text-base max-w-xl mx-auto">
            Explora los resultados reales de nuestros pacientes. Cambios notables antes y después de pasar por el cuidado de la Dra. Pamela Miranda.
        </p>
    </div>
</section>

<!-- Sección de Casos Clínicos -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($casos->isEmpty())
            <div class="text-center py-20 space-y-4 max-w-md mx-auto">
                <div class="w-16 h-16 bg-jade-50 rounded-full flex items-center justify-center text-jade-500 mx-auto border border-jade-100">
                    <i class="fa-solid fa-images text-2xl"></i>
                </div>
                <h3 class="text-xl font-serif font-bold text-slate-900">Próximamente más casos</h3>
                <p class="text-slate-500 text-sm">
                    Estamos recopilando las fotos autorizadas de nuestros pacientes felices para mostrarte sus increíbles resultados aquí.
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                @foreach($casos as $caso)
                    <div class="bg-white rounded-3xl overflow-hidden border border-jade-50 shadow-xl shadow-jade-100/10 hover:shadow-2xl hover:shadow-jade-100/20 transition-all p-6 space-y-6">
                        
                        <!-- Contenedor Comparativa Antes/Después o Foto Única -->
                        @if($caso->foto_despues)
                            <div class="grid grid-cols-2 gap-4 relative">
                                <!-- Foto Antes -->
                                <div class="relative rounded-2xl overflow-hidden aspect-[4/3] bg-slate-50 border border-jade-50">
                                    <img src="{{ (str_starts_with($caso->foto_antes, 'http')) ? $caso->foto_antes : asset($caso->foto_antes) }}" class="w-full h-full object-cover" alt="Antes - {{ $caso->titulo }}">
                                    <span class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-sm text-white text-[10px] uppercase font-bold tracking-wider px-2.5 py-1 rounded-md">
                                        Antes
                                    </span>
                                </div>

                                <!-- Foto Después -->
                                <div class="relative rounded-2xl overflow-hidden aspect-[4/3] bg-slate-50 border border-jade-100">
                                    <img src="{{ (str_starts_with($caso->foto_despues, 'http')) ? $caso->foto_despues : asset($caso->foto_despues) }}" class="w-full h-full object-cover" alt="Después - {{ $caso->titulo }}">
                                    <span class="absolute top-3 left-3 bg-jade-500 text-white text-[10px] uppercase font-bold tracking-wider px-2.5 py-1 rounded-md shadow-md">
                                        Después
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="relative rounded-3xl overflow-hidden aspect-[16/10] bg-slate-50 border border-jade-50">
                                <img src="{{ (str_starts_with($caso->foto_antes, 'http')) ? $caso->foto_antes : asset($caso->foto_antes) }}" class="w-full h-full object-cover" alt="Resultado - {{ $caso->titulo }}">
                                <span class="absolute top-3 left-3 bg-jade-500 text-white text-[10px] uppercase font-bold tracking-wider px-2.5 py-1 rounded-md shadow-md">
                                    Resultado Clínico
                                </span>
                            </div>
                        @endif

                        <!-- Detalles del Caso -->
                        <div class="space-y-2">
                            <h3 class="text-xl font-serif font-bold text-slate-900">{{ $caso->titulo }}</h3>
                            @if($caso->descripcion)
                                <p class="text-slate-600 text-sm leading-relaxed">
                                    {{ $caso->descripcion }}
                                </p>
                            @endif
                        </div>

                        <!-- Botón para consultar -->
                        <div class="pt-2">
                            <a href="https://wa.me/51948097148?text=Hola%20Dra.%20Pamela%20Miranda,%20vi%20el%20caso%20de%20{{ urlencode($caso->titulo) }}%20y%20me%20gustaría%20saber%20si%20puedo%20hacerme%20un%20tratamiento%20similar" target="_blank" class="inline-flex items-center text-sm font-bold text-jade-500 hover:text-jade-600 group">
                                Consultar tratamiento por WhatsApp
                                <i class="fa-solid fa-arrow-right ml-1.5 text-xs group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>
@endsection
