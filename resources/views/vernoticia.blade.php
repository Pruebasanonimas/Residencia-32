<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Noticias</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @vite('resources/css/app.css')

    <style>
        .image-fixed {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .bg-custom {
            background-color: #2d2d2d;
        }

        .bg-card {
            background-color: #ffffff;
        }

        .text-custom {
            color: #000000;
        }

        .bg-blue-light {
            background-color: #a1c6ea;
        }

        .hover-custom:hover {
            color: #3490dc;
        }
    </style>
</head>

<body class="antialiased bg-blue-light">

   
    <div class="flex justify-start p-4">
    
        <a href="{{ route('alumno.principal') }}"
            class="group inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-blue-500 p-[2px] text-sm font-semibold 
              rounded-full transition-all hover:shadow-lg active:scale-95">
      
            <span
                class="block rounded-full bg-white px-6 py-2 text-black group-hover:bg-transparent group-hover:text-white">
                Volver al menú
            </span>
        </a>
    </div>

    <div class="bg-cover bg-center" style="background-image: url('/images/logoeditable.png');">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 p-4">
            @foreach ($noticias as $noticia)
                <div class="bg-card border rounded-sm max-w-md">
                    <div class="flex items-center px-4 py-3">
                        <img class="h-8 w-8 rounded-full" src="{{ Storage::url($noticia->foto_perfil) }}"
                            alt="Perfil del autor" />
                        <div class="ml-3">
                            <span
                                class="text-sm font-semibold text-custom antialiased block leading-tight">{{ $noticia->autor }}</span>
                            <span class="text-gray-400 text-xs block">{{ $noticia->created_at->format('d M, Y') }}
                                &middot;</span>

                        </div>
                    </div>
                    <img class="image-fixed" src="{{ Storage::url($noticia->imagen) }}" alt="Imagen de la noticia" />
                    <div class="flex items-center justify-between mx-4 mt-3 mb-2">
                        <div class="flex gap-5">
                           {{--  Botón de like --}} 
                            <button class="like-button" data-id="{{ $noticia->id }}" data-alumnoe-id="12345">
                              
                                <svg fill="#262626" height="24" viewBox="0 0 48 48" width="24"
                                    class="hover-custom">
                                    <path
                                        d="M34.6 6.1c5.7 0 10.4 5.2 10.4 11.5 0 6.8-5.9 11-11.5 16S25 41.3 24 41.9c-1.1-.7-4.7-4-9.5-8.3-5.7-5-11.5-9.2-11.5-16C3 11.3 7.7 6.1 13.4 6.1c4.2 0 6.5 2 8.1 4.3 1.9 2.6 2.2 3.9 2.5 3.9.3 0 .6-1.3 2.5-3.9 1.6-2.3 3.9-4.3 8.1-4.3m0-3c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5.6 0 1.1-.2 1.6-.5 1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z">
                                    </path>
                                </svg>
                            </button>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            {{-- Botón de "Ver más" con solo el icono --}}
                            <a href="{{ route('noticias.show', $noticia->id) }}"
                                class="text-black hover:text-gray-700 flex items-center gap-2 ml-auto">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    {{--  Likes  --}}
                    <p class="text-black text-sm ml-4 mt-2">Likes: <span
                            id="like-count-{{ $noticia->id }}">{{ $noticia->likes_count }}</span></p>
                    <p class="text-gray-800 text-sm ml-4 mt-3">{{ Str::limit($noticia->descripcion, 100) }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.like-button', function() {
            const noticiaId = $(this).data('id');
            const alumnoeId = $(this).data('alumnoe-id'); 

            $.ajax({
                url: `/noticias/${noticiaId}/like`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    alumnoe_id: alumnoeId 
                },
                success: function(response) {
                    
                    $(`#like-count-${noticiaId}`).text(response.likes);
                },
                error: function() {
                    alert('Error al dar like.');
                }
            });
        });
    </script>
</body>

</html>
