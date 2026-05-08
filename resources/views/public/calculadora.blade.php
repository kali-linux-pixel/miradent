@extends('layouts.app')

@section('title', 'Calculadora Inteligente de Tratamiento')

@section('content')
<!-- Header de Página - Blanco y Verde Jade -->
<section class="bg-white py-16 border-b border-jade-50 relative overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-10">
        <img src="{{ asset('img/fondo.png') }}" onerror="this.style.display='none'" class="w-full h-full object-cover" alt="Fondo Clínica Miradent">
    </div>
    <div class="absolute right-0 bottom-0 w-96 h-96 bg-jade-100/30 rounded-full blur-3xl"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
        <span class="text-xs font-semibold uppercase tracking-widest text-jade-600 bg-jade-50 px-4 py-1.5 rounded-full border border-jade-100">Evaluación Dental Digital</span>
        <h1 class="text-4xl sm:text-5xl font-serif font-bold text-slate-900">Calculadora de Tratamiento</h1>
        <p class="text-slate-600 text-sm sm:text-base max-w-xl mx-auto">
            Responde un breve cuestionario de 3 pasos y nuestro algoritmo inteligente te recomendará de inmediato el tratamiento dental ideal para tu caso.
        </p>
    </div>
</section>

<!-- Sección del Cuestionario -->
<section class="py-20 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-white border border-jade-100 rounded-3xl p-8 sm:p-10 shadow-2xl shadow-jade-100/10 relative">
            
            <!-- Barra de Progreso -->
            <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden mb-10 flex">
                <div id="progress-bar" class="bg-jade-500 h-full transition-all duration-500 w-1/3"></div>
            </div>

            <!-- PASO 1 -->
            <div id="step-1" class="step-container space-y-6">
                <div class="space-y-2 text-center sm:text-left">
                    <span class="text-xs font-bold text-jade-600 uppercase tracking-widest">Paso 1 de 3</span>
                    <h3 class="text-2xl font-serif font-bold text-slate-900">¿Cuál es tu objetivo odontológico principal?</h3>
                    <p class="text-slate-500 text-sm">Selecciona la opción que más se asimile a lo que deseas lograr.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
                    <button onclick="selectOption(1, 'Estética / Mejorar sonrisa', 'estetica')" class="option-btn text-left p-6 rounded-2xl border border-jade-50 hover:border-jade-300 hover:bg-jade-50/10 transition-all flex items-start space-x-4 group focus:outline-none">
                        <div class="w-10 h-10 rounded-xl bg-jade-50 flex items-center justify-center text-jade-500 group-hover:bg-jade-500 group-hover:text-white transition-colors flex-shrink-0">
                            <i class="fa-solid fa-wand-magic-sparkles"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm group-hover:text-jade-600 transition-colors">Estética y Blanqueamiento</h4>
                            <p class="text-slate-400 text-xs mt-1">Quiero dientes más blancos, alineados o carillas estéticas.</p>
                        </div>
                    </button>

                    <button onclick="selectOption(1, 'Dolor / Molestia Dental', 'dolor')" class="option-btn text-left p-6 rounded-2xl border border-jade-50 hover:border-jade-300 hover:bg-jade-50/10 transition-all flex items-start space-x-4 group focus:outline-none">
                        <div class="w-10 h-10 rounded-xl bg-jade-50 flex items-center justify-center text-jade-500 group-hover:bg-jade-500 group-hover:text-white transition-colors flex-shrink-0">
                            <i class="fa-solid fa-tooth"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm group-hover:text-jade-600 transition-colors">Aliviar Dolor de Muelas</h4>
                            <p class="text-slate-400 text-xs mt-1">Siento dolor agudo, hinchazón o tengo una muela rota.</p>
                        </div>
                    </button>

                    <button onclick="selectOption(1, 'Limpieza / Sarro', 'limpieza')" class="option-btn text-left p-6 rounded-2xl border border-jade-50 hover:border-jade-300 hover:bg-jade-50/10 transition-all flex items-start space-x-4 group focus:outline-none">
                        <div class="w-10 h-10 rounded-xl bg-jade-50 flex items-center justify-center text-jade-500 group-hover:bg-jade-500 group-hover:text-white transition-colors flex-shrink-0">
                            <i class="fa-solid fa-sparkles"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm group-hover:text-jade-600 transition-colors">Limpieza y Prevención</h4>
                            <p class="text-slate-400 text-xs mt-1">Deseo una limpieza profunda, eliminar sarro o mal aliento.</p>
                        </div>
                    </button>

                    <button onclick="selectOption(1, 'Falta de diente / Implante', 'implante')" class="option-btn text-left p-6 rounded-2xl border border-jade-50 hover:border-jade-300 hover:bg-jade-50/10 transition-all flex items-start space-x-4 group focus:outline-none">
                        <div class="w-10 h-10 rounded-xl bg-jade-50 flex items-center justify-center text-jade-500 group-hover:bg-jade-500 group-hover:text-white transition-colors flex-shrink-0">
                            <i class="fa-solid fa-circle-plus"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm group-hover:text-jade-600 transition-colors">Reemplazar Diente Perdido</h4>
                            <p class="text-slate-400 text-xs mt-1">Me falta uno o varios dientes, necesito un implante o prótesis.</p>
                        </div>
                    </button>
                </div>
            </div>

            <!-- PASO 2 -->
            <div id="step-2" class="step-container hidden space-y-6">
                <div class="space-y-2 text-center sm:text-left">
                    <span class="text-xs font-bold text-jade-600 uppercase tracking-widest">Paso 2 de 3</span>
                    <h3 class="text-2xl font-serif font-bold text-slate-900">¿Qué síntoma o molestia presentas?</h3>
                    <p class="text-slate-500 text-sm">Selecciona el síntoma más relevante que experimentas en tu boca.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
                    <button onclick="selectOption(2, 'Sensibilidad extrema', 'sensibilidad')" class="option-btn text-left p-6 rounded-2xl border border-jade-50 hover:border-jade-300 hover:bg-jade-50/10 transition-all flex items-start space-x-4 group focus:outline-none">
                        <div class="w-10 h-10 rounded-xl bg-jade-50 flex items-center justify-center text-jade-500 group-hover:bg-jade-500 group-hover:text-white transition-colors flex-shrink-0">
                            <i class="fa-solid fa-temperature-empty"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm group-hover:text-jade-600 transition-colors">Sensibilidad al Frío/Calor</h4>
                            <p class="text-slate-400 text-xs mt-1">Siento corrientazos o dolor al tomar líquidos helados.</p>
                        </div>
                    </button>

                    <button onclick="selectOption(2, 'Sangrado de encías', 'sangrado')" class="option-btn text-left p-6 rounded-2xl border border-jade-50 hover:border-jade-300 hover:bg-jade-50/10 transition-all flex items-start space-x-4 group focus:outline-none">
                        <div class="w-10 h-10 rounded-xl bg-jade-50 flex items-center justify-center text-jade-500 group-hover:bg-jade-500 group-hover:text-white transition-colors flex-shrink-0">
                            <i class="fa-solid fa-droplet"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm group-hover:text-jade-600 transition-colors">Sangrado al Cepillarme</h4>
                            <p class="text-slate-400 text-xs mt-1">Mis encías se ven rojas, inflamadas o sangran fácilmente.</p>
                        </div>
                    </button>

                    <button onclick="selectOption(2, 'Ninguno, solo estética', 'ninguno')" class="option-btn text-left p-6 rounded-2xl border border-jade-50 hover:border-jade-300 hover:bg-jade-50/10 transition-all flex items-start space-x-4 group focus:outline-none">
                        <div class="w-10 h-10 rounded-xl bg-jade-50 flex items-center justify-center text-jade-500 group-hover:bg-jade-500 group-hover:text-white transition-colors flex-shrink-0">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm group-hover:text-jade-600 transition-colors">Sin Molestias (Saludable)</h4>
                            <p class="text-slate-400 text-xs mt-1">Mis dientes están sanos, solo busco mejorar la apariencia.</p>
                        </div>
                    </button>

                    <button onclick="selectOption(2, 'Dolor punzante / agudo', 'punzante')" class="option-btn text-left p-6 rounded-2xl border border-jade-50 hover:border-jade-300 hover:bg-jade-50/10 transition-all flex items-start space-x-4 group focus:outline-none">
                        <div class="w-10 h-10 rounded-xl bg-jade-50 flex items-center justify-center text-jade-500 group-hover:bg-jade-500 group-hover:text-white transition-colors flex-shrink-0">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm group-hover:text-jade-600 transition-colors">Dolor Fuerte y Constante</h4>
                            <p class="text-slate-400 text-xs mt-1">Tengo dolor de muela persistente que no me deja dormir.</p>
                        </div>
                    </button>
                </div>

                <div class="pt-4 flex justify-start">
                    <button onclick="goBack(1)" class="text-sm font-bold text-slate-500 hover:text-slate-700 flex items-center">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Volver al paso anterior
                    </button>
                </div>
            </div>

            <!-- PASO 3: RESULTADO ESTIMADO -->
            <div id="step-3" class="step-container hidden space-y-8 text-center py-6">
                <div class="w-20 h-20 bg-jade-50 rounded-full flex items-center justify-center text-jade-500 mx-auto border border-jade-100 shadow-xl shadow-jade-100/30 animate-bounce">
                    <i class="fa-solid fa-circle-check text-4xl"></i>
                </div>
                
                <div class="space-y-2">
                    <span class="text-xs font-bold text-jade-600 uppercase tracking-widest">Resultado de Evaluación</span>
                    <h3 class="text-3xl font-serif font-bold text-slate-900">Tu Tratamiento Recomendado</h3>
                    <h4 id="resultado-titulo" class="text-xl font-bold text-jade-600 pt-2">Diseño de Sonrisa VIP</h4>
                    <p id="resultado-descripcion" class="text-slate-600 text-sm max-w-lg mx-auto leading-relaxed pt-2">
                        De acuerdo a tus respuestas, la mejor solución para tus objetivos y molestias es un procedimiento clínico preventivo y estético de alta gama.
                    </p>
                </div>

                <!-- Tarjeta del tratamiento sugerido -->
                <div class="bg-jade-50/30 border border-jade-100 rounded-2xl p-6 max-w-md mx-auto space-y-2 text-left">
                    <h5 class="text-xs font-bold text-jade-600 uppercase tracking-wider">¿Por qué este tratamiento?</h5>
                    <p id="resultado-por-que" class="text-slate-500 text-xs leading-relaxed">
                        Este procedimiento remueve manchas externas, limpia sarro bacteriano acumulado y previene futuras dolencias o sangrados de encías de forma segura y en una sola sesión de 45 minutos.
                    </p>
                </div>

                <div class="pt-6 space-y-4 max-w-sm mx-auto">
                    <a id="resultado-whatsapp-btn" href="#" target="_blank" class="w-full flex items-center justify-center bg-jade-500 text-white font-bold py-4 rounded-xl hover:bg-jade-600 transition-all shadow-lg shadow-jade-500/20 hover:-translate-y-0.5">
                        <i class="fa-brands fa-whatsapp mr-2 text-xl"></i>Reservar este tratamiento por WhatsApp
                    </a>
                    <button onclick="resetCalculator()" class="text-xs font-bold text-slate-500 hover:text-slate-700">
                        Volver a calcular test
                    </button>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Lógica interactiva en JS -->
