@vite('resources/css/app.css')

@extends('layouts.app')



@section('content')
    
    <div class="absolute top-4 right-4 p-4">
        <a href="{{ route('cursos.inscripciones') }}"
            class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-blue-500 p-[2px] text-sm font-semibold 
        rounded-full transition-all hover:shadow-lg active:scale-95">
            <span class="block rounded-full bg-white px-6 py-2 text-black group-hover:bg-transparent group-hover:text-white">
                Volver a mis cursos
            </span>
        </a>
    </div>
    </br>

    <div
        style="
    min-height: 100vh; 
    background: linear-gradient(to top right, #b3c7f9, #d9e4fc); 
    display: flex; 
    justify-content: center; 
    align-items: center; 
    padding: 2.5rem; 
    position: relative;">





        <div
            style="
        width: 100%; 
        max-width: 50rem; 
        background: #fff; 
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); 
        border-radius: 0.75rem; 
        padding: 1.5rem;">

             {{-- Advertencia  --}}
            <div
                style="
            background-color: #fffbeb; 
            border: 1px solid #fcd34d; 
            color: #854d0e; 
            padding: 0.75rem; 
            border-radius: 0.5rem; 
            margin-bottom: 1.5rem; 
            font-size: 1rem;">
                Recuerda que este examen solo se puede resolver 1 sola vez. Si aún no estás preparado, puedes regresar a tus
                lecciones.
            </div>

            <h1
                style="
            font-size: 2rem; 
            font-weight: bold; 
            color: #1a202c; 
            margin-bottom: 1rem; 
            text-align: center;">
                {{ $exam->title }}
            </h1>

            @if (session('error'))
                <div
                    style="
                background-color: #ffe4e6; 
                border: 1px solid #ffccd5; 
                color: #b91c1c; 
                padding: 0.75rem; 
                border-radius: 0.5rem; 
                margin-bottom: 1rem;">
                    {{ session('error') }}
                </div>
            @endif

            <form id="exam-form" action="{{ route('exams.submit', $exam->id) }}" method="POST" style="gap: 1.5rem;">
                @csrf
                @foreach ($exam->questions as $index => $question)
                    <div style="padding: 1rem; border-bottom: 1px solid #e2e8f0;">
                        <h2
                            style="
                        font-size: 1.125rem; 
                        font-weight: 600; 
                        color: #4a5568;">
                            {{ $index + 1 }}. {{ $question->question_text }}
                        </h2>
                        <div style="margin-top: 0.5rem; gap: 0.5rem;">
                            @foreach ($question->answers as $answer)
                                <label
                                    style="
                                display: block; 
                                font-size: 1rem; 
                                color: #2d3748; 
                                padding: 0.5rem 0;">
                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}"
                                        style="
                                    margin-right: 0.5rem; 
                                    transform: scale(1.2);">
                                    {{ $answer->answer_text }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <button type="submit"
                    style="
                width: 100%; 
                background-color: #3b82f6; 
                color: #fff; 
                padding: 0.75rem; 
                border-radius: 0.5rem; 
                font-size: 1.125rem; 
                font-weight: 600; 
                text-align: center; 
                cursor: pointer; 
                transition: background-color 0.3s ease;">
                    Enviar Examen
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('exam-form').addEventListener('submit', function(event) {
            const questions = @json($exam->questions->pluck('id'));
            let allAnswered = true;

            questions.forEach(questionId => {
                if (!document.querySelector(`input[name="answers[${questionId}]"]:checked`)) {
                    allAnswered = false;
                }
            });

            if (!allAnswered) {
                event.preventDefault();
                alert('Por favor responde todas las preguntas antes de enviar el examen.');
            }
        });
    </script>
@endsection
