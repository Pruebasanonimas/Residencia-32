<?php

namespace App\Http\Controllers;

use App\Models\Alumnoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AlumnosController extends Controller
{
    
    // Función para obtener datos de los alumnos con filtros y gráficas
    public function obtenerDatos(Request $request)
    {
        $years = Alumnoe::selectRaw('YEAR(created_at) as year')->distinct()->orderBy('year', 'desc')->pluck('year');
        $months = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];

        $selectedYear = $request->input('year');
        $selectedMonth = $request->input('month');
        $selectedEscuela = $request->input('escuela');
        $selectedEspecialidad = $request->input('especialidad');

        $query = Alumnoe::query();
        if ($selectedYear) $query->whereYear('created_at', $selectedYear);
        if ($selectedMonth) $query->whereMonth('created_at', $selectedMonth);
        if ($selectedEscuela) $query->where('escuela', $selectedEscuela);
        if ($selectedEspecialidad) $query->where('especialidad', $selectedEspecialidad);

        $alumnos = $query->get();

        $allEscuelas = Alumnoe::select('escuela')->distinct()->pluck('escuela');
        $allEspecialidades = Alumnoe::select('especialidad')->distinct()->pluck('especialidad');

        $graphYear = $request->input('year_graph');
        $graphMonth = $request->input('month_graph');
        $graphEscuela = $request->input('escuela_graph');
        $graphEspecialidad = $request->input('especialidad_graph');

        $graphQuery = Alumnoe::query();
        if ($graphYear) $graphQuery->whereYear('created_at', $graphYear);
        if ($graphMonth) $graphQuery->whereMonth('created_at', $graphMonth);
        if ($graphEscuela) $graphQuery->where('escuela', $graphEscuela);
        if ($graphEspecialidad) $graphQuery->where('especialidad', $graphEspecialidad);

        $escuelas = $graphQuery->select('escuela', DB::raw('count(*) as total'))->groupBy('escuela')->get();
        $especialidades = $graphQuery->select('especialidad', DB::raw('count(*) as total'))->groupBy('especialidad')->get();

        return view('gestion', compact('alumnos', 'escuelas', 'especialidades', 'years', 'months', 'allEscuelas', 'allEspecialidades'));
    }

   
    // Función para exportar los alumnos a CSV
    public function exportarCSV(Request $request)
    {
        $selectedYear = $request->input('year');
        $selectedMonth = $request->input('month');
        $selectedEscuela = $request->input('escuela');
        $selectedEspecialidad = $request->input('especialidad');

        $query = Alumnoe::query();
        if ($selectedYear) $query->whereYear('created_at', $selectedYear);
        if ($selectedMonth) $query->whereMonth('created_at', $selectedMonth);
        if ($selectedEscuela) $query->where('escuela', $selectedEscuela);
        if ($selectedEspecialidad) $query->where('especialidad', $selectedEspecialidad);

        $alumnos = $query->get();

        if ($alumnos->isEmpty()) {
            return redirect()->back()->with('error', 'No hay alumnos para exportar en el período seleccionado.');
        }

        $response = new StreamedResponse(function () use ($alumnos) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, ['ID', 'Nombre', 'Escuela', 'Especialidad', 'Teléfono', 'Correo', 'Domicilio']);

            foreach ($alumnos as $alumno) {
                fputcsv($handle, [
                    $alumno->id,
                    $alumno->nombre,
                    $alumno->escuela,
                    $alumno->especialidad,
                    $alumno->telefono,
                    $alumno->email,
                    $alumno->domicilio
                ]);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="alumnos_filtrados.csv"',
        ]);

        return $response;
    }

    // Función para exportar solo los correos a CSV
    public function exportarCorreosCSV(Request $request)
    {
        $selectedYear = $request->input('year');
        $selectedMonth = $request->input('month');
        $selectedEscuela = $request->input('escuela');
        $selectedEspecialidad = $request->input('especialidad');

        $query = Alumnoe::query();
        if ($selectedYear) $query->whereYear('created_at', $selectedYear);
        if ($selectedMonth) $query->whereMonth('created_at', $selectedMonth);
        if ($selectedEscuela) $query->where('escuela', $selectedEscuela);
        if ($selectedEspecialidad) $query->where('especialidad', $selectedEspecialidad);

        $alumnos = $query->get(['email']);

        $csvFileName = 'correos_alumnos.csv';

        return response()->stream(function () use ($alumnos) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, ['Correo']);

            foreach ($alumnos as $alumno) {
                fputcsv($handle, [$alumno->email]);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$csvFileName\"",
        ]);
    }
}
