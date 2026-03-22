<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\CanalPublicitarioController;
use App\Http\Controllers\InscriptorController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\PlazoinscripcionController;
use App\Http\Controllers\BecaController;
use App\Http\Controllers\EstadoVerificacionController;
use App\Http\Controllers\ModalidadPagoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\ExpedicionCiController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\FacultadController;
use App\Http\Controllers\PlanestudioController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\ResolucionController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\DetalleInscripcionBecaController;
use App\Http\Controllers\NotasgestionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Profile Routes
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
});

// Roles
Route::resource('roles', RolesController::class)->middleware('auth');

// Permissions
Route::resource('permissions', PermissionsController::class)->middleware('auth');

Route::resource('estudiantes', EstudianteController::class)->middleware('auth');
Route::get('estudiantes/{estudiante_id}/{estado}', [EstudianteController::class, 'actualizarEstado'])->name('estudiantes.estado')->middleware('auth');
//Docentes
Route::resource('docentes', DocenteController::class)->middleware('auth');
Route::get('docentes/{docente_id}/{estado}', [DocenteController::class, 'actualizarEstado'])->name('docentes.estado')->middleware('auth');
//Carreras Crud
Route::resource('carreras', CarreraController::class)->middleware('auth'); //
Route::get('carreras/{carrera_id}/{estado}', [CarreraController::class, 'actualizarEstado'])->name('carreras.estado')->middleware('auth');
//Turno
Route::resource('turnos', TurnoController::class)->middleware('auth'); //Crud
Route::get('turnos/{turno_id}/{estado}', [TurnoController::class, 'actualizarEstado'])->name('turnos.estado')->middleware('auth');
//Canal Publicitario
Route::resource('canal_publicitarios', CanalPublicitarioController::class)->middleware('auth'); //Crud
Route::get('canal_publicitarios/{canal_publicitario_id}/{estado}', [CanalPublicitarioController::class, 'actualizarEstado'])->name('canal_publicitarios.estado')->middleware('auth');
//Inscriptor
Route::resource('inscriptors', InscriptorController::class)->middleware('auth'); //Crud
Route::get('inscriptors/{inscriptor_id}/{estado}', [InscriptorController::class, 'actualizarEstado'])->name('inscriptors.estado')->middleware('auth');

Route::resource('gestions', GestionController::class)->middleware('auth');
Route::get('gestions/{gestion_id}/{estado}', [GestionController::class, 'actualizarEstado'])->name('gestions.estado')->middleware('auth');
// ruta para  plaza inscripciones
Route::resource('plazoinscripcions', PlazoinscripcionController::class)->middleware('auth');
Route::get('plazoinscripcions/{plazoinscripcion_id}/{estado}', [PlazoinscripcionController::class, 'actualizarEstado'])->name('plazoinscripcions.estado')->middleware('auth');
// modalidad pagos
Route::resource('modalidadpagos', ModalidadPagoController::class)->middleware('auth');
Route::get('modalidadpagos/{modalidadpago_id}/{estado}', [ModalidadPagoController::class, 'actualizarEstado'])->name('modalidadpagos.estado')->middleware('auth');
// Users
Route::middleware('auth')->prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    //
    Route::get('/show/{user}', [UserController::class, 'show'])->name('show');
    //
    Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('destroy');
    Route::get('/update/status/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('status');

    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

    Route::get('export/', [UserController::class, 'export'])->name('export');
});

