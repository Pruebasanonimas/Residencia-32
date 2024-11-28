<?php

use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\Auth\AlumnoeAuthController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CSVController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\LeccionController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\ProgresoController;
use App\Http\Controllers\RecuperarContraalumnoController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\SecurityCodeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



/*  RUTAS PARA ACTUALIZAR DATOS DEL ALUMNO */

Route::prefix('alumno')->name('alumno.')->group(function () {

    // Ruta para mostrar el formulario de edición de un alumno
    Route::get('editar/{id}', [AlumnoeAuthController::class, 'edit'])->name('edit');

    // Ruta para procesar la actualización de los datos del alumno
    Route::put('editar/{id}', [AlumnoeAuthController::class, 'update'])->name('update');
});


// Ruta para la vista de actualización de datos personales
Route::get('/actualizar-datos', [AlumnoeAuthController::class, 'mostrarFormularioActualizar'])->name('alumnoe.actualizar');

/*  RUTAS PARA LA GESTION DEL MENÚ PRINCIPAL */

Route::get('/principal', [MenuController::class, 'index'])->name('alumno.principal');
Route::get('/crearmenu', [MenuController::class, 'create'])->name('alumno.crearmenu');
Route::post('/storemenu', [MenuController::class, 'store'])->name('alumno.storemenu');
Route::get('/editarmenu', [MenuController::class, 'edit'])->name('alumno.editarmenu');
Route::post('/updatemenu', [MenuController::class, 'update'])->name('alumno.updatemenu');
Route::post('/addimagenmenu', [MenuController::class, 'addImagen'])->name('alumno.addimagenmenu');
Route::delete('/deleteimagenmenu/{id}', [MenuController::class, 'deleteImagen'])->name('alumno.deleteimagenmenu');



/*  RUTAS PARA LA VISTA DE LOS ELEMENTOS DEL MENÚ */

Route::get('/vistanoticias', [NoticiaController::class, 'vistaNoticias'])->name('vistanoticias');
Route::get('/vistamenu', [MenuController::class, 'vistaMenu'])->name('vistamenu');
Route::get('/vistamenu', [MenuController::class, 'vistamenu'])->name('alumno.vistamenu');





/*  RUTAS PARA EL MANEJO DE INSCRIPCIONES DE ALUMNOS */
// Rutas para inscripciones de alumnos
Route::middleware(['auth:alumnoe'])->group(function () {
    Route::get('/inscrito', [InscripcionController::class, 'index'])->name('cursos.inscripciones');
    Route::post('/cursos/{cursoId}/inscribir', [InscripcionController::class, 'inscribir'])->name('cursos.inscribir');
});

Route::get('/cursos/{curso}/alumnosinscritos', [CursoController::class, 'alumnosInscritos'])
    ->name('cursos.alumnosinscritos');

Route::post('/progreso/{leccionId}', [ProgresoController::class, 'actualizarProgreso'])->name('progreso.actualizar');

Route::get('/cursos/{curso}/alumnos', [InscripcionController::class, 'mostrarAlumnos'])
    ->name('cursos.alumnos');


Route::post('/logout', [AlumnoeAuthController::class, 'logout'])->name('alumno.logout');

Route::delete('/inscripcion/eliminar/{cursoId}', [InscripcionController::class, 'eliminar'])->name('inscripcion.eliminar');



/*  RUTAS PARA EL MANEJO DE CURSOS */

// Rutas para cursos
Route::get('/cursos', [CursoController::class, 'index'])->name('cursos.index');  // Ver todos los cursos
Route::get('/cursos/create', [CursoController::class, 'create'])->name('cursos.create');  // Crear un nuevo curso
Route::post('/cursos', [CursoController::class, 'store'])->name('cursos.store');  // Guardar nuevo curso
Route::get('/cursos/{id}/edit', [CursoController::class, 'edit'])->name('cursos.edit');  // Editar un curso
Route::put('/cursos/{id}', [CursoController::class, 'update'])->name('cursos.update');  // Actualizar curso
Route::get('/cursos/{id}', [CursoController::class, 'show'])->name('cursos.show');  // Ver detalles de un curso
Route::delete('/cursos/{id}', [CursoController::class, 'destroy'])->name('cursos.destroy');  // Eliminar curso
//calificacion
Route::post('/cursos/{curso}/calificacion', [CursoController::class, 'storeCalificacion'])->name('calificaciones.store');
//Comentarios
Route::post('cursos/{curso}/comentarios', [CursoController::class, 'store']);

