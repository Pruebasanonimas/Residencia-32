@extends('layouts.editcurso')

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

    <div class="text-center mb-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Editar Curso: {{ $curso->nombre }}</h1>
    </div>

    <form action="{{ route('cursos.update', $curso->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="mb-6">
            <label for="nombre" class="block text-lg font-medium text-gray-700">Nombre del Curso</label>
            <input type="text"
                class="mt-2 block w-full border-2 border-gray-300 rounded-lg p-3 text-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                id="nombre" name="nombre" value="{{ old('nombre', $curso->nombre) }}" required>
            @error('nombre')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

      
        <div class="mb-6">
            <label for="descripcion" class="block text-lg font-medium text-gray-700">Descripción</label>
            <textarea
                class="mt-2 block w-full border-2 border-gray-300 rounded-lg p-3 text-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                id="descripcion" name="descripcion" required>{{ old('descripcion', $curso->descripcion) }}</textarea>
            @error('descripcion')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

      
        <div class="mb-6">
            <label for="estado" class="block text-lg font-medium text-gray-700">Estado</label>
            <select
                class="mt-2 block w-full border-2 border-gray-300 rounded-lg p-3 text-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                id="estado" name="estado" required>
                <option value="1" {{ $curso->estado == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ $curso->estado == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
            @error('estado')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        
        <div class="mb-6">
            <label for="imagen" class="block text-lg font-medium text-gray-700">Imagen del Curso</label>
            <input type="file"
                class="mt-2 block w-full border-2 border-gray-300 rounded-lg p-3 text-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                id="imagen" name="imagen">
            @error('imagen')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

     
        <div class="text-center">
            <button type="submit"
                class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-200">Actualizar
                Curso</button>
        </div>
    </form>
@endsection
