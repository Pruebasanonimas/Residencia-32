<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguridad</title>
    @vite('resources/css/app.css') 
    <style>
        /* Estilo para la página de seguridad */
        body {
            background-color: #000000;
            font-family: Arial, sans-serif;
        }

        .neon-box {
            background-color: #1a1a1a;
            border: 2px solid #00ff00;
            color: #00ff00;
            padding: 20px;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.8);
            font-size: 18px;
        }

        .neon-box input {
            background-color: transparent;
            color: #00ff00;
            border: 1px solid #00ff00;
            padding: 10px;
            width: 100%;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .neon-box input:focus {
            outline: none;
            border-color: #ff00ff;
            box-shadow: 0 0 5px #ff00ff;
        }

        .neon-box button {
            background-color: #00ff00;
            color: #000000;
            border: none;
            padding: 10px 20px;
            width: 100%;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .neon-box button:hover {
            background-color: #00cc00;
        }
    </style>
</head>

<body>
    <div class="h-screen flex justify-center items-center">
        <div class="neon-box">
            @yield('content')
        </div>
    </div>
</body>

</html>
