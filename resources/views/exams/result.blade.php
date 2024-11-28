<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados del Examen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-6">
      
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-blue-600">Resultados del Examen</h1>
        </div>

         {{-- Información del puntaje --}} 
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <p class="text-xl font-semibold">Tu puntaje: <span class="text-blue-600">{{ $score }}</span> de <span
                    class="text-blue-600">{{ $total }}</span></p>
            <p class="text-xl font-semibold">Porcentaje: <span class="text-green-600">{{ $percentage }}%</span></p>
        </div>

         {{-- Preguntas y respuestas --}} 
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Detalles de las preguntas:</h2>
            @foreach ($exam->questions as $question)
                <div class="mb-6">
                    <p class="text-lg font-semibold text-gray-800">Pregunta:</p>
                    <p class="text-gray-600 mb-2">{{ $question->question_text }}</p>
                    <p class="text-lg font-semibold text-gray-800">Respuesta correcta:</p>
                    <p class="text-green-600">{{ $question->answers->where('is_correct', true)->first()->answer_text }}
                    </p>
                </div>
            @endforeach
        </div>

        
        <div class="mt-8 text-center">
            <a href="{{ route('cursos.show', ['curso' => $curso->id]) }}"
                class="inline-block bg-gradient-to-r from-purple-600 to-blue-500 text-white font-semibold text-lg py-2 px-6 rounded-full shadow-lg transition-all hover:shadow-xl hover:scale-105">
                Volver a Cursos
            </a>
        </div>

</body>

</html>
