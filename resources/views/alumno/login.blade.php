@vite('resources/css/app.css')
@extends('layouts.app')

@section('content')
    <div
        class="relative flex min-h-screen text-gray-800 antialiased flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
        <div class="relative py-3 sm:w-96 mx-auto text-center">
            <span class="text-2xl font-light">Iniciar sesión en tu cuenta</span>
            <div class="mt-4 bg-white shadow-md rounded-lg text-left">
                <div class="h-2 bg-purple-400 rounded-t-md"></div>
                <div class="px-8 py-6">
                    <form method="POST" action="{{ route('alumno.login') }}">
                        @csrf

                        {{--  Correo electrónico  --}}
                        <label for="email" class="block font-semibold">Correo electrónico</label>
                        <input type="email" id="email" name="email"
                            class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md"
                            value="{{ old('email') }}" required placeholder="Correo electrónico" />
                        @error('email')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror

                        {{-- Contraseña  --}}
                        <label for="password" class="block mt-3 font-semibold">Contraseña</label>
                        <input type="password" id="password" name="password"
                            class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md"
                            required placeholder="Contraseña" />
                        @error('password')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror

                        {{--  Botón de inicio de sesión y enlace de recuperación --}} 
                        <div class="flex justify-between items-baseline">
                            <button type="submit"
                                class="mt-4 bg-purple-500 text-white py-2 px-6 rounded-md hover:bg-purple-600">Iniciar
                                sesión</button>
                            <a href="{{ route('alumno.recuperar-contraseña') }}"
                                class="text-sm text-indigo-600 hover:underline">¿Olvidaste tu contraseña?</a>
                        </div>
                    </form>

                    {{--  Enlace para registro  --}}
                    <div class="mt-4 text-center">
                        <p class="text-sm">¿Aún no tienes una cuenta?
                            <a href="{{ route('alumno.register') }}" class="text-purple-500 hover:underline">Regístrate</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
