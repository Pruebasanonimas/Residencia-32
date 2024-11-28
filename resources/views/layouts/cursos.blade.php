<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Curso')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        .leccion-botones {
            max-width: 200px;
        }

        .leccion-contenido {
            max-width: 700px;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto my-6">
         {{-- Información del Curso --}} 
        <div class="bg-white p-6 rounded-lg shadow-lg text-center mb-6">
            <h1 class="text-3xl font-semibold text-blue-700">@yield('curso_titulo')</h1>
            <p class="text-gray-600">@yield('curso_descripcion')</p>
        </div>

        <div class="flex justify-center space-x-6">
            {{-- Botones de Lecciones a la derecha --}} 
            <div class="leccion-botones space-y-4">
                @yield('lecciones_botones')
            </div>

             {{-- Contenido de la Lección al centro --}} 
            <div class="leccion-contenido bg-white p-6 rounded-lg shadow-lg">
                @yield('leccion_contenido')
            </div>
        </div>

       {{--  Comentarios --}} 
        <div class="bg-white p-6 rounded-lg shadow-lg mt-6">
            @yield('comentarios')
        </div>
    </div>
</body>

</html>
