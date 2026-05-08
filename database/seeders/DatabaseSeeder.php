<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Galeria;
use App\Models\Promocion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear la cuenta administrativa única para C.D. Pamela Miranda
        User::updateOrCreate(
            ['email' => 'miradent@gmail.com'],
            [
                'name' => 'C.D. Pamela Miranda',
                'password' => Hash::make('admin'), // Contraseña por defecto: admin
            ]
        );

        // Seeder de casos clínicos (Galería de Antes y Después)
        Galeria::updateOrCreate(
            ['titulo' => 'Diseño de Sonrisa Completo'],
            [
                'descripcion' => 'Caso clínico premium de ortodoncia invisible combinado con carillas estéticas de porcelana.',
                'foto_antes' => 'https://images.unsplash.com/photo-1516205651411-aef33a44f7c2?auto=format&fit=crop&q=80&w=400',
                'foto_despues' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&q=80&w=400'
            ]
        );

        Galeria::updateOrCreate(
            ['titulo' => 'Blanqueamiento Clínico'],
            [
                'descripcion' => 'Aclaramiento de 4 tonos en una sola sesión clínica utilizando gel activado por luz LED.',
                'foto_antes' => 'https://images.unsplash.com/photo-1606811971618-4486d14f3f99?auto=format&fit=crop&q=80&w=400',
                'foto_despues' => 'https://images.unsplash.com/photo-1598256989800-fe5f95da9787?auto=format&fit=crop&q=80&w=400'
            ]
        );

        // Seeder de Promociones
        Promocion::updateOrCreate(
            ['titulo' => 'Campaña Sonrisa Brillante 2x1'],
            [
                'descripcion' => 'Ven con un familiar o amigo y llévense una Limpieza Dental Ultrasónica completa pagando solo uno. ¡Incluye fluorización!',
                'descuento' => '2x1 Especial',
                'fecha_fin' => 'Válido hasta fin de mes',
                'foto' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&q=80&w=600'
            ]
        );

        Promocion::updateOrCreate(
            ['titulo' => '30% OFF en Ortodoncia Invisible'],
            [
                'descripcion' => 'Inicia tu tratamiento de alineadores invisibles este mes y obtén un 30% de descuento directo en tu cuota inicial. ¡Evaluación 100% gratuita!',
                'descuento' => '30% Descuento',
                'fecha_fin' => 'Cupos limitados',
                'foto' => 'https://images.unsplash.com/photo-1598256989800-fe5f95da9787?auto=format&fit=crop&q=80&w=600'
            ]
        );
    }
}
