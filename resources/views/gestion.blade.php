<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Alumnos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .chart-container {
            width: 50%;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    
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

    <h1>Gestión de Alumnos</h1>
    {{-- Botones para descargar CSV  --}}
    <a
        href="{{ route('alumnos.exportar.csv', [
            'year' => request('year'),
            'month' => request('month'),
            'escuela' => request('escuela'),
            'especialidad' => request('especialidad'),
        ]) }}">
        <button {{ $alumnos->isEmpty() ? 'disabled' : '' }}>Descargar CSV Completo</button>
    </a>

    <a
        href="{{ route('alumnos.exportar.correos.csv', [
            'year' => request('year'),
            'month' => request('month'),
            'escuela' => request('escuela'),
            'especialidad' => request('especialidad'),
        ]) }}">
        <button {{ $alumnos->isEmpty() ? 'disabled' : '' }}>Descargar Correos</button>
    </a>




    {{-- Formulario de filtros --}}
    <div class="filter-container">
        <form action="{{ route('alumnos.gestion') }}" method="GET">
            <!-- Filtro por Año -->
            <label for="year">Filtrar por Año:</label>
            <select name="year" id="year">
                <option value="">Seleccionar Año</option>
                @foreach ($years as $year)
                    <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                        {{ $year }}</option>
                @endforeach
            </select>

            {{-- Filtro por Mes  --}}
            <label for="month">Filtrar por Mes:</label>
            <select name="month" id="month">
                <option value="">Seleccionar Mes</option>
                @foreach ($months as $key => $month)
                    <option value="{{ $key }}" {{ request('month') == $key ? 'selected' : '' }}>
                        {{ $month }}</option>
                @endforeach
            </select>

            {{-- Filtro por Escuela --}} 
            <label for="escuela">Filtrar por Escuela:</label>
            <select name="escuela" id="escuela">
                <option value="">Seleccionar Escuela</option>
                @foreach ($escuelas as $escuela)
                    <option value="{{ $escuela->escuela }}"
                        {{ request('escuela') == $escuela->escuela ? 'selected' : '' }}>
                        {{ $escuela->escuela }}
                    </option>
                @endforeach
            </select>

          {{--  Filtro por Especialidad  --}}
            <label for="especialidad">Filtrar por Especialidad:</label>
            <select name="especialidad" id="especialidad">
                <option value="">Seleccionar Especialidad</option>
                @foreach ($especialidades as $especialidad)
                    <option value="{{ $especialidad->especialidad }}"
                        {{ request('especialidad') == $especialidad->especialidad ? 'selected' : '' }}>
                        {{ $especialidad->especialidad }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Filtrar</button>
        </form>
    </div>

     {{-- Tabla con la lista de alumnos  --}}
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Escuela</th>
                <th>Especialidad</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Domicilio</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->id }}</td>
                    <td>{{ $alumno->nombre }}</td>
                    <td>{{ $alumno->escuela }}</td>
                    <td>{{ $alumno->especialidad }}</td>
                    <td>{{ $alumno->telefono }}</td>
                    <td>{{ $alumno->email }}</td>
                    <td>{{ $alumno->domicilio }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No se encontraron alumnos con esos filtros.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br><br><br>
    <hr color="blue">
    <br><br><br>

    {{--  Formulario de filtros para las gráficas  --}}
    <div class="filter-container">
        <form action="{{ route('alumnos.gestion') }}" method="GET">
          {{--   Filtros para gráficas --}} 
            <label for="year_graph">Año para Gráficas:</label>
            <select name="year_graph" id="year_graph">
                <option value="">Seleccionar Año</option>
                @foreach ($years as $year)
                    <option value="{{ $year }}" {{ request('year_graph') == $year ? 'selected' : '' }}>
                        {{ $year }}</option>
                @endforeach
            </select>

            <label for="month_graph">Mes para Gráficas:</label>
            <select name="month_graph" id="month_graph">
                <option value="">Seleccionar Mes</option>
                @foreach ($months as $key => $month)
                    <option value="{{ $key }}" {{ request('month_graph') == $key ? 'selected' : '' }}>
                        {{ $month }}</option>
                @endforeach
            </select>

            <label for="escuela_graph">Escuela para Gráficas:</label>
            <select name="escuela_graph" id="escuela_graph">
                <option value="">Seleccionar Escuela</option>
                @foreach ($allEscuelas as $escuela)
                    <option value="{{ $escuela }}" {{ request('escuela_graph') == $escuela ? 'selected' : '' }}>
                        {{ $escuela }}
                    </option>
                @endforeach
            </select>

            <label for="especialidad_graph">Especialidad para Gráficas:</label>
            <select name="especialidad_graph" id="especialidad_graph">
                <option value="">Seleccionar Especialidad</option>
                @foreach ($allEspecialidades as $especialidad)
                    <option value="{{ $especialidad }}"
                        {{ request('especialidad_graph') == $especialidad ? 'selected' : '' }}>
                        {{ $especialidad }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Filtrar Gráficas</button>
        </form>
    </div>


    <h2>Gráfica de Barras - Escuelas</h2>
    <div class="chart-container">
        <canvas id="barChartEscuela"></canvas>
        <button id="downloadBtnEscuela">Descargar Gráfica de Escuelas</button>
    </div>

    <h2>Gráfica de Pastel - Escuelas</h2>
    <div class="chart-container">
        <canvas id="pieChartEscuela"></canvas>
        <button id="downloadBtnPieEscuela">Descargar Gráfica de Pastel de Escuelas</button>
    </div>

    <h2>Gráfica de Barras - Especialidades</h2>
    <div class="chart-container">
        <canvas id="barChartEspecialidad"></canvas>
        <button id="downloadBtnEspecialidad">Descargar Gráfica de Especialidades</button>
    </div>

    <h2>Gráfica de Pastel - Especialidades</h2>
    <div class="chart-container">
        <canvas id="pieChartEspecialidad"></canvas>
        <button id="downloadBtnPieEspecialidad">Descargar Gráfica de Pastel de Especialidades</button>
    </div>

   
    <script>
        // Paleta de colores para las gráficas
        const schoolColors = [
            '#FF6384', // Rojo
            '#36A2EB', // Azul
            '#FFCE56', // Amarillo
            '#4BC0C0', // Verde claro
            '#9966FF', // Violeta
            '#FF9F40', // Naranja
            '#FF5733', // Rojo oscuro
            '#FFC300', // Amarillo oscuro
            '#C70039', // Rojo oscuro
            '#900C3F', // Vino
            '#581845', // Morado
        ];

        // Datos de la gráfica - Escuelas
        const escuelas = @json($escuelas->pluck('escuela'));
        const totalEscuelas = @json($escuelas->pluck('total'));

        // Asegurar que los colores no se repitan si hay más escuelas que colores
        const colorsForSchools = schoolColors.slice(0, escuelas.length % schoolColors.length +
        1); // Limitar al número de escuelas

        // Gráfica de Barras para Escuelas
        const barCtxEscuela = document.getElementById('barChartEscuela').getContext('2d');
        new Chart(barCtxEscuela, {
            type: 'bar',
            data: {
                labels: escuelas,
                datasets: [{
                    label: 'Número de Alumnos por Escuela',
                    data: totalEscuelas,
                    backgroundColor: colorsForSchools,
                    borderColor: colorsForSchools,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Gráfica de Pastel para Escuelas
        const pieCtxEscuela = document.getElementById('pieChartEscuela').getContext('2d');
        new Chart(pieCtxEscuela, {
            type: 'pie',
            data: {
                labels: escuelas,
                datasets: [{
                    label: 'Distribución por Escuela',
                    data: totalEscuelas,
                    backgroundColor: colorsForSchools,
                }]
            }
        });

        // Datos de la gráfica - Especialidades
        const especialidades = @json($especialidades->pluck('especialidad'));
        const totalEspecialidades = @json($especialidades->pluck('total'));

        // Asegurar que los colores no se repitan si hay más especialidades que colores
        const colorsForSpecialties = schoolColors.slice(0, especialidades.length % schoolColors.length +
        1); 

        // Gráfica de Barras para Especialidades
        const barCtxEspecialidad = document.getElementById('barChartEspecialidad').getContext('2d');
        new Chart(barCtxEspecialidad, {
            type: 'bar',
            data: {
                labels: especialidades,
                datasets: [{
                    label: 'Número de Alumnos por Especialidad',
                    data: totalEspecialidades,
                    backgroundColor: colorsForSpecialties,
                    borderColor: colorsForSpecialties,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Gráfica de Pastel para Especialidades
        const pieCtxEspecialidad = document.getElementById('pieChartEspecialidad').getContext('2d');
        new Chart(pieCtxEspecialidad, {
            type: 'pie',
            data: {
                labels: especialidades,
                datasets: [{
                    label: 'Distribución por Especialidad',
                    data: totalEspecialidades,
                    backgroundColor: colorsForSpecialties,
                }]
            }
        });

        // Función para descargar el canvas como imagen
        function downloadCanvas(canvasId, filename) {
            const canvas = document.getElementById(canvasId);

            // Crear un nuevo canvas para dibujar con fondo blanco
            const tempCanvas = document.createElement('canvas');
            tempCanvas.width = canvas.width;
            tempCanvas.height = canvas.height;
            const ctx = tempCanvas.getContext('2d');

            // Dibuja un fondo blanco en el nuevo canvas
            ctx.fillStyle = 'white';
            ctx.fillRect(0, 0, tempCanvas.width, tempCanvas.height);

            // Dibuja la gráfica original sobre el fondo blanco
            ctx.drawImage(canvas, 0, 0);

            // Crea el enlace de descarga con el nuevo canvas
            const link = document.createElement('a');
            link.href = tempCanvas.toDataURL('image/jpg');
            link.download = filename;
            link.click();
        }


        // Event listeners para los botones de descarga
        document.getElementById('downloadBtnEscuela').addEventListener('click', function() {
            downloadCanvas('barChartEscuela', 'grafica_escuelas.jpg');
        });

        document.getElementById('downloadBtnPieEscuela').addEventListener('click', function() {
            downloadCanvas('pieChartEscuela', 'grafica_pie_escuelas.jpg');
        });

        document.getElementById('downloadBtnEspecialidad').addEventListener('click', function() {
            downloadCanvas('barChartEspecialidad', 'grafica_especialidades.jpg');
        });

        document.getElementById('downloadBtnPieEspecialidad').addEventListener('click', function() {
            downloadCanvas('pieChartEspecialidad', 'grafica_pie_especialidades.jpg');
        });
    </script>

</body>

</html>
