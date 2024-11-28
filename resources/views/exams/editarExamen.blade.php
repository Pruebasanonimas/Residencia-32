<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Examen</title>
    @vite('resources/css/app.css')
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Inter', sans-serif;
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center justify-center">


    <div class="w-full max-w-4xl mx-auto p-4">
        <a href="{{ route('cursos.edit', $curso->id) }}"
            class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-blue-500 p-[2px] text-sm font-semibold 
            rounded-full transition-all hover:shadow-lg active:scale-95">
            <span
                class="block rounded-full bg-white px-6 py-2 text-black group-hover:bg-transparent group-hover:text-white">
                Volver a editar el curso
            </span>
        </a>
    </div>


    <div class="card w-full max-w-4xl mx-auto p-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Editar Examen del Curso: {{ $curso->nombre }}</h2>

        <form action="{{ route('exams.update', $exam->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')


            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Título del Examen</label>
                <input type="text" id="title" name="title"
                    class="block w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ $exam->title }}" required>
            </div>

            {{--  Contenedor de preguntas  --}}
            <div id="questions" class="space-y-6">
                {{-- Preguntas existentes --}}
                @foreach ($exam->questions as $index => $question)
                    <div class="p-4 border rounded-md bg-gray-50">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pregunta {{ $index + 1 }}</label>
                        <input type="text" name="questions[{{ $question->id }}][text]"
                            class="block w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
                            value="{{ $question->question_text }}" required>

                        {{-- Respuestas existentes --}}
                        <div id="answers-{{ $question->id }}" class="space-y-4">
                            @foreach ($question->answers as $answerIndex => $answer)
                                <div>
                                    <input type="text"
                                        name="questions[{{ $question->id }}][answers][{{ $answer->id }}][text]"
                                        class="block w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        value="{{ $answer->answer_text }}" required>
                                    <label class="flex items-center space-x-2 mt-2">
                                        <input type="checkbox"
                                            name="questions[{{ $question->id }}][answers][{{ $answer->id }}][is_correct]"
                                            class="form-check-input" {{ $answer->is_correct ? 'checked' : '' }}>
                                        <span>Correcta</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        {{-- Botón para agregar respuestas --}}
                        <button type="button" onclick="addAnswer({{ $question->id }})"
                            class="mt-4 bg-gray-500 text-white px-3 py-1 rounded-md shadow-md hover:bg-gray-600">
                            Agregar Respuesta
                        </button>
                    </div>
                @endforeach


                {{-- Botones de guardar --}}
                <div class="flex justify-between mt-6">
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-700">
                        Guardar Cambios
                    </button>
                </div>
        </form>

        <hr class="my-6">

        {{-- Botón para eliminar el examen --}}
        <form action="{{ route('exams.destroy', $exam->id) }}" method="POST"
            onsubmit="return confirm('¿Estás seguro de eliminar este examen?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-700">
                Eliminar Examen
            </button>
        </form>
    </div>


    <script>
        let newQuestionCount = 0;
        //Función para agregar preguntas
        function addQuestion() {
            const newQuestionsDiv = document.getElementById('new-questions');
            const questionDiv = document.createElement('div');
            questionDiv.classList.add('p-4', 'border', 'rounded-md', 'bg-gray-50');
            questionDiv.innerHTML = `
                <label class="block text-sm font-medium text-gray-700 mb-2">Nueva Pregunta</label>
                <input type="text" name="new_questions[${newQuestionCount}][text]" 
                    class="block w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4" 
                    placeholder="Escriba la pregunta" required>
                <div id="answers-new-${newQuestionCount}" class="space-y-4">
                    <input type="text" name="new_questions[${newQuestionCount}][answers][0][text]" 
                        class="block w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="Respuesta" required>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="new_questions[${newQuestionCount}][answers][0][is_correct]">
                        <span>Correcta</span>
                    </label>
                </div>
                <button type="button" onclick="addAnswer('new-${newQuestionCount}')"
                    class="mt-4 bg-gray-500 text-white px-3 py-1 rounded-md shadow-md hover:bg-gray-600">
                    Agregar Respuesta
                </button>
            `;
            newQuestionsDiv.appendChild(questionDiv);
            newQuestionCount++;
        }
        //Función para agregar preguntas
        function addAnswer(questionId) {
            const answersDiv = document.getElementById(`answers-${questionId}`);
            if (!answersDiv) {

                const newAnswersDiv = document.getElementById(`answers-new-${questionId.split('-')[1]}`);
                const answerCount = newAnswersDiv.querySelectorAll('input[type="text"]').length;

                const answerDiv = document.createElement('div');
                answerDiv.innerHTML = `
            <input type="text" name="new_questions[${questionId.split('-')[1]}][answers][${answerCount}][text]"
                class="block w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Respuesta" required>
            <label class="flex items-center space-x-2 mt-2">
                <input type="checkbox" name="new_questions[${questionId.split('-')[1]}][answers][${answerCount}][is_correct]">
                <span>Correcta</span>
            </label>
        `;
                newAnswersDiv.appendChild(answerDiv);
            } else {

                const answerCount = answersDiv.querySelectorAll('input[type="text"]').length;

                const answerDiv = document.createElement('div');
                answerDiv.innerHTML = `
            <input type="text" name="questions[${questionId}][answers][new_${answerCount}][text]"
                class="block w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Respuesta" required>
            <label class="flex items-center space-x-2 mt-2">
                <input type="checkbox" name="questions[${questionId}][answers][new_${answerCount}][is_correct]">
                <span>Correcta</span>
            </label>
        `;
                answersDiv.appendChild(answerDiv);
            }
        }
    </script>


</body>

</html>