// Becas
Route::resource('becas', BecaController::class)->middleware('auth');
Route::get('becas/{beca_id}/{estado}', [BecaController::class, 'actualizarEstado'])->name('becas.estado')->middleware('auth');
//Inscripciones
Route::resource('inscripciones', InscripcionController::class)->middleware('auth');
Route::get('inscripciones/{inscripcion_id}/{estado}', [InscripcionController::class, 'actualizarEstado'])->name('inscripciones.estado')->middleware('auth');
//ruta para imprimir inscripciones
Route::post('reporte_inscripcion/{inscripcion_id}', [InscripcionController::class, 'reporteInscripcion'])->name('reporte_inscripcion')->middleware('auth');
// Definición de ruta para mostrar una inscripción específica
//Route::get('inscripciones/{inscripcion_id}', [InscripcionController::class, 'show'])->name('inscripciones.show')>name('inscripciones.show')->middleware('auth');
// Estado Verificación
Route::resource('estado_verificaciones', EstadoVerificacionController::class)->middleware('auth');
Route::get('estado_verificaciones/{estado_verificacion_id}/{estado}', [EstadoVerificacionController::class, 'actualizarEstado'])->name('estado_verificaciones.estado')->middleware('auth');

Route::resource('paises', PaisController::class)->middleware('auth');
Route::get('paises/{pais_id}/{estado}', [PaisController::class, 'actualizarEstado'])->name('paises.estado')->middleware('auth');

Route::resource('departamentos', DepartamentoController::class)->middleware('auth');
Route::get('departamentos/{departamento_id}/{estado}', [DepartamentoController::class, 'actualizarEstado'])->name('departamentos.estado')->middleware('auth');

Route::resource('provincias', ProvinciaController::class)->middleware('auth');
Route::get('provincias/{provincia_id}/{estado}', [ProvinciaController::class, 'actualizarEstado'])->name('provincias.estado')->middleware('auth');

Route::resource('materias', MateriaController::class)->middleware('auth');
Route::get('materias/{materia_id}/{estado}', [MateriaController::class, 'actualizarEstado'])->name('materias.estado')->middleware('auth');

Route::resource('localidades', LocalidadController::class)->middleware('auth');
Route::get('localidades/{localidad_id}/{estado}', [LocalidadController::class, 'actualizarEstado'])->name('localidades.estado')->middleware('auth');

Route::resource('generos', GeneroController::class)->middleware('auth');
Route::get('generos/{genero_id}/{estado}', [GeneroController::class, 'actualizarEstado'])->name('generos.estado')->middleware('auth');

Route::resource('expedicion_cis', ExpedicionCiController::class)->middleware('auth');
Route::get('expedicion_cis/{expedicion_ci_id}/{estado}', [ExpedicionCiController::class, 'actualizarEstado'])->name('expedicion_cis.estado')->middleware('auth');

Route::get('r_inscripcion.index', [InscripcionController::class, 'reporteInscripciones'])->name('r_inscripcion.index')->middleware('auth');
Route::post('r_inscripcion.filtrar', [InscripcionController::class, 'filtrar'])->name('r_inscripcion.filtrar')->middleware('auth');

Route::resource('empresas', EmpresaController::class)->middleware('auth');
//facultades
Route::resource('facultads', FacultadController::class)->middleware('auth');
Route::get('facultads/{facultads_id}/{estado}', [FacultadController::class, 'actualizarEstado'])->name('facultads.estado')->middleware('auth');
//PLANES DE ESTUDIOS
Route::resource('plan_estudios', PlanestudioController::class)->middleware('auth');
Route::get('plan_estudios/{plan_estudios_id}/{estado}', [PlanestudioController::class, 'actualizarEstado'])->name('plan_estudios.estado')->middleware('auth');
//LIBROS
Route::resource('libros', LibroController::class)->middleware('auth');
Route::get('libros/{libro_id}/{estado}', [LibroController::class, 'actualizarEstado'])->name('libros.estado')->middleware('auth');
//RUTA PARA EL REPORTE DE HISTORICO ACADEMICO

//1. Ruta para mostrar el formulario de reporte
Route::get('r_historico_academico.index', [InscripcionController::class, 'reporteIstoricoAcademico'])->name('r_historico_academico.index')->middleware('auth');

