<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    // Mostrar el formulario para crear una noticia
    public function create()
    {
        return view('crearnoticia');
    }

    // Guardar la noticia en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'cuerpo' => 'required',
            'imagen' => 'required|image',
            'autor' => 'required|string',
            'foto_perfil' => 'nullable|image',
        ]);

        $path = $request->file('imagen')->store('imagenes', 'public');

        $rutaFotoPerfil = $request->file('foto_perfil')
            ? $request->file('foto_perfil')->store('fotos_perfil', 'public')
            : null;

        Noticia::create([
            'cuerpo' => $request->input('cuerpo'),
            'imagen' => $path,
            'autor' => $request->input('autor'),
            'foto_perfil' => $rutaFotoPerfil,
        ]);

        return redirect()->route('editarnoticia')->with('success', 'Noticia creada con éxito.');
    }


    // Mostrar todas las noticias
    public function index()
    {
        $noticias = Noticia::orderBy('created_at', 'desc')->get();
        return view('vernoticia', compact('noticias'));
    }

    // Mostrar la vista de edición de noticias
    public function edit()
    {
        $noticias = Noticia::all();

        return view('editarnoticia', compact('noticias'));
    }

    // Función para destruir una noticia
    public function destroy($id)
    {
        $noticia = Noticia::findOrFail($id);

        $noticia->delete();

        return redirect()->route('editarnoticia')->with('success', 'Noticia eliminada con éxito');
    }

    // Mostrar el formulario de edición para una noticia específica
    public function editForm($id)
    {
        $noticia = Noticia::findOrFail($id);

        return view('editarnoticiaform', compact('noticia'));
    }

    // Función para Actualizar la noticia en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'cuerpo' => 'required',
            'imagen' => 'nullable|image',
            'autor' => 'required|string',
            'foto_perfil' => 'nullable|image',
        ]);

        $noticia = Noticia::findOrFail($id);

        if ($request->hasFile('imagen')) {
            if ($noticia->imagen) {
                Storage::delete('public/' . $noticia->imagen);
            }
            $pathImagen = $request->file('imagen')->store('imagenes_noticias', 'public');
            $noticia->imagen = $pathImagen;
        }

        if ($request->hasFile('foto_perfil')) {
            if ($noticia->foto_perfil) {
                Storage::delete('public/' . $noticia->foto_perfil);
            }
            $pathFotoPerfil = $request->file('foto_perfil')->store('fotos_perfil', 'public');
            $noticia->foto_perfil = $pathFotoPerfil;
        }

        $noticia->update([
            'cuerpo' => $request->input('cuerpo'),
            'autor' => $request->input('autor'),
        ]);

        $noticia->save();

        return redirect()->route('vistanoticias')->with('success', 'Noticia actualizada con éxito.');
    }


    // Función para guardar un video
    public function uploadVideo(Request $request)
    {
        if ($request->hasFile('video')) {
            $request->validate([
                'video' => 'mimes:mp4,avi,mov,wmv|max:20000'
            ]);

            $videoPath = $request->file('video')->store('videos', 'public');

            return response()->json(['url' => Storage::url($videoPath)]);
        }

        return response()->json(['error' => 'Error al subir el video'], 400);
    }

    // Función para dar like
    public function like($id, Request $request)
    {
        $noticia = Noticia::findOrFail($id);

        $alumnoeId = $request->input('alumnoe_id'); 

        $noticia->likes_count = $noticia->likes_count + 1;
        $noticia->save();

        return response()->json([
            'likes' => $noticia->likes_count
        ]);
    }


    // Mostrar la noticia especifica
    public function show($id)
    {
        $noticia = Noticia::findOrFail($id);
        return view('noticias.show', compact('noticia'));
    }

    public function vistaNoticias()
    {
        $noticias = Noticia::orderBy('created_at', 'desc')->get(); 
        return view('vistanoticias', compact('noticias'));
    }

    public function vistaNoticiaProfesor($id)
    {
        $noticia = Noticia::findOrFail($id); 
        return view('vistanoticiasprofesor', compact('noticia'));
    }
}
