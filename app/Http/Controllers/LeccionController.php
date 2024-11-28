<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Leccion;
use Illuminate\Http\Request;

class LeccionController extends Controller
{
    // Mostrar la vista para crear una nueva lección en un curso específico
    public function create($cursoId)
    {
        $curso = Curso::findOrFail($cursoId); 
        return view('cursos.lecciones.create', compact('curso'));
    }

    // Función para guardar la lección en la base de datos
    public function store(Request $request, $cursoId)
    {
        $request->validate([
            'titulo' => 'required|string|max:3000',
            'contenido' => 'required|string',
        ]);

        $leccion = new Leccion();
        $leccion->curso_id = $cursoId;
        $leccion->titulo = $request->titulo;
        $leccion->contenido = $request->contenido;
        $leccion->save();

        return redirect()->route('cursos.vistacurso', ['id' => $cursoId])
            ->with('success', 'Lección creada correctamente.');
    }

    // Función para eliminar una lección
    public function destroy($id)
    {
        $leccion = Leccion::findOrFail($id);
        $cursoId = $leccion->curso_id; 
        $leccion->delete();
        return redirect()->route('lecciones.listar', $cursoId)
            ->with('success', 'Lección eliminada correctamente.');
    }

    // Mostrar la lista de lecciones para un curso
    public function listarLecciones($cursoId)
    {
        $curso = Curso::findOrFail($cursoId); 
        $lecciones = Leccion::where('curso_id', $cursoId)->get(); 

        return view('cursos.eliminalecciones', compact('curso', 'lecciones'));
    }

    // Función para editar una lección (pruebas)
    public function edit($id)
    {
        $curso = Curso::findOrFail($id);
        return view('cursos.edit', compact('curso'));
    }
}
