<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivos</title>
    <style>
      
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #3498db;
          
        }

        .container {
            width: 90%;
            max-width: 1000px;
            background-color: white;
            padding: 60px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-upload {
            color: white;
            background-color: #27ae60;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            display: block;
        }

        .btn-category {
            color: white;
            background-color: #27ae60;
            padding: 12px;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
            margin-top: 10px;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .file-input {
            text-align: center;
            padding: 10px;
        }

        h1 {
            text-align: center;
            color: #3498db;
        }

        
        .progress-container {
            width: 100%;
            background-color: #f3f3f3;
            border-radius: 5px;
            height: 20px;
           
            margin-top: 10px;
            display: none;
           
        }

        .progress-bar {
            width: 0%;
            height: 100%;
            background-color: #27ae60;
            border-radius: 5px;
            text-align: center;
            color: white;
            font-weight: bold;
        }

       
        .boton-volver {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(to right, #9b59b6, #2980b9);
            padding: 2px;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 9999px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        
        }

   
        .boton-volver span {
            display: block;
            border-radius: 9999px;
        
            background-color: white;
            padding: 0.5rem 1.5rem;
            color: black;
            transition: background-color 0.3s ease, color 0.3s ease;
         
        }

       
        .boton-volver:hover span {
            background-color: transparent;
            color: white;
        }

       
        .boton-volver:active {
            transform: scale(0.95);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="flex justify-end p-4">

            <div class="contenedor-boton-volver">
                <a href="{{ route('home') }}" class="boton-volver">
                    <span>🔙 Volver al menú</span>
                </a>
            </div>
            <br>
        </div>
        <h1 class="text-4xl font-bold mb-8 text-center text-indigo-600">Subir Nuevo Archivo</h1>
        <form id="uploadForm" action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            <div>
                <label for="title" class="block text-lg font-medium text-gray-700">Título del archivo</label>
                <input type="text" name="title" id="title"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="category" class="block text-lg font-medium text-gray-700">Categoría</label>
                <select name="category_id" id="category"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="author" class="block text-lg font-medium text-gray-700">Autor</label>
                <input type="text" name="author" id="author"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="file" class="block text-lg font-medium text-gray-700">Cargar Archivo</label>
                <input type="file" name="file" id="file" class="file-input">
            </div>
            <div>
                <button type="submit"
                    class="btn-upload w-full py-3 px-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 shadow-lg">Subir
                    Archivo</button>
            </div>
        </form>

      {{--  Barra de progreso --}}
        <div class="progress-container" id="progressContainer">
            <div class="progress-bar" id="progressBar">0%</div>
        </div>

        <div class="mt-10">
            <h2 class="text-2xl font-semibold mb-4 text-indigo-600">Agregar Nueva Categoría</h2>
            <form action="{{ route('category.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="category_name" class="block text-lg font-medium text-gray-700">Nombre de la
                        categoría</label>
                    <input type="text" name="name" id="category_name"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <button type="submit"
                        class="btn-category w-full py-3 px-4 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 shadow-lg">Agregar
                        Categoría</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const uploadForm = document.getElementById('uploadForm');
        const progressContainer = document.getElementById('progressContainer');
        const progressBar = document.getElementById('progressBar');

        uploadForm.addEventListener('submit', function(e) {
            e.preventDefault(); 

            // Muestra la barra de progreso
            progressContainer.style.display = 'block';

            const formData = new FormData(uploadForm);
            const xhr = new XMLHttpRequest();
            xhr.open('POST', uploadForm.action, true);

            // Evento de progreso
            xhr.upload.addEventListener('progress', function(e) {
                if (e.lengthComputable) {
                    const percent = (e.loaded / e.total) * 100;
                    progressBar.style.width = percent + '%';
                    progressBar.textContent = Math.round(percent) + '%'; // Muestra el porcentaje
                }
            });

            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert('Archivo subido con éxito');
                    progressContainer.style.display = 'none';
                    uploadForm.reset(); 
                } else {
                    alert('Hubo un error en la subida');
                }
            };

           
            xhr.send(formData);
        });
    </script>
</body>

</html>
