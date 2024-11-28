<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FullCalenderController extends Controller
{
    /**
     * Mostrar el calendario y los eventos.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */

     // Mostrar la vista del calendario
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
        }
        return view('fullcalender');
    }

    /**
     * Manejar solicitudes AJAX para agregar, actualizar o eliminar eventos.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function ajax(Request $request): JsonResponse
    {
        // Validación de los datos recibidos
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'start' => 'sometimes|required|date',
            'end' => 'sometimes|required|date',
            'id' => 'sometimes|integer|exists:events,id',
        ]);

        switch ($request->type) {
            case 'add':
                $event = Event::create([
                    'title' => $validatedData['title'],
                    'start' => $validatedData['start'],
                    'end' => $validatedData['end'],
                ]);
                return response()->json($event);

            case 'update':
                $event = Event::findOrFail($validatedData['id']);
                $event->update([
                    'title' => $validatedData['title'],
                    'start' => $validatedData['start'],
                    'end' => $validatedData['end'],
                ]);
                return response()->json($event);

            case 'delete':
                $event = Event::findOrFail($validatedData['id']);
                $event->delete();
                return response()->json(['success' => true]);

            default:
                return response()->json(['error' => 'Invalid type'], 400);
        }
    }
}
