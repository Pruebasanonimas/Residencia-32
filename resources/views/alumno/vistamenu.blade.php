<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    @vite('resources/css/app.css')

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
 
    <header class="bg-gray-800 text-white shadow-lg rounded-b-lg w-full">
        <nav class="flex items-center justify-between p-4">
            {{--  Logo y texto --}} 
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/logosistemas.png') }}" alt="Logo Ingeniería en Sistemas" class="h-20 w-20 ">
                <span class="text-xl font-semibold">Ingeniería en Sistemas <br> Computacionales</span>
            </div>
           {{--  Botones de navegación --}}
            <div class="hidden md:flex space-x-4">
                <a href="#"
                    class="bg-gray-700 hover:bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-300">Calendario</a>
                <a href="#"
                    class="bg-gray-700 hover:bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-300">Noticias</a>
                <a href="#"
                    class="bg-gray-700 hover:bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-300">Documentos</a>
                <a href="#"
                    class="bg-gray-700 hover:bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-300">Cursos</a>
                <a href="#"
                    class="bg-gray-700 hover:bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-300">Mis
                    cursos</a>
               {{-- Botón de redes con icono de Facebook --}} 
              <a  target="_blank"
              class="bg-gray-700 hover:bg-blue-500 text-white py-2 px-4 rounded-lg transition duration-300 flex items-center space-x-2">
              <i class="fab fa-facebook-square text-xl"></i>
              <span>Facebook</span>
          </a>
                
                <div class="flex justify-start p-4">
                   
                    <a href="{{ route('home') }}"
                        class="group inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-blue-500 p-[2px] text-sm font-semibold 
              rounded-full transition-all hover:shadow-lg active:scale-95">
                      
                        <span
                            class="block rounded-full bg-white px-6 py-2 text-black group-hover:bg-transparent group-hover:text-white">
                            Volver al menú
                        </span>
                    </a>
                </div>
            </div>
        </nav>
    </header>

    {{--  Carrusel de imágenes  --}}
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
                            {{--  Ajuste para evitar que la imagen se corte  --}}
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

                    {{--  Controles del carrusel --}} 
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

   {{-- Mostrar información de la página --}} 
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
</body>

</html>
