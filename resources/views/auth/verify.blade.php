@vite('resources/css/app.css')
@extends('layouts.app')

@section('content')
    <div class="h-screen bg-indigo-100 flex justify-center items-center">
        <div class="lg:w-2/5 md:w-1/2 w-2/3">
            <form class="bg-white p-10 rounded-lg shadow-lg min-w-full">
                <h1 class="text-center text-2xl mb-6 text-gray-600 font-bold font-sans">
                    {{ __('Verifica tu dirección de correo electrónico') }}</h1>

                @if (session('resent'))
                    <div class="alert alert-success mb-4" role="alert">
                        {{ __('Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.') }}
                    </div>
                @endif

                <p class="text-gray-800 mb-4">
                    {{ __('Antes de continuar, por favor revisa tu correo electrónico para un enlace de verificación.') }}
                </p>
                <p class="text-gray-800 mb-6">
                    {{ __('Si no es visible el correo en tu bandeja de entrada, recuerda revisar tu carpeta de spam o no deseados.') }}
                </p>
                <p class="text-gray-800 mb-6">
                    <a href="{{ url('/') }}" class="text-indigo-600 font-semibold hover:underline focus:outline-none">
                        {{ __('Regresar a inicio') }}
                    </a>
                </p>
            </form>
        </div>
    </div>
@endsection