//2. Ruta para filtrar el reporte
Route::post('r_historico_academico.filtrar', [InscripcionController::class, 'filtrarHistoricoAcademico'])->name('r_historico_academico.filtrar')->middleware('auth');
Route::post('r_historico_academico.buscar_carreras_estudiante', [InscripcionController::class, 'buscar_carreras_estudiante'])->name('r_historico_academico.buscar_carreras_estudiante')->middleware('auth');

//3. Ruta para imprimir el reporte
Route::post('print_historico/{estudiante_id}', [InscripcionController::class, 'reporteHistoricoAcademico'])->name('print_historico')->middleware('auth');

//RUTA PARA EL REPORTE DE CENTRALIZADOR DE CALIFICACIONES

//1. Ruta para mostrar el formulario de reporte
Route::get('r_centralizador.index', [InscripcionController::class, 'reporteCentralizador'])->name('r_centralizador.index')->middleware('auth');

//2. Ruta para filtrar el reporte
Route::post('r_centralizador.filtrar', [InscripcionController::class, 'filtrarCentralizador'])->name('r_centralizador.filtrar')->middleware('auth');

//3. Ruta para imprimir el reporte
Route::post('print_centralizador', [InscripcionController::class, 'reportePDFCentralizador'])->name('print_centralizador')->middleware('auth');
Route::post('print_historico_academico/{estudiante_id}', [InscripcionController::class, 'reporteHistoricoAcademico'])->name('reporte_historico_academico')->middleware('auth');

Route::resource('resoluciones', ResolucionController::class)->middleware('auth');
Route::get('resoluciones/{resolucion_id}/{estado}', [ResolucionController::class, 'actualizarEstado'])->name('resoluciones.estado')->middleware('auth');

Route::resource('notasgestions', NotasgestionController::class)->middleware('auth');
Route::get('notasgestions/{notasgestion_id}/{estado}', [NotasgestionController::class, 'actualizarEstado'])->name('notasgestions.estado')->middleware('auth');
Route::post('notasgestions.notas_estudiantes', [NotasgestionController::class, 'notas_estudiantes'])->name('notasgestions.notas_estudiantes')->middleware('auth');
Route::post('notasgestions.buscar_materias', [NotasgestionController::class, 'buscar_materias'])->name('notasgestions.buscar_materias')->middleware('auth');

//detalle_inscripcion_becas
Route::resource('detalle_inscripcion_becas', DetalleInscripcionBecaController::class)->middleware('auth');
Route::get('detalle_inscripcion_becas/{detalle_inscripcion_beca_id}/{estado}', [DetalleInscripcionBecaController::class, 'actualizarEstado'])->name('detalle_inscripcion_becas.estado')->middleware('auth');

//TOMA DE MATERIAS
/* Route::get('toma_materia/{inscripcion_id}', [InscripcionController::class, 'toma_materia'])->name('toma_materia')->middleware('auth'); */
Route::get('toma_materia/{estudiante_id}', [InscripcionController::class, 'toma_materia'])->name('inscripciones.toma_materia')->middleware('auth');
Route::post('toma_materia/{estudiante_id}', [InscripcionController::class, 'toma_materia'])->name('inscripciones.toma_materia')->middleware('auth');
Route::post('new', [InscripcionController::class, 'new'])->name('new')->middleware('auth');
Route::delete('eliminar_materia_tomada/{inscripcion_id}', [InscripcionController::class, 'eliminar_materia_tomada'])->name('eliminar_materia_tomada')->middleware('auth');

Route::get('notasgestions.filtros', [NotasgestionController::class, 'index'])->name('notasgestions.filtros')->middleware('auth');
Route::post('notasgestions.filtros', [NotasgestionController::class, 'index'])->name('notasgestions.filtros')->middleware('auth');

Route::post('excel_historico/{estudiante_id}', [InscripcionController::class, 'excel_historico'])->name('excel_historico')->middleware('auth');

Route::post('materias.buscar_materias', [MateriaController::class, 'buscar_materias'])->name('materias.buscar_materias')->middleware('auth');
