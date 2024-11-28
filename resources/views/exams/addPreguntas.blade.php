<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Preguntas al Examen</title>
    @vite('resources/css/app.css')
    
</head>
<body class="min-h-screen flex flex-col items-center justify-center bg-gray-100">

    <div class="w-full max-w-4xl mx-auto p-4">
        <a href="{{ route('cursos.edit', 1) }}" 
            class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-blue-500 p-[2px] text-sm font-semibold 
            rounded-full transition-all hover:shadow-lg active:scale-95">
            <span
                class="block rounded-full bg-white px-6 py-2 text-black group-hover:bg-transparent group-hover:text-white">
                Volver a editar el curso
            </span>
        </a>
    </div>
    

    <div class="w-full max-w-4xl mx-auto p-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Agregar Preguntas al Examen: {{ $exam->title }}</h2>

        <form action="{{ route('exams.addPreguntas.store', $exam->id) }}" method="POST" class="space-y-6">
            @csrf

         
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Título del Examen</label>
                <input type="text" id="title" name="title" 
                    class="block w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ $exam->title }}" required readonly>
            </div>

             {{-- Contenedor de preguntas --}} 
            <div id="new-questions"></div>

            {{--  Botón para agregar nuevas preguntas --}} 
            <button type="button" onclick="addQuestion()" 
                class="bg-blue-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-700">
                Agregar Pregunta
            </button>

            {{--  Botones de acción --}} 
            <div class="flex justify-between mt-6">
                <button type="submit" 
                    class="bg-green-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-700">
                    Guardar Preguntas
                </button>
            </div>
        </form>
    </div>

    <script>
        let newQuestionCount = 0;
    //Función para agregar pregunta
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
                <button type="button" onclick="addAnswerNew(${newQuestionCount})"
                    class="mt-4 bg-gray-500 text-white px-3 py-1 rounded-md shadow-md hover:bg-gray-600">
                    Agregar Respuesta
                </button>
            `;
            newQuestionsDiv.appendChild(questionDiv);
            newQuestionCount++;
        }
        //Función para agregar respuesta
        function addAnswerNew(questionIndex) {
            const answersDiv = document.getElementById(`answers-new-${questionIndex}`);
            const answerCount = answersDiv.querySelectorAll('input[type="text"]').length;

            const answerDiv = document.createElement('div');
            answerDiv.innerHTML = `
                <input type="text" name="new_questions[${questionIndex}][answers][${answerCount}][text]"
                    class="block w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Respuesta" required>
                <label class="flex items-center space-x-2 mt-2">
                    <input type="checkbox" name="new_questions[${questionIndex}][answers][${answerCount}][is_correct]">
                    <span>Correcta</span>
                </label>
            `;
            answersDiv.appendChild(answerDiv);
        }
    </script>
</body>
</html>
