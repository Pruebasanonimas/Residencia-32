<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
   
</head>

<body class="bg-gradient-to-tr from-blue-200 to-blue-500">

  {{--   Contenedor principal  --}}
    <div class="min-h-screen flex justify-center items-center">
        <div class="w-full max-w-3xl bg-white p-8 rounded-xl shadow-xl">
            @yield('content')
        </div>
    </div>

</body>

</html>
