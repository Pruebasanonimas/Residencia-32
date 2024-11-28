<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Datos Personales</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto bg-white p-8 mt-10 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-6 text-center">Actualizar Datos Personales</h2>
        
      {{--    Formulario de actualización  --}}
        <form action="{{ route('alumno.update', $alumno->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $alumno->nombre) }}" class="mt-1 p-2 w-full border border-gray-300 rounded-lg">
            </div>

            <div class="mb-4">
                <label for="escuela" class="block text-sm font-medium text-gray-700">Escuela</label>
                <input type="text" name="escuela" id="escuela" value="{{ old('escuela', $alumno->escuela) }}" class="mt-1 p-2 w-full border border-gray-300 rounded-lg">
            </div>

            <div class="mb-4">
                <label for="especialidad" class="block text-sm font-medium text-gray-700">Especialidad</label>
                <input type="text" name="especialidad" id="especialidad" value="{{ old('especialidad', $alumno->especialidad) }}" class="mt-1 p-2 w-full border border-gray-300 rounded-lg">
            </div>

            <div class="mb-4">
                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $alumno->telefono) }}" class="mt-1 p-2 w-full border border-gray-300 rounded-lg">
            </div>

            <div class="mb-4">
                <label for="domicilio" class="block text-sm font-medium text-gray-700">Domicilio</label>
                <input type="text" name="domicilio" id="domicilio" value="{{ old('domicilio', $alumno->domicilio) }}" class="mt-1 p-2 w-full border border-gray-300 rounded-lg">
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg transition duration-300">Actualizar</button>
            </div>
        </form>

      
        @if(session('status'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif
    </div>

</body>
</html>