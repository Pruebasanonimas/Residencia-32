<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
 
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .ql-video {
            display: block;
            width: 100%;
            max-width: 40rem;
            /* Ajusta el tamaño máximo del video */
            height: 20rem;
            /* Mantiene la proporción original del video */
            margin: auto;
            /* Centra el video en el contenedor */
        }

        .ql-align-center {
            text-align: center;
        }

        .ql-align-right {
            text-align: right;
        }

        .ql-size-large {
            font-size: 1.5rem;
        }

        .ql-font-monospace {
            font-family: monospace;
        }

        .ql-font-serif {
            font-family: serif;
        }

        
        header {
            position: sticky;
            top: 0;
            z-index: 50;
           
        }

        :root {
            --button-size: 40px;
            /* Tamaño de los botones */
            --icon-size: 16px;
            /* Tamaño de los iconos */
        }

        /* Botones de control del carrusel */
        .carousel-control-prev,
        .carousel-control-next {
            width: var(--button-size);
            height: var(--button-size);
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #3b82f6;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }
    </style>
</head>

<body>
     {{-- Navbar  --}}
    <header class="bg-gray-800 text-white shadow-lg rounded-b-lg w-full">
        <nav class="flex flex-wrap items-center justify-between p-4">
           {{-- Logo y texto --}}
            <div class="flex items-center space-x-4 w-full sm:w-auto">
                <img src="{{ asset('images/logosistemas.png') }}" alt="Logo Ingeniería en Sistemas" class="h-20 w-20">
                <span class="text-xl font-semibold">Ingeniería en Sistemas <br> Computacionales</span>
            </div>

       {{-- Botones de navegación --}}
            <div class="hidden lg:flex space-x-4 w-full sm:w-auto">
                <a href="{{ route('user.calendar') }}"
                    class="bg-gray-700 hover:bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-300">Calendario</a>
                <a href="{{ route('vernoticia') }}"
                    class="bg-gray-700 hover:bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-300">Noticias</a>
                <a href="{{ route('view') }}"
                    class="bg-gray-700 hover:bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-300">Documentos</a>
                <a href="{{ route('cursos.vercursos') }}"
                    class="bg-gray-700 hover:bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-300">Cursos</a>
                <a href="{{ route('cursos.inscripciones') }}"
                    class="bg-gray-700 hover:bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-300">Mis
                    cursos</a>
                    <a href="{{ route('alumno.edit', Auth::guard('alumnoe')->user()->id) }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition duration-300">
                         Actualizar datos
                     </a>
                {{-- Botón de redes con icono de Facebook  --}}
                <a href="https://www.facebook.com/share/15AxRWZie4/?mibextid=LQQJ4d" target="_blank"
                    class="bg-gray-700 hover:bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-300 flex items-center space-x-2">
                    <i class="fab fa-facebook-square text-xl"></i>
                    <span>Facebook</span>
                </a>
               {{-- Botón de cerrar sesión --}}
                <form action="{{ route('alumno.logout') }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg transition duration-300">
                        Cerrar sesión
                    </button>
                </form>
            </div>

           
            <div class="lg:hidden flex items-center">
                <button id="menu-toggle" class="text-white">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </nav>

        {{-- Menu para mobile  --}}
        <div id="mobile-menu" class="lg:hidden bg-gray-800 text-white p-4 hidden">
            <a href="{{ route('user.calendar') }}" class="block py-2">Calendario</a>
            <a href="{{ route('vernoticia') }}" class="block py-2">Noticias</a>
            <a href="{{ route('view') }}" class="block py-2">Documentos</a>
            <a href="{{ route('cursos.vercursos') }}" class="block py-2">Cursos</a>
            <a href="{{ route('cursos.inscripciones') }}" class="block py-2">Mis cursos</a>
            <a href="https://www.facebook.com" target="_blank" class="block py-2 flex items-center space-x-2">
                <i class="fab fa-facebook-square text-xl"></i>
                <span>Facebook</span>
            </a>
            <form action="{{ route('alumno.logout') }}" method="POST" class="inline-block">
                @csrf
                <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg transition duration-300 block w-full">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </header>

    {{--  Contenido principal  --}}
    <main class="mt-8 text-center">
        @auth('alumnoe')
            <h1 class="text-2xl font-bold">Bienvenido, {{ Auth::guard('alumnoe')->user()->nombre }}!</h1>
        @else
            <h1 class="text-2xl font-bold">Bienvenido, invitado!</h1>
        @endauth
        <p class="mt-4">Esta es tu página principal.</p>

         {{-- Carrusel de imágenes  --}}
        <div class="mt-20 relative">
            @php
                $imagenes = App\Models\Carrusel::all(); 
            @endphp

            @if ($imagenes->count() > 0)
                <div class="carousel-container max-w-4xl mx-auto">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($imagenes as $index => $imagen)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $imagen->imagen) }}"
                                        class="d-block w-full h-96 object-contain" alt="{{ $imagen->titulo }}">
                                    @if ($imagen->titulo)
                                        <div
                                            class="carousel-caption d-none d-md-block text-center p-6 bg-white bg-opacity-25">
                                            <h5 class="text-black text-4xl font-medium mb-4">{{ $imagen->titulo }}</h5>
                                            @if ($imagen->descripcion)
                                                <p class="text-black text-base">{{ $imagen->descripcion }}</p>
                                            @endif
                                        </div>
                                    @endif

                                </div>
                            @endforeach
                        </div>

                        {{-- Controles del carrusel --}} 
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            @else
                <p>No hay imágenes disponibles.</p>
            @endif
        </div>
    </main>

   {{--  Mostrar información de la página  --}}
    @php
        $informacion = App\Models\InformacionPagina::first(); 
    @endphp
    @if ($informacion)
        <div class="mt-8 p-4 bg-gray-100 rounded-lg shadow">
            <div class="mt-4">{!! $informacion->contenido !!}</div>
        </div>
    @else
        <p>No se encontró información de la página.</p>
    @endif

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Vista de mobiles 
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>

</html>
