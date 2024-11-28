<?php

namespace App\Http\Controllers;

use App\Models\Carrusel;
use App\Models\InformacionPagina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    // Mostrar la página principal
    public function index()
    {
        $imagenes = Carrusel::all();
        $informacion = InformacionPagina::first();
        return view('alumno.principal', compact('imagenes', 'informacion'));
    }

    // Función para crear nuevo contenido de cero
    public function create()
    {
        $informacion = InformacionPagina::first();
        if ($informacion) {
            return redirect()->route('alumno.editarmenu')->with('error', 'El contenido ya existe. Edítalo en lugar de crear nuevo.');
        }
        return view('alumno.crearmenu');
    }

    // Función para guardar el contenido inicial
    public function store(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:1048576',
            'titulo' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'contenido' => 'required',
        ]);

        $path = $request->file('imagen')->store('carrusel', 'public');

        Carrusel::create([
            'imagen' => $path,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
        ]);

        InformacionPagina::create([
            'contenido' => $request->contenido,
        ]);

        return redirect()->route('home')->with('success', 'Contenido creado con éxito.');
    }

    // Mostrar la vista de editar la página principal
    public function edit()
    {
        $informacion = InformacionPagina::first();

        if (!$informacion) {
            return redirect()->route('alumno.crearmenu');
        }

        $imagenes = Carrusel::all();
        return view('alumno.editarmenu', compact('imagenes', 'informacion'));
    }


    // Función para actualizar el contenido
    public function update(Request $request)
    {
        $request->validate([
            'contenido' => 'required',
        ]);

        $informacion = InformacionPagina::first();
        $informacion->update(['contenido' => $request->contenido]);

        return redirect()->route('alumno.vistamenu')->with('success', 'Contenido actualizado con éxito.');
    }


    // Función para agregar nuevas imagnes al carussel
    public function addImagen(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:1048576',
            'titulo' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $path = $request->file('imagen')->store('carrusel', 'public');

        Carrusel::create([
            'imagen' => $path,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('alumno.editarmenu')->with('success', 'Imagen agregada con éxito.');
    }

    // Función para eliminar imagenes del carrusel
    public function deleteImagen($id)
    {
        $imagen = Carrusel::findOrFail($id);

        Storage::disk('public')->delete($imagen->imagen);

        $imagen->delete();

        return redirect()->route('alumno.editarmenu')->with('success', 'Imagen eliminada con éxito.');
    }

    // Función para mostrar el menú de alumnos para profesores
    public function vistaMenu()
    {
        $imagenes = Carrusel::all(); 
        $informacion = InformacionPagina::first();
        return view('alumno.vistamenu', compact('imagenes', 'informacion'));
    }
}
