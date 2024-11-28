<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archivos</title>
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
            max-width: 1200px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .action-buttons a,
        .action-buttons form {
            display: inline-block;
        }

        .search-input {
            padding: 10px;
            width: 100%;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-download {
            color: white;
            background-color: #27ae60;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-delete {
            color: white;
            background-color: #e74c3c;
            padding: 8px 16px;
            border-radius: 5px;
            border: none;
        }

        .contenedor-boton-volver {
            display: flex;
            justify-content: flex-end;
          
            padding: 1rem;
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

        <div class="contenedor-boton-volver">
            <a href="{{ route('home') }}" class="boton-volver">
                <span>🔙 Volver al menú</span>
            </a>
        </div>
        <br>
        <h1 class="text-3xl font-bold mb-6 text-center">Archivos</h1>

        <div class="mb-6">
            <form action="{{ url('/edit') }}" method="GET" class="flex items-center space-x-4">
                <select name="category_id" class="px-4 py-2 border border-gray-300 rounded-md">
                    <option value="">Todas las Categorías</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md">Filtrar</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Autor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($uploads as $upload)
                    <tr>
                        <td>{{ $upload->title }}</td>
                        <td>{{ $upload->category->name }}</td>
                        <td>{{ $upload->author }}</td>
                        <td class="action-buttons">
                            <a href="{{ asset('storage/' . $upload->file_path) }}" download
                                class="btn-download">Descargar</a>
                            <form action="{{ route('delete', $upload->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
