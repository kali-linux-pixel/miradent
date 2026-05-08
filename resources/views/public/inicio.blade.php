@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<!-- Hero Section Premium - Blanco y Verde Jade -->
<section class="relative min-h-[85vh] flex items-center bg-white overflow-hidden border-b border-jade-50">
    <!-- Fondo decorativo con gradiente y la imagen manual 'fondo.png' -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-r from-white via-white/85 to-transparent z-10"></div>
        <img src="{{ asset('img/fondo.png') }}" onerror="this.style.display='none'" class="w-full h-full object-cover opacity-15" alt="Fondo Clínica Miradent">
    </div>

    <!-- Círculos decorativos sutiles de fondo -->
    <div class="absolute right-0 top-0 w-[500px] h-[500px] bg-jade-100/30 rounded-full blur-3xl -mr-48 -mt-48 pointer-events-none"></div>
    <div class="absolute left-1/3 bottom-0 w-[300px] h-[300px] bg-jade-100/20 rounded-full blur-2xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Textos del Hero -->
            <div class="lg:col-span-7 space-y-6 text-left">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-jade-50 text-jade-600 border border-jade-200 uppercase tracking-widest">
                    <i class="fa-solid fa-star mr-1.5 text-[10px]"></i> Estética & Salud Dental de Lujo
                </span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-serif font-bold text-slate-900 leading-tight">
                    Tu sonrisa merece el cuidado de un <span class="text-jade-500">Especialista</span>
                </h1>
                <p class="text-base sm:text-lg text-slate-600 max-w-xl leading-relaxed">
                    En <strong class="text-slate-900 font-bold">Miradent</strong> combinamos arte, ciencia y una atención VIP para diseñar la sonrisa saludable que siempre has deseado. Reserva tu cita en menos de un minuto.
                </p>
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 pt-4">
                    <a href="https://wa.me/51990353982?text=Hola,%20me%20gustaría%20agendar%20una%20cita%20en%20Miradent" target="_blank" class="flex items-center justify-center bg-jade-500 text-white px-8 py-4 rounded-full font-semibold hover:bg-jade-600 transition-all shadow-lg shadow-jade-500/20 hover:-translate-y-0.5">
                        <i class="fa-brands fa-whatsapp mr-2.5 text-xl"></i> Agendar Cita por WhatsApp
                    </a>
                    <a href="{{ route('servicios') }}" class="flex items-center justify-center bg-transparent text-slate-700 border border-slate-200 px-8 py-4 rounded-full font-semibold hover:bg-slate-50 transition-all">
                        Explorar Servicios <i class="fa-solid fa-arrow-right ml-2 text-sm text-jade-500"></i>
                    </a>
                </div>
                
                <!-- Datos de Confianza -->
                <div class="grid grid-cols-3 gap-6 pt-10 border-t border-slate-100 max-w-lg">
                    <div>
                        <p class="text-3xl font-serif font-bold text-slate-900">100%</p>
                        <p class="text-xs text-slate-500 mt-1">Pacientes Felices</p>
                    </div>
                    <div>
                        <p class="text-3xl font-serif font-bold text-slate-900">Garantía</p>
                        <p class="text-xs text-slate-500 mt-1">En Tratamientos</p>
                    </div>
                    <div>
                        <p class="text-3xl font-serif font-bold text-slate-900">VIP</p>
                        <p class="text-xs text-slate-500 mt-1">Atención Exclusiva</p>
                    </div>
                </div>
            </div>
            
            <!-- Imagen Hero Interactiva -->
            <div class="lg:col-span-5 relative hidden lg:block">
                <div class="w-full aspect-[4/5] bg-gradient-to-tr from-jade-50 to-white rounded-[2.5rem] p-3 shadow-2xl border border-jade-100 relative overflow-hidden">
                    <img src="{{ asset('img/C.D. Pamela Miranda.png') }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&q=80&w=600'; " class="w-full h-full object-cover rounded-[2.2rem] transition-transform duration-700 hover:scale-105" alt="Doctora de Miradent">
                    
                    <!-- Tarjeta flotante interactiva -->
                    <div class="absolute bottom-6 left-6 right-6 bg-white/95 backdrop-blur-md p-5 rounded-2xl border border-jade-100 shadow-xl z-20 flex items-center space-x-4">
                        <div class="w-12 h-12 bg-jade-50 rounded-xl flex items-center justify-center text-jade-500 border border-jade-100">
                            <i class="fa-solid fa-shield-halved text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-slate-900 font-bold text-sm">C.D. Pamela Miranda</h4>
                            <p class="text-slate-500 text-xs mt-0.5">Odontología Estética Avanzada</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sección Presentación Bienvenida -->
<section id="sobre-nosotros" class="py-24 bg-white scroll-mt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Imagen Presentación -->
            <div class="relative">
                <div class="absolute -left-6 -top-6 w-32 h-32 bg-jade-50 rounded-3xl -z-10 border border-jade-100"></div>
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-jade-50/50 rounded-3xl -z-10 border border-jade-100/50"></div>
                <div class="rounded-3xl overflow-hidden shadow-2xl aspect-[4/3] bg-slate-50 border border-slate-100">
                    <img src="{{ asset('img/clinica.png') }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&q=80&w=800';" class="w-full h-full object-cover" alt="Instalaciones de Miradent">
                </div>
            </div>

            <!-- Textos de Bienvenida -->
            <div class="space-y-6">
                <span class="text-sm font-semibold text-jade-600 uppercase tracking-widest">Nuestra Filosofía</span>
                <h2 class="text-3xl sm:text-4xl font-serif font-bold text-slate-900">
                    Bienvenido a Miradent, tu clínica de confianza
                </h2>
                <p class="text-slate-600 leading-relaxed">
                    En nuestra clínica, entendemos que ir al dentista es una experiencia sumamente personal. Por eso, hemos diseñado un entorno cálido, relajante y moderno donde te sentirás como en casa desde el primer momento.
                </p>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="mt-1 w-5 h-5 bg-jade-50 rounded-full flex items-center justify-center text-jade-600 border border-jade-100">
                            <i class="fa-solid fa-check text-xs"></i>
                        </div>
                        <p class="text-sm text-slate-700 font-medium">Tecnología dental de última generación.</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="mt-1 w-5 h-5 bg-jade-50 rounded-full flex items-center justify-center text-jade-600 border border-jade-100">
                            <i class="fa-solid fa-check text-xs"></i>
                        </div>
                        <p class="text-sm text-slate-700 font-medium">Tratamientos personalizados y sin dolor.</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="mt-1 w-5 h-5 bg-jade-50 rounded-full flex items-center justify-center text-jade-600 border border-jade-100">
                            <i class="fa-solid fa-check text-xs"></i>
                        </div>
                        <p class="text-sm text-slate-700 font-medium">Facilidades de pago y transferencia directa.</p>
                    </div>
                </div>
                <div class="pt-2">
                    <a href="{{ route('contacto') }}" class="inline-flex items-center text-jade-600 font-bold hover:text-jade-700 group">
                        Más información sobre nosotros 
                        <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sección Tres Servicios Destacados -->
