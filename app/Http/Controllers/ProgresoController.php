<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progreso;

class ProgresoController extends Controller
{
    // Función para actualizar el progreso de la lección especifica
    public function actualizarProgreso(Request $request, $leccionId)
    {
        $alumnoId = auth('alumnoe')->id();
        $progreso = Progreso::updateOrCreate(
            ['alumno_id' => $alumnoId, 'leccion_id' => $leccionId],
            ['completado' => $request->input('completado', false)]
        );

        return response()->json(['success' => true, 'progreso' => $progreso]);
    }
}
