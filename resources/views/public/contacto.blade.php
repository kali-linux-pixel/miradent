@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
<!-- Header de Página - Blanco y Verde Jade -->
<section class="bg-white py-20 border-b border-jade-50 relative overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-10">
        <img src="{{ asset('img/fondo.png') }}" onerror="this.style.display='none'" class="w-full h-full object-cover" alt="Fondo Clínica Miradent">
    </div>
    <div class="absolute left-0 bottom-0 w-96 h-96 bg-jade-100/30 rounded-full blur-3xl"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
        <span class="text-xs font-semibold uppercase tracking-widest text-jade-600 bg-jade-50 px-3 py-1 rounded-full border border-jade-100">Atención Personalizada</span>
        <h1 class="text-4xl sm:text-5xl font-serif font-bold text-slate-900">Ponte en Contacto</h1>
        <p class="text-slate-600 text-sm sm:text-base max-w-xl mx-auto">
            Estamos listos para atender tus dudas y brindarte la mejor experiencia de cuidado dental en Lima.
        </p>
    </div>
</section>

<!-- Contenido de Contacto -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            
            <!-- Columna Izquierda: Información de Contacto -->
            <div class="lg:col-span-5 space-y-8">
                <div class="space-y-3">
                    <span class="text-sm font-semibold text-jade-600 uppercase tracking-widest">Encuéntranos</span>
                    <h2 class="text-3xl font-serif font-bold text-slate-900">Ubicación y Horarios</h2>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Visítanos en nuestra clínica ubicada en una de las zonas más seguras e importantes de la ciudad. Contamos con estacionamiento exclusivo vigilado.
                    </p>
                </div>
                
                <!-- Tarjetas de Información -->
                <div class="space-y-6">
                    <!-- Dirección -->
                    <div class="flex items-start space-x-4 bg-white p-6 rounded-2xl border border-jade-50 shadow-xl shadow-jade-100/10">
                        <div class="w-12 h-12 bg-jade-50 rounded-xl flex items-center justify-center text-jade-500 border border-jade-100 flex-shrink-0">
                            <i class="fa-solid fa-location-dot text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-slate-900 font-bold text-base">Dirección de la Clínica</h4>
                            <p class="text-slate-500 text-sm mt-1">Av. Principal 123, Miraflores, Lima, Perú</p>
                        </div>
                    </div>

                    <!-- Teléfono / WhatsApp -->
                    <div class="flex items-start space-x-4 bg-white p-6 rounded-2xl border border-jade-50 shadow-xl shadow-jade-100/10">
                        <div class="w-12 h-12 bg-jade-50 rounded-xl flex items-center justify-center text-jade-500 border border-jade-100 flex-shrink-0">
                            <i class="fa-solid fa-phone text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-slate-900 font-bold text-base">Teléfono de Reservas</h4>
                            <p class="text-slate-500 text-sm mt-1">+51 948 097 148</p>
                            <p class="text-slate-400 text-xs mt-0.5">Llamadas y WhatsApp</p>
                        </div>
                    </div>

                    <!-- Horarios -->
                    <div class="flex items-start space-x-4 bg-white p-6 rounded-2xl border border-jade-50 shadow-xl shadow-jade-100/10">
                        <div class="w-12 h-12 bg-jade-50 rounded-xl flex items-center justify-center text-jade-500 border border-jade-100 flex-shrink-0">
                            <i class="fa-solid fa-clock text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-slate-900 font-bold text-base">Horario de Atención</h4>
                            <div class="text-slate-500 text-sm mt-1 space-y-0.5">
                                <p class="font-medium">Lunes a Viernes:</p>
                                <p class="pl-3">9:00 AM a 12:00 PM</p>
                                <p class="pl-3">4:00 PM a 7:00 PM</p>
                                <p class="text-jade-500 font-bold mt-1"><i class="fa-solid fa-star mr-1"></i> Emergencias por WhatsApp</p>
                            </div>
                        </div>
                    </div>

                    <!-- Métodos de Pago aceptados -->
                    <div class="flex items-start space-x-4 bg-white p-6 rounded-2xl border border-jade-50 shadow-xl shadow-jade-100/10">
                        <div class="w-12 h-12 bg-jade-50 rounded-xl flex items-center justify-center text-jade-500 border border-jade-100 flex-shrink-0">
                            <i class="fa-solid fa-credit-card text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-slate-900 font-bold text-base">Métodos de Pago</h4>
                            <p class="text-slate-500 text-sm mt-1">Efectivo o Transferencia directa:</p>
                            <div class="flex flex-wrap gap-1.5 mt-2">
                                <span class="text-[10px] font-bold bg-jade-50 text-jade-600 border border-jade-100 px-2.5 py-1 rounded-md uppercase">Yape</span>
                                <span class="text-[10px] font-bold bg-jade-50 text-jade-600 border border-jade-100 px-2.5 py-1 rounded-md uppercase">BCP</span>
                                <span class="text-[10px] font-bold bg-jade-50 text-jade-600 border border-jade-100 px-2.5 py-1 rounded-md uppercase">Interbank</span>
                                <span class="text-[10px] font-bold bg-jade-50 text-jade-600 border border-jade-100 px-2.5 py-1 rounded-md uppercase">Nación</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botón de WhatsApp Gigante de Contacto -->
                <div class="bg-jade-50/50 p-8 rounded-3xl border border-jade-100 space-y-4">
                    <div class="flex items-center space-x-3">
                        <i class="fa-brands fa-whatsapp text-3xl text-jade-500"></i>
                        <h4 class="font-serif font-bold text-lg text-slate-900">¿Tienes dudas rápidas?</h4>
                    </div>
                    <p class="text-slate-600 text-sm">
                        Escríbenos directamente por WhatsApp haciendo clic abajo. Te responderemos en un par de minutos de forma atenta y profesional.
                    </p>
                    <a href="https://wa.me/51948097148?text=Hola,%20me%20gustaría%20agendar%20una%20cita%20en%20Miradent" target="_blank" class="w-full flex items-center justify-center bg-jade-500 text-white font-bold py-3.5 px-6 rounded-2xl hover:bg-jade-600 transition-all shadow-lg shadow-jade-500/10">
                        Chat directo con la doctora
                    </a>
                </div>
            </div>

            <!-- Columna Derecha: Formulario y Mapa -->
            <div class="lg:col-span-7 space-y-8">
                <!-- Formulario -->
                <div class="bg-white p-8 sm:p-10 rounded-3xl border border-jade-50 shadow-xl shadow-jade-100/10 space-y-6">
                    <h3 class="text-2xl font-serif font-bold text-slate-900">Envíanos un Mensaje</h3>
                    <form action="#" method="POST" class="space-y-5" onsubmit="event.preventDefault(); alert('¡Gracias! Tu mensaje ha sido enviado correctamente de manera simulada.');">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="space-y-2">
                                <label for="name" class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Nombre Completo</label>
                                <input type="text" id="name" required class="w-full px-4 py-3 rounded-xl border border-jade-100 focus:outline-none focus:border-jade-500 focus:ring-1 focus:ring-jade-500 transition-all text-sm" placeholder="Ej. Carlos Mendoza">
                            </div>
                            <div class="space-y-2">
                                <label for="phone" class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Teléfono / WhatsApp</label>
                                <input type="tel" id="phone" required class="w-full px-4 py-3 rounded-xl border border-jade-100 focus:outline-none focus:border-jade-500 focus:ring-1 focus:ring-jade-500 transition-all text-sm" placeholder="Ej. 948097148">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="service" class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Servicio de Interés</label>
                            <select id="service" class="w-full px-4 py-3 rounded-xl border border-jade-100 focus:outline-none focus:border-jade-500 focus:ring-1 focus:ring-jade-500 transition-all text-sm bg-white">
                                <option>Limpieza Dental Profesional</option>
                                <option>Ortodoncia Avanzada</option>
                                <option>Implantes Dentales VIP</option>
                                <option>Diseño de Sonrisa</option>
                                <option>Otro Tratamiento</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label for="message" class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Mensaje o Consulta</label>
                            <textarea id="message" rows="4" required class="w-full px-4 py-3 rounded-xl border border-jade-100 focus:outline-none focus:border-jade-500 focus:ring-1 focus:ring-jade-500 transition-all text-sm" placeholder="Cuéntanos un poco sobre tu caso clínico o tus dudas..."></textarea>
                        </div>
                        <button type="submit" class="w-full bg-jade-500 text-white font-bold py-4 rounded-xl hover:bg-jade-600 transition-all shadow-md shadow-jade-500/10">
                            Enviar Consulta <i class="fa-solid fa-paper-plane ml-2"></i>
                        </button>
                    </form>
                </div>

                <!-- Mapa elegante -->
                <div class="rounded-3xl overflow-hidden shadow-lg border border-jade-50 aspect-[16/9] bg-slate-50 relative">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m13!1d15602.585501306354!2d-77.03713914841968!3d-12.12213941421045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c81607cd1b51%3A0x7d6a5c1813459c5d!2sMiraflores%2C%20Lima%2C%20Peru!5e0!3m2!1sen!2spe!4v1715132213421" class="w-full h-full border-none" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

        </div>

        <!-- SECCIÓN DE FAQs (PREGUNTAS FRECUENTES) -->
        <div class="mt-28 max-w-4xl mx-auto space-y-12">
            <div class="text-center space-y-3">
                <span class="text-sm font-semibold text-jade-600 uppercase tracking-widest">Resuelve tus Dudas</span>
                <h2 class="text-3xl font-serif font-bold text-slate-900">Preguntas Frecuentes</h2>
                <p class="text-slate-500 text-sm">Todo lo que necesitas saber antes de tu primera visita a la clínica Miradent.</p>
            </div>

            <div class="space-y-4">
                <!-- Pregunta 1 -->
                <div class="faq-item bg-white border border-jade-100 rounded-2xl overflow-hidden transition-all duration-300">
                    <button class="w-full flex justify-between items-center px-6 py-5 text-left focus:outline-none group">
                        <span class="font-bold text-slate-800 text-sm sm:text-base group-hover:text-jade-500 transition-colors">¿Cómo puedo agendar una cita de evaluación?</span>
                        <span class="faq-icon w-8 h-8 rounded-full bg-jade-50 flex items-center justify-center text-jade-500 transition-transform duration-300 group-hover:bg-jade-500 group-hover:text-white">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 bg-jade-50/20">
                        <div class="px-6 pb-6 text-slate-600 text-sm leading-relaxed">
                            Puedes agendar de forma inmediata haciendo clic en cualquiera de nuestros botones de WhatsApp en la web, llamándonos por teléfono o rellenando el formulario de contacto superior. Te responderemos y confirmaremos tu fecha ideal en menos de 10 minutos.
                        </div>
                    </div>
                </div>

                <!-- Pregunta 2 -->
                <div class="faq-item bg-white border border-jade-100 rounded-2xl overflow-hidden transition-all duration-300">
                    <button class="w-full flex justify-between items-center px-6 py-5 text-left focus:outline-none group">
                        <span class="font-bold text-slate-800 text-sm sm:text-base group-hover:text-jade-500 transition-colors">¿Cuáles son los horarios de atención de la clínica?</span>
                        <span class="faq-icon w-8 h-8 rounded-full bg-jade-50 flex items-center justify-center text-jade-500 transition-transform duration-300 group-hover:bg-jade-500 group-hover:text-white">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 bg-jade-50/20">
                        <div class="px-6 pb-6 text-slate-600 text-sm leading-relaxed">
                            Nuestros horarios de atención personalizada con la Dra. Pamela Miranda son de lunes a sábado en dos turnos: por las mañanas de **9:00 AM a 12:00 PM**, y por las tardes de **4:00 PM a 7:00 PM**.
                        </div>
                    </div>
                </div>

                <!-- Pregunta 3 -->
                <div class="faq-item bg-white border border-jade-100 rounded-2xl overflow-hidden transition-all duration-300">
                    <button class="w-full flex justify-between items-center px-6 py-5 text-left focus:outline-none group">
                        <span class="font-bold text-slate-800 text-sm sm:text-base group-hover:text-jade-500 transition-colors">¿Qué métodos de pago aceptan?</span>
                        <span class="faq-icon w-8 h-8 rounded-full bg-jade-50 flex items-center justify-center text-jade-500 transition-transform duration-300 group-hover:bg-jade-500 group-hover:text-white">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 bg-jade-50/20">
                        <div class="px-6 pb-6 text-slate-600 text-sm leading-relaxed">
                            Aceptamos pagos en efectivo, transferencias bancarias directas (BCP, BBVA, Interbank) y billeteras digitales móviles como **Yape y Plin** al instante y sin ningún tipo de recargo adicional.
                        </div>
                    </div>
                </div>

                <!-- Pregunta 4 -->
                <div class="faq-item bg-white border border-jade-100 rounded-2xl overflow-hidden transition-all duration-300">
                    <button class="w-full flex justify-between items-center px-6 py-5 text-left focus:outline-none group">
                        <span class="font-bold text-slate-800 text-sm sm:text-base group-hover:text-jade-500 transition-colors">¿Cuánto tiempo dura una sesión de tratamiento?</span>
                        <span class="faq-icon w-8 h-8 rounded-full bg-jade-50 flex items-center justify-center text-jade-500 transition-transform duration-300 group-hover:bg-jade-500 group-hover:text-white">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 bg-jade-50/20">
                        <div class="px-6 pb-6 text-slate-600 text-sm leading-relaxed">
                            Nuestras sesiones personalizadas tienen una duración promedio de **40 a 50 minutos**. Esto garantiza un tratamiento sumamente minucioso, cómodo para el paciente, y sin prisas para lograr la máxima perfección clínica.
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Script para el Acordeón de FAQs -->
<script>
    document.querySelectorAll('.faq-item button').forEach(button => {
        button.addEventListener('click', () => {
            const faqItem = button.parentElement;
            const answer = faqItem.querySelector('.faq-answer');
            const icon = faqItem.querySelector('.faq-icon');
            
            // Cerrar otros abiertos
            document.querySelectorAll('.faq-item').forEach(item => {
                if (item !== faqItem) {
                    item.querySelector('.faq-answer').style.maxHeight = null;
                    item.querySelector('.faq-icon').classList.remove('rotate-180');
                    item.classList.remove('border-jade-300');
                }
            });

            // Expandir/Colapsar el actual
            if (answer.style.maxHeight) {
                answer.style.maxHeight = null;
                icon.classList.remove('rotate-180');
                faqItem.classList.remove('border-jade-300');
            } else {
                answer.style.maxHeight = answer.scrollHeight + 'px';
                icon.classList.add('rotate-180');
                faqItem.classList.add('border-jade-300');
            }
        });
    });
</script>
@endsection
