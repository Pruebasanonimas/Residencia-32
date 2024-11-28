@vite('resources/css/app.css')
@extends('layouts.app')

@section('content')
    
    <div class="flex justify-end p-4">
       
        <a href="{{ route('cursos.edit') }}"
            class="group inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-blue-500 p-[2px] text-sm font-semibold 
            rounded-full transition-all hover:shadow-lg active:scale-95">
           
            <span class="block rounded-full bg-white px-6 py-2 text-black group-hover:bg-transparent group-hover:text-white">
                Volver a los cursos
            </span>
        </a>
    </div>

    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 py-12">
        <div class="max-w-2xl w-full bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 text-center">Editar Curso</h2>
            <p class="text-gray-600 text-center mb-4">Edita las secciones del curso <strong>{{ $curso->nombre }}</strong></p>

            <a href="{{ route('exams.edit', $curso->id) }}"
                class="block w-full text-center bg-blue-600 text-white py-2 rounded-lg mb-4 hover:bg-blue-700">
                Editar Examen
            </a>

             {{-- Nuevo botón para agregar preguntas  --}}
            <a href="{{ route('exams.addPreguntas', $curso->exams->first()->id) }}" 
                class="block w-full text-center bg-green-600 text-white py-2 rounded-lg mb-4 hover:bg-green-700">
                Agregar Preguntas
            </a>

             {{--    Botón para editar la vista del curso --}} 
            <a href="{{ route('cursos.editarvistacurso', $curso->id) }}"
                class="block w-full text-center bg-blue-600 text-white py-2 rounded-lg mb-4 hover:bg-blue-700">
                Editar la vista del Curso
            </a>

             {{-- Botón para eliminar lecciones --}} 
            <a href="{{ route('lecciones.listar', $curso->id) }}"
                class="block w-full text-center bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700">
                Eliminar Lecciones
            </a>
        </div>
    </div>
@endsection
