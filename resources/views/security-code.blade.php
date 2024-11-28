@extends('layouts.security') 

@section('content')
    <h1 class="text-2xl mb-4">Ingrese el Código de Seguridad</h1>

    <form method="POST" action="{{ url('/security-code') }}">
        @csrf
        <div class="mb-4">
            <label for="security_code" class="block text-xl">Código de Seguridad</label>
            <input id="security_code" type="text"
                class="w-full text-xl bg-transparent border border-green-500 p-3 text-green-500 focus:outline-none"
                name="security_code" required placeholder="Código de seguridad" />
            @error('security_code')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-0">
            <button type="submit"
                class="w-full mt-6 bg-green-500 rounded-lg px-4 py-2 text-lg text-black tracking-wide font-semibold hover:bg-green-600">Verificar</button>
        </div>
    </form>

   
    <div class="mt-6">
        <a href="{{ url('/') }}"
            class="w-full block text-center mt-4 bg-gray-300 rounded-lg px-4 py-2 text-lg text-gray-800 tracking-wide font-semibold hover:bg-gray-400">Volver
            al Inicio</a>
    </div>
@endsection
