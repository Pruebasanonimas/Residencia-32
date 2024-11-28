<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Lecciones</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

  
    <div class="flex justify-end p-4">
       
        <a href="{{ route('cursos.edit') }}"
            class="group inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-blue-500 p-[2px] text-sm font-semibold 
            rounded-full transition-all hover:shadow-lg active:scale-95">
           
            <span
                class="block rounded-full bg-white px-6 py-2 text-black group-hover:bg-transparent group-hover:text-white">
                Volver a los cursos
            </span>
        </a>
    </div>
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-bold text-center mb-6">Eliminar Lecciones</h1>

        {{-- Lista de lecciones --}}
        <div class="bg-white shadow-md rounded-lg p-6">
            @if ($lecciones->isEmpty())
                <p class="text-gray-600 text-center">No hay lecciones disponibles para este curso.</p>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach ($lecciones as $leccion)
                        <li class="flex justify-between items-center py-4">
                            <span class="text-lg font-medium">{{ $leccion->titulo }}</span>
                            <form action="{{ route('lecciones.destroy', $leccion->id) }}" method="POST"
                                onsubmit="return confirm('¿Estás seguro de eliminar esta lección?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                    Eliminar
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>
</body>

</html>
