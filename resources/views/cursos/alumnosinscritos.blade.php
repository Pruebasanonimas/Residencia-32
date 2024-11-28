<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Curso</title>
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .chart-container {
            width: 50%;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
        }

        th {
            background-color: #f2f2f2;
        }


        .contenedor {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .contenedor-imagen-curso {
            width: 35rem;
            height: 25rem;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            margin-bottom: 0.5rem;
            
        }

        .imagen-curso {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

      
        .imagen-curso-placeholder {
            width: 100%;
            height: 100%;
            background-color: #E2E8F0;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
        }

        
        .titulo-curso {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-top: 15px;
        }

        
        .informacion-curso {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        
        .contenedor-tabla {
            overflow-x: auto;
            margin-top: 20px;
        }
    </style>
</head>

<body>


    <div class="flex justify-end p-4">
   
        <a href="{{ route('cursos.index') }}"
            class="group inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-blue-500 p-[2px] text-sm font-semibold 
            rounded-full transition-all hover:shadow-lg active:scale-95">
          
            <span
                class="block rounded-full bg-white px-6 py-2 text-black group-hover:bg-transparent group-hover:text-white">
                Volver al menú
            </span>
        </a>
    </div>

     {{-- Información del curso  --}}
    <div class="contenedor">
        <div class="informacion-curso">
            <div class="contenedor-imagen-curso">
                @if ($curso->imagen)
                    <img src="{{ asset('storage/' . $curso->imagen) }}" alt="Imagen del curso" class="imagen-curso">
                @else
                    <div class="imagen-curso-placeholder">
                        <span class="text-gray-600">Sin imagen</span>
                    </div>
                @endif
            </div>
            <div class="titulo-curso">
                <h2 class="text-2xl font-bold text-gray-800">{{ $curso->nombre }}</h2>
            </div>
        </div>

        {{-- Tabla con la lista de alumnos  --}} 
        <div class="contenedor-tabla">
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Nombre</th>
                        <th class="border border-gray-300 px-4 py-2">Escuela</th>
                        <th class="border border-gray-300 px-4 py-2">Especialidad</th>
                        <th class="border border-gray-300 px-4 py-2">Teléfono</th>
                        <th class="border border-gray-300 px-4 py-2">Correo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($alumnos as $alumno)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $alumno->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $alumno->nombre }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $alumno->escuela }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $alumno->especialidad }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $alumno->telefono }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $alumno->email }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border border-gray-300 px-4 py-2 text-center text-gray-600">No hay
                                alumnos inscritos en este curso.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