<section class="py-24 bg-white border-t border-b border-jade-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-16">
        <div class="max-w-2xl mx-auto space-y-4">
            <span class="text-sm font-semibold text-jade-600 uppercase tracking-widest">Nuestros Servicios</span>
            <h2 class="text-3xl sm:text-4xl font-serif font-bold text-slate-900">Tratamientos Especializados</h2>
            <p class="text-slate-500">Ofrecemos soluciones dentales integrales adaptadas a las necesidades específicas de tu sonrisa.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Servicio 1: Limpieza Dental -->
            <div class="bg-white rounded-2xl p-8 border border-jade-50 shadow-xl shadow-jade-100/10 hover:shadow-2xl hover:shadow-jade-100/20 hover:-translate-y-1 transition-all group text-left space-y-5">
                <div class="w-14 h-14 bg-jade-50 rounded-2xl flex items-center justify-center text-jade-500 group-hover:bg-jade-500 group-hover:text-white transition-all border border-jade-100">
                    <i class="fa-solid fa-hand-sparkles text-2xl"></i>
                </div>
                <h3 class="text-xl font-serif font-semibold text-slate-900">Limpieza Profesional</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Eliminación profunda de sarro y placa bacteriana para prevenir caries y enfermedades en las encías, garantizando aliento fresco y dientes brillantes.
                </p>
                <div class="pt-2">
                    <a href="{{ route('servicios') }}" class="text-sm font-semibold text-jade-500 hover:text-jade-600 inline-flex items-center group/link">
                        Saber más <i class="fa-solid fa-arrow-right ml-1.5 text-xs group-hover/link:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Servicio 2: Ortodoncia -->
            <div class="bg-white rounded-2xl p-8 border border-jade-50 shadow-xl shadow-jade-100/10 hover:shadow-2xl hover:shadow-jade-100/20 hover:-translate-y-1 transition-all group text-left space-y-5">
                <div class="w-14 h-14 bg-jade-50 rounded-2xl flex items-center justify-center text-jade-500 group-hover:bg-jade-500 group-hover:text-white transition-all border border-jade-100">
                    <i class="fa-solid fa-teeth text-2xl"></i>
                </div>
                <h3 class="text-xl font-serif font-semibold text-slate-900">Ortodoncia Avanzada</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Alineación de dientes mediante brackets tradicionales o sistemas estéticos invisibles para mejorar tanto la masticación como la belleza de tu rostro.
                </p>
                <div class="pt-2">
                    <a href="{{ route('servicios') }}" class="text-sm font-semibold text-jade-500 hover:text-jade-600 inline-flex items-center group/link">
                        Saber más <i class="fa-solid fa-arrow-right ml-1.5 text-xs group-hover/link:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Servicio 3: Implantes Dentales -->
            <div class="bg-white rounded-2xl p-8 border border-jade-50 shadow-xl shadow-jade-100/10 hover:shadow-2xl hover:shadow-jade-100/20 hover:-translate-y-1 transition-all group text-left space-y-5">
                <div class="w-14 h-14 bg-jade-50 rounded-2xl flex items-center justify-center text-jade-500 group-hover:bg-jade-500 group-hover:text-white transition-all border border-jade-100">
                    <i class="fa-solid fa-teeth-open text-2xl"></i>
                </div>
                <h3 class="text-xl font-serif font-semibold text-slate-900">Implantes Dentales</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Recupera de manera definitiva las piezas dentales perdidas con implantes de titanio de máxima biocompatibilidad, recuperando tu seguridad al sonreír.
                </p>
                <div class="pt-2">
                    <a href="{{ route('servicios') }}" class="text-sm font-semibold text-jade-500 hover:text-jade-600 inline-flex items-center group/link">
                        Saber más <i class="fa-solid fa-arrow-right ml-1.5 text-xs group-hover/link:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action (Reservas) -->
<section class="py-20 bg-jade-50 border-t border-b border-jade-100 relative overflow-hidden text-center">
    <div class="absolute inset-0 opacity-5 bg-cover bg-center" style="background-image: url('{{ asset('img/fondo.png') }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-jade-50/90 to-jade-50/95"></div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-6">
        <h2 class="text-3xl sm:text-4xl font-serif font-bold text-slate-900">¿Listo para lucir una sonrisa perfecta?</h2>
        <p class="text-slate-600 text-base sm:text-lg max-w-xl mx-auto">
            Haz clic abajo y solicita una evaluación completa hoy mismo. Atendemos consultas personalizadas y emergencias odontológicas.
        </p>
        <div class="pt-4">
            <a href="https://wa.me/51990353982?text=Hola,%20me%20gustaría%20agendar%20una%20cita%20en%20Miradent" target="_blank" class="inline-flex items-center justify-center bg-jade-500 text-white px-8 py-4 rounded-full font-bold hover:bg-jade-600 transition-all shadow-xl hover:-translate-y-0.5 text-base">
                <i class="fa-brands fa-whatsapp mr-2.5 text-2xl"></i> Solicitar mi cita ahora
            </a>
        </div>
    </div>
</section>
@endsection
