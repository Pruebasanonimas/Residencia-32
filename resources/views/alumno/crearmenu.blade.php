@extends('layouts.custom-layout')

@section('content')

    <div class="flex justify-end p-4">
   
        <a href="{{ route('home') }}"
            class="group inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-blue-500 p-[2px] text-sm font-semibold 
            rounded-full transition-all hover:shadow-lg active:scale-95">
           {{--  Contenedor interno  --}}
            <span class="block rounded-full bg-white px-6 py-2 text-black group-hover:bg-transparent group-hover:text-white">
                Volver al menú
            </span>
        </a>
    </div>
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold text-center mb-6">Crear Menú Inicial</h1>
        <form action="{{ route('alumno.storemenu') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

           {{--   Imagen  --}}
            <div>
                <label for="imagen" class="block text-lg font-medium">Imagen del Carrusel</label>
                <input type="file" name="imagen" id="imagen" accept="image/png, image/jpeg, image/jpg, image/gif"
                    class="block w-full border rounded-md mt-2" required>
            </div>

            {{--  Título  --}}
            <div>
                <label for="titulo" class="block text-lg font-medium">Título (opcional)</label>
                <input type="text" name="titulo" id="titulo" class="block w-full border rounded-md mt-2">
            </div>

          {{--   Descripción  --}}
            <div>
                <label for="descripcion" class="block text-lg font-medium">Descripción (opcional)</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="block w-full border rounded-md mt-2"></textarea>
            </div>

           {{--   Contenido  --}}
            <div>
                <label for="contenido" class="block text-lg font-medium">Información de la Página</label>
                <div id="editor-container" class="border rounded-md p-2"></div>
                <input type="hidden" name="contenido" id="contenido">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Guardar</button>
        </form>
    </div>

    {{-- Quill  --}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }]
                ]
            }
        });

        document.querySelector('form').onsubmit = function() {
            document.querySelector('#contenido').value = quill.root.innerHTML;
        };
    </script>
@endsection
