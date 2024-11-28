<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
     
        header {
            background: url('https://images.pexels.com/photos/57690/pexels-photo-57690.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body>

    <nav class="fixed inset-x-0 top-0 flex flex-row justify-between z-10 text-white bg-transparent">
        <div class="p-4">
            <div class="font-extrabold tracking-widest text-xl"><a
                    class="transition duration-500 hover:text-indigo-500">ITSCO</a></div>
        </div>

        <div class="p-4 md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-menu">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </div>
    </nav>

    <header class="bg-center bg-fixed bg-no-repeat bg-center bg-cover h-screen relative">
        <div class="h-screen bg-opacity-50 bg-black flex items-center justify-center"
            style="background:rgba(0,0,0,0.5);">
            <div class="mx-2 text-center">
                <h1 class="text-gray-100 font-extrabold text-4xl xs:text-5xl md:text-6xl">
                    <span class="text-white">Bienvenidos</span>
                </h1>
                <h2 class="text-gray-200 font-extrabold text-3xl xs:text-4xl md:text-5xl leading-tight">
                    Listos <span class="text-white">para</span> crear <span class="text-white">un</span> curso
                </h2>
                <div class="inline-flex">
                 {{--   Botón "Ingresar"   --}}
                    <a href="{{ route('login') }}">
                        <button
                            class="p-2 my-5 mx-2 bg-indigo-700 hover:bg-indigo-800 font-bold text-white rounded border-2 border-transparent hover:border-indigo-800 shadow-md transition duration-500 md:text-xl">
                            Ingresar
                        </button>
                    </a>

                    {{--  Botón "Registrarse"  --}}
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">
                            <button
                                class="p-2 my-5 mx-2 bg-transparent border-2 bg-indigo-200 bg-opacity-75 hover:bg-opacity-100 border-indigo-700 rounded hover:border-indigo-800 font-bold text-indigo-800 shadow-md transition duration-500 md:text-lg">
                                Registrarse
                            </button>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </header>

</body>

</html>
