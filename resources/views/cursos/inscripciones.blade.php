@vite('resources/css/app.css')

@extends('layouts.app')


<div class="flex justify-start p-4">
    
    <a href="{{ route('alumno.principal') }}"
        class="group inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-blue-500 p-[2px] text-sm font-semibold 
              rounded-full transition-all hover:shadow-lg active:scale-95">
      
        <span class="block rounded-full bg-white px-6 py-2 text-black group-hover:bg-transparent group-hover:text-white">
            Volver al menú
        </span>
    </a>
</div>

@section('content')
    <div class="min-h-screen bg-gradient-to-tr from-blue-300 to-blue-200 flex justify-center items-center py-20">
        <div class="md:px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @if ($inscripciones->isEmpty())
                <p class="text-center text-gray-600 col-span-full">No estás inscrito en ningún curso.</p>
            @else
                @foreach ($inscripciones as $inscripcion)
                    <div class="w-[300px] bg-white rounded-lg shadow-lg transform hover:scale-105 transition duration-500">
                        <div class="relative">
                            @if ($inscripcion->curso->imagen)
                                <img src="{{ asset('storage/' . $inscripcion->curso->imagen) }}" alt="Imagen del curso"
                                    class="w-full h-[200px] object-cover rounded-t-lg">
                            @else
                                <div class="w-full h-[200px] bg-gray-300 flex justify-center items-center rounded-t-lg">
                                    <span class="text-gray-600">No hay imagen disponible</span>
                                </div>
                            @endif

                             {{-- Cambiar el color de fondo según el estado del curso --}}
                            <p
                                class="absolute bottom-0 left-0 
                            {{ $inscripcion->curso->estado == 1 ? 'bg-green-500' : 'bg-red-500' }} 
                            text-white font-semibold py-1 px-2 text-xs rounded-br-lg">
                                {{ $inscripcion->curso->estado == 1 ? 'Activo' : 'Inactivo' }}
                            </p>
                        </div>

                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-900">{{ $inscripcion->curso->nombre }}</h3>
                            <p class="text-sm text-gray-600">{{ $inscripcion->curso->profesor->name }}</p>
                          {{-- Nombre del profesor  --}}
                            <div class="flex items-center my-2">
                                <p class="text-yellow-500 font-semibold">
                                    {{ number_format($inscripcion->curso->promedioEstrellas(), 1) }} <span
                                        class="text-gray-600">★</span>
                                </p>
                                <span class="ml-1 text-gray-600 text-sm">({{ $inscripcion->curso->calificaciones->count() }}
                                    reseñas)</span>
                            </div>

                            <div class="text-sm text-gray-600 my-2">
                                <strong>Duración:</strong> {{ $inscripcion->curso->duracion }}
                            </div>
                            <div class="flex items-center space-x-2 my-2">
                                @if ($inscripcion->curso->precio == 0)
                                    <p class="text-lg font-semibold text-gray-900">Gratis</p>
                                @else
                                    <p class="text-lg font-semibold text-gray-900">{{ $inscripcion->curso->precio }} MX$</p>
                                @endif
                            </div>

                             {{-- Condición para deshabilitar el botón si el curso está inactivo --}} 
                            <a href="{{ route('cursos.show', $inscripcion->curso->id) }}"
                                class="mt-4 w-full block text-center text-white bg-indigo-600 py-2 rounded-lg shadow-lg 
                           {{ $inscripcion->curso->estado == 0 ? 'cursor-not-allowed opacity-50 pointer-events-none' : '' }}"
                                {{ $inscripcion->curso->estado == 0 ? 'disabled' : '' }}>
                                Seguir Curso
                            </a>

                            <p>
                                Progreso:
                                {{ $inscripcion->curso->lecciones->whereIn('id', auth('alumnoe')->user()->progresos->where('completado', true)->pluck('leccion_id'))->count() }}
                                /
                                {{ $inscripcion->curso->lecciones->count() }}
                            </p>

                            <p>
                                Puntaje:
                                @php
                                    $resultado = $inscripcion->curso->examen
                                        ? $inscripcion->curso->examen->resultados
                                            ->where('alumno_id', auth('alumnoe')->id())
                                            ->first()
                                        : null;
                                @endphp

                                @if ($resultado)
                                    {{ $resultado->puntaje }} / {{ $resultado->exam->questions->count() }}
                                    ({{ $resultado->porcentaje }}%)
                                @else
                                    Aún no has realizado el examen.
                                @endif
                            </p>

                            {{--  Botón para eliminar inscripción --}} 
                            <form action="{{ route('inscripcion.eliminar', $inscripcion->curso->id) }}" method="POST"
                                class="mt-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full text-center text-red-600 bg-transparent border-2 border-red-600 py-2 rounded-lg hover:bg-red-600 hover:text-white">
                                    Eliminar Inscripción
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
