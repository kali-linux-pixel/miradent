@extends('layouts.app')

@section('title', 'Servicios')

@section('content')
<!-- Header de Página - Blanco y Verde Jade -->
<section class="bg-white py-24 border-b border-jade-50 relative overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-10">
        <img src="{{ asset('img/fondo.png') }}" onerror="this.style.display='none'" class="w-full h-full object-cover" alt="Fondo Clínica Miradent">
    </div>
    <div class="absolute right-0 bottom-0 w-96 h-96 bg-jade-100/30 rounded-full blur-3xl"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
        <span class="text-xs font-semibold uppercase tracking-widest text-jade-600 bg-jade-50 px-4 py-1.5 rounded-full border border-jade-100">C.D. Pamela Miranda</span>
        <h1 class="text-4xl sm:text-5xl font-serif font-bold tracking-tight text-slate-900">Nuestras Especialidades Odontológicas</h1>
        <p class="text-slate-600 text-sm sm:text-base max-w-2xl mx-auto">
            Ofrecemos tratamientos de vanguardia diseñados a medida, enfocados en restaurar tu salud bucal completa en sesiones personalizadas de 40 a 50 minutos.
        </p>

        <!-- Barra de Búsqueda Interactiva -->
        <div class="max-w-md mx-auto pt-6">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <input type="text" id="buscar-servicio" class="w-full pl-11 pr-4 py-3.5 rounded-2xl border border-jade-100 focus:outline-none focus:border-jade-500 focus:ring-1 focus:ring-jade-500 text-sm bg-white shadow-lg shadow-jade-100/10 placeholder-slate-400" placeholder="Buscar un tratamiento (ej. Ortodoncia, Limpieza, Resina)...">
            </div>
        </div>
    </div>
</section>

