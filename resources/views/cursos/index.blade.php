@vite('resources/css/app.css')

@extends('layouts.app')


<div class="flex justify-end p-4">
  
    <a href="{{ route('home') }}"
        class="group inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-blue-500 p-[2px] text-sm font-semibold 
            rounded-full transition-all hover:shadow-lg active:scale-95">
       
        <span class="block rounded-full bg-white px-6 py-2 text-black group-hover:bg-transparent group-hover:text-white">
            Volver a los cursos
        </span>
    </a>
</div>

@section('content')
    <div class="min-h-screen bg-gradient-to-tr from-blue-300 to-blue-200 flex justify-center items-center py-20">
        <div class="md:px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @if ($cursos->isEmpty())
                <p class="text-center text-gray-600 col-span-full">No hay cursos disponibles.</p>
            @else
                @foreach ($cursos as $curso)
                    <div class="w-[300px] bg-white rounded-lg shadow-lg transform hover:scale-105 transition duration-500">
                        <div class="relative">
                            @if ($curso->imagen)
                                <img src="{{ asset('storage/' . $curso->imagen) }}" alt="Imagen del curso"
                                    class="w-full h-[200px] object-cover rounded-t-lg">
                            @else
                                <div class="w-full h-[200px] bg-gray-300 flex justify-center items-center rounded-t-lg">
                                    <span class="text-gray-600">No hay imagen disponible</span>
                                </div>
                            @endif

                            <p
                                class="absolute bottom-0 left-0 
                            {{ $curso->estado == 1 ? 'bg-green-500' : 'bg-red-500' }} 
                            text-white font-semibold py-1 px-2 text-xs rounded-br-lg">
                                {{ $curso->estado == 1 ? 'Activo' : 'Inactivo' }}
                            </p>
                        </div>

                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-900">{{ $curso->nombre }}</h3>
                            <p class="text-sm text-gray-600">{{ $curso->profesor->name }}</p> 
                            <div class="flex items-center my-2">
                                <p class="text-yellow-500 font-semibold">
                                    {{ number_format($curso->promedioEstrellas(), 1) }} <span class="text-gray-600">★</span>
                                </p>
                                <span class="ml-1 text-gray-600 text-sm">({{ $curso->calificaciones->count() }}
                                    reseñas)</span>
                            </div>

                            <div class="text-sm text-gray-600 my-2">
                                <strong>Duración:</strong> {{ $curso->duracion }}
                            </div>
                            <div class="flex items-center space-x-2 my-2">
                                @if ($curso->precio == 0)
                                    <p class="text-lg font-semibold text-gray-900">Gratis</p>
                                @else
                                    <p class="text-lg font-semibold text-gray-900">{{ $curso->precio }} MX$</p>
                                @endif
                            </div>
                            <a href="{{ route('cursos.vistacurso', $curso->id) }}"
                                class="mt-4 w-full block text-center text-white bg-indigo-600 py-2 rounded-lg shadow-lg">Ver
                                Curso</a>
                            <a href="{{ route('cursos.alumnosinscritos', $curso->id) }}"
                                class="mt-4 w-full block text-center text-white bg-indigo-600 py-2 rounded-lg shadow-lg">Ver
                                alumnos inscritos</a>

                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
