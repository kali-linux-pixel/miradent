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
        
        /* Sidebar de Lujo - Verde Jade Intenso */
        aside {
            background-color: #002f1e !important;
            border-right: 1px solid #004d32 !important;
        }
        aside span, aside h5, aside h2 {
            color: #e6fcf4 !important;
        }
        aside p {
            color: #37eba5 !important;
        }
        
        /* Links inactivos en el Sidebar */
        aside nav a {
            color: #cdfae9 !important;
        }
        aside nav a:hover {
            background-color: #004d32 !important;
            color: #37eba5 !important;
        }
        
        /* Link activo en el Sidebar - Verde Jade Brillante */
        aside nav a[class*="bg-jade-950"] {
            background-color: #00BB77 !important;
            color: #FFFFFF !important;
            border-left: 4px solid #37eba5 !important;
        }
        aside nav a[class*="bg-jade-950"] i, aside nav a[class*="bg-jade-950"] span {
            color: #FFFFFF !important;
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
            color: #002f1e !important;
            border: 1px solid #cdfae9 !important;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #00BB77 !important;
            box-shadow: 0 0 0 1px #00BB77 !important;
        }
        
        /* Botones de Acción */
        button[class*="bg-jade-600"], a[class*="bg-jade-600"], button[class*="bg-jade-800"], a[class*="bg-jade-800"] {
            background-color: #00BB77 !important;
            color: #FFFFFF !important;
        }
        button[class*="bg-jade-600"]:hover, a[class*="bg-jade-600"]:hover, button[class*="bg-jade-800"]:hover, a[class*="bg-jade-800"]:hover {
            background-color: #00a368 !important;
        }
        
        /* Modales */
        div[id^="modal-"] > div {
            background-color: #FFFFFF !important;
            border-color: #cdfae9 !important;
        }
        div[id^="modal-"] h3 {
            color: #002f1e !important;
        }
        div[id^="modal-"] label {
            color: #005d3c !important;
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
        .bg-slate-900\/50:hover {
            background-color: #e6fcf4 !important;
        }
    </style>
</head>
<body class="font-sans h-full text-slate-700 flex overflow-hidden bg-white">

    <!-- SIDEBAR -->
    <aside class="hidden lg:flex flex-col w-64 bg-vip-slate border-r border-vip-border flex-shrink-0">
        <!-- Logo Header -->
        <div class="h-20 flex items-center px-6 border-b border-vip-border">
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

            <a href="{{ route('pagos.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Route::is('pagos.*') ? 'bg-jade-950 text-jade-400 font-semibold border-l-2 border-jade-50' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                <i class="fa-solid fa-file-invoice-dollar text-base"></i>
                <span>Registro de Pagos</span>
            </a>

            <a href="{{ route('gastos.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Route::is('gastos.*') ? 'bg-jade-950 text-jade-400 font-semibold border-l-2 border-jade-50' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                <i class="fa-solid fa-receipt text-base"></i>
                <span>Registro de Gastos</span>
            </a>

            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-3 pt-6 mb-2">Páginas Web</p>
            <a href="{{ route('admin.galeria.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Route::is('admin.galeria.*') ? 'bg-jade-950 text-jade-400 font-semibold border-l-2 border-jade-50' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                <i class="fa-solid fa-camera-retro text-base"></i>
                <span>Galería Antes/Desp</span>
            </a>
            <a href="{{ route('admin.promociones.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Route::is('admin.promociones.*') ? 'bg-jade-950 text-jade-400 font-semibold border-l-2 border-jade-50' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                <i class="fa-solid fa-gift text-base"></i>
                <span>Promociones</span>
            </a>
            <a href="{{ route('inicio') }}" target="_blank" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm text-slate-400 hover:bg-slate-900 hover:text-white">
                <i class="fa-solid fa-globe text-base"></i>
                <span>Ver Sitio Público</span>
            </a>
        </nav>

        <!-- Doctor Profile Footer -->
        <div class="p-4 border-t border-vip-border bg-slate-950/40">
            <div class="flex items-center space-x-3 px-2 py-1.5 rounded-xl">
                <div class="w-9 h-9 rounded-full bg-jade-800 flex items-center justify-center text-white font-bold text-sm">
                    DM
                </div>
                <div>
                    <h5 class="text-xs font-semibold text-white">Dra. Miradent</h5>
                    <p class="text-[10px] text-slate-500">Administrador</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- ÁREA DE CONTENIDO -->
    <div class="flex-grow flex flex-col min-w-0 overflow-hidden">
        <!-- TOP NAVBAR -->
        <header class="h-20 bg-vip-slate border-b border-vip-border flex items-center justify-between px-6 lg:px-8">
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
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-xs text-slate-400 hover:text-white bg-slate-900 border border-slate-800 px-3.5 py-2 rounded-xl transition-colors">
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
    </script>
</body>
</html>
