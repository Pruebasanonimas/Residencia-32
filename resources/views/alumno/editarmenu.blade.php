<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Menú</title>


    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    <style>
        .ql-snow .ql-picker.ql-size .ql-picker-label::before,
        .ql-snow .ql-picker.ql-size .ql-picker-item::before {
            content: attr(data-label);
        }

  
        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="10px"]::before {
            content: "10";
        }

        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="12px"]::before {
            content: "12";
        }

        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="14px"]::before {
            content: "14";
        }

        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="16px"]::before {
            content: "16";
        }

        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="18px"]::before {
            content: "18";
        }

        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="20px"]::before {
            content: "20";
        }

        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="22px"]::before {
            content: "22";
        }

        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="24px"]::before {
            content: "24";
        }

        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="26px"]::before {
            content: "26";
        }

        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="28px"]::before {
            content: "28";
        }

        .ql-snow .ql-picker.ql-size .ql-picker-item[data-value="30px"]::before {
            content: "30";
        }
    </style>

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
    <div class="container mx-auto mt-10 bg-white p-6 rounded-md shadow-lg">
        <h1 class="text-2xl font-bold text-center mb-6">Editar Menú</h1>

      {{--   Formulario para editar contenido  --}}
        <form action="{{ route('alumno.updatemenu') }}" method="POST" class="space-y-6">
            @csrf

           {{--   Contenido  --}}
            <div>
                <label for="contenido" class="block text-lg font-medium">Información de la Página</label>
              {{--    Editor Quill  --}}
                <div id="editor-container" class="border rounded-md p-2 h-64">
                    {!! $informacion->contenido !!}
                </div>
                {{--  Campo oculto para enviar el contenido  --}}
                <input type="hidden" name="contenido" id="contenido">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Actualizar</button>
        </form>

       {{--   Carrusel (Mostrar imágenes existentes y opciones para eliminar)  --}}
        <h2 class="text-xl font-bold mt-8">Gestionar Imágenes del Carrusel</h2>
        <form action="{{ route('alumno.addimagenmenu') }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            <div class="flex items-center space-x-4">
                <input type="file" name="imagen" accept="image/*" class="border p-2 rounded-md">
                <input type="text" name="titulo" placeholder="Título" class="border p-2 rounded-md">
                <input type="text" name="descripcion" placeholder="Descripción" class="border p-2 rounded-md">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md">Agregar Imagen</button>
            </div>
        </form>

        {{--  Mostrar imágenes actuales  --}}
        <div class="mt-6 grid grid-cols-3 gap-4">
            @foreach ($imagenes as $imagen)
                <div class="relative">
                    <img src="{{ asset('storage/' . $imagen->imagen) }}" class="w-full h-32 object-cover rounded-md"
                        alt="Imagen Carrusel">
                    <div class="absolute top-2 right-2">
                {{-- Eliminación de imagen  --}}
                        <form action="{{ route('alumno.deleteimagenmenu', $imagen->id) }}" method="POST"
                            class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
      
        const Font = Quill.import('formats/font');
        Font.whitelist = ['serif', 'sans-serif', 'monospace', 'cursive'];
        Quill.register(Font, true);

     
        const SizeStyle = Quill.import('attributors/style/size');
        SizeStyle.whitelist = [
            '10px', '12px', '14px', '16px',
            '18px', '20px', '22px', '24px',
            '26px', '28px', '30px'
        ];
        Quill.register(SizeStyle, true);

        // Inicializar Quill
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: [
             
                    [{
                        'font': ['serif', 'sans-serif', 'monospace', 'cursive']
                    }],
                  
                    [{
                        'size': [
                            '10px', '12px', '14px', '16px',
                            '18px', '20px', '22px', '24px',
                            '26px', '28px', '30px'
                        ]
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
            document.getElementById('contenido').value = contenido;
        };
    </script>


</body>

</html>
