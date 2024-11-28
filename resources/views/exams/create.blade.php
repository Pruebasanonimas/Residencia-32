<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Examen</title>
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
        <a href="{{ route('home') }}"
            class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-blue-500 p-[2px] text-sm font-semibold 
            rounded-full transition-all hover:shadow-lg active:scale-95">
            <span
                class="block rounded-full bg-white px-6 py-2 text-black group-hover:bg-transparent group-hover:text-white">
                Volver al menú
            </span>
        </a>
    </div>


    <div class="card w-full max-w-4xl mx-auto p-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Crear Examen para el Curso: {{ $curso->nombre }}</h2>

        <form action="{{ route('exams.store', $curso->id) }}" method="POST" class="space-y-6">
            @csrf

        
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Título del Examen</label>
                <input type="text" id="title" name="title"
                    class="block w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Ingrese el título del examen" required>
            </div>

             {{-- Contenedor de preguntas --}} 
            <div id="questions" class="space-y-4">
               
            </div>

             {{-- Botones --}}
            <div class="flex justify-between">
                <button type="button" onclick="addQuestion()"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-700">
                    Agregar Pregunta
                </button>
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-700">
                    Guardar Examen
                </button>
            </div>
        </form>
    </div>

    
    <script>
        let questionCount = 0;
        //Función para agregar preguntas
        function addQuestion() {
            const questionDiv = document.createElement('div');
            questionDiv.classList.add('p-4', 'border', 'rounded-md', 'bg-gray-50');

            questionDiv.innerHTML = `
                <label class="block text-sm font-medium text-gray-700 mb-2">Pregunta</label>
                <input type="text" name="questions[${questionCount}][text]" class="block w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4" placeholder="Escriba la pregunta" required>
                
                <div id="answers-${questionCount}" class="space-y-2">
                    <input type="text" name="questions[${questionCount}][answers][0][text]" class="block w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Respuesta" required>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="questions[${questionCount}][answers][0][is_correct]">
                        <span>Correcta</span>
                    </label>
                </div>

                <button type="button" onclick="addAnswer(${questionCount})" class="mt-4 bg-gray-500 text-white px-3 py-1 rounded-md shadow-md hover:bg-gray-600">Agregar Respuesta</button>
            `;

            document.getElementById('questions').appendChild(questionDiv);
            questionCount++;
        }
        //Función para agregar respuestas
        function addAnswer(questionIndex) {
            const answersDiv = document.getElementById(`answers-${questionIndex}`);
            const answerCount = answersDiv.querySelectorAll('input[type="text"]').length;

            const answerDiv = document.createElement('div');
            answerDiv.classList.add('space-y-2');
            answerDiv.innerHTML = `
                <input type="text" name="questions[${questionIndex}][answers][${answerCount}][text]" class="block w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Respuesta" required>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="questions[${questionIndex}][answers][${answerCount}][is_correct]">
                    <span>Correcta</span>
                </label>
            `;

            answersDiv.appendChild(answerDiv);
        }
    </script>

</body>

</html>
