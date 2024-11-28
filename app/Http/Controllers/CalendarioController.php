<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class CalendarioController extends Controller
{
    /**
     * Mostrar solo los eventos en el calendario para los usuarios.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */

    //Función para solo mostrar la vista de calendario a alumnos
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
        }
        return view('calendario');
    }
}