// Ruta para guardar comentarios en un curso
Route::resource('cursos', CursoController::class);
Route::post('cursos/{curso}/comentarios', [CursoController::class, 'storeComentario'])->name('cursos.comentarios.store');

Route::patch('/cursos/{id}/estado', [CursoController::class, 'updateEstado'])->name('cursos.updateEstado'); //cambiar el estado 


/*  RUTA PARA SOLO LA VISTA DE LOS CURSOS CUANDO CLIKEAN SOLO VER CURSO SIN ESTAR INSCRITOS  */
Route::get('/cursos/solovistacurso/{id}', [CursoController::class, 'showSOLOvista'])->name('cursos.solovistacurso');



/*  RUTA PARA VISTA DE SOLO CURSO PROFESORES*/

Route::get('/cursos/{id}/vistacurso', [CursoController::class, 'showVistacurso'])->name('cursos.vistacurso');
Route::get('/cursos/{curso}/vistacurso/leccion/{leccion}', [CursoController::class, 'showLeccionVistacurso'])->name('cursos.vistacurso.leccion');



// Ruta para mostrar el formulario de edición
Route::get('/cursos/{curso}/editar', [CursoController::class, 'editvistacurso'])->name('cursos.editarvistacurso');
Route::put('/cursos/{curso}', [CursoController::class, 'updatevistacurso'])->name('cursos.update');
// Ruta para editar el curso (si existe)
Route::get('/cursos/{curso}/edit', [CursoController::class, 'edit'])->name('cursos.editarvistacurso');


Route::get('/editcursos', [CursoController::class, 'edit'])->name('cursos.edit');














/*  RUTAS PARA EL MANEJO DE EXAMENES */
Route::get('/exams/{exam}', [ExamController::class, 'show'])->name('exams.show');
Route::post('/exams/{exam}/submit', [ExamController::class, 'submit'])->name('exams.submit');
Route::get('/cursos/{curso}/exams/create', [ExamController::class, 'create'])->name('exams.create');
Route::post('/cursos/{curso}/exams', [ExamController::class, 'store'])->name('exams.store');

Route::post('/exams/{examId}/addPreguntas', [ExamController::class, 'storeAddPreguntas'])->name('exams.addPreguntas.store');


/*  RUTAS PARA EDITAR EXAMENES  */
//RUTA QUE SI FUNCIONA PARA MOSTAR EL EXAMEN 
Route::get('/exams/{curso_id}/edit', [ExamController::class, 'edit'])->name('exams.edit');
//RUTA PARA ACTUALIZAR EL EXAMEN 
Route::put('/exams/{exam}', [ExamController::class, 'update'])->name('exams.update');
Route::delete('/exams/{exam}', [ExamController::class, 'destroy'])->name('exams.destroy');


/*  RUTAS PARA EDITAR COSAS DE LOS CURSOS */
Route::get('/cursos/{id}/editacurso', [CursoController::class, 'editacurso'])->name('cursos.editacurso');
//ESTA RUTA ES DEL CURSO CONTROLLER PERO NO HACER NADA PORQUE TODO LO HACE DESDE EL ExamController con la vista exams.editarExamen
Route::get('/cursos/{id}/editar-examen', [CursoController::class, 'editarExamen'])->name('cursos.editar.examen');

Route::get('/exams/{examId}/addPreguntas', [ExamController::class, 'addPreguntas'])->name('exams.addPreguntas');



// Ruta para agregar preguntas (no necesitas duplicar la creación del examen ni la edición del examen)
Route::get('/exams/{exam}/addPreguntas', [ExamController::class, 'addPreguntas'])->name('exams.addPreguntas');
Route::post('/exams/{exam}/addPreguntas', [ExamController::class, 'storeAddPreguntas'])->name('exams.storeAddPreguntas');




/*  RUTAS PARA EL ENVIO DE CORREOS ELECTRONICOS*/
// Ruta para enviar correos
Route::get('/enviar-correos', [CSVController::class, 'showForm'])->name('formularioCorreos');
Route::post('/enviar-correos', [CSVController::class, 'enviarCorreosDesdeCSV'])->name('enviarCorreos');





/*  RUTAS PARA LA GESTION DE LOS ALUMNOS DE LA MUESTRA DE INFORMACIÓN */
// Gestión de alumnos
Route::get('/gestion', [AlumnosController::class, 'obtenerDatos'])->name('alumnos.gestion');