<!-- Catálogo de Servicios Completo -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        <div class="text-center max-w-xl mx-auto space-y-3">
            <span class="text-sm font-semibold text-jade-600 uppercase tracking-widest">Tratamientos de Lujo</span>
            <h2 class="text-3xl font-serif font-bold text-slate-900">Servicios Disponibles</h2>
            <p class="text-slate-500 text-sm">Reserva cualquiera de nuestros tratamientos directamente por WhatsApp de forma inmediata.</p>
        </div>

        <!-- Mensaje de no resultados -->
        <div id="no-results" class="hidden text-center py-16 space-y-4 max-w-md mx-auto">
            <div class="w-14 h-14 bg-jade-50 rounded-full flex items-center justify-center text-jade-500 mx-auto border border-jade-100">
                <i class="fa-solid fa-circle-info text-xl"></i>
            </div>
            <p class="text-slate-500 text-sm">No encontramos tratamientos que coincidan con tu búsqueda. ¡Prueba con otra palabra!</p>
        </div>

        <div id="servicios-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Tratamiento 1: Limpieza Dental Profesional -->
            <div class="servicio-card bg-white rounded-3xl overflow-hidden border border-jade-50 shadow-xl shadow-jade-100/10 hover:shadow-2xl hover:shadow-jade-100/20 hover:-translate-y-1 transition-all flex flex-col justify-between group h-full">
                <div>
                    <div class="aspect-video w-full bg-slate-50 overflow-hidden relative border-b border-jade-50">
                        <img src="{{ asset('img/Limpieza Dental Profesional.png') }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&q=80&w=600';" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Limpieza Dental Profesional">
                    </div>
                    <div class="p-8 space-y-4">
                        <h3 class="text-xl font-serif font-bold text-slate-900">Limpieza Dental Profesional</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">
                            Procedimiento clínico fundamental que remueve el sarro calcificado y la placa bacteriana acumulada. Incluye pulido coronario y fluorización para un esmalte fuerte y saludable.
                        </p>
                    </div>
                </div>
                <div class="p-8 pt-0">
                    <a href="https://wa.me/51948097148?text=Hola%20Dra.%20Pamela%20Miranda,%20me%20gustaría%20agendar%20una%20cita%20para%20una%20Limpieza%20Dental%20Profesional" target="_blank" class="w-full flex items-center justify-center bg-jade-500 text-white text-xs font-semibold py-3 px-6 rounded-full hover:bg-jade-600 transition-colors shadow-md shadow-jade-500/10">
                        <i class="fa-brands fa-whatsapp mr-2 text-base"></i> Reservar por WhatsApp
                    </a>
                </div>
            </div>

            <!-- Tratamiento 2: Restauraciones de Resina -->
            <div class="servicio-card bg-white rounded-3xl overflow-hidden border border-jade-50 shadow-xl shadow-jade-100/10 hover:shadow-2xl hover:shadow-jade-100/20 hover:-translate-y-1 transition-all flex flex-col justify-between group h-full">
                <div>
                    <div class="aspect-video w-full bg-slate-50 overflow-hidden relative border-b border-jade-50">
                        <img src="{{ asset('img/Restauraciones de Resina.png') }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1606811971618-4486d14f3f99?auto=format&fit=crop&q=80&w=600';" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Restauraciones de Resina">
                    </div>
                    <div class="p-8 space-y-4">
                        <h3 class="text-xl font-serif font-bold text-slate-900">Restauraciones de Resina</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">
                            Eliminación de caries y restauración estética de piezas dañadas utilizando resinas compuestas de alta resistencia y color idéntico al esmalte original de tus dientes.
                        </p>
                    </div>
                </div>
                <div class="p-8 pt-0">
                    <a href="https://wa.me/51948097148?text=Hola%20Dra.%20Pamela%20Miranda,%20me%20gustaría%20agendar%20una%20cita%20para%20Restauraciones%20de%20Resina" target="_blank" class="w-full flex items-center justify-center bg-jade-500 text-white text-xs font-semibold py-3 px-6 rounded-full hover:bg-jade-600 transition-colors shadow-md shadow-jade-500/10">
                        <i class="fa-brands fa-whatsapp mr-2 text-base"></i> Reservar por WhatsApp
                    </a>
                </div>
            </div>

            <!-- Tratamiento 3: Endodoncia -->
            <div class="servicio-card bg-white rounded-3xl overflow-hidden border border-jade-50 shadow-xl shadow-jade-100/10 hover:shadow-2xl hover:shadow-jade-100/20 hover:-translate-y-1 transition-all flex flex-col justify-between group h-full">
                <div>
                    <div class="aspect-video w-full bg-slate-50 overflow-hidden relative border-b border-jade-50">
                        <img src="{{ asset('img/Endodoncia.png') }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1512224013790-b55911194477?auto=format&fit=crop&q=80&w=600';" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Endodoncia de Precisión">
                    </div>
                    <div class="p-8 space-y-4">
                        <h3 class="text-xl font-serif font-bold text-slate-900">Endodoncia</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">
                            Tratamiento de conducto avanzado para salvar piezas dentales gravemente infectadas o con caries profundas, eliminando por completo el dolor y restaurando la salud interna del diente.
                        </p>
                    </div>
                </div>
                <div class="p-8 pt-0">
                    <a href="https://wa.me/51948097148?text=Hola%20Dra.%20Pamela%20Miranda,%20me%20gustaría%20agendar%20una%20cita%20para%20una%20Endodoncia" target="_blank" class="w-full flex items-center justify-center bg-jade-500 text-white text-xs font-semibold py-3 px-6 rounded-full hover:bg-jade-600 transition-colors shadow-md shadow-jade-500/10">
                        <i class="fa-brands fa-whatsapp mr-2 text-base"></i> Reservar por WhatsApp
                    </a>
                </div>
            </div>

            <!-- Tratamiento 4: Prótesis Fija y Coronas -->
            <div class="servicio-card bg-white rounded-3xl overflow-hidden border border-jade-50 shadow-xl shadow-jade-100/10 hover:shadow-2xl hover:shadow-jade-100/20 hover:-translate-y-1 transition-all flex flex-col justify-between group h-full">
                <div>
                    <div class="aspect-video w-full bg-slate-50 overflow-hidden relative border-b border-jade-50">
                        <img src="{{ asset('img/Prótesis Fija (Coronas).png') }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1579684389782-64d84b5e901d?auto=format&fit=crop&q=80&w=600';" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Prótesis Fija y Coronas">
                    </div>
                    <div class="p-8 space-y-4">
                        <h3 class="text-xl font-serif font-bold text-slate-900">Prótesis Fija (Coronas)</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">
                            Restauración completa de dientes severamente debilitados mediante coronas individuales estéticas de porcelana, circonio o metal-cerámica que imitan la forma y fuerza del diente original.
                        </p>
                    </div>
                </div>
                <div class="p-8 pt-0">
                    <a href="https://wa.me/51948097148?text=Hola%20Dra.%20Pamela%20Miranda,%20me%20gustaría%20agendar%20una%20cita%20para%20Prótesis%20Fija" target="_blank" class="w-full flex items-center justify-center bg-jade-500 text-white text-xs font-semibold py-3 px-6 rounded-full hover:bg-jade-600 transition-colors shadow-md shadow-jade-500/10">
                        <i class="fa-brands fa-whatsapp mr-2 text-base"></i> Reservar por WhatsApp
                    </a>
                </div>
            </div>

            <!-- Tratamiento 5: Prótesis Removibles -->
            <div class="servicio-card bg-white rounded-3xl overflow-hidden border border-jade-50 shadow-xl shadow-jade-100/10 hover:shadow-2xl hover:shadow-jade-100/20 hover:-translate-y-1 transition-all flex flex-col justify-between group h-full">
                <div>
                    <div class="aspect-video w-full bg-slate-50 overflow-hidden relative border-b border-jade-50">
                        <img src="{{ asset('img/Prótesis Removibles.png') }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1512224013790-b55911194477?auto=format&fit=crop&q=80&w=600';" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Prótesis Removibles">
                    </div>
                    <div class="p-8 space-y-4">
                        <h3 class="text-xl font-serif font-bold text-slate-900">Prótesis Removibles</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">
                            Diseño personalizado de prótesis dentales parciales o totales que el paciente puede retirar para su limpieza, ofreciendo una opción accesible y efectiva para recuperar la masticación y el habla.
                        </p>
                    </div>
                </div>
                <div class="p-8 pt-0">
                    <a href="https://wa.me/51948097148?text=Hola%20Dra.%20Pamela%20Miranda,%20me%20gustaría%20agendar%20una%20cita%20para%20Prótesis%20Removible" target="_blank" class="w-full flex items-center justify-center bg-jade-500 text-white text-xs font-semibold py-3 px-6 rounded-full hover:bg-jade-600 transition-colors shadow-md shadow-jade-500/10">
                        <i class="fa-brands fa-whatsapp mr-2 text-base"></i> Reservar por WhatsApp
                    </a>
                </div>
            </div>

            <!-- Tratamiento 6: Implantes Dentales -->
            <div class="servicio-card bg-white rounded-3xl overflow-hidden border border-jade-50 shadow-xl shadow-jade-100/10 hover:shadow-2xl hover:shadow-jade-100/20 hover:-translate-y-1 transition-all flex flex-col justify-between group h-full">
                <div>
                    <div class="aspect-video w-full bg-slate-50 overflow-hidden relative border-b border-jade-50">
                        <img src="{{ asset('img/Implantes dentales.png') }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1579684389782-64d84b5e901d?auto=format&fit=crop&q=80&w=600';" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Implantes Dentales">
                    </div>
                    <div class="p-8 space-y-4">
                        <h3 class="text-xl font-serif font-bold text-slate-900">Implantes Dentales</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">
                            Reemplazo permanente de raíces de dientes perdidos mediante pernos de titanio biocompatible integrados al hueso y coronas con aspecto 100% natural.
                        </p>
                    </div>
                </div>
                <div class="p-8 pt-0">
                    <a href="https://wa.me/51948097148?text=Hola%20Dra.%20Pamela%20Miranda,%20me%20gustaría%20agendar%20una%20cita%20para%20Implantes%20Dentales" target="_blank" class="w-full flex items-center justify-center bg-jade-500 text-white text-xs font-semibold py-3 px-6 rounded-full hover:bg-jade-600 transition-colors shadow-md shadow-jade-500/10">
                        <i class="fa-brands fa-whatsapp mr-2 text-base"></i> Reservar por WhatsApp
                    </a>
                </div>
            </div>

            <!-- Tratamiento 7: Flúor y Selladores Dentales -->
            <div class="servicio-card bg-white rounded-3xl overflow-hidden border border-jade-50 shadow-xl shadow-jade-100/10 hover:shadow-2xl hover:shadow-jade-100/20 hover:-translate-y-1 transition-all flex flex-col justify-between group h-full">
                <div>
                    <div class="aspect-video w-full bg-slate-50 overflow-hidden relative border-b border-jade-50">
                        <img src="{{ asset('img/Flúor y Selladores Dentales.png') }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1445527815219-ecbfec67492e?auto=format&fit=crop&q=80&w=600';" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Tratamiento con Flúor y Selladores">
                    </div>
                    <div class="p-8 space-y-4">
                        <h3 class="text-xl font-serif font-bold text-slate-900">Flúor y Selladores Dentales</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">
                            Aplicación de barniz de flúor de alta adherencia para remineralizar el esmalte y colocación de selladores en fosas y fisuras profundas de los molares para prevenir caries.
                        </p>
                    </div>
                </div>
                <div class="p-8 pt-0">
                    <a href="https://wa.me/51948097148?text=Hola%20Dra.%20Pamela%20Miranda,%20me%20gustaría%20agendar%20una%20cita%20para%20Tratamientos%20con%20Flúor" target="_blank" class="w-full flex items-center justify-center bg-jade-500 text-white text-xs font-semibold py-3 px-6 rounded-full hover:bg-jade-600 transition-colors shadow-md shadow-jade-500/10">
                        <i class="fa-brands fa-whatsapp mr-2 text-base"></i> Reservar por WhatsApp
                    </a>
                </div>
            </div>

            <!-- Tratamiento 8: Blanqueamiento Dental -->
            <div class="servicio-card bg-white rounded-3xl overflow-hidden border border-jade-50 shadow-xl shadow-jade-100/10 hover:shadow-2xl hover:shadow-jade-100/20 hover:-translate-y-1 transition-all flex flex-col justify-between group h-full">
                <div>
                    <div class="aspect-video w-full bg-slate-50 overflow-hidden relative border-b border-jade-50">
                        <img src="{{ asset('img/Blanqueamiento Dental.png') }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1598256989800-fe5f95da9787?auto=format&fit=crop&q=80&w=600';" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Blanqueamiento Dental">
                    </div>
                    <div class="p-8 space-y-4">
                        <h3 class="text-xl font-serif font-bold text-slate-900">Blanqueamiento Dental</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">
                            Procedimiento de estética dental seguro y de rápido efecto que aclara varios tonos el color de tus dientes mediante geles activados clínicamente, devolviendo el brillo a tu sonrisa.
                        </p>
                    </div>
                </div>
                <div class="p-8 pt-0">
                    <a href="https://wa.me/51948097148?text=Hola%20Dra.%20Pamela%20Miranda,%20me%20gustaría%20agendar%20una%20cita%20para%20un%20Blanqueamiento%20Dental" target="_blank" class="w-full flex items-center justify-center bg-jade-500 text-white text-xs font-semibold py-3 px-6 rounded-full hover:bg-jade-600 transition-colors shadow-md shadow-jade-500/10">
                        <i class="fa-brands fa-whatsapp mr-2 text-base"></i> Reservar por WhatsApp
                    </a>
                </div>
            </div>

            <!-- Tratamiento 9: Ortodoncia Avanzada -->
            <div class="servicio-card bg-white rounded-3xl overflow-hidden border border-jade-50 shadow-xl shadow-jade-100/10 hover:shadow-2xl hover:shadow-jade-100/20 hover:-translate-y-1 transition-all flex flex-col justify-between group h-full">
                <div>
                    <div class="aspect-video w-full bg-slate-50 overflow-hidden relative border-b border-jade-50">
                        <img src="{{ asset('img/Ortodoncia Avanzada.png') }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1598256989800-fe5f95da9787?auto=format&fit=crop&q=80&w=600';" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Ortodoncia Tradicional e Invisible">
                    </div>
                    <div class="p-8 space-y-4">
                        <h3 class="text-xl font-serif font-bold text-slate-900">Ortodoncia Avanzada</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">
                            Corrección de mordidas y desalineación dental mediante brackets tradicionales metálicos, cerámicos o modernos sistemas de alineadores transparentes invisibles.
                        </p>
                    </div>
                </div>
                <div class="p-8 pt-0">
                    <a href="https://wa.me/51948097148?text=Hola%20Dra.%20Pamela%20Miranda,%20me%20gustaría%20agendar%20una%20cita%20para%20un%20Tratamiento%20de%20Ortodoncia" target="_blank" class="w-full flex items-center justify-center bg-jade-500 text-white text-xs font-semibold py-3 px-6 rounded-full hover:bg-jade-600 transition-colors shadow-md shadow-jade-500/10">
                        <i class="fa-brands fa-whatsapp mr-2 text-base"></i> Reservar por WhatsApp
                    </a>
                </div>
            </div>

            <!-- Tratamiento 10: Carillas Estéticas -->
            <div class="servicio-card bg-white rounded-3xl overflow-hidden border border-jade-50 shadow-xl shadow-jade-100/10 hover:shadow-2xl hover:shadow-jade-100/20 hover:-translate-y-1 transition-all flex flex-col justify-between group h-full">
                <div>
                    <div class="aspect-video w-full bg-slate-50 overflow-hidden relative border-b border-jade-50">
                        <img src="{{ asset('img/Carillas Estéticas.png') }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1606811971618-4486d14f3f99?auto=format&fit=crop&q=80&w=600';" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Carillas Estéticas">
                    </div>
                    <div class="p-8 space-y-4">
                        <h3 class="text-xl font-serif font-bold text-slate-900">Carillas Estéticas</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">
                            Láminas ultrafinas de resina o porcelana adheridas al frente del diente. Corrige de forma permanente imperfecciones leves de espaciado, fracturas y decoloración.
                        </p>
                    </div>
                </div>
                <div class="p-8 pt-0">
                    <a href="https://wa.me/51948097148?text=Hola%20Dra.%20Pamela%20Miranda,%20me%20gustaría%20agendar%20una%20cita%20para%20un%20Diseño%20de%20Carillas" target="_blank" class="w-full flex items-center justify-center bg-jade-500 text-white text-xs font-semibold py-3 px-6 rounded-full hover:bg-jade-600 transition-colors shadow-md shadow-jade-500/10">
                        <i class="fa-brands fa-whatsapp mr-2 text-base"></i> Reservar por WhatsApp
                    </a>
                </div>
            </div>

            <!-- Tratamiento 11: Extracciones Dentales -->
            <div class="servicio-card bg-white rounded-3xl overflow-hidden border border-jade-50 shadow-xl shadow-jade-100/10 hover:shadow-2xl hover:shadow-jade-100/20 hover:-translate-y-1 transition-all flex flex-col justify-between group h-full">
                <div>
                    <div class="aspect-video w-full bg-slate-50 overflow-hidden relative border-b border-jade-50">
                        <img src="{{ asset('img/Extracciones Dentales.png') }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1579684389782-64d84b5e901d?auto=format&fit=crop&q=80&w=600';" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Extracciones Dentales">
                    </div>
                    <div class="p-8 space-y-4">
                        <h3 class="text-xl font-serif font-bold text-slate-900">Extracciones Dentales</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">
                            Procedimientos quirúrgicos seguros y libres de dolor para retirar raíces fracturadas, molares con destrucción total o terceras molares (muelas del juicio) en mal posición.
                        </p>
                    </div>
                </div>
                <div class="p-8 pt-0">
                    <a href="https://wa.me/51948097148?text=Hola%20Dra.%20Pamela%20Miranda,%20me%20gustaría%20agendar%20una%20cita%20para%20una%20Extracción%20Dental" target="_blank" class="w-full flex items-center justify-center bg-jade-500 text-white text-xs font-semibold py-3 px-6 rounded-full hover:bg-jade-600 transition-colors shadow-md shadow-jade-500/10">
                        <i class="fa-brands fa-whatsapp mr-2 text-base"></i> Reservar por WhatsApp
                    </a>
                </div>
            </div>

            <!-- Tratamiento 12: Tratamientos Integrales -->
            <div class="servicio-card bg-white rounded-3xl overflow-hidden border border-jade-50 shadow-xl shadow-jade-100/10 hover:shadow-2xl hover:shadow-jade-100/20 hover:-translate-y-1 transition-all flex flex-col justify-between group h-full">
                <div>
                    <div class="aspect-video w-full bg-slate-50 overflow-hidden relative border-b border-jade-50">
                        <img src="{{ asset('img/Tratamiento Integral VIP10.png') }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1512224013790-b55911194477?auto=format&fit=crop&q=80&w=600';" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Tratamientos Integrales">
                    </div>
                    <div class="p-8 space-y-4">
                        <h3 class="text-xl font-serif font-bold text-slate-900">Tratamiento Integral VIP</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">
                            Enfoque completo que busca restaurar tu salud bucal integral, ayudándote a comer, hablar cómodamente y contribuyendo de forma directa a tu salud física general.
                        </p>
                    </div>
                </div>
                <div class="p-8 pt-0">
                    <a href="https://wa.me/51948097148?text=Hola%20Dra.%20Pamela%20Miranda,%20me%20gustaría%20agendar%20una%20cita%20para%20un%20Tratamiento%20Integral" target="_blank" class="w-full flex items-center justify-center bg-jade-500 text-white text-xs font-semibold py-3 px-6 rounded-full hover:bg-jade-600 transition-colors shadow-md shadow-jade-500/10">
                        <i class="fa-brands fa-whatsapp mr-2 text-base"></i> Reservar por WhatsApp
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Script para Filtrado de Búsqueda Instantáneo -->
<script>
    document.getElementById('buscar-servicio').addEventListener('input', function (e) {
        const query = e.target.value.toLowerCase().trim();
        const cards = document.querySelectorAll('.servicio-card');
        let visibleCount = 0;

        cards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const desc = card.querySelector('p').textContent.toLowerCase();

            if (title.includes(query) || desc.includes(query)) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Mostrar u ocultar mensaje de "no resultados"
        const noResults = document.getElementById('no-results');
        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    });
</script>
@endsection
