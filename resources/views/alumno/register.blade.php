@vite('resources/css/app.css')
@extends('layouts.app')

@section('content')
    <div
        class="relative flex min-h-screen text-gray-800 antialiased flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
        <div class="relative py-3 sm:w-96 mx-auto text-center">
            <span class="text-2xl font-light">Regístrate en tu cuenta</span>
            <div class="mt-4 bg-white shadow-md rounded-lg text-left">
                <div class="h-2 bg-purple-400 rounded-t-md"></div>
                <div class="px-8 py-6">
                    @if (session('status'))
                        <div class="bg-green-500 text-white p-3 mb-4 rounded">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('alumno.register') }}" method="POST">
                        @csrf

                       
                        <label for="nombre" class="block font-semibold">Nombre</label>
                        <input type="text" name="nombre" id="nombre"
                            class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md"
                            value="{{ old('nombre') }}" required />

                     
                        <label for="escuela" class="block font-semibold mt-3">Escuela</label>
                        <select name="escuela" id="escuela"
                            class="border w-full px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md"
                            onchange="toggleCustomInput('escuela', this.value)" required>
                            <option value="">Selecciona una opción</option>
                            <option value="CBETIS N.17">CBETIS N.17</option>
                            <option value="CONALEP 122">CONALEP 122</option>
                            <option value="CBETA N.84">CBETA N.84</option>
                            <option value="Luis A. Beauregard">Luis A. Beauregard</option>
                            <option value="TEBAEV Carlos A. Carrillo">TEBAEV Carlos A. Carrillo</option>
                            <option value="TEBAEV Cosamaloapan">TEBAEV Cosamaloapan</option>
                            <option value="UPAV Carlos A. Carrillo">UPAV Carlos A. Carrillo</option>
                            <option value="UPAV Cosamaloapan">UPAV Cosamaloapan</option>
                            <option value="otras">Otras</option>
                        </select>
                        <input type="text" name="escuela_otras" id="escuela_otras"
                            class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md hidden"
                            placeholder="Escribe tu escuela" />

                       
                        <label for="especialidad" class="block font-semibold mt-3">Especialidad</label>
                        <select name="especialidad" id="especialidad"
                            class="border w-full px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md"
                            onchange="toggleCustomInput('especialidad', this.value)" required>
                            <option value="">Selecciona una opción</option>
                            <option value="Programación">Programación</option>
                            <option value="Contabilidad">Contabilidad</option>
                            <option value="Electromecánica">Electromecánica</option>
                            <option value="Trabajo social">Trabajo social</option>
                            <option value="Laboratorista químico">Laboratorista químico</option>
                            <option value="Informática">Informática</option>
                            <option value="Enfermería">Enfermería</option>
                            <option value="Agropecuario">Agropecuario</option>
                            <option value="Ofimática">Ofimática</option>
                            <option value="Exactas">Exactas</option>
                            <option value="Químico biológico">Químico biológico</option>
                            <option value="Humanidades">Humanidades</option>
                            <option value="Contaduría">Contaduría</option>
                            <option value="No tengo">No tengo</option>
                            <option value="otras">Otras</option>
                        </select>
                        <input type="text" name="especialidad_otras" id="especialidad_otras"
                            class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md hidden"
                            placeholder="Escribe tu especialidad" />

                    
                        <label for="telefono" class="block font-semibold mt-3">Teléfono</label>
                        <input type="text" name="telefono" id="telefono"
                            class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md"
                            value="{{ old('telefono') }}" required />

                    
                        <label for="email" class="block font-semibold mt-3">Correo electrónico</label>
                        <input type="email" name="email" id="email"
                            class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md"
                            value="{{ old('email') }}" required />

                       
                        <label for="domicilio" class="block font-semibold mt-3">Domicilio</label>
                        <input type="text" name="domicilio" id="domicilio"
                            class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md"
                            value="{{ old('domicilio') }}" required />

                    
                        <label for="password" class="block font-semibold mt-3">Contraseña</label>
                        <input type="password" name="password" id="password"
                            class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md"
                            placeholder="Mínimo 8 caracteres" required />

                   
                        <label for="password_confirmation" class="block font-semibold mt-3">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md"
                            placeholder="Mínimo 8 caracteres" required />

                   
                        <div class="flex justify-between items-baseline mt-4">
                            <button type="submit"
                                class="bg-purple-500 text-white py-2 px-6 rounded-md hover:bg-purple-600">Registrar</button>
                        </div>
                    </form>

                 
                    <p class="text-center text-sm mt-4">
                        ¿Ya tienes cuenta? <a href="{{ route('alumno.login') }}"
                            class="text-indigo-600 hover:underline">Inicia sesión aquí</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleCustomInput(field, value) {
            const input = document.getElementById(`${field}_otras`);
            if (value === 'otras') {
                input.classList.remove('hidden');
                input.required = true;
            } else {
                input.classList.add('hidden');
                input.required = false;
            }
        }
    </script>
@endsection
