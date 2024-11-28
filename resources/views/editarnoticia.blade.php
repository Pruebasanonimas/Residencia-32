<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Noticias</title>
    @vite('resources/css/app.css')
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


    <style>
        .ql-align-center {
            text-align: center;
        }

        .ql-align-right {
            text-align: right;
        }

        .ql-align-left {
            text-align: left;
        }

        .ql-size-small {
            font-size: 0.75em;
        }

        .ql-size-large {
            font-size: 1.5em;
        }

        .ql-size-huge {
            font-size: 2.5em;
        }


        .card {
            height: 40rem;

            overflow-y: auto;

        }
    </style>
</head>

<body class="antialiased md:bg-gray-100">



    <div class="flex justify-end p-4">

        <a href="{{ route('crearnoticia') }}"
            class="group inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-blue-500 p-[2px] text-sm font-semibold 
                rounded-full transition-all hover:shadow-lg active:scale-95">

            <span
                class="block rounded-full bg-white px-6 py-2 text-black group-hover:bg-transparent group-hover:text-white">
                Ir a crear una noticia
            </span>
        </a>
    </div>


    <div class="flex justify-end p-4">

        <a href="{{ route('home') }}"
            class="group inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-blue-500 p-[2px] text-sm font-semibold 
                    rounded-full transition-all hover:shadow-lg active:scale-95">

            <span
                class="block rounded-full bg-white px-6 py-2 text-black group-hover:bg-transparent group-hover:text-white">
                Volver al menú
            </span>
        </a>
    </div>

    {{--  Fondo de la página --}}
    <div class="bg-cover bg-center" style="background-image: url('/images/logoeditable.png');">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 p-4">
            @foreach ($noticias as $noticia)
                <div class="card p-8 bg-white rounded-lg shadow-md">

                    <img class="rounded-lg w-full h-64 object-cover" src="{{ Storage::url($noticia->imagen) }}"
                        alt="Imagen de la noticia" />

                    <p class="text-indigo-500 font-semibold text-base mt-2">{{ $noticia->categoria }}</p>

                    <div class="max-w-full">
                        <p class="text-base font-medium tracking-wide text-gray-600 mt-1">
                            {!! $noticia->cuerpo !!}
                        </p>
                    </div>

                    <div class="flex items-center space-x-2 mt-4">
                        {{--  imagen del autor --}}
                        <img class="h-8 w-8 rounded-full" src="{{ Storage::url($noticia->foto_perfil) }}"
                            alt="Perfil del autor" />
                        <div>
                            {{--  Nombre del autor  --}}
                            <p class="text-gray-900 font-semibold">{{ $noticia->autor }}</p>
                            <span class="text-gray-400 text-xs block">{{ $noticia->created_at->format('d M, Y') }}
                                &middot;</span>

                        </div>
                    </div>
                    </br>
                    {{-- Botón de Editar --}}
                    <a href="{{ route('noticias.edit', $noticia->id) }}"
                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        Editar
                    </a>
                    </br>

                    {{-- Botón de Eliminar --}}
                    <form action="{{ route('noticias.destroy', $noticia->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Eliminar
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