<script>
    let answers = {
        step1: null,
        step1Label: '',
        step2: null,
        step2Label: ''
    };

    function selectOption(step, label, value) {
        if (step === 1) {
            answers.step1 = value;
            answers.step1Label = label;
            
            // Avanzar al paso 2
            document.getElementById('step-1').classList.add('hidden');
            document.getElementById('step-2').classList.remove('hidden');
            document.getElementById('progress-bar').style.width = '66%';
        } else if (step === 2) {
            answers.step2 = value;
            answers.step2Label = label;
            
            // Avanzar al resultado final
            calculateResult();
        }
    }

    function goBack(step) {
        if (step === 1) {
            document.getElementById('step-2').classList.add('hidden');
            document.getElementById('step-1').classList.remove('hidden');
            document.getElementById('progress-bar').style.width = '33%';
        }
    }

    function calculateResult() {
        let title = '';
        let desc = '';
        let porQue = '';
        
        const s1 = answers.step1;
        const s2 = answers.step2;

        if (s1 === 'estetica') {
            if (s2 === 'sensibilidad' || s2 === 'punzante') {
                title = "Evaluación Integral + Restauración Estética de Resinas";
                desc = "Buscas estética pero presentas una dolencia interna activa. Es vital primero retirar cualquier foco de caries profunda y proteger la pieza con resinas del color natural de tu esmalte.";
                porQue = "La Dra. Pamela Miranda primero aliviará la sensibilidad interna y luego realizará un esculpido dental estético para lucir una sonrisa reluciente.";
            } else {
                title = "Blanqueamiento Dental LED + Carillas Estéticas";
                desc = "¡Perfecto para mejorar tu sonrisa! Te sugerimos una sesión de aclaramiento con luz LED de alta frecuencia combinado con carillas estéticas ultrafinas.";
                porQue = "Permite modificar el tamaño, color e imperfecciones de tus dientes en sesiones cómodas y con un brillo natural inigualable.";
            }
        } else if (s1 === 'dolor') {
            if (s2 === 'punzante' || s2 === 'sensibilidad') {
                title = "Endodoncia de Precisión (Salvar pieza dental)";
                desc = "El dolor agudo o constante suele indicar que la pulpa o nervio del diente está inflamado o infectado de gravedad.";
                porQue = "Este procedimiento clínico limpia internamente los conductos bacterianos, sella el diente sin dolor y lo salva por completo evitando una extracción.";
            } else {
                title = "Restauración Anatómica de Resinas Compuestas";
                desc = "Tienes molestia por una muela rota o caries superficial. Restauraremos la cavidad con resinas de alta resistencia estructural.";
                porQue = "Permite recuperar al 100% la fuerza de mordida y la anatomía original de tu diente previniendo infecciones.";
            }
        } else if (s1 === 'limpieza') {
            title = "Limpieza Dental Ultrasónica Profunda + Fluorización";
            desc = "El sarro calcificado y la placa dental acumulada provocan inflamación o sangrado de encías (gingivitis).";
            porQue = "El ultrasonido remueve impurezas que el cepillo común no logra alcanzar, eliminando el mal aliento e inflamaciones en una sola sesión.";
        } else if (s1 === 'implante') {
            title = "Implantes Dentales de Titanio o Prótesis Fija";
            desc = "La pérdida de una pieza dental afecta la masticación, fonación y causa el desplazamiento del resto de tus dientes.";
            porQue = "El implante de titanio biocompatible reemplaza la raíz de forma definitiva devolviendo una estética y funcionalidad idéntica a un diente natural.";
        } else {
            title = "Evaluación Odontológica Integral VIP";
            desc = "Recomendamos una evaluación clínica exhaustiva para planificar el cuidado de tu salud bucal de forma personalizada.";
            porQue = "Permite mapear tus dientes, realizar un diagnóstico preciso con la Dra. Miranda y agendar tratamientos preventivos.";
        }

        // Mostrar resultados en pantalla
        document.getElementById('resultado-titulo').innerText = title;
        document.getElementById('resultado-descripcion').innerText = desc;
        document.getElementById('resultado-por-que').innerText = porQue;

        // Generar enlace dinámico de WhatsApp
        const mensajeWhatsApp = `Hola Dra. Pamela Miranda, realicé el test de la Calculadora Dental Inteligente y obtuve el siguiente resultado sugerido: *${title}*. Mi objetivo es ${answers.step1Label} y presento molestia de ${answers.step2Label}. Me gustaría agendar una cita de evaluación por favor.`;
        document.getElementById('resultado-whatsapp-btn').href = `https://wa.me/51948097148?text=${encodeURIComponent(mensajeWhatsApp)}`;

        // Mostrar pantalla final
        document.getElementById('step-2').classList.add('hidden');
        document.getElementById('step-3').classList.remove('hidden');
        document.getElementById('progress-bar').style.width = '100%';
    }

    function resetCalculator() {
        answers = { step1: null, step1Label: '', step2: null, step2Label: '' };
        document.getElementById('step-3').classList.add('hidden');
        document.getElementById('step-1').classList.remove('hidden');
        document.getElementById('progress-bar').style.width = '33%';
    }
</script>
@endsection
