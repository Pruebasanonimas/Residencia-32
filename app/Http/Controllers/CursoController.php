<?php

namespace App\Http\Controllers;

use App\Models\CalificacionCurso;
use App\Models\Comentario;
use App\Models\Curso;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CursoController extends Controller
{
    // Mostrar la vista de todos los cursos del profesor autenticado
    public function index()
    {
        $cursos = Curso::where('profesor_id', Auth::id())->get();
        return view('cursos.index', compact('cursos'));
    }

    // Mostrar la vista de crear los cursos
    public function create()
    {
        return view('cursos.create');
    }

    // Función para guardar la vista del curso
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'estado' => 'required|boolean',
            'duracion' => ['required', 'regex:/^(\d+\s*(hora|minuto)s?(\s*\d+\s*(hora|minuto)s?)?)$/'],
            'imagen' => 'nullable|image|max:1048576',
        ], [
            'duracion.regex' => 'La duración debe tener el formato correcto, como "1 hora 30 minutos" o "120 minutos".'
        ]);

        $curso = new Curso();
        $curso->nombre = $request->nombre;
        $curso->descripcion = $request->descripcion;
        $curso->estado = $request->estado;
        $curso->duracion = $request->duracion;
        $curso->profesor_id = Auth::id();

        if ($request->hasFile('imagen')) {
            $curso->imagen = $request->file('imagen')->store('cursos_imagenes', 'public');
        }

        $curso->save();
        return redirect()->route('cursos.index')->with('success', 'Curso creado con éxito');
    }

    // Mostrar la vista del contenido del curso
    public function show($id)
    {
        $curso = Curso::with(['lecciones', 'comentarios' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'examen'])
            ->findOrFail($id);


        return view('cursos.show', compact('curso'));
    }

    // Mostrar la vista del contenido del curso para profesores
    public function showVistacurso($id)
    {

        $curso = Curso::with(['lecciones', 'comentarios' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'examen'])
            ->findOrFail($id);


        return view('cursos.vistacurso', compact('curso'));
    }

    // Mostrar la vista de editar los cursos (primera ventana)
    public function edit()
    {
        $cursos = Curso::where('profesor_id', Auth::id())->get();
        return view('cursos.edit', compact('cursos'));
    }


    // Función para actualizar el curso
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|boolean',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1048576',
        ]);

        $curso = Curso::where('id', $id)->where('profesor_id', Auth::id())->firstOrFail();
        $curso->nombre = $request->nombre;
        $curso->descripcion = $request->descripcion;
        $curso->estado = $request->estado;

        if ($request->hasFile('imagen')) {
            $curso->imagen = $request->file('imagen')->store('cursos_imagenes', 'public');
        }

        $curso->save();
        return redirect()->route('cursos.index')->with('success', 'Curso actualizado exitosamente');
    }

    // Función para guardar un comentario
    public function storeComentario(Request $request, $cursoId)
    {
        $request->validate([
            'comentario' => 'required|string|max:500',
        ]);

        $authorId = null;
        $authorType = null;

        if (Auth::check()) {
            $authorId = Auth::id();
            $authorType = 'App\Models\User'; 
        }
        elseif (Auth::guard('alumnoe')->check()) {
            $authorId = Auth::guard('alumnoe')->id();
            $authorType = 'App\Models\Alumnoe'; 
        } else {
            return redirect()->back()->withErrors(['error' => 'Debes iniciar sesión para comentar.']);
        }

        $comentario = Comentario::create([
            'comentario' => $request->comentario,
            'curso_id' => $cursoId,
            'author_id' => $authorId,
            'author_type' => $authorType,
        ]);

        if ($comentario) {
            return redirect()->back()->with('success', 'Comentario publicado.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Hubo un error al publicar el comentario.']);
        }
    }

    // Función para mostrar lecciones
    public function showLeccion($cursoId, $leccionId)
    {
        $curso = Curso::with('lecciones')->findOrFail($cursoId);
        $leccionSeleccionada = $curso->lecciones->where('id', $leccionId)->first();

        return view('cursos.show', compact('curso', 'leccionSeleccionada'));
    }

    // Función para mostrar solo la vista del curso
    public function showLeccionVistacurso($cursoId, $leccionId)
    {
        $curso = Curso::with('lecciones')->findOrFail($cursoId);
        $leccionSeleccionada = $curso->lecciones->where('id', $leccionId)->first();

        return view('cursos.vistacurso', compact('curso', 'leccionSeleccionada'));
    }


    // Mostrar la vista de todo los cursos
    public function vercursos(Request $request)
    {
        $query = Curso::query();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nombre', 'like', '%' . $search . '%');
        }
        $cursos = $query->get();

        return view('cursos.vercursos', compact('cursos'));
    }

    // Función para subir una imagen
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048576',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        return response()->json(['success' => true, 'url' => asset('images/' . $imageName)]);
    }

    // Función para guardar la calificación
    public function storeCalificacion(Request $request, $cursoId)
    {
        $request->validate([
            'estrellas' => 'required|integer|min:1|max:5',
        ]);

        $authorId = null;
        $authorType = null;

        if (Auth::check()) {
            $authorId = Auth::id(); 
            $authorType = 'App\Models\User'; 
        }
        elseif (Auth::guard('alumnoe')->check()) {
            $authorId = Auth::guard('alumnoe')->id(); 
            $authorType = 'App\Models\Alumnoe'; 
        } else {
            return redirect()->back()->withErrors(['error' => 'Debes iniciar sesión para calificar.']);
        }

        $calificacionExistente = CalificacionCurso::where('curso_id', $cursoId)
            ->where('author_id', $authorId)
            ->where('author_type', $authorType)
            ->first();

        if ($calificacionExistente) {
            return redirect()->route('cursos.show', $cursoId)->with('error', 'Ya has calificado este curso.');
        }

        CalificacionCurso::create([
            'curso_id' => $cursoId,
            'estrellas' => $request->input('estrellas'),
            'author_id' => $authorId,
            'author_type' => $authorType,
        ]);

        return redirect()->route('cursos.show', $cursoId)->with('success', 'Calificación guardada exitosamente.');
    }

    // Función para crear inscripciones
    public function alumnosInscritos($id)
    {
        $curso = Curso::findOrFail($id);
        $alumnos = $curso->alumnos;
        return view('cursos.alumnosinscritos', compact('curso', 'alumnos'));
    }

    // Función para actualizar estado
    public function updateEstado($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->estado = $curso->estado == 1 ? 0 : 1; // Cambia el estado entre 1 (activo) y 0 (inactivo)
        $curso->save();

        return redirect()->route('cursos.edit', $curso->id)->with('success', 'Estado del curso actualizado');
    }

    // Función función para eliminar un curso
    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();

        return redirect()->route('cursos.index')->with('success', 'Curso eliminado con éxito.');
    }

    // Mostrar la vista de los cursos para alumnos no inscritos
    public function showSOLOvista($id)
    {
        $curso = Curso::with(['lecciones', 'comentarios' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'examen'])
            ->findOrFail($id);

        return view('cursos.solovistacurso', compact('curso'));
    }

    // Función para la vista de editar curso
    public function editacurso($id)
    {
        $curso = Curso::findOrFail($id);
        return view('cursos.editacurso', compact('curso'));
    }


    // Función para la vista de editar examen
    public function editarExamen($id)
    {
        $curso = Curso::findOrFail($id);
        return view('exam.editarExamen', compact('curso'));
    }

    //Mostrar el formulario de edición
    public function editvistacurso(Curso $curso)
    {
        return view('cursos.editarvistacurso', compact('curso'));
    }
    
    // Función para editar la vista de un curso
    public function updatevistacurso(Request $request, Curso $curso)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'estado' => 'required|boolean',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1048576',
        ]);

        $curso->update($request->only(['nombre', 'descripcion', 'estado']));

        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('cursos', 'public');
            $curso->imagen = $imagenPath;
            $curso->save();
        }

        return redirect()->route('home')->with('success', 'Curso actualizado correctamente');
    }

    // Mostrar la vista de mostrar la lección para alumnos
    public function showLeccionvista($cursoId, $leccionId)
    {
        $curso = Curso::with('lecciones')->findOrFail($cursoId);
        $leccionSeleccionada = $curso->lecciones->where('id', $leccionId)->first();

        return view('cursos.solovistacurso', compact('curso', 'leccionSeleccionada'));
    }

    // Mostrar la vista de añadir preguntas
    public function showAddQuestionsForm(Exam $exam)
{
    $curso = $exam->curso;
    return view('exams.addQuestions', compact('exam', 'curso'));
}

}
