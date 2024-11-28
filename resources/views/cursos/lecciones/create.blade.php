<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Lección al Curso</title>


    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">

   
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

    <div class="flex items-center justify-center p-12">
        <div class="w-full max-w-[550px] bg-white p-6 rounded-md shadow-lg">
            <h2 class="text-2xl font-semibold text-center mb-6">Agregar Lección al Curso: {{ $curso->nombre }}</h2>

            <form action="{{ route('lecciones.store', $curso->id) }}" method="POST">
                @csrf
              
                <div class="mb-5">
                    <label for="titulo" class="block text-base font-medium">Título de la Lección</label>
                    <input type="text" class="w-full rounded-md border py-3 px-6" id="titulo" name="titulo"
                        required>
                </div>

             {{-- Contenido de la Lección con Quill --}} 
                <div id="editor-container" class="h-64 bg-white"></div>
                <input type="hidden" name="contenido" id="contenido">

             
                <button type="submit"
                    class="w-full py-3 px-8 rounded-md bg-blue-600 text-white font-semibold hover:bg-blue-500 focus:outline-none">Guardar
                    Lección</button>
            </form>
        </div>
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
            console.log(contenido); 
            document.getElementById('contenido').value = contenido;
        };
    </script>
</body>

</html>
