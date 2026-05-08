@extends('layouts.app')

@section('title', 'Promociones Dentales')

@section('content')
<!-- Header de Página - Blanco y Verde Jade -->
<section class="bg-white py-20 border-b border-jade-50 relative overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-10">
        <img src="{{ asset('img/fondo.png') }}" onerror="this.style.display='none'" class="w-full h-full object-cover" alt="Fondo Clínica Miradent">
    </div>
    <div class="absolute right-0 bottom-0 w-96 h-96 bg-jade-100/30 rounded-full blur-3xl"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
        <span class="text-xs font-semibold uppercase tracking-widest text-jade-600 bg-jade-50 px-4 py-1.5 rounded-full border border-jade-100">Campañas Especiales</span>
        <h1 class="text-4xl sm:text-5xl font-serif font-bold text-slate-900">Nuestras Promociones</h1>
        <p class="text-slate-600 text-sm sm:text-base max-w-xl mx-auto">
            Aprovecha nuestros descuentos y paquetes exclusivos diseñados para cuidar de tu salud bucal y la de tu familia al mejor precio.
        </p>
    </div>
</section>

<!-- Sección de Promociones -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($promociones->isEmpty())
            <div class="text-center py-20 space-y-4 max-w-md mx-auto">
                <div class="w-16 h-16 bg-jade-50 rounded-full flex items-center justify-center text-jade-500 mx-auto border border-jade-100">
                    <i class="fa-solid fa-gift text-2xl"></i>
                </div>
                <h3 class="text-xl font-serif font-bold text-slate-900">Nuevas promociones pronto</h3>
                <p class="text-slate-500 text-sm">
                    Estamos diseñando nuevas ofertas espectaculares para ti. Regresa pronto para descubrirlas.
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($promociones as $promo)
                    <div class="bg-white rounded-3xl overflow-hidden border border-jade-50 shadow-xl shadow-jade-100/10 hover:shadow-2xl hover:shadow-jade-100/20 transition-all flex flex-col md:flex-row group">
                        
                        <!-- Imagen de la Promo -->
                        @if($promo->foto)
                            <div class="md:w-2/5 aspect-square md:aspect-auto overflow-hidden relative border-b md:border-b-0 md:border-r border-jade-50">
                                <img src="{{ (str_starts_with($promo->foto, 'http')) ? $promo->foto : asset($promo->foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $promo->titulo }}">
                                @if($promo->descuento)
                                    <span class="absolute top-4 left-4 bg-jade-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-md">
                                        {{ $promo->descuento }}
                                    </span>
                                @endif
                            </div>
                        @endif

                        <!-- Detalles de la Promo -->
                        <div class="p-8 flex flex-col justify-between flex-grow space-y-6">
                            <div class="space-y-3">
                                <h3 class="text-xl font-serif font-bold text-slate-900">{{ $promo->titulo }}</h3>
                                <p class="text-slate-500 text-sm leading-relaxed">
                                    {{ $promo->descripcion }}
                                </p>
                                @if($promo->fecha_fin)
                                    <div class="inline-flex items-center text-xs font-medium text-amber-600 bg-amber-50 px-2.5 py-1 rounded-md border border-amber-100 mt-2">
                                        <i class="fa-solid fa-clock mr-1.5"></i> {{ $promo->fecha_fin }}
                                    </div>
                                @endif
                            </div>

                            <div class="pt-4">
                                <a href="https://wa.me/51948097148?text=Hola%20Dra.%20Pamela%20Miranda,%20me%20gustaría%20reservar%20la%20promoción:%20{{ urlencode($promo->titulo) }}" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center bg-jade-500 text-white font-bold py-3 px-6 rounded-full hover:bg-jade-600 transition-all shadow-md shadow-jade-500/10 hover:-translate-y-0.5">
                                    <i class="fa-brands fa-whatsapp mr-2 text-lg"></i> Reservar Promoción
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>
@endsection
