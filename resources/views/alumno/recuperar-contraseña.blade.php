@vite('resources/css/app.css')
@extends('layouts.app')

@section('content')
    <div
        class="relative flex min-h-screen text-gray-800 antialiased flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
        <div class="relative py-3 sm:w-96 mx-auto text-center">
            <span class="text-2xl font-light">Recuperar Contraseña</span>
            <div class="mt-4 bg-white shadow-md rounded-lg text-left">
                <div class="h-2 bg-purple-400 rounded-t-md"></div>
                <div class="px-8 py-6">

                   {{--  Mostrar mensaje de error --}}
                    @if (session('error'))
                        <div class="bg-red-500 text-white p-3 mb-4 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                     {{-- Mostrar mensaje de éxito --}}
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-3 mb-4 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                     {{-- Formulario de recuperación de contraseña --}} 
                    <form action="{{ url('alumno/enviar-correo-recuperacion') }}" method="POST">
                        @csrf
                        <label for="email" class="block font-semibold">Correo Electrónico:</label>
                        <input type="email" name="email" id="email"
                            class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md"
                            required />

                         {{-- Botón de enviar correo de recuperación centrado --}} 
                        <div class="flex justify-center items-baseline mt-4">
                            <button type="submit"
                                class="bg-purple-500 text-white py-2 px-6 rounded-md hover:bg-purple-600">Enviar Correo de
                                Recuperación</button>
                        </div>
                    </form>

                 
                    <p class="text-center text-sm mt-4">
                        ¿Ya la recordaste? <a href="{{ route('alumno.login') }}"
                            class="text-indigo-600 hover:underline">Regresar al login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
