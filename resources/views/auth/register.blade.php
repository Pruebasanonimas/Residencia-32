@vite('resources/css/app.css')
@extends('layouts.app')

@section('content')
    @if (!session('security_verified'))
        <script>
            window.location.href = "{{ route('security.code') }}"; //Redirigir a la página de código de sguridad si no está verificado
        </script>
    @endif



   
    <div class="h-screen bg-indigo-100 flex justify-center items-center">
        <div class="lg:w-2/5 md:w-1/2 w-2/3">
            <form method="POST" action="{{ route('register') }}" class="bg-white p-10 rounded-lg shadow-lg min-w-full">
                @csrf
                <h1 class="text-center text-2xl mb-6 text-gray-600 font-bold font-sans">Registro</h1>

               
                <div class="mb-4">
                    <label for="name" class="text-gray-800 font-semibold block my-2">{{ __('Nombre') }}</label>
                    <input id="name" type="text"
                        class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none @error('name') border-red-500 @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                        placeholder="Nombre de usuario" />
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

              
                <div class="mb-4">
                    <label for="email"
                        class="text-gray-800 font-semibold block my-2">{{ __('Correo electronico') }}</label>
                    <input id="email" type="email"
                        class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none @error('email') border-red-500 @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email"
                        placeholder="correo@example.com" />
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

              
                <div class="mb-4">
                    <label for="password" class="text-gray-800 font-semibold block my-2">{{ __('Contraseña') }}</label>
                    <input id="password" type="password"
                        class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none @error('password') border-red-500 @enderror"
                        name="password" required autocomplete="new-password" placeholder="Minimo 8 caracteres" />
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

            
                <div class="mb-4">
                    <label for="password-confirm"
                        class="text-gray-800 font-semibold block my-2">{{ __('Confirmar Contraseña') }}</label>
                    <input id="password-confirm" type="password"
                        class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" name="password_confirmation"
                        required autocomplete="new-password" placeholder="Confirme su contraseña" />
                </div>

            
                <div class="mb-0">
                    <button type="submit"
                        class="w-full mt-6 bg-indigo-600 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold">Registrar</button>
                </div>
               
                <div class="mt-4">
                    <a href="{{ url('/') }}"
                        class="w-full block text-center mt-4 bg-gray-300 rounded-lg px-4 py-2 text-lg text-gray-800 tracking-wide font-semibold hover:bg-gray-400">Regresar
                        al Inicio</a>
                </div>
            </form>
        </div>
    </div>
@endsection
