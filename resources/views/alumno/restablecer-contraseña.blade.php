@vite('resources/css/app.css')
@extends('layouts.app')

@section('content')
    <div
        class="relative flex min-h-screen text-gray-800 antialiased flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
        <div class="relative py-3 sm:w-96 mx-auto text-center">
            <span class="text-2xl font-light">Restablecer Contraseña</span>
            <div class="mt-4 bg-white shadow-md rounded-lg text-left">
                <div class="h-2 bg-purple-400 rounded-t-md"></div>
                <div class="px-8 py-6">

                  {{--  Formulario de restablecimiento de contraseña  --}}
                    <form action="{{ url('alumno/actualizar-contraseña') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                       
                        <label for="password" class="block font-semibold">Nueva Contraseña:</label>
                        <input type="password" name="password" id="password"
                            class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md"
                            required />

                       
                        <label for="password_confirmation" class="block font-semibold mt-4">Confirmar Contraseña:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md"
                            required />

                       
                        <div class="flex justify-center items-baseline mt-4">
                            <button type="submit"
                                class="bg-purple-500 text-white py-2 px-6 rounded-md hover:bg-purple-600">Actualizar
                                Contraseña</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
