@vite('resources/css/app.css')
@extends('layouts.app')


<div class="flex justify-end p-4">
 
    <a href="{{ route('home') }}"
        class="group inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-blue-500 p-[2px] text-sm font-semibold 
            rounded-full transition-all hover:shadow-lg active:scale-95">
       
        <span class="block rounded-full bg-white px-6 py-2 text-black group-hover:bg-transparent group-hover:text-white">
            Volver al menú
        </span>
    </a>
</div>
@section('content')
    <div class="min-h-screen bg-gradient-to-tr from-blue-300 to-blue-200 flex justify-center items-center py-20">

  
        <div class="w-full max-w-4xl bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-2xl font-semibold text-center mb-6">Crear Nuevo Curso</h1>

            <form action="{{ route('cursos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

               
                <div class="form-group mb-4">
                    <label for="nombre" class="text-gray-700 font-medium">Nombre del Curso</label>
                    <input type="text" class="form-control border-2 border-gray-300 rounded-lg p-2 w-full" id="nombre"
                        name="nombre" value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

               
                <div class="form-group mb-4">
                    <label for="descripcion" class="text-gray-700 font-medium">Descripción</label>
                    <textarea class="form-control border-2 border-gray-300 rounded-lg p-2 w-full" id="descripcion" name="descripcion"
                        required>{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

              
                <div class="form-group mb-4">
                    <label for="estado" class="text-gray-700 font-medium">Estado</label>
                    <select class="form-control border-2 border-gray-300 rounded-lg p-2 w-full" id="estado"
                        name="estado" required>
                        <option value="1" {{ old('estado') == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado') == 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

               
                <div class="form-group mb-4">
                    <label for="duracion" class="text-gray-700 font-medium">Duración del curso</label>
                    <input type="text" class="form-control border-2 border-gray-300 rounded-lg p-2 w-full" id="duracion"
                        name="duracion" value="{{ old('duracion') }}" required
                        placeholder="Ej: 1 hora 30 minutos o 120 minutos">
                    @error('duracion')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

            
                <div class="form-group mb-4">
                    <label for="imagen" class="text-gray-700 font-medium">Imagen del Curso</label>
                    <input type="file" class="form-control border-2 border-gray-300 rounded-lg p-2 w-full" id="imagen"
                        name="imagen">
                    @error('imagen')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

               
                <div class="text-center">
                    <button type="submit"
                        class="btn btn-primary bg-indigo-600 text-white rounded-lg px-6 py-2 shadow-md hover:bg-indigo-700">Crear
                        Curso</button>
                </div>
            </form>
        </div>
    </div>
@endsection
