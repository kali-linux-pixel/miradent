<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receta Médica - Miradent VIP</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        jade: '#00BB77'
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }
        @media print {
            body {
                background-color: white !important;
            }
            .no-print {
                display: none !important;
            }
            .print-card {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                margin: 0 !important;
                max-width: 100% !important;
            }
        }
    </style>
</head>
<body class="p-4 sm:p-12 flex flex-col items-center justify-center min-h-screen">

    <!-- Botonera de Acción (No se imprime) -->
    <div class="no-print flex space-x-4 mb-8">
        <button onclick="window.print()" class="bg-jade text-white font-bold py-3 px-6 rounded-xl text-sm flex items-center space-x-2 shadow-lg shadow-green-500/10 hover:shadow-xl transition-all">
            <i class="fa-solid fa-print"></i> <span>Imprimir Receta</span>
        </button>
        <button onclick="window.close()" class="bg-slate-200 text-slate-700 font-bold py-3 px-6 rounded-xl text-sm flex items-center space-x-2 hover:bg-slate-300 transition-all">
            <i class="fa-solid fa-xmark"></i> <span>Cerrar Ventana</span>
        </button>
    </div>

    <!-- Receta Médica Imprimible -->
    <div class="print-card w-full max-w-2xl bg-white border border-slate-100 rounded-3xl p-10 shadow-2xl relative space-y-8">
        
        <!-- Cabecera de la Clínica -->
        <div class="flex justify-between items-start border-b border-slate-100 pb-6">
            <div class="space-y-1">
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 font-serif flex items-center space-x-2">
                    <span class="text-jade"><i class="fa-solid fa-tooth"></i></span>
                    <span>MIRADENT VIP</span>
                </h1>
                <p class="text-[10px] uppercase font-bold tracking-widest text-jade">Clínica Dental Especializada</p>
                <p class="text-xs text-slate-500 mt-1">C.D. Pamela Miranda - Colegiatura COP 12345</p>
            </div>
            <div class="text-right text-xs text-slate-400 space-y-0.5">
                <p><i class="fa-solid fa-location-dot mr-1.5 text-jade"></i> Jr. Unión 637 P.J Miramar Alto, Chimbote</p>
                <p><i class="fa-solid fa-phone mr-1.5 text-jade"></i> +51 990 353 982</p>
                <p><i class="fa-solid fa-globe mr-1.5 text-jade"></i> www.miradent.pe</p>
            </div>
        </div>

        <!-- Información del Paciente -->
        <div class="grid grid-cols-2 gap-4 bg-slate-50/50 border border-slate-100 p-5 rounded-2xl text-xs sm:text-sm">
            <div>
                <p class="text-slate-400 text-[10px] uppercase font-bold tracking-wider">Paciente</p>
                <p class="font-bold text-slate-800 mt-1">{{ $paciente }}</p>
            </div>
            <div class="text-right">
                <p class="text-slate-400 text-[10px] uppercase font-bold tracking-wider">Fecha de Emisión</p>
                <p class="font-bold text-slate-800 mt-1">{{ $fecha }}</p>
            </div>
        </div>

        <!-- Contenido de la Receta (RP/) -->
        <div class="space-y-4">
            <div class="flex items-center space-x-2 border-b border-jade/20 pb-2">
                <span class="text-xl font-bold text-jade">Rp.</span>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tratamiento Farmacológico</span>
            </div>
            <div class="text-slate-700 text-sm sm:text-base leading-relaxed whitespace-pre-line min-h-[150px] p-2">
                {{ $medicamentos }}
            </div>
        </div>

        <!-- Indicaciones Generales -->
        <div class="space-y-3 bg-green-50/10 border border-green-50 p-6 rounded-2xl">
            <h4 class="text-xs font-bold text-jade uppercase tracking-wider flex items-center space-x-1.5">
                <i class="fa-solid fa-circle-info"></i> <span>Indicaciones Especiales</span>
            </h4>
            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed whitespace-pre-line">
                {{ $indicaciones }}
            </p>
        </div>

        <!-- Firma y Sello -->
        <div class="pt-12 flex justify-end">
            <div class="text-center w-64 space-y-2">
                <div class="border-b border-slate-300 h-16 w-full relative flex items-end justify-center">
                    <!-- Sello / Firma simulada elegante -->
                    <span class="font-serif italic text-jade text-lg select-none opacity-40 absolute bottom-1">Pamela Miranda</span>
                </div>
                <p class="text-xs font-bold text-slate-700">C.D. Pamela Miranda</p>
                <p class="text-[10px] text-slate-400">Cirujano Dentista - Miradent VIP</p>
            </div>
        </div>

        <!-- Pie de Receta -->
        <div class="text-center text-[10px] text-slate-400 border-t border-slate-100 pt-6">
            <p>¡Gracias por confiar tu sonrisa en nosotros! Conserve esta receta para su control clínico.</p>
        </div>

    </div>

</body>
</html>
