<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $noticia->titulo }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-t from-[#80deea] to-[#4dd0e1]">
    <div class="relative mt-10 h-screen pt-10 sm:pt-0 mb-10">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 items-start md:gap-20 px-4 sm:px-6 lg:px-8">
           
            <div class="content sm:px-12 lg:px-16 xl:px-20 max-w-4xl mx-auto text-left">
                <div class="flex items-center gap-3 mb-5 justify-start">
                    <hr class="w-10 bg-orange-500 border" />
                    <span class="md:text-[30px] font-medium text-gray-800">
                        Noticia Destacada
                    </span>
                </div>

                <p
                    class="text-[70px] lg:text-[90px] xl:text-[110px] font-extrabold leading-tight mt-5 sm:mt-0 text-gray-800">
                    {{ $noticia->titulo }}
                </p>

                <p class="mt-5 text-[40px] md:text-[60px] lg:text-[80px] xl:text-[90px] leading-relaxed text-gray-800">
                    {!! Str::limit($noticia->cuerpo, 1500) !!}
                </p>

               {{--  Botón para volver a las noticias  --}}
                <div class="flex gap-4 mt-10 justify-start">
                    <a href="{{ route('vernoticia') }}"
                        class="font-medium text-[24px] flex items-center px-6 py-3 md:py-4 md:px-8 rounded-xl capitalize bg-gradient-to-r from-[#ff7043] to-[#f4511e] hover:from-[#ff5722] hover:to-[#d32f2f] relative gap-2 transition duration-300 hover:scale-105 text-white shadow-glass">
                        Volver a las noticias
                    </a>
                </div>

               {{--  Información del autor y fecha (centrado) --}} 
                <div class="mt-10 text-center">
                    <p class="text-[28px] text-gray-700"><strong class="font-semibold">Autor:</strong>
                        {{ $noticia->autor }}</p>
                    <p class="text-[28px] text-gray-700"><strong class="font-semibold">Fecha:</strong>
                        {{ $noticia->created_at->format('d M, Y') }}</p>
                </div>
            </div>

            {{--  Imagen de la noticia --}} 
            <div class="relative sm:mt-0 mt-10 px-6 sm:px-0">
                <img class="w-[800px] animate__animated animate__fadeInRight animate__delay-.5s"
                    src="{{ Storage::url($noticia->imagen) }}" alt="Imagen de la noticia" />
            </div>
        </div>
    </div>
</body>

</html>
