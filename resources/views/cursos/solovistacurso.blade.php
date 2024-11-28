<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso: {{ $curso->nombre }}</title>
    
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .ql-video {
            display: block;
            width: 100%;
            max-width: 40rem;
            height: 20rem;
            margin: auto;
        }

        .leccion-contenido h3 {
            text-align: center;
        }

        .contenedor-lecciones {
            display: flex;
            justify-content: flex-start;
            width: 100%;
            margin-top: 20px;
        }

        .leccion-contenido {
            width: 83%;
            padding: 30px;
            background-color: rgb(250, 225, 225);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .leccion-botones {
            width: 17%;
            padding: 30px;
            margin-left: 0;
            background-color: #000000;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .leccion-btn {
            background-color: #3a44f0;
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 8px;
            width: 100%;
            max-width: 300px;
            text-align: center;
            transition: background-color 0.3s;
        }

        .leccion-btn:hover {
            background-color: #434190;
        }

        .calificacion-panel {
            background-color: #f9fafb;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .calificacion-btn {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            padding: 12px 25px;
            border-radius: 8px;
            width: 100%;
            max-width: 250px;
            transition: background-color 0.3s ease-in-out;
            margin-top: 15px;
            text-align: center;
        }

        .calificacion-btn:hover {
            background-color: #45a049;
        }

        .calificacion-btn:active {
            transform: scale(0.98);
        }

        select {
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            max-width: 200px;
            border: 1px solid #ddd;
            margin-top: 10px;
            font-size: 16px;
        }

        .calificacion-text {
            font-size: 16px;
            color: #333;
            margin-bottom: 12px;
        }

        .stars {
            color: #ffcc00;
            margin-right: 5px;
        }
    </style>
</head>

<body class="bg-gray-100">

   
    <div class="flex justify-end p-4">
       
        <a href="{{ route('cursos.vercursos') }}"
            class="group inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-blue-500 p-[2px] text-sm font-semibold 
            rounded-full transition-all hover:shadow-lg active:scale-95">
            
            <span
                class="block rounded-full bg-white px-6 py-2 text-black group-hover:bg-transparent group-hover:text-white">
                Volver a ver los cursos
            </span>
        </a>
    </div>

    <div class="container mx-auto my-6">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center mb-6">
            <h1 class="text-3xl font-semibold text-blue-700">Curso: {{ $curso->nombre }}</h1>
            <p class="text-gray-600">{{ $curso->descripcion }}</p>
        </div>

        <div class="contenedor-lecciones">
            <div class="panel leccion-contenido">
                @if (isset($leccionSeleccionada))
                    <h3 class="text-2xl font-semibold text-blue-600">{{ $leccionSeleccionada->titulo }}</h3>
                    <p class="text-gray-700 mt-2">{!! $leccionSeleccionada->contenido !!}</p>
                @else
                    <p class="text-gray-500">Selecciona una lección para ver su contenido.</p>
                @endif
            </div>

          <div class="leccion-botones">
                @foreach ($curso->lecciones as $leccion)
                    <div class="flex items-center gap-2">  
                            <form action="{{ route('cursos.showLeccionvista', [$curso->id, $leccion->id]) }}" method="GET" class="flex-1">
                                <button type="submit" class="leccion-btn text-left">{{ $leccion->titulo }}</button>
                            </form>                            
                    </div>
                @endforeach
            </div>
        </div>
        @if ($curso->examen)
            <p class="text-gray-600 mt-4">Título: {{ $curso->examen->title }}</p>
            <a href="#" onclick="mostrarMensaje('Ver examen')"
                class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 cursor-pointer">
                Ver Examen
            </a>
        @else
            <p>No hay examen disponible</p>
        @endif

        <div class="calificacion-panel">
            <h3 class="calificacion-text">Calificar este curso:</h3>
            @php
                $calificacionExistente = $curso->calificaciones->firstWhere('alumno_id', auth('alumnoe')->id());
            @endphp
            <form>
                @csrf
                <div class="flex">
                    <select name="estrellas" id="estrellas" required disabled>
                        @foreach (range(1, 5) as $estrella)
                            <option value="{{ $estrella }}"
                                {{ $calificacionExistente && $calificacionExistente->estrellas == $estrella ? 'selected' : '' }}>
                                {{ str_repeat('★', $estrella) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="button"
                    class="calificacion-btn {{ $calificacionExistente ? 'bg-red-600 opacity-50 cursor-not-allowed' : 'bg-green-600 hover:bg-green-700' }}"
                    disabled onclick="mostrarMensaje('Enviar calificación')">
                    {{ $calificacionExistente ? 'Ya calificaste este curso' : 'Enviar Calificación' }}
                </button>
            </form>

            @if ($calificacionExistente)
                <div class="mt-2 p-4 bg-yellow-100 text-yellow-800 border-l-4 border-yellow-500">
                    <p>¡Ya has calificado este curso! Gracias por tu valoración.</p>
                </div>
            @endif
            <div class="flex items-center my-2">
                <p class="text-yellow-500 font-semibold">{{ number_format($curso->promedioEstrellas(), 1) }} <span
                        class="text-gray-600">★</span></p>
                <span class="ml-1 text-gray-600 text-sm">({{ $curso->calificaciones->count() }} reseñas)</span>
            </div>
        </div>

         {{-- Comentarios --}} 
        <div class="bg-white p-6 rounded-lg shadow-lg mt-6">
            <h2 class="text-2xl font-semibold mb-4 text-indigo-600">Comentarios</h2>
            @csrf
            <textarea name="comentario" class="w-full p-3 rounded border-gray-300" rows="4"
                placeholder="Escribe tu comentario" required></textarea>
            <button type="submit" class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded"
                onclick="mostrarMensaje('Publicar comentario')">Publicar Comentario</button>

            <div class="p-4 bg-gray-100 rounded-lg shadow-md overflow-y-auto" style="max-height: 300px;">
                @forelse($curso->comentarios as $comentario)
                    <div class="p-4 bg-white rounded-lg shadow-md mb-2">
                        <p class="font-semibold">
                            @if ($comentario->author_type == 'App\Models\User')
                                {{ $comentario->author->name }}
                            @elseif($comentario->author_type == 'App\Models\Alumnoe')
                                {{ $comentario->author->nombre }}
                            @endif
                        </p>
                        <p class="text-gray-600">{{ $comentario->contenido }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">No hay comentarios aún.</p>
                @endforelse
            </div>
        </div>

    </div>

    <script>
        function mostrarMensaje(accion) {
            alert('Debes inscribirte al curso para ' + accion);
        }
    </script>

</body>

</html>
