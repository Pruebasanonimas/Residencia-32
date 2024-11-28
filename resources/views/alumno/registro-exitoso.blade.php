<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Exitoso</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 md:p-10 lg:p-12 text-center w-full max-w-lg">
        
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">¡Registro Exitoso!</h1>
       
        <p class="text-lg text-gray-600 mb-6">
            Se ha enviado un correo de verificación a su dirección de correo electrónico.<br>
            Por favor, revise su bandeja de entrada, incluido el apartado de <strong>spam</strong> o <strong>no
                deseados</strong> en caso de no verlo en su bandeja principal.
        </p>
   
        <a href="{{ route('alumno.login') }}"
            class="mt-6 bg-blue-500 text-white py-3 px-6 rounded-lg shadow hover:bg-blue-600 transition duration-200">
            Ir al Inicio
        </a>
    </div>
</body>

</html>