/*  RUTAS PARA EXPORTAR LOS CSV */

Route::get('/alumnos/exportar/csv', [AlumnosController::class, 'exportarCSV'])->name('alumnos.exportar.csv');
Route::get('/alumnos/exportar/correos', [AlumnosController::class, 'exportarCorreosCSV'])->name('alumnos.exportar.correos.csv');





/*  RUTAS PARA CALENDARIO*/

// Rutas de calendario
Route::controller(FullCalenderController::class)->group(function () {
    Route::get('fullcalender', 'index');
    Route::post('fullcalenderAjax', 'ajax');
});





/*  RUTAS PARA LA GESTION DE LECCIONES */

Route::get('/lecciones/{id}', [LeccionController::class, 'show'])->name('lecciones.show');
Route::get('/lecciones/{id}/edit', [LeccionController::class, 'edit'])->name('lecciones.edit');
Route::get('/cursos/{curso}/lecciones/create', [LeccionController::class, 'create'])->name('lecciones.create');
Route::post('/cursos/{curso}/lecciones', [LeccionController::class, 'store'])->name('lecciones.store');
Route::delete('/lecciones/{id}', [LeccionController::class, 'destroy'])->name('lecciones.destroy');



// Ruta para listar lecciones de un curso para eliminarlas
Route::get('/cursos/{cursoId}/lecciones', [LeccionController::class, 'listarLecciones'])->name('lecciones.listar');


// Ruta para mostrar una lección específica 
Route::get('/curso/{cursoId}/leccion/{leccionId}', [CursoController::class, 'showLeccion'])->name('cursos.showLeccion');




/*  RUTAS para MOSTRAR SOLO VISTA DE CURSO DE LAS LECCIONES */

Route::get('/cursos/{curso}/leccion/{leccion}', [CursoController::class, 'showLeccionvista'])->name('cursos.showLeccionvista');




/*  RUTAS PARA EL MANEJO DE ARCHIVOS */
Route::get('/subir', [UploadController::class, 'create'])->name('upload');
Route::post('/upload', [UploadController::class, 'store']);
Route::get('/edit', [UploadController::class, 'edit'])->name('edit');
Route::delete('/delete/{upload}', [UploadController::class, 'destroy'])->name('delete');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');






/*  RUTAS PARA LA GESTION DE NOTICIAS */

// +++++ Empieza app de noticias +++++

// Ruta para crear noticia
Route::get('/crearnoticia', function () {
    if (!Auth::check()) {
        abort(404);
    }
    return view('crearnoticia');
})->name('crearnoticia');

// Ruta para almacenar noticia
Route::post('/noticias', function () {
    if (!Auth::check()) {
        abort(404);
    }
    return app(NoticiaController::class)->store(request());
})->name('noticias.store');

// Ruta para la vista de crear noticia
Route::get('/noticias/create', function () {
    if (!Auth::check()) {
        abort(404);
    }
    return app(NoticiaController::class)->create();
})->name('noticias.create');

// Ruta para eliminar noticia
Route::delete('/noticias/{id}', function ($id) {
    if (!Auth::check()) {
        abort(404);
    }
    return app(NoticiaController::class)->destroy($id);
})->name('noticias.destroy');

// Nueva ruta para la vista de editar noticias
Route::get('/editarnoticia', function () {
    if (!Auth::check()) {
        abort(404);
    }
    return app(NoticiaController::class)->edit();
})->name('editarnoticia');

Route::get('/editarnoticia/{id}', function ($id) {
    if (!Auth::check()) {
        abort(404);
    }
    return app(NoticiaController::class)->editForm($id);
})->name('editarnoticiaform');

// Ruta para subir videos
Route::post('/upload-video', function () {
    if (!Auth::check()) {
        abort(404);
    }
    return app(NoticiaController::class)->uploadVideo(request());
})->name('upload.video');

// Ruta para la vista de edición de noticias específica
Route::get('/noticias/{id}/edit', function ($id) {
    if (!Auth::check()) {
        abort(404);
    }
    return app(NoticiaController::class)->editForm($id);
})->name('noticias.edit');

// Ruta para actualizar una noticia
Route::put('/noticias/{id}', function ($id) {
    if (!Auth::check()) {
        abort(404);
    }
    return app(NoticiaController::class)->update(request(), $id);
})->name('noticias.update');



