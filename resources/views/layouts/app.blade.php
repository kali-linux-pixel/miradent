<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Miradent') | Clínica Odontológica Premium</title>
    <meta name="description" content="En Miradent ofrecemos servicios odontológicos de la más alta calidad con tecnología de vanguardia y profesionales dedicados a diseñar tu sonrisa.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome para Iconos -->
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
                        luxury: {
                            gold: '#C5A880',
                            goldLight: '#DFD3C3',
                            charcoal: '#1A2321',
                            cream: '#FCFBF7'
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
        .glass-navbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="font-sans bg-white text-slate-800 flex flex-col min-h-screen">

    <!-- Header / Navbar Premium -->
    <header class="glass-navbar sticky top-0 z-50 border-b border-jade-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logotipo -->
                <a href="{{ route('inicio') }}" class="flex items-center group">
                    <img src="{{ asset('img/logo.png') }}" class="h-16 w-auto object-contain group-hover:scale-105 transition-transform duration-300" alt="Miradent Logo">
                </a>

                <!-- Navegación Escritorio -->
                <nav class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('inicio') }}" class="text-sm font-medium transition-colors hover:text-jade-500 {{ Route::is('inicio') ? 'text-jade-500 font-bold' : 'text-slate-600' }}">
                        Inicio
                    </a>
                    <a href="{{ route('inicio') }}#sobre-nosotros" class="text-sm font-medium transition-colors hover:text-jade-500 text-slate-600">
                        Sobre Nosotros
                    </a>
                    <a href="{{ route('servicios') }}" class="text-sm font-medium transition-colors hover:text-jade-500 {{ Route::is('servicios') ? 'text-jade-500 font-bold' : 'text-slate-600' }}">
                        Servicios
                    </a>
                    <a href="{{ route('galeria') }}" class="text-sm font-medium transition-colors hover:text-jade-500 {{ Route::is('galeria') ? 'text-jade-500 font-bold' : 'text-slate-600' }}">
                        Galería
                    </a>
                    <a href="{{ route('promociones') }}" class="text-sm font-medium transition-colors hover:text-jade-500 {{ Route::is('promociones') ? 'text-jade-500 font-bold' : 'text-slate-600' }}">
                        Promociones
                    </a>
                    <a href="{{ route('calculadora') }}" class="text-sm font-medium transition-colors hover:text-jade-500 {{ Route::is('calculadora') ? 'text-jade-500 font-bold' : 'text-slate-600' }}">
                        Calculadora
                    </a>
                    <a href="{{ route('contacto') }}" class="text-sm font-medium transition-colors hover:text-jade-500 {{ Route::is('contacto') ? 'text-jade-500 font-bold' : 'text-slate-600' }}">
                        Contacto
                    </a>

                    <a href="https://wa.me/51948097148?text=Hola,%20me%20gustaría%20agendar%20una%20cita%20en%20Miradent" target="_blank" class="bg-jade-500 text-white px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-jade-600 transition-all shadow-md shadow-jade-500/10 hover:shadow-lg hover:-translate-y-0.5">
                        <i class="fa-brands fa-whatsapp mr-2 text-lg"></i>Reservar Cita
                    </a>
                </nav>

                <!-- Botón de Menú Móvil -->
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg text-slate-600 hover:text-jade-500 hover:bg-jade-50 focus:outline-none">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Menú Móvil -->
        <div id="mobile-menu" class="hidden md:hidden bg-white/95 border-b border-jade-100 backdrop-blur-md">
            <div class="px-4 pt-2 pb-6 space-y-3">
                <a href="{{ route('inicio') }}" class="block px-3 py-2 rounded-lg text-base font-medium hover:bg-jade-50 hover:text-jade-500 {{ Route::is('inicio') ? 'bg-jade-50 text-jade-500 font-bold' : 'text-slate-600' }}">
                    Inicio
                </a>
                <a href="{{ route('inicio') }}#sobre-nosotros" class="block px-3 py-2 rounded-lg text-base font-medium hover:bg-jade-50 hover:text-jade-500 text-slate-600">
                    Sobre Nosotros
                </a>
                <a href="{{ route('servicios') }}" class="block px-3 py-2 rounded-lg text-base font-medium hover:bg-jade-50 hover:text-jade-500 {{ Route::is('servicios') ? 'bg-jade-50 text-jade-500 font-bold' : 'text-slate-600' }}">
                    Servicios
                </a>
                <a href="{{ route('galeria') }}" class="block px-3 py-2 rounded-lg text-base font-medium hover:bg-jade-50 hover:text-jade-500 {{ Route::is('galeria') ? 'bg-jade-50 text-jade-500 font-bold' : 'text-slate-600' }}">
                    Galería
                </a>
                <a href="{{ route('promociones') }}" class="block px-3 py-2 rounded-lg text-base font-medium hover:bg-jade-50 hover:text-jade-500 {{ Route::is('promociones') ? 'bg-jade-50 text-jade-500 font-bold' : 'text-slate-600' }}">
                    Promociones
                </a>
                <a href="{{ route('calculadora') }}" class="block px-3 py-2 rounded-lg text-base font-medium hover:bg-jade-50 hover:text-jade-500 {{ Route::is('calculadora') ? 'bg-jade-50 text-jade-500 font-bold' : 'text-slate-600' }}">
                    Calculadora
                </a>
                <a href="{{ route('contacto') }}" class="block px-3 py-2 rounded-lg text-base font-medium hover:bg-jade-50 hover:text-jade-500 {{ Route::is('contacto') ? 'bg-jade-50 text-jade-500 font-bold' : 'text-slate-600' }}">
                    Contacto
                </a>

                <div class="pt-2">
                    <a href="https://wa.me/51948097148?text=Hola,%20me%20gustaría%20agendar%20una%20cita%20en%20Miradent" target="_blank" class="w-full flex items-center justify-center bg-jade-500 text-white px-4 py-3 rounded-xl text-base font-semibold hover:bg-jade-600 transition-all">
                        <i class="fa-brands fa-whatsapp mr-2 text-xl"></i> Reservar por WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Premium - Blanco y Verde Jade -->
    <footer class="bg-white text-slate-600 border-t border-jade-100 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <!-- Columna 1: Info General -->
                <div class="md:col-span-1.5 space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-jade-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-jade-500/10">
                            <i class="fa-solid fa-tooth text-lg"></i>
                        </div>
                        <span class="text-2xl font-serif font-bold tracking-wide text-slate-900">
                            Miradent
                        </span>
                    </div>
                    <p class="text-sm text-slate-500 max-w-xs">
                        Diseñando sonrisas de lujo con los más altos estándares de calidad, ética y tecnología dental.
                    </p>
                    <div class="flex space-x-4 pt-2">
                        <a href="#" class="w-9 h-9 rounded-full bg-jade-50 flex items-center justify-center text-jade-600 hover:bg-jade-500 hover:text-white transition-colors border border-jade-100">
                            <i class="fa-brands fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full bg-jade-50 flex items-center justify-center text-jade-600 hover:bg-jade-500 hover:text-white transition-colors border border-jade-100">
                            <i class="fa-brands fa-instagram text-sm"></i>
                        </a>
                        <a href="https://wa.me/51948097148" target="_blank" class="w-9 h-9 rounded-full bg-jade-50 flex items-center justify-center text-jade-600 hover:bg-jade-500 hover:text-white transition-colors border border-jade-100">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                        </a>
                    </div>
                </div>

                <!-- Columna 2: Enlaces Rápidos -->
                <div>
                    <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4">Enlaces Rápidos</h4>
                    <ul class="space-y-2.5 text-sm text-slate-600">
                        <li><a href="{{ route('inicio') }}" class="hover:text-jade-500 transition-colors">Inicio</a></li>
                        <li><a href="{{ route('servicios') }}" class="hover:text-jade-500 transition-colors">Servicios</a></li>
                        <li><a href="{{ route('contacto') }}" class="hover:text-jade-500 transition-colors">Contacto</a></li>
                    </ul>
                </div>

                <!-- Columna 3: Servicios -->
                <div>
                    <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4">Tratamientos</h4>
                    <ul class="space-y-2.5 text-sm text-slate-600">
                        <li><span class="hover:text-jade-500 cursor-pointer">Limpieza Dental Profesional</span></li>
                        <li><span class="hover:text-jade-500 cursor-pointer">Ortodoncia Avanzada</span></li>
                        <li><span class="hover:text-jade-500 cursor-pointer">Implantes Dentales VIP</span></li>
                        <li><span class="hover:text-jade-500 cursor-pointer">Diseño de Sonrisa</span></li>
                    </ul>
                </div>

                <!-- Columna 4: Ubicación y Contacto -->
                <div>
                    <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4">Contacto</h4>
                    <ul class="space-y-3.5 text-sm">
                        <li class="flex items-start space-x-3 text-slate-600">
                            <i class="fa-solid fa-location-dot mt-1 text-jade-500"></i>
                            <span>Av. Principal 123, Miraflores, Lima</span>
                        </li>
                        <li class="flex items-center space-x-3 text-slate-600">
                            <i class="fa-solid fa-phone text-jade-500"></i>
                            <span>+51 948 097 148</span>
                        </li>
                        <li class="flex items-center space-x-3 text-slate-600">
                            <i class="fa-solid fa-envelope text-jade-500"></i>
                            <span>contacto@miradent.pe</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-jade-50 pt-8 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-400">
                <p>&copy; {{ date('Y') }} Miradent. Todos los derechos reservados.</p>
                <p class="mt-2 sm:mt-0">Diseño y desarrollo exclusivo para Dra. Pamela Miranda</p>
            </div>
        </div>
    </footer>

    <!-- Botón Flotante de WhatsApp -->
    <a href="https://wa.me/51948097148?text=Hola,%20me%20gustaría%20agendar%20una%20cita%20en%20Miradent" target="_blank" class="fixed bottom-6 right-6 z-50 bg-[#25D366] text-white w-14 h-14 rounded-full flex items-center justify-center shadow-2xl hover:bg-[#20ba5a] hover:scale-110 transition-all duration-300 group" aria-label="Contacto por WhatsApp">
        <i class="fa-brands fa-whatsapp text-3xl"></i>
        <span class="absolute right-16 bg-white text-slate-800 font-semibold px-3 py-1 rounded-lg text-sm shadow-md whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300 border border-slate-100">
            ¿Cómo te ayudamos?
        </span>
    </a>

    <!-- Lógica de Menú Móvil -->
    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            const icon = btn.querySelector('i');
            if (menu.classList.contains('hidden')) {
                icon.className = 'fa-solid fa-bars text-xl';
            } else {
                icon.className = 'fa-solid fa-xmark text-xl';
            }
        });
    </script>
</body>
</html>
