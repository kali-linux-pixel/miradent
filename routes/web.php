<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\HistorialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rutas Públicas de la Clínica Dental Miradent
Route::get('/', [ClinicController::class, 'inicio'])->name('inicio');
Route::get('/servicios', [ClinicController::class, 'servicios'])->name('servicios');
Route::get('/contacto', [ClinicController::class, 'contacto'])->name('contacto');
Route::get('/galeria', [GaleriaController::class, 'index'])->name('galeria');
Route::get('/promociones', [PromocionController::class, 'index'])->name('promociones');
Route::get('/calculadora', function() { return view('public.calculadora'); })->name('calculadora');

// Rutas de Autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas Administrativas Protegidas con Middleware 'auth'
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('pacientes', PacienteController::class);
    Route::resource('citas', CitaController::class);
    Route::resource('pagos', PagoController::class);
    Route::resource('gastos', GastoController::class);
    
    // Rutas de la Galería Antes/Después
    Route::get('/galeria', [GaleriaController::class, 'adminIndex'])->name('admin.galeria.index');
    Route::post('/galeria', [GaleriaController::class, 'store'])->name('admin.galeria.store');
    Route::delete('/galeria/{id}', [GaleriaController::class, 'destroy'])->name('admin.galeria.destroy');

    // Rutas de Promociones
    Route::get('/promociones', [PromocionController::class, 'adminIndex'])->name('admin.promociones.index');
    Route::post('/promociones', [PromocionController::class, 'store'])->name('admin.promociones.store');
    Route::delete('/promociones/{id}', [PromocionController::class, 'destroy'])->name('admin.promociones.destroy');

    // Rutas de Historial Clínico y Recetario Digital
    Route::get('/pacientes/{id}/historial', [HistorialController::class, 'getHistorial'])->name('admin.pacientes.historial');
    Route::post('/pacientes/historial', [HistorialController::class, 'store'])->name('admin.pacientes.historial.store');
    Route::post('/pacientes/receta', [HistorialController::class, 'generarReceta'])->name('admin.pacientes.receta');
});