//muestra la noticia especifica del profesor
Route::get('/noticias/profesor/{id}', [NoticiaController::class, 'vistaNoticiaProfesor'])->name('noticias.profesor.show');

// +++++ Termina app de noticias +++++




/*  RUTAS PARA QUE FUNCIONE LOS LIKES DE LAS PUBLICACIONES  REVISAR SI FUNCIONAN DE ALGO */

//MUESTRA NOTICIAS ALUMNOS LIKES
Route::get('/noticias/{id}', [NoticiaController::class, 'show'])->name('noticias.show');
//Guardar likes
Route::post('/noticias/{noticiaId}/like', [NoticiaController::class, 'like']);




/*  RUTAS PARA EL MANEJO DE REGISTRO Y LOGIN DEL ALUMNO */
// Ruta para mostrar el formulario de login
Route::get('alumno/login', [AlumnoeAuthController::class, 'showLoginForm'])->name('alumno.login');

// Ruta para procesar el formulario de login
Route::post('alumno/login', [AlumnoeAuthController::class, 'login']);

// Ruta para mostrar el formulario de registro
Route::get('alumno/register', [AlumnoeAuthController::class, 'showRegistrationForm'])->name('alumno.register');

// Ruta para procesar el formulario de registro
Route::post('alumno/register', [AlumnoeAuthController::class, 'register']);

// Ruta para verificar el correo electrónico
Route::get('alumno/verify/{id}/{hash}', [AlumnoeAuthController::class, 'verifyEmail'])->name('alumno.verify');

// Ruta para cerrar sesión
Route::post('alumno/logout', [AlumnoeAuthController::class, 'logout'])->name('alumno.logout');

// Ruta para la vista principal después del login exitoso (sin middleware auth)
Route::get('alumno/principal', function () {
    return view('alumno.principal');  // Asegúrate de tener la vista principal.blade.php en resources/views/alumno/
})->name('alumno.principal');


/*  RUTAS PARA QUE NOTIFIQUE QUE SE ENVIO UN CORREO  */

Route::get('/registro-exitoso', function () {
    return view('alumno.registro-exitoso');
})->name('alumno.registro-exitoso');




/*  RUTAS PARA EL MANERO DE LA RECUPERACIÓN DE CONTRASEÑAS DE LOS ALUMNOS*/
// Ruta para mostrar el formulario de recuperación de contraseña
Route::get('alumno/recuperar-contraseña', [RecuperarContraalumnoController::class, 'mostrarFormularioRecuperacion'])->name('alumno.recuperar-contraseña');

// Ruta para enviar el correo de recuperación de contraseña
Route::post('alumno/enviar-correo-recuperacion', [RecuperarContraalumnoController::class, 'enviarCorreoRecuperacion'])->name('alumno.enviar-correo-recuperacion');

// Ruta para mostrar el formulario de restablecimiento de contraseña
Route::get('alumno/restablecer-contraseña/{token}', [RecuperarContraalumnoController::class, 'mostrarFormularioRestablecimiento'])->name('alumno.restablecer-contraseña');

// Ruta para actualizar la contraseña
Route::post('alumno/actualizar-contraseña', [RecuperarContraalumnoController::class, 'actualizarContraseña'])->name('alumno.actualizar-contraseña');





//Rutas para usuarios autentificados
Route::get('calendario', [CalendarioController::class, 'index'])->name('user.calendar');
Route::get('/vernoticia', [NoticiaController::class, 'index'])->name('vernoticia');
Route::get('/ver', [UploadController::class, 'index'])->name('view');
Route::get('/vercursos', [CursoController::class, 'vercursos'])->name('cursos.vercursos');


// Esta ruta no requiere autenticación, ya que es para los estudiantes ver los cursos
//vista de profesores 
Route::get('/cursos', [CursoController::class, 'index'])->name('cursos.index');


//vista de alumnos inscritos a los cursos
Route::get('/cursos/{id}', [CursoController::class, 'show'])->name('cursos.show');




/*  RUTAS EL CODIGO DE SEGURIDAD  */

// Ruta para mostrar el formulario de verificación del código
Route::get('/security-code', [SecurityCodeController::class, 'show'])->name('security.code');

// Ruta para verificar el código de seguridad
Route::post('/security-code', [SecurityCodeController::class, 'verify']);





//ruta welcome

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación con verificación de correo
Auth::routes(['verify' => true]);




// Rutas protegidas para profesores autenticados y verificados
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
