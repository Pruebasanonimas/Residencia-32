@extends('layouts.appcorreo')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">

       
        <h2 class="text-2xl font-semibold text-center text-indigo-600 mb-6">Enviar Correos Masivos</h2>

        @if (session('success'))
            <div class="alert alert-success bg-green-100 text-green-700 border-l-4 border-green-500 p-4 mb-4 rounded-lg">
                {{ session('success') }}
            </div>
        @elseif($errors->any())
            <div class="alert alert-danger bg-red-100 text-red-700 border-l-4 border-red-500 p-4 mb-4 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario --}} 
        <form action="{{ route('enviarCorreos') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

             {{-- Campo para el asunto del correo --}} 
            <div>
                <label for="subject" class="block text-sm font-medium text-gray-700">Asunto del correo</label>
                <input type="text" name="subject" id="subject"
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>
            </div>

            {{-- Campo para el título del correo --}} 
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Título del correo</label>
                <input type="text" name="title" id="title"
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>
            </div>

          {{-- Campo para el cuerpo del correo --}} 
            <div>
                <label for="body" class="block text-sm font-medium text-gray-700">Cuerpo del correo</label>
                <textarea name="body" id="body"
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    rows="5" required></textarea>
            </div>

             {{-- Campo para el archivo CSV --}} 
            <div>
                <label for="csv_file" class="block text-sm font-medium text-gray-700">Archivo CSV</label>
                <input type="file" name="csv_file" id="csv_file"
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    accept=".csv, .txt" required>
            </div>

             {{-- Campo para los archivos adjuntos --}} 
            <div>
                <label for="attachments" class="block text-sm font-medium text-gray-700">Archivos adjuntos</label>
                <input type="file" name="attachments[]" id="attachments"
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    multiple accept=".jpg, .jpeg, .png, .pdf, .doc, .docx, .xls, .xlsx">
            </div>

             {{-- Botón de envío --}}
            <button type="submit"
                class="w-full py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Enviar Correos
            </button>
        </form>

       
        <div class="flex justify-end p-4 mt-6">
            <a href="{{ route('home') }}"
                class="group inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-blue-500 p-[2px] text-sm font-semibold 
            rounded-full transition-all hover:shadow-lg active:scale-95">
                <span
                    class="block rounded-full bg-white px-6 py-2 text-black group-hover:bg-transparent group-hover:text-white">
                    Volver al menú
                </span>
            </a>
        </div>
    </div>
@endsection
