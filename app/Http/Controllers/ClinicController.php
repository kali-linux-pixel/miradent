<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClinicController extends Controller
{
    /**
     * Muestra la página de inicio pública.
     */
    public function inicio()
    {
        return view('public.inicio');
    }

    /**
     * Muestra la página de servicios públicos.
     */
    public function servicios()
    {
        return view('public.servicios');
    }

    /**
     * Muestra la página de contacto pública.
     */
    public function contacto()
    {
        return view('public.contacto');
    }
}
