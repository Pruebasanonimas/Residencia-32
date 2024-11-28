<form action="{{ route('lecciones.update', $leccion->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="nombre">Nombre de la lección</label>
    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $leccion->nombre) }}" required>

    <label for="editor-container">Contenido de la lección</label>
    <div id="editor-container">{!! old('contenido', $leccion->contenido) !!}</div>

   {{--  Campo oculto para enviar el contenido al servidor --}}
    <input type="hidden" name="contenido" id="contenido">

    <button type="submit">Actualizar Lección</button>
</form>

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var quill = new Quill('#editor-container', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                ['link']
            ]
        }
    });

    document.querySelector('form').onsubmit = function() {
        var contenido = quill.root.innerHTML;
        document.getElementById('contenido').value = contenido;
    };
</script>
