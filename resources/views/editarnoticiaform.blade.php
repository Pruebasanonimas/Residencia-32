<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Noticia</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body
    class='flex items-center flex-col justify-center min-h-screen from-purple-200 via-purple-400 to-purple-600 bg-gradient-to-br'>
    <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-xl'>
        <h1 class="text-2xl font-semibold mb-6">Editar Noticia</h1>

   
        <form action="{{ route('noticias.update', $noticia->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 

        
            <div class="w-full mb-4">
                <label class="block mb-1 text-sm text-slate-800 mt-4">Cuerpo</label>
                <div id="editor-container" class="h-64 bg-white">
                    {!! $noticia->cuerpo !!} 
                </div>
                <input type="hidden" name="cuerpo" id="cuerpo">
            </div>

           
            <div class="w-full mb-4">
                <label class="block mb-1 text-sm text-slate-800 mt-4">Imagen</label>
                <input type="file" name="imagen"
                    class="w-full bg-transparent text-slate-700 text-sm border border-slate-200 rounded px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                    accept="image/*" />
                <p class="text-sm text-gray-600">Dejar en blanco para mantener la imagen actual</p>
            </div>

         
            <div class="w-full mb-4">
                <label class="block mb-1 text-sm text-slate-800 mt-4">Foto de Perfil</label>
                <input type="file" name="foto_perfil"
                    class="w-full bg-transparent text-slate-700 text-sm border border-slate-200 rounded px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                    accept="image/*" />
                <p class="text-sm text-gray-600">Dejar en blanco para mantener la foto de perfil actual</p>
                @if ($noticia->foto_perfil)
                    <div class="mt-2">
                        <p class="text-sm text-slate-800">Foto de Perfil Actual:</p>
                        <img src="{{ asset('storage/' . $noticia->foto_perfil) }}" alt="Foto de Perfil Actual"
                            class="w-20 h-20 rounded-full">
                    </div>
                @endif
            </div>

           
            <div class="w-full mb-4">
                <label class="block mb-1 text-sm text-slate-800 mt-4">Autor</label>
                <input type="text" name="autor" value="{{ $noticia->autor }}"
                    class="w-full h-10 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                    required />
            </div>

           
            <button type="submit"
                class="text-sm flex items-center justify-center bg-yellow-300 rounded hover:bg-green-500 py-3 px-6 mt-4">
                Actualizar Noticia
            </button>
        </form>
    </div>

  
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{
                        'font': []
                    }, {
                        'size': []
                    }],
                    ['bold', 'italic', 'underline'],
                    [{
                        'align': []
                    }],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }],
                    ['link', 'video']
                ]
            }
        });

        document.querySelector('form').onsubmit = function() {
            var contenido = quill.root.innerHTML;
            document.getElementById('cuerpo').value = contenido;
        };
    </script>
</body>

</html>
