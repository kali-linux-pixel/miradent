<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | Miradent VIP Panel</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        jade: {
                            50: '#e6fcf4',
                            100: '#cdfae9',
                            200: '#9bf5d2',
                            300: '#69f0bc',
                            400: '#37eba5',
                            500: '#00BB77', // El Verde Jade exacto de la doctora (#00BB77)
                            600: '#00a368',
                            700: '#008c5a',
                            800: '#00754b',
                            900: '#005d3c',
                            950: '#002f1e',
                        },
                        vip: {
                            gold: '#D4AF37',
                            slate: '#0B1311',
                            panel: '#101B18',
                            border: '#1A2F2B'
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    }
                }
            }
        }
    </script>
    <style>
        /* Fondo principal suave en verde jade lila/claro */
        html, body {
            background-color: #f3fbf8 !important;
            color: #002f1e !important;
        }
        
        /* Sidebar de Lujo - Blanco Puro y Verde Jade */
        aside {
            background-color: #ffffff !important;
            border-right: 1px solid #cdfae9 !important;
        }
        aside span, aside h5, aside h2 {
            color: #002f1e !important;
        }
        aside p[class*="tracking-widest"] {
            color: #00BB77 !important;
            font-weight: 800 !important;
            font-size: 10px !important;
            letter-spacing: 0.15em !important;
            border-bottom: 1px solid #e6fcf4 !important;
            padding-bottom: 6px !important;
            margin-top: 1.5rem !important;
            opacity: 0.85 !important;
        }
        
        /* Links inactivos en el Sidebar */
        aside nav a {
            color: #005d3c !important;
            border-left: 3px solid transparent !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        aside nav a:hover {
            background-color: #e6fcf4 !important;
            color: #00BB77 !important;
            border-left-color: #00BB77 !important;
            padding-left: 1.25rem !important;
        }
        
        /* Link activo en el Sidebar - Verde Jade */
        aside nav a[class*="bg-jade-950"] {
            background: linear-gradient(135deg, #00BB77 0%, #00a368 100%) !important;
            color: #FFFFFF !important;
            border-left: 4px solid #00BB77 !important;
            box-shadow: 0 4px 15px -2px rgba(0, 187, 119, 0.2) !important;
            font-weight: 700 !important;
            transform: translateX(4px) !important;
        }
        aside nav a[class*="bg-jade-950"] i, aside nav a[class*="bg-jade-950"] span {
            color: #FFFFFF !important;
        }
        aside nav a[class*="bg-jade-950"]::after {
            content: '';
            width: 6px;
            height: 6px;
            background-color: #37eba5;
            border-radius: 50%;
            margin-left: auto;
            box-shadow: 0 0 10px #37eba5;
            animation: pulse-dot 2s infinite;
        }
        @keyframes pulse-dot {
            0% { transform: scale(0.9); opacity: 0.6; }
            50% { transform: scale(1.25); opacity: 1; box-shadow: 0 0 14px #37eba5; }
            100% { transform: scale(0.9); opacity: 0.6; }
        }
        
        /* Indicador de Estado Médico Online */
        .doctor-avatar-container {
            position: relative;
        }
        .doctor-avatar-container::after {
            content: '';
            position: absolute;
            bottom: -1px;
            right: -1px;
            width: 10px;
            height: 10px;
            background-color: #37eba5;
            border: 2px solid #002f1e;
            border-radius: 50%;
            box-shadow: 0 0 8px #37eba5;
        }
        
        /* Top Header - Blanco Suave */
        header {
            background-color: #ffffff !important;
            border-bottom: 1px solid #e6fcf4 !important;
        }
        header h2 {
            color: #002f1e !important;
        }
        header span {
            background-color: #e6fcf4 !important;
            color: #00BB77 !important;
            border-color: #cdfae9 !important;
        }
        header button, header a {
            background-color: #e6fcf4 !important;
            color: #00BB77 !important;
            border-color: #cdfae9 !important;
        }
        header button:hover, header a:hover {
            background-color: #00BB77 !important;
            color: #FFFFFF !important;
        }
        
        /* Contenedor Principal */
        main {
            background-color: #f3fbf8 !important;
        }
        
        /* Tarjetas (Panels) - Blanco Puro con Sombra Verde Jade */
        .bg-vip-panel {
            background-color: #ffffff !important;
            border: 1px solid #cdfae9 !important;
            box-shadow: 0 10px 30px -10px rgba(0, 187, 119, 0.12) !important;
        }
        .bg-vip-panel h4, .bg-vip-panel h3, .bg-vip-panel p, .bg-vip-panel h5 {
            color: #002f1e !important;
        }
        
        /* Tablas */
        table {
            background-color: #FFFFFF !important;
        }
        thead {
            background-color: #e6fcf4 !important;
        }
        thead th {
            color: #005d3c !important;
        }
        tbody tr:hover {
            background-color: rgba(230, 252, 244, 0.3) !important;
        }
        tbody td {
            color: #002f1e !important;
            border-bottom: 1px solid #e6fcf4 !important;
        }
        
        /* Inputs y Formularios */
        input, select, textarea {
            background-color: #FFFFFF !important;
            color: #0f172a !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 14px !important;
            padding: 10px 14px !important;
            font-size: 13px !important;
            transition: all 0.25s ease-in-out !important;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #00BB77 !important;
            box-shadow: 0 0 0 4px rgba(0, 187, 119, 0.12) !important;
            outline: none !important;
        }
        
        /* Botones de Acción */
        button[class*="bg-jade-600"], a[class*="bg-jade-600"], button[class*="bg-jade-800"], a[class*="bg-jade-800"] {
            background-color: #00BB77 !important;
            color: #FFFFFF !important;
        }
        button[class*="bg-jade-600"]:hover, a[class*="bg-jade-600"]:hover, button[class*="bg-jade-800"]:hover, a[class*="bg-jade-800"]:hover {
            background-color: #00a368 !important;
        }
        
        /* Modales Premium de Lujo */
        div[id^="modal-"] > div {
            background-color: #FFFFFF !important;
            border: 1px solid #f1f5f9 !important;
            border-radius: 28px !important;
            box-shadow: 0 25px 50px -12px rgba(0, 187, 119, 0.15) !important;
            overflow: hidden !important;
        }
        div[id^="modal-"] .bg-slate-900\/50 {
            background-color: #f8fafc !important;
            border-bottom: 1px solid #f1f5f9 !important;
            padding: 20px 24px !important;
            height: auto !important;
        }
        div[id^="modal-"] h3 {
            font-family: 'Playfair Display', serif !important;
            font-size: 18px !important;
            font-weight: 700 !important;
            color: #0f172a !important;
            letter-spacing: -0.02em !important;
        }
        div[id^="modal-"] label {
            font-size: 11px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            color: #475569 !important;
        }
        div[id^="modal-"] button[type="submit"] {
            background: linear-gradient(135deg, #00BB77, #00a368) !important;
            border-radius: 14px !important;
            padding: 10px 22px !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            color: #FFFFFF !important;
            box-shadow: 0 4px 12px rgba(0, 187, 119, 0.15) !important;
            transition: all 0.25s ease !important;
            border: none !important;
        }
        div[id^="modal-"] button[type="submit"]:hover {
            background: linear-gradient(135deg, #00a368, #008c5a) !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 16px rgba(0, 187, 119, 0.25) !important;
        }
        div[id^="modal-"] button[type="button"] {
            background-color: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            color: #64748b !important;
            border-radius: 14px !important;
            padding: 10px 22px !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            transition: all 0.25s ease !important;
        }
        div[id^="modal-"] button[type="button"]:hover {
            background-color: #f1f5f9 !important;
            color: #334155 !important;
        }
        
        /* Iconos de las tarjetas de Dashboard */
        .w-14.h-14, .w-10.h-10 {
            background-color: #e6fcf4 !important;
            color: #00BB77 !important;
            border-color: #cdfae9 !important;
        }
        
        /* Links rápidos */
        .bg-slate-900\/50 {
            background-color: #FFFFFF !important;
            border-color: #e6fcf4 !important;
        }
        /* Estilos de Modo Oscuro Ejecutivo */
        body.dark-theme {
            background-color: #020617 !important;
            color: #f1f5f9 !important;
        }
        body.dark-theme main {
            background-color: #0b0f19 !important;
        }
        body.dark-theme .bg-white {
            background-color: #0f172a !important;
        }
        body.dark-theme .bg-vip-panel {
            background-color: #1e293b !important;
            border-color: #334155 !important;
        }
        body.dark-theme h1, body.dark-theme h2, body.dark-theme h3, body.dark-theme h4, body.dark-theme h5, body.dark-theme p, body.dark-theme span, body.dark-theme td, body.dark-theme th {
            color: #f8fafc !important;
        }
        body.dark-theme table {
            background-color: #1e293b !important;
        }
        body.dark-theme thead {
            background-color: #0f172a !important;
        }
        body.dark-theme tbody td {
            color: #e2e8f0 !important;
            border-color: #334155 !important;
        }
        body.dark-theme tbody tr:hover {
            background-color: rgba(30, 41, 59, 0.5) !important;
        }
        body.dark-theme input, body.dark-theme select, body.dark-theme textarea {
            background-color: #1e293b !important;
            color: #f8fafc !important;
            border-color: #475569 !important;
        }
        body.dark-theme div[id^="modal-"] > div {
            background-color: #1e293b !important;
            border-color: #334155 !important;
        }
        body.dark-theme div[id^="modal-"] .bg-slate-900\/50 {
            background-color: #0f172a !important;
            border-color: #334155 !important;
        }
        body.dark-theme .bg-slate-900\/50 {
            background-color: #1e293b !important;
            border-color: #334155 !important;
        }
        body.dark-theme .bg-slate-900\/50:hover {
            background-color: #334155 !important;
        }
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-spin-slow {
            animation: spin-slow 8s linear infinite;
        }
    </style>
</head>
<body class="font-sans h-full text-slate-700 flex overflow-hidden bg-white">

    <!-- SIDEBAR -->
    <aside class="hidden lg:flex flex-col w-64 bg-white border-r border-[#cdfae9] flex-shrink-0">
        <!-- Logo Header -->
        <div class="h-20 flex items-center px-6 border-b border-[#cdfae9]">
            <a href="{{ route('inicio') }}" class="flex items-center">
                <img src="{{ asset('img/logo.png') }}" class="h-12 w-auto object-contain" alt="Miradent Logo">
            </a>
        </div>

        <!-- Links del Menú -->
        <nav class="flex-grow py-6 px-4 space-y-1.5 overflow-y-auto">
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-3 mb-2">Panel de Control</p>
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Route::is('admin.dashboard') ? 'bg-jade-950 text-jade-400 font-semibold border-l-2 border-jade-500' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                <i class="fa-solid fa-chart-line text-base"></i>
                <span>Estadísticas</span>
            </a>
            
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-3 pt-6 mb-2">Gestión Médica</p>

            <a href="{{ route('pacientes.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Route::is('pacientes.*') ? 'bg-jade-950 text-jade-400 font-semibold border-l-2 border-jade-500' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                <i class="fa-solid fa-user-injured text-base"></i>
                <span>Pacientes</span>
            </a>

            <a href="{{ route('citas.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Route::is('citas.*') ? 'bg-jade-950 text-jade-400 font-semibold border-l-2 border-jade-500' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                <i class="fa-solid fa-calendar-check text-base"></i>
                <span>Agenda de Citas</span>
            </a>

            <a href="{{ route('pagos.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Route::is('pagos.*') ? 'bg-jade-950 text-jade-400 font-semibold border-l-2 border-jade-500' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                <i class="fa-solid fa-file-invoice-dollar text-base"></i>
                <span>Registro de Pagos</span>
            </a>

            <a href="{{ route('gastos.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Route::is('gastos.*') ? 'bg-jade-950 text-jade-400 font-semibold border-l-2 border-jade-500' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                <i class="fa-solid fa-receipt text-base"></i>
                <span>Registro de Gastos</span>
            </a>

            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-3 pt-6 mb-2">Páginas Web</p>
            <a href="{{ route('admin.galeria.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Route::is('admin.galeria.*') ? 'bg-jade-950 text-jade-400 font-semibold border-l-2 border-jade-500' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                <i class="fa-solid fa-camera-retro text-base"></i>
                <span>Galería Antes/Desp</span>
            </a>
            <a href="{{ route('admin.promociones.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Route::is('admin.promociones.*') ? 'bg-jade-950 text-jade-400 font-semibold border-l-2 border-jade-500' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                <i class="fa-solid fa-gift text-base"></i>
                <span>Promociones</span>
            </a>
            <a href="{{ route('inicio') }}" target="_blank" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm text-slate-400 hover:bg-slate-900 hover:text-white">
                <i class="fa-solid fa-globe text-base"></i>
                <span>Ver Sitio Público</span>
            </a>
            <a href="{{ route('admin.backup') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm text-amber-400 hover:bg-amber-950/40 hover:text-amber-300 transition-all border border-transparent hover:border-amber-900/30 font-semibold" title="Descargar Copia de Seguridad de la Base de Datos">
                <i class="fa-solid fa-database text-base"></i>
                <span>Copia de Seguridad</span>
            </a>
        </nav>

        <div class="p-4 border-t border-[#cdfae9] bg-[#e6fcf4]/30">
            <div class="flex items-center space-x-3 px-2 py-1.5 rounded-xl">
                <div class="doctor-avatar-container w-9 h-9 rounded-full bg-[#00BB77] flex items-center justify-center text-white font-bold text-sm relative">
                    DM
                </div>
                <div>
                    <h5 class="text-xs font-semibold text-[#002f1e]">Dra. Miradent</h5>
                    <p class="text-[10px] text-[#005d3c] font-medium">Administrador</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- ÁREA DE CONTENIDO -->
    <div class="flex-grow flex flex-col min-w-0 overflow-hidden">
        <!-- TOP NAVBAR -->
        <header class="h-20 bg-white border-b border-[#cdfae9] flex items-center justify-between px-6 lg:px-8">
            <div class="flex items-center space-x-4">
                <!-- Botón móvil -->
                <button id="sidebar-toggle" class="lg:hidden text-slate-400 hover:text-white focus:outline-none p-1">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <h2 class="text-lg font-bold text-white">@yield('page_title', 'Administración')</h2>
            </div>

            <!-- Acciones Rápidas -->
            <div class="flex items-center space-x-4">
                <span class="hidden sm:inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-jade-950 text-jade-400 border border-jade-900">
                    <span class="w-1.5 h-1.5 bg-jade-400 rounded-full mr-1.5 animate-pulse"></span> Servidor Conectado
                </span>
                <!-- Interruptor de Tema (Dark Mode / Light Mode Ejecutivo) -->
                <button onclick="toggleDarkMode()" id="dark-mode-toggle-btn" class="p-2.5 text-slate-400 hover:text-white bg-slate-900 border border-slate-800 rounded-xl transition-all focus:outline-none flex items-center justify-center" title="Cambiar Tema (Claro / Oscuro)">
                    <i id="dark-mode-icon" class="fa-solid fa-moon text-base"></i>
                </button>
                <!-- Centro de Notificaciones -->
                <div class="relative inline-block text-left" id="notification-dropdown-container">
                    <button onclick="toggleNotifications()" class="relative p-2.5 text-slate-400 hover:text-white bg-slate-900 border border-slate-800 rounded-xl transition-all focus:outline-none flex items-center justify-center">
                        <i class="fa-solid fa-bell text-base"></i>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-rose-500 rounded-full animate-ping"></span>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-rose-500 rounded-full"></span>
                    </button>
                    
                    <!-- Menú de Notificaciones -->
                    <div id="notification-menu" class="hidden absolute right-0 mt-2.5 w-80 bg-vip-panel border border-vip-border rounded-2xl shadow-2xl z-50 overflow-hidden py-1 divide-y divide-vip-border/10">
                        <div class="px-4 py-2.5 bg-slate-900/50 flex items-center justify-between">
                            <span class="text-xs font-bold text-white uppercase tracking-wider">Alertas de Hoy</span>
                            <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-rose-950/40 text-rose-400 border border-rose-900/50">3 Nuevas</span>
                        </div>
                        <div class="py-1 max-h-64 overflow-y-auto">
                            <!-- Alerta 1 -->
                            <div class="px-4 py-3 hover:bg-slate-900/10 transition-all flex items-start space-x-3 text-xs">
                                <div class="w-7 h-7 rounded-lg bg-emerald-950/60 text-emerald-400 border border-emerald-900/50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="fa-solid fa-calendar-check text-xs"></i>
                                </div>
                                <div class="space-y-0.5 min-w-0 flex-grow text-left">
                                    <p class="font-semibold text-slate-800 truncate">Nueva Cita Programada</p>
                                    <p class="text-slate-500 text-[10px]">Paciente: Juan Pérez (Hoy 4:30 PM)</p>
                                </div>
                            </div>
                            <!-- Alerta 2 -->
                            <div class="px-4 py-3 hover:bg-slate-900/10 transition-all flex items-start space-x-3 text-xs">
                                <div class="w-7 h-7 rounded-lg bg-rose-950/60 text-rose-400 border border-rose-900/50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="fa-solid fa-triangle-exclamation text-xs"></i>
                                </div>
                                <div class="space-y-0.5 min-w-0 flex-grow text-left">
                                    <p class="font-semibold text-rose-400 truncate">Paciente Alérgico</p>
                                    <p class="text-slate-500 text-[10px]">Alerta crítica registrada en la ficha.</p>
                                </div>
                            </div>
                            <!-- Alerta 3 -->
                            <div class="px-4 py-3 hover:bg-slate-900/10 transition-all flex items-start space-x-3 text-xs">
                                <div class="w-7 h-7 rounded-lg bg-blue-950/60 text-blue-400 border border-blue-900/50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="fa-solid fa-file-invoice-dollar text-xs"></i>
                                </div>
                                <div class="space-y-0.5 min-w-0 flex-grow text-left">
                                    <p class="font-semibold text-slate-800 truncate">Balance de Caja Diario</p>
                                    <p class="text-slate-500 text-[10px]">El reporte contable del día está listo.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-xs text-slate-400 hover:text-white bg-slate-900 border border-slate-800 px-3.5 py-2.5 rounded-xl transition-colors">
                        <i class="fa-solid fa-arrow-right-from-bracket mr-1.5"></i> Salir
                    </button>
                </form>
            </div>
        </header>

        <!-- MENU MÓVIL DESPLEGABLE -->
        <div id="sidebar-mobile" class="hidden lg:hidden fixed inset-0 z-40 bg-slate-950/80 backdrop-blur-sm">
            <div class="w-64 h-full bg-vip-slate border-r border-vip-border flex flex-col justify-between">
                <div>
                    <div class="h-20 flex items-center justify-between px-6 border-b border-vip-border">
                        <a href="{{ route('inicio') }}">
                            <img src="{{ asset('img/logo.png') }}" class="h-12 w-auto object-contain" alt="Miradent Logo">
                        </a>
                        <button id="sidebar-close" class="text-slate-400 hover:text-white focus:outline-none">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </button>
                    </div>
                    <nav class="py-6 px-4 space-y-1.5">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm text-slate-300 hover:bg-slate-900">
                            <i class="fa-solid fa-chart-line text-base"></i>
                            <span>Estadísticas</span>
                        </a>
                        <a href="{{ route('pacientes.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm text-slate-300 hover:bg-slate-900">
                            <i class="fa-solid fa-user-injured text-base"></i>
                            <span>Pacientes</span>
                        </a>
                        <a href="{{ route('citas.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm text-slate-300 hover:bg-slate-900">
                            <i class="fa-solid fa-calendar-check text-base"></i>
                            <span>Agenda de Citas</span>
                        </a>
                        <a href="{{ route('pagos.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm text-slate-300 hover:bg-slate-900">
                            <i class="fa-solid fa-file-invoice-dollar text-base"></i>
                            <span>Registro de Pagos</span>
                        </a>
                        <a href="{{ route('gastos.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm text-slate-300 hover:bg-slate-900">
                            <i class="fa-solid fa-receipt text-base"></i>
                            <span>Registro de Gastos</span>
                        </a>
                        <a href="{{ route('admin.galeria.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm text-slate-300 hover:bg-slate-900">
                            <i class="fa-solid fa-camera-retro text-base"></i>
                            <span>Galería Antes/Desp</span>
                        </a>
                        <a href="{{ route('admin.promociones.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm text-slate-300 hover:bg-slate-900">
                            <i class="fa-solid fa-gift text-base"></i>
                            <span>Promociones</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- CONTENIDO CENTRAL -->
        <main class="flex-grow overflow-y-auto p-6 lg:p-8">
            <!-- Alerta de éxito global -->
            @if(session('success'))
                <div class="mb-6 bg-jade-950/80 border border-jade-500/30 text-jade-400 p-4 rounded-2xl flex items-center space-x-3">
                    <i class="fa-solid fa-circle-check text-xl"></i>
                    <p class="text-sm font-semibold">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Errores de validación globales -->
            @if($errors->any())
                <div class="mb-6 bg-red-950/50 border border-red-500/20 text-red-400 p-4 rounded-2xl">
                    <div class="flex items-center space-x-3 mb-2">
                        <i class="fa-solid fa-circle-exclamation text-xl"></i>
                        <p class="text-sm font-semibold">Por favor corrige los siguientes errores:</p>
                    </div>
                    <ul class="list-disc pl-5 text-xs space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Script de toggle móvil -->
    <script>
        const burger = document.getElementById('sidebar-toggle');
        const closeBtn = document.getElementById('sidebar-close');
        const mobileMenu = document.getElementById('sidebar-mobile');

        burger.addEventListener('click', () => {
            mobileMenu.classList.remove('hidden');
        });

        closeBtn.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
        });

        // Cerrar al clickear fuera
        mobileMenu.addEventListener('click', (e) => {
            if (e.target === mobileMenu) {
                mobileMenu.classList.add('hidden');
            }
        });

        // Toggle del menú de notificaciones
        function toggleNotifications() {
            const menu = document.getElementById('notification-menu');
            menu.classList.toggle('hidden');
        }

        // Cerrar menú de notificaciones al hacer clic fuera de él
        document.addEventListener('click', (e) => {
            const container = document.getElementById('notification-dropdown-container');
            const menu = document.getElementById('notification-menu');
            if (container && !container.contains(e.target) && menu) {
                menu.classList.add('hidden');
            }
        });

        // Lógica de Modo Oscuro Ejecutivo
        function toggleDarkMode() {
            const isDark = document.body.classList.toggle('dark-theme');
            localStorage.setItem('admin-dark-mode', isDark ? 'enabled' : 'disabled');
            updateDarkModeIcon(isDark);
        }

        function updateDarkModeIcon(isDark) {
            const icon = document.getElementById('dark-mode-icon');
            if (icon) {
                if (isDark) {
                    icon.className = 'fa-solid fa-sun text-base text-amber-400 animate-spin-slow';
                } else {
                    icon.className = 'fa-solid fa-moon text-base';
                }
            }
        }

        // Cargar preferencia guardada de Modo Oscuro
        document.addEventListener('DOMContentLoaded', () => {
            const savedMode = localStorage.getItem('admin-dark-mode');
            if (savedMode === 'enabled') {
                document.body.classList.add('dark-theme');
                updateDarkModeIcon(true);
            }
        });
    </script>
</body>
</html>
