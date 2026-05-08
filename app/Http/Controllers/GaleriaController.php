<?php

namespace App\Http\Controllers;

use App\Models\Galeria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriaController extends Controller
{
    /**
     * Vista pública de la Galería de Antes y Después
     */
    public function index()
    {
        $casos = Galeria::latest()->get();
        return view('public.galeria', compact('casos'));
    }

    /**
     * Listado administrativo de Casos de Éxito
     */
    public function adminIndex()
    {
        $casos = Galeria::latest()->get();
        return view('admin.galeria.index', compact('casos'));
    }

    /**
     * Almacenar un nuevo Caso Clínico
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'foto_antes' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'foto_despues' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $galeria = new Galeria();
        $galeria->titulo = $request->titulo;
        $galeria->descripcion = $request->descripcion;

        // Subir Foto Principal / Antes
        if ($request->hasFile('foto_antes')) {
            $fileBefore = $request->file('foto_antes');
            $filenameBefore = 'antes_' . time() . '_' . uniqid() . '.' . $fileBefore->getClientOriginalExtension();
            $fileBefore->move(public_path('uploads'), $filenameBefore);
            $galeria->foto_antes = 'uploads/' . $filenameBefore;
        }

        // Subir Foto Después (Opcional)
        if ($request->hasFile('foto_despues')) {
            $fileAfter = $request->file('foto_despues');
            $filenameAfter = 'despues_' . time() . '_' . uniqid() . '.' . $fileAfter->getClientOriginalExtension();
            $fileAfter->move(public_path('uploads'), $filenameAfter);
            $galeria->foto_despues = 'uploads/' . $filenameAfter;
        } else {
            $galeria->foto_despues = null;
        }

        $galeria->save();

        return redirect()->route('admin.galeria.index')->with('success', 'Foto agregada a la galería correctamente.');
    }

    /**
     * Eliminar un caso de la galería
     */
    public function destroy($id)
    {
        $caso = Galeria::findOrFail($id);

        // Eliminar archivos físicos si existen
        if ($caso->foto_antes && file_exists(public_path($caso->foto_antes))) {
            @unlink(public_path($caso->foto_antes));
        }
        if ($caso->foto_despues && file_exists(public_path($caso->foto_despues))) {
            @unlink(public_path($caso->foto_despues));
        }

        $caso->delete();

        return redirect()->route('admin.galeria.index')->with('success', 'Caso clínico eliminado de la galería.');
    }
}
