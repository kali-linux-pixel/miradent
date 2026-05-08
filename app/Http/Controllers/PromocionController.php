<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    /**
     * Vista pública de Promociones
     */
    public function index()
    {
        $promociones = Promocion::latest()->get();
        return view('public.promociones', compact('promociones'));
    }

    /**
     * Listado administrativo de Promociones
     */
    public function adminIndex()
    {
        $promociones = Promocion::latest()->get();
        return view('admin.promociones.index', compact('promociones'));
    }

    /**
     * Almacenar una nueva promoción
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'descuento' => 'nullable|string|max:100',
            'fecha_fin' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $promocion = new Promocion();
        $promocion->titulo = $request->titulo;
        $promocion->descripcion = $request->descripcion;
        $promocion->descuento = $request->descuento;
        $promocion->fecha_fin = $request->fecha_fin;

        // Subir foto si existe
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'promo_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $promocion->foto = 'uploads/' . $filename;
        }

        $promocion->save();

        return redirect()->route('admin.promociones.index')->with('success', 'Promoción agregada correctamente.');
    }

    /**
     * Eliminar una promoción
     */
    public function destroy($id)
    {
        $promocion = Promocion::findOrFail($id);

        // Eliminar archivo físico si existe
        if ($promocion->foto && file_exists(public_path($promocion->foto))) {
            @unlink(public_path($promocion->foto));
        }

        $promocion->delete();

        return redirect()->route('admin.promociones.index')->with('success', 'Promoción eliminada correctamente.');
    }
}
