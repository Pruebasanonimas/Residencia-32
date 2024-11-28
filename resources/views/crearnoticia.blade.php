<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Noticia</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')

   
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body
    class='flex items-center flex-col justify-center min-h-screen from-purple-200 via-purple-400 to-purple-600 bg-gradient-to-br'>

   
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

    <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-xl'>
        <h1 class="text-2xl font-semibold mb-6">Crear Nueva Noticia</h1>


       {{--  Formulario de Creación de Noticia --}} 
        <form action="{{ route('noticias.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
           
            <div class="w-full mb-4">
                <label class="block mb-1 text-sm text-slate-800 mt-4">Cuerpo</label>
                <div id="editor-container" class="h-64 bg-white"></div> 
                <input type="hidden" name="cuerpo" id="cuerpo"> 
            </div>

        
            <div class="w-full mb-4">
                <label class="block mb-1 text-sm text-slate-800 mt-4">Imagen</label>
                <input type="file" name="imagen"
                    class="w-full bg-transparent text-slate-700 text-sm border border-slate-200 rounded px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                    accept="image/*" required />
            </div>

          
            <div class="w-full mb-4">
                <label class="block mb-1 text-sm text-slate-800 mt-4">Foto de Perfil</label>
                <input type="file" name="foto_perfil"
                    class="w-full bg-transparent text-slate-700 text-sm border border-slate-200 rounded px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                    accept="image/*" />
            </div>

          
            <div class="w-full mb-4">
                <label class="block mb-1 text-sm text-slate-800 mt-4">Autor</label>
                <input type="text" name="autor"
                    class="w-full h-10 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                    required />
            </div>

         
            <button type="submit"
                class="text-sm flex items-center justify-center bg-yellow-300 rounded hover:bg-green-500 py-3 px-6 mt-4">
                Crear Noticia
            </button>
        </form>
    </div>

   
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
        // Inicializar Quill
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

        // Guardar el contenido del editor en el campo oculto antes de enviar el formulario
        document.querySelector('form').onsubmit = function() {
            var contenido = quill.root.innerHTML;
            document.getElementById('cuerpo').value = contenido;
        };
    </script>
</body>

</html>
