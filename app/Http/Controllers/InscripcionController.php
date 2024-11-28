<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Inscripcion;


class InscripcionController extends Controller
{   
    // Función para inscribir a un alumno a un curso
    public function inscribir($cursoId)
    {
        $alumno = auth()->guard('alumnoe')->user();

        if (!$alumno) {
            return redirect()->back()->with('error', 'No tienes permisos para inscribirte.');
        }

        $curso = Curso::find($cursoId);

        if ($curso->estado == 0) {
            return redirect()->back()->with('error', 'Este curso está inactivo y no puedes inscribirte.');
        }

        $yaInscrito = Inscripcion::where('curso_id', $cursoId)
            ->where('alumno_id', $alumno->id)
            ->exists();

        if ($yaInscrito) {
            return redirect()->back()->with('error', 'Ya estás inscrito en este curso.');
        }

        Inscripcion::create([
            'curso_id' => $cursoId,
            'alumno_id' => $alumno->id,
        ]);

        return redirect()->route('cursos.inscripciones')->with('success', 'Te has inscrito al curso exitosamente.');
    }


    // Muestra la vista de los cursos a los que está subscrito el alumno
    public function index()
    {
        $alumno = auth()->guard('alumnoe')->user();

        if (!$alumno) {
            return redirect()->route('login')->with('error', 'Por favor inicia sesión para ver tus inscripciones.');
        }

        $inscripciones = Inscripcion::where('alumno_id', $alumno->id)
            ->with('curso')
            ->get();

        return view('cursos.inscripciones', compact('inscripciones'));
    }

    // Función para eliminar la subscrición al curso
    public function eliminar($cursoId)
    {
        $alumno = auth()->guard('alumnoe')->user();

        if (!$alumno) {
            return redirect()->route('login')->with('error', 'Por favor inicia sesión para eliminar la inscripción.');
        }

        $inscripcion = Inscripcion::where('curso_id', $cursoId)
            ->where('alumno_id', $alumno->id)
            ->first();

        if (!$inscripcion) {
            return redirect()->route('cursos.inscripciones')->with('error', 'No estás inscrito en este curso.');
        }

        $inscripcion->delete();

        return redirect()->route('cursos.inscripciones')->with('success', 'Te has desinscrito del curso exitosamente.');
    }
}
