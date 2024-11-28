@vite('resources/css/app.css')
@extends('layouts.app')

@section('content')

    <body class="antialiased bg-slate-200">
        <div class="max-w-lg mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300">
            <h1 class="text-4xl font-medium">Restablecer Contraseña</h1>
            <p class="text-slate-500">Completa el formulario para restablecer la contraseña</p>

            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">¡Éxito!</strong>
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
                <p class="text-center mt-5">
                    <a href="{{ url('/') }}" class="text-indigo-600 font-medium inline-flex space-x-1 items-center">
                        <span>Regresar al inicio</span>
                    </a>
                </p>
            @else
                <form method="POST" action="{{ route('password.email') }}" class="my-10">
                    @csrf

                    <div class="flex flex-col space-y-5">
                        <label for="email">
                            <p class="font-medium text-slate-700 pb-2">Dirección de correo</p>
                            <input id="email" type="email" name="email"
                                class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow @error('email') is-invalid @enderror"
                                placeholder="Ingresa la dirección de correo" value="{{ old('email') }}" required
                                autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </label>

                        <button type="submit"
                            class="w-full py-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow inline-flex space-x-2 items-center justify-center">
                            <span>Restablecer Contraseña</span>
                        </button>

                        <p class="text-center mt-5">
                            <a href="{{ url('/') }}"
                                class="text-indigo-600 font-medium inline-flex space-x-1 items-center">
                                <span>Ir a Inicio</span>
                            </a>
                        </p>

                        <p class="text-center">¿No estás registrado?
                            <a href="{{ route('register') }}"
                                class="text-indigo-600 font-medium inline-flex space-x-1 items-center">
                                <span>Regístrate ahora </span>
                            </a>
                        </p>
                    </div>
                </form>
            @endif
        </div>
    </body>
@endsection
