<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use App\Models\ResultadoExamen;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    // Función para crear el examen
    public function create($cursoId)
    {
        $curso = Curso::with('exams')->findOrFail($cursoId);

        // Verificar si ya hay un examen creado
        if ($curso->exams->isNotEmpty()) {
            return redirect()->route('cursos.edit', $cursoId)
                ->with('error', 'Ya existe un examen para este curso. Puedes editar o eliminar el existente.');
        }

        return view('exams.create', compact('curso'));
    }

    // Función para guardar el examen en la base de datos
    public function store(Request $request, $cursoId)
    {
        $curso = Curso::with('exams')->findOrFail($cursoId);

        if ($curso->exams->isNotEmpty()) {
            return redirect()->route('cursos.edit', $cursoId)
                ->with('error', 'No puedes crear más de un examen para este curso.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'required|array',
        ]);

        $exam = new Exam();
        $exam->curso_id = $cursoId;
        $exam->title = $request->title;
        $exam->save();

        foreach ($request->questions as $question) {
            $newQuestion = $exam->questions()->create([
                'question_text' => $question['text'],
            ]);

            foreach ($question['answers'] as $answer) {
                $newQuestion->answers()->create([
                    'answer_text' => $answer['text'],
                    'is_correct' => isset($answer['is_correct']),
                ]);
            }
        }

        return redirect()->route('cursos.edit', $cursoId)
            ->with('success', 'Examen creado correctamente.');
    }


    // Muestra la vista del examen
    public function show($id)
    {
        $exam = Exam::with('questions.answers')->findOrFail($id);
        return view('exams.show', compact('exam'));
    }

    // Función para cargar bien los resultados
    public function submit(Request $request, $examId)
    {
        $exam = Exam::with('questions.answers')->findOrFail($examId);
        $curso = $exam->curso; 
        $alumnoId = auth('alumnoe')->id();
    

        $resultadoExistente = ResultadoExamen::where('alumno_id', $alumnoId)
            ->where('exam_id', $examId)
            ->first();
    
        if ($resultadoExistente) {
            return redirect()->route('exams.show', $examId)
                ->with('error', 'Ya has resuelto este examen.');
        }
    
        $score = 0;
        $total = $exam->questions->count();
    
        foreach ($exam->questions as $question) {
            $correctAnswer = $question->answers->where('is_correct', true)->first();
            if ($correctAnswer && isset($request->answers[$question->id]) && $request->answers[$question->id] == $correctAnswer->id) {
                $score++;
            }
        }
    
        $percentage = ($total > 0) ? ($score / $total) * 100 : 0;
    
        ResultadoExamen::create([
            'alumno_id' => $alumnoId,
            'exam_id' => $examId,
            'puntaje' => $score,
            'porcentaje' => $percentage,
        ]);
    
        return view('exams.result', compact('score', 'total', 'percentage', 'exam', 'curso'));
    }

    // Función para editar el examen
    public function edit($cursoId)
    {
        $curso = Curso::with('exams.questions.answers')->findOrFail($cursoId);

        $exam = $curso->exams->first();

        if (!$exam) {
            return redirect()->route('cursos.edit', $cursoId)
                ->with('error', 'No existe ningún examen asociado a este curso.');
        }

        return view('exams.editarExamen', compact('curso', 'exam'));
    }


    // Función para actualizar el examen
    public function update(Request $request, $examId)
    {
        $exam = Exam::findOrFail($examId);

        $exam->title = $request->input('title');
        $exam->save();

        if ($request->has('questions')) {
            foreach ($request->input('questions') as $questionId => $questionData) {
                $question = Question::find($questionId);
                if ($question) {
                    $question->question_text = $questionData['text'];
                    $question->save();

                    if (isset($questionData['answers'])) {
                        foreach ($questionData['answers'] as $answerId => $answerData) {
                            if (is_numeric($answerId)) {
                                $answer = Answer::find($answerId);
                                if ($answer) {
                                    $answer->answer_text = $answerData['text'];
                                    $answer->is_correct = isset($answerData['is_correct']);
                                    $answer->save();
                                }
                            } elseif (strpos($answerId, 'new_') === 0) {
                                $question->answers()->create([
                                    'answer_text' => $answerData['text'],
                                    'is_correct' => isset($answerData['is_correct']),
                                ]);
                            }
                        }
                    }
                }
            }
        }

        if ($request->has('new_questions')) {
            foreach ($request->input('new_questions') as $newQuestionData) {
                $newQuestion = new Question([
                    'question_text' => $newQuestionData['text'],
                    'exam_id' => $exam->id,
                ]);
                $newQuestion->save();

                if (isset($newQuestionData['answers'])) {
                    foreach ($newQuestionData['answers'] as $newAnswerData) {
                        $newQuestion->answers()->create([
                            'answer_text' => $newAnswerData['text'],
                            'is_correct' => isset($newAnswerData['is_correct']),
                        ]);
                    }
                }
            }
        }

        return redirect()->route('cursos.edit', $exam->curso_id)->with('success', 'Examen actualizado correctamente.');
    }


    // Función para eliminar el examen completo (el examen, respuestas y preguntas)
    public function destroy(Exam $exam)
    {
        $exam->questions()->each(function ($question) {
            $question->answers()->delete();
            $question->delete();
        });

        $exam->delete();

        return redirect()->route('cursos.edit', $exam->curso_id)
            ->with('success', 'Examen eliminado correctamente.');
    }


    // Mostrar la vista de añadir preguntas a un examen
    public function addPreguntas($examId)
    {
        $exam = Exam::findOrFail($examId);
        return view('exams.addPreguntas', compact('exam'));
    }
    
    // Función para guardar las preguntas
    public function storeAddPreguntas(Request $request, $examId)
    {
        $request->validate([
            'new_questions' => 'required|array',
            'new_questions.*.text' => 'required|string',
            'new_questions.*.answers' => 'required|array',
            'new_questions.*.answers.*.text' => 'required|string',
        ]);

        $exam = Exam::findOrFail($examId);

        foreach ($request->new_questions as $questionData) {
            $question = $exam->questions()->create([
                'question_text' => $questionData['text'],
            ]);

            foreach ($questionData['answers'] as $answerData) {
                $question->answers()->create([
                    'answer_text' => $answerData['text'],
                    'is_correct' => isset($answerData['is_correct']),
                ]);
            }
        }

        return redirect()->route('cursos.edit', $examId)->with('success', 'Preguntas agregadas correctamente.');
    }
}
