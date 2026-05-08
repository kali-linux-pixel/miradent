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
                            <!-- Comparador Interactivo con Deslizador de Arrastre -->
                            <div class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden select-none border border-jade-100 group cursor-ew-resize comparison-slider-container" id="slider-{{ $caso->id }}">
                                <!-- Foto Después (Base) -->
                                <img src="{{ (str_starts_with($caso->foto_despues, 'http')) ? $caso->foto_despues : asset($caso->foto_despues) }}" class="absolute inset-0 w-full h-full object-cover pointer-events-none" alt="Después">
                                <span class="absolute top-3 right-3 bg-jade-500 text-white text-[10px] uppercase font-bold tracking-wider px-2.5 py-1 rounded-md shadow-md z-10 pointer-events-none">Después</span>

                                <!-- Foto Antes (Capa Superior Deslizable) -->
                                <div class="absolute inset-y-0 left-0 overflow-hidden slider-overlay" style="width: 50%">
                                    <img src="{{ (str_starts_with($caso->foto_antes, 'http')) ? $caso->foto_antes : asset($caso->foto_antes) }}" class="absolute inset-0 w-full h-full object-cover pointer-events-none max-w-none slider-before-img" alt="Antes">
                                    <span class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-sm text-white text-[10px] uppercase font-bold tracking-wider px-2.5 py-1 rounded-md z-10 pointer-events-none">Antes</span>
                                </div>

                                <!-- Barra Separadora y Botón de Arrastre -->
                                <div class="absolute inset-y-0 w-1 bg-white flex items-center justify-center z-20 shadow-2xl slider-handle" style="left: 50%">
                                    <div class="w-8 h-8 rounded-full bg-white text-jade-600 flex items-center justify-center shadow-lg border border-jade-100 text-xs pointer-events-none">
                                        <i class="fa-solid fa-arrows-left-right"></i>
                                    </div>
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

<!-- Lógica y estilos del Slider Comparador Interactivo de Antes y Después -->
<style>
    .comparison-slider-container {
        position: relative;
    }
    .slider-before-img {
        max-width: none !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sliders = document.querySelectorAll('.comparison-slider-container');
        
        sliders.forEach(slider => {
            const overlay = slider.querySelector('.slider-overlay');
            const handle = slider.querySelector('.slider-handle');
            const beforeImg = slider.querySelector('.slider-before-img');
            
            // Forzar ancho de la imagen de antes para que coincida exactamente con el contenedor
            function adjustImageSize() {
                beforeImg.style.width = slider.offsetWidth + 'px';
                beforeImg.style.height = slider.offsetHeight + 'px';
            }
            
            adjustImageSize();
            window.addEventListener('resize', adjustImageSize);
            
            function move(clientX) {
                const rect = slider.getBoundingClientRect();
                const x = clientX - rect.left;
                let position = (x / rect.width) * 100;
                
                if (position < 0) position = 0;
                if (position > 100) position = 100;
                
                overlay.style.width = position + '%';
                handle.style.left = position + '%';
            }
            
            // Mouse Events
            let isDragging = false;
            
            slider.addEventListener('mousedown', (e) => {
                isDragging = true;
                move(e.clientX);
            });
            
            window.addEventListener('mousemove', (e) => {
                if (!isDragging) return;
                move(e.clientX);
            });
            
            window.addEventListener('mouseup', () => {
                isDragging = false;
            });
            
            // Touch Events (Móviles y Tablets)
            slider.addEventListener('touchstart', (e) => {
                isDragging = true;
                move(e.touches[0].clientX);
            }, { passive: true });
            
            window.addEventListener('touchmove', (e) => {
                if (!isDragging) return;
                move(e.touches[0].clientX);
            }, { passive: true });
            
            window.addEventListener('touchend', () => {
                isDragging = false;
            });
        });
    });
</script>
@endsection
