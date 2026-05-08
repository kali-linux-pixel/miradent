<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Miradent VIP Admin</title>
    
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
        html, body {
            background-color: #FFFFFF !important;
            color: #002f1e !important;
        }
        .bg-vip-panel {
            background-color: #FFFFFF !important;
            border: 1px solid #e6fcf4 !important;
            box-shadow: 0 20px 40px -15px rgba(0, 187, 119, 0.12) !important;
        }
        h2 {
            color: #002f1e !important;
        }
        label, p, span {
            color: #005d3c !important;
        }
        input {
            background-color: #FFFFFF !important;
            color: #002f1e !important;
            border: 1px solid #cdfae9 !important;
        }
        input:focus {
            border-color: #00BB77 !important;
            box-shadow: 0 0 0 1px #00BB77 !important;
        }
        button[type="submit"] {
            background-color: #00BB77 !important;
            color: #FFFFFF !important;
        }
        button[type="submit"]:hover {
            background-color: #00a368 !important;
        }
    </style>
</head>
<body class="font-sans h-full bg-white flex items-center justify-center relative overflow-hidden px-4">

    <!-- Fondo de login real subido por el usuario -->
    <div class="absolute inset-0 z-0 opacity-10">
        <img src="{{ asset('img/Fondo-Logo-Login.png') }}" class="w-full h-full object-cover pointer-events-none" alt="Fondo Clínico">
    </div>

    <!-- Círculos decorativos premium en segundo plano -->
    <div class="absolute -left-20 -top-20 w-[450px] h-[450px] bg-jade-700/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -right-20 -bottom-20 w-[450px] h-[450px] bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Contenedor Principal Lujoso (Glassmorphism) -->
    <div class="w-full max-w-md bg-white border border-jade-100 p-8 sm:p-10 rounded-[2.5rem] shadow-2xl relative z-10 space-y-8">
        
        <!-- Cabecera / Identidad -->
        <div class="text-center space-y-3">
            <div class="mx-auto w-24 h-24 flex items-center justify-center">
                <img src="{{ asset('img/logo.png') }}" class="w-full h-full object-contain" alt="Miradent Logo">
            </div>
            <h2 class="text-3xl font-serif font-bold text-slate-900 tracking-wide">Miradent <span class="text-jade-600 font-sans text-xs uppercase font-bold tracking-widest block mt-1">Acceso VIP</span></h2>
            <p class="text-slate-500 text-xs font-medium">Exclusivo para la Dra. Pamela Miranda</p>
        </div>

        <!-- Alertas de Sesión -->
        @if(session('success'))
            <div class="bg-jade-950/80 border border-jade-500/30 text-jade-400 p-3 rounded-xl flex items-center space-x-2 text-xs">
                <i class="fa-solid fa-circle-check text-sm"></i>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-950/60 border border-red-500/20 text-red-400 p-3 rounded-xl text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <p class="flex items-center"><i class="fa-solid fa-circle-exclamation mr-2 text-sm"></i> {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Formulario -->
        <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Campo Email -->
            <div class="space-y-2">
                <label for="email" class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Correo Electrónico</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-500">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full bg-slate-900/60 border border-vip-border text-slate-200 text-sm rounded-2xl pl-10 pr-4 py-3.5 focus:outline-none focus:border-jade-600 focus:ring-1 focus:ring-jade-600 transition-all" placeholder="ejemplo@miradent.pe">
                </div>
            </div>

            <!-- Campo Password -->
            <div class="space-y-2">
                <label for="password" class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Contraseña</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-500">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" id="password" name="password" required class="w-full bg-slate-900/60 border border-vip-border text-slate-200 text-sm rounded-2xl pl-10 pr-4 py-3.5 focus:outline-none focus:border-jade-600 focus:ring-1 focus:ring-jade-600 transition-all" placeholder="••••••••">
                </div>
            </div>

            <!-- Recordar sesión -->
            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center space-x-2 text-slate-400 cursor-pointer">
                    <input type="checkbox" name="remember" class="accent-jade-600 rounded">
                    <span>Recordar sesión</span>
                </label>
                <a href="{{ route('inicio') }}" class="text-jade-400 hover:text-jade-300 transition-colors">Volver a la web</a>
            </div>

            <!-- Botón de Envío -->
            <button type="submit" class="w-full bg-jade-600 text-white font-bold py-4 rounded-2xl hover:bg-jade-500 transition-all shadow-lg shadow-jade-600/10 hover:shadow-jade-600/20">
                Ingresar al Panel <i class="fa-solid fa-right-to-bracket ml-2"></i>
            </button>
        </form>
    </div>

</body>
</html>
