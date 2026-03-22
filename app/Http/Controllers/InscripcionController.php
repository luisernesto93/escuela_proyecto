<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Inscripcion;
use App\Models\Estudiante;
use App\Models\Gestion;
use App\Models\Inscriptor;
use App\Models\ModalidadPago;
use App\Models\Turno;
use App\Models\CanalPublicitario;
use App\Models\Plazoinscripcion;
use App\Models\EstadoVerificacion;
use App\Models\Beca;
use App\Models\Carrera;
use App\Models\DetalleInscripcionBeca;
use App\Models\Empresa;
use App\Models\Libro;
use App\Models\Materia;
use App\Models\Notasgestion;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HistoricoExport;
use Illuminate\Support\Facades\Auth;

class InscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inscripciones = Inscripcion::all()->unique('estudiante_id');
        $carreras = Carrera::where('estado', 1)->get();
        //$estudiantes = Estudiante::all();
        // $inscriptors = Inscriptor::all();
        return view('inscripciones.index', [
            'inscripciones' => $inscripciones,
            'carreras' => $carreras
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //Se utiliza en el botón nuevo
    {
        $estudiantes = Estudiante::all();
        $carrera = Carrera::where('estado', 1)->get();

        $gestiones = Gestion::where('estado', 1)->get();
        $turnos = Turno::all();
        $modalidad_pago = ModalidadPago::all();
        $canal_publicitarios = CanalPublicitario::all();
        $becas = Beca::all();

        $plazo_inscripcion = Plazoinscripcion::where('estado', 1)->first() ?? null;
        if ($plazo_inscripcion != null) {
            return view('inscripciones.create', [
                'estudiantes' => $estudiantes,
                'carreras' => $carrera,
                'gestiones' => $gestiones,
                'turnos' => $turnos,
                'modalidad_pagos' => $modalidad_pago,
                'canal_publicitarios' => $canal_publicitarios,
                'becas' => $becas
            ]);
        } else {
            return redirect()->route('inscripciones.index')->with('error', 'No existe un plazo de inscripción activo');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'estudiante_id' => ['required', 'numeric'],
            'gestion_id' => ['required', 'numeric'],
            'carrera_id' => ['required', 'numeric'],
            'turno_id' => ['required', 'numeric'],
            'modalidad_pago_id' => ['required', 'numeric'],
            'nro_deposito_glosa' => ['required', 'max:255'],
            'canal_publicitario_id' => ['required', 'numeric'],
            'beca_id' => ['required', 'numeric'],

        ]);

        DB::beginTransaction();

        //dd(Materia::where('id', $request->carrera_id)->first()->id ?? null);
        $inscripcion = Inscripcion::create([
            'fecha_inscripcion' => now(),
            'nombre_inscriptor' => Auth::user()->first_name . ' ' . Auth::user()->last_name ?? null,

        ] + $request->all());

        $plazo_inscripcion = Plazoinscripcion::where('gestion_id', $request->gestion_id)->where('estado', 1)->first() ?? null;
        // dd($plazo_inscripcion);
        $fecha_incio = now();
        if ($plazo_inscripcion != null) {
            $fecha_fin = date('Y-m-d 23:59:59', strtotime($plazo_inscripcion->fecha_limite));
            $fecha_inscripcion = date('Y-m-d H:i:s', strtotime($inscripcion->fecha_inscripcion));
            //$fecha_inscripcion = date('Y-m-d H:i:s', strtotime($request->fecha_inscripcion));

            //verifico si la fecha de inscripcion esta en el rango
            if ($fecha_inscripcion >= $fecha_incio && $fecha_inscripcion <= $fecha_fin) {
                try {
                    $request->validate([
                        'compromiso_titulo' => ['required', 'numeric'],
                        'ci_estado' => ['required', 'numeric'],
                        'foto_estado' => ['required', 'numeric'],
                        'folder_estado' => ['required', 'numeric'],
                        'certificado_estado' => ['required', 'numeric'],
                        'pago_folder_estado' => ['required', 'numeric'],
                    ]);
                    EstadoVerificacion::create([ //Es para guardar internanmente este dato en la tabla verificaciones
                        'estudiante_id' => $request->estudiante_id,
                        'compromiso_titulo' => $request->compromiso_titulo ?? 0,
                        'ci_estado' => $request->ci_estado ?? 0,
                        'foto_estado' => $request->foto_estado ?? 0,
                        'folder_estado' => $request->folder_estado ?? 0,
                        'certificado_estado' => $request->certificado_estado  ?? 0,
                        'pago_folder_estado' => $request->pago_folder_estado ?? 0,
                        'estado' => 1
                    ]);
                    //Registrar internamente en la tabla detalle inscripción
                    DetalleInscripcionBeca::create([
                        'inscripcion_id' => Inscripcion::latest('id')->first()->id ?? null,
                        'beca_id' => $request->beca_id,
                        'porcentaje' => Beca::where('id', $request->beca_id)->first()->porcentaje ?? 0
                    ]);

                    $materia_orden_1 = Materia::where('orden', 1)->where('carrera_id', $request->carrera_id)->get() ?? null;

                    if ($materia_orden_1 != null) {
                        foreach ($materia_orden_1 as $materia) {
                            Notasgestion::create([
                                'gestion_id' => $request->gestion_id ?? null,
                                'carrera_id' => $request->carrera_id ?? null,
                                'libro_id' => Libro::where('gestion_id', $request->gestion_id)->first()->id ?? null,
                                'materia_id' => Materia::where('id', $materia->id)->first()->id ?? null,
                                'estudiante_id' => $request->estudiante_id ?? null,
                                'docente_id' => 1,
                                'nota1' => 0,
                                'nota2' => 0,
                                'nota3' => 0,
                                'promedio' => 0,
                                'prueba_recuperatoria' => 0,
                                'nota_final' => 0,
                                'observaciones' => 0,
                                'estado' => 1,
                                'usuario' => Auth::user()->first_name . ' ' . Auth::user()->last_name ?? null,
                            ]);
                        }
                    }
                    DB::commit();
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return redirect()->route('inscripciones.create')->with('error', $th->getMessage());
                }
                return redirect()->route('inscripciones.index');
            } else {
                return redirect()->route('inscripciones.create')->with('error', 'La fecha de inscripción no esta en el rango');
            }
        } else {
            return redirect()->route('inscripciones.create')->with('error', 'No existe un plazo de inscripción activo');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function show(Inscripcion $inscripcione)
    {
        /*$gestiones = Gestion::all();
        $estudiantes = Estudiante::all();
        $modalidad_pagos = ModalidadPago::all();
        $turnos = Turno::all();
        $inscriptores = Inscriptor::all();
        $canal_publicitarios = CanalPublicitario::all();*/
        $carreras = Carrera::where('estado', 1)->get();
        return view('inscripciones.show', [
            'inscripcion' => $inscripcione,
            'carreras' => $carreras/*,
            'estudiante' => $estudiantes*/
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function edit(Inscripcion $inscripcione)
    {
        $gestiones = Gestion::all();
        $estudiantes  = Estudiante::all();
        $carreras = Carrera::where('estado', 1)->get();
        $turnos = Turno::all();
        $becas = Beca::all();
        $modalidades_pago = ModalidadPago::all();
        $canales_publicitarios = CanalPublicitario::all();
        return view('inscripciones.edit', [
            'inscripcion' => $inscripcione,
            'gestiones' => $gestiones,
            'estudiantes' => $estudiantes,
            'carreras' => $carreras,
            'turnos' => $turnos,
            'becas' => $becas,
            'modalidades_pago' => $modalidades_pago,
            'canales_publicitarios' => $canales_publicitarios
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inscripcion $inscripcione) //   Obliga a utilizar inscripcione en vez de inscripcion
    {
        $request->validate([
            'estudiante_id' => ['required', 'numeric'],
            'gestion_id' => ['required', 'numeric'],
            'carrera_id' => ['required', 'numeric'],
            'turno_id' => ['required', 'numeric'],
            'modalidad_pago_id' => ['required', 'numeric'],
            'nro_deposito_glosa' => ['required', 'max:255'],
            'canal_publicitario_id' => ['required', 'numeric'],
            'beca_id' => ['required', 'numeric'],
            'estado' => ['required', 'numeric']
        ]);

        $plazo_inscripcion = Plazoinscripcion::where('gestion_id', $request->gestion_id)->where('estado', 1)->first() ?? null;

        if ($plazo_inscripcion != null) {
            $fecha_incio = date('Y-m-d 00:00:00', strtotime($plazo_inscripcion->fecha_inicio));
            $fecha_fin = date('Y-m-d 23:59:59', strtotime($plazo_inscripcion->fecha_limite));
            $fecha_inscripcion = date('Y-m-d H:i:s', strtotime($request->fecha_inscripcion));
            //verificar si la fecha de inscripcion esta en el rango
            if ($fecha_inscripcion >= $fecha_incio && $fecha_inscripcion <= $fecha_fin) {

                //$inscripcione->update($request->all());
                Inscripcion::whereId($inscripcione->id)->update($request->except(
                    '_token',
                    '_method',
                    'compromiso_titulo',
                    'ci_estado',
                    'foto_estado',
                    'folder_estado',
                    'certificado_estado',
                    'pago_folder_estado'
                ));

                $estado_verificacion = EstadoVerificacion::where('estudiante_id', $inscripcione->estudiante_id)->first() ?? null;

                if ($estado_verificacion['estudiante_id'] != (int)$request['estudiante_id']) {

                    $estado_verificacion->update([
                        'estudiante_id' => $request->estudiante_id,
                    ]);
                }

                DetalleInscripcionBeca::where('inscripcion_id', $inscripcione->id)->update([
                    'beca_id' => $request->beca_id,
                    //'porcentaje' => Beca::where('id', $request->beca_id)->first()->porcentaje ?? 0
                ]);

                $materia_orden_1 = Materia::where('orden', 1)->where('carrera_id', $request->carrera_id)->get() ?? null;

                if ($materia_orden_1 != null) {
                    foreach ($materia_orden_1 as $materia) {
                        Notasgestion::where('estudiante_id', $inscripcione->estudiante_id)->update([
                            'gestion_id' => $request->gestion_id ?? null,
                            'carrera_id' => $request->carrera_id ?? null,
                            'libro_id' => Libro::where('gestion_id', $request->gestion_id)->first()->id ?? null,
                            'materia_id' => Materia::where('id', $materia->id)->first()->id ?? null,
                            'estudiante_id' => $request->estudiante_id ?? null,
                            'docente_id' => 1,
                            'nota1' => 0,
                            'nota2' => 0,
                            'nota3' => 0,
                            'promedio' => 0,
                            'prueba_recuperatoria' => 0,
                            'nota_final' => 0,
                            'observaciones' => 0,
                            'estado' => 1,
                            'usuario' => Auth::user()->first_name . ' ' . Auth::user()->last_name ?? null
                        ]);
                    }
                }
                return redirect()->route('inscripciones.index')->with('success', 'Inscripción atualizada correctamente');
            } else {
                return redirect()->route('inscripciones.index')->with('error', 'La fecha de inscripcion no esta en el rango');
            }
        } else {
            return redirect()->route('inscripciones.index')->with('error', 'No existe un plazo de inscripcion activo');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inscripcion $inscripcione)
    {
        if ($inscripcione->estado == 1) {
            return redirect()->route('inscripciones.index')
                ->with('error', 'No se puede eliminar una inscripción activa');
        }
        EstadoVerificacion::where('estudiante_id', $inscripcione->estudiante_id)->delete();
        DetalleInscripcionBeca::where('inscripcion_id', $inscripcione->id)->delete(); //Elimitar tabla vinculada
        DetalleInscripcionBeca::where('beca_id', $inscripcione->beca_id)->delete();
        $inscripcione->delete();
        return redirect()->route('inscripciones.index')
            ->with('success', 'Inscripcion eliminada satisfactoriamente');
    }
    public function actualizarEstado($inscripcion_id, $estado)
    {
        try {
            DB::beginTransaction();

            // Update Status
            Inscripcion::whereId($inscripcion_id)->update(['estado' => $estado]);

            DB::commit();
            return redirect()->route('inscripciones.index')->with('success', 'Estado de la inscripcipción actualizado correctamente!');
        } catch (\Throwable $th) {

            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function reporteInscripciones()
    {
        $gestions = Gestion::where('estado', 1)->get();
        $canal_publicitarios = CanalPublicitario::where('estado', 1)->get();

        return view('reportes.reporte_inscripciones')->with([
            'gestions' => $gestions,
            'canal_publicitarios' => $canal_publicitarios,
        ]);
    }

    public function filtrar(Request $request)
    {
        $fecha_inicio = date('Y-m-d 00:00:00', strtotime($request->fecha_inicio));
        $fecha_fin = date('Y-m-d 23:59:59', strtotime($request->fecha_fin));
        $gestions = Gestion::where('estado', 1)->get();
        $canal_publicitarios = CanalPublicitario::where('estado', 1)->get();

        $r_inscripciones = DB::table('inscripcions')
            ->select(
                'inscripcions.id',
                'gestions.descripcion as gestion',
                'gestions.anio as anio',
                'estudiantes.nombres as nombres',
                'estudiantes.apellidos as apellidos',
                'turnos.descripcion as turno',
                'carreras.nombre as carrera',
                'inscripcions.fecha_inscripcion as fecha_inscripcion',
                'canal_publicitarios.descripcion as canal_publicitario'
            ) //Lo añadí
            ->join('gestions', 'gestions.id', '=', 'inscripcions.gestion_id')
            ->join('estudiantes', 'estudiantes.id', '=', 'inscripcions.estudiante_id')
            ->join('turnos', 'turnos.id', '=', 'inscripcions.turno_id')
            ->join('canal_publicitarios', 'canal_publicitarios.id', '=', 'inscripcions.canal_publicitario_id')
            //->join('carreras', 'carreras.id', '=', 'inscripcions.categoria_id');
            ->join('carreras', 'carreras.id', '=', 'inscripcions.carrera_id');

        if ($request->gestion_id != '*') {
            $r_inscripciones = $r_inscripciones->where('inscripcions.gestion_id', $request->gestion_id);
        }
        if ($request->canal_publicitario_id != '*') {
            $r_inscripciones = $r_inscripciones->where('inscripcions.canal_publicitario_id', $request->canal_publicitario_id);
        }

        if ($request->fecha_inicio != null) {
            $r_inscripciones = $r_inscripciones->where('inscripcions.fecha_inscripcion', '>=', $fecha_inicio);
        }

        if ($request->fecha_fin != null) {
            $r_inscripciones = $r_inscripciones->where('inscripcions.fecha_inscripcion', '<=', $fecha_fin);
        }

        $r_inscripciones = $r_inscripciones->get();

        return view('reportes.reporte_inscripciones')->with([
            'r_inscripciones' => $r_inscripciones,
            'gestions' => $gestions,
            'canal_publicitarios' => $canal_publicitarios,
        ]);
    }

    public function reporteInscripcion(Request $request)
    {
        $inscripcions = Inscripcion::where('id', $request->inscripcion_id)->with('estudiante')->first();

        $estado_verificacions = EstadoVerificacion::where('estudiante_id', $inscripcions->estudiante_id)->first();

        $empresa = Empresa::first();

        //$empresa = $empresa->logo = 'images/CI-IVER.jpg';


        view()->share('empresa', $empresa);
        view()->share('inscripcions', $inscripcions);
        view()->share('estado_verificacions', $estado_verificacions);

        //$pdf =  PDF::loadView('pdf.printInscripcion');
        $pdf = PDF::loadView('pdf.printInscripcion')->setOptions([
            'page-size' => 'Letter',
            'orientation' => 'portrait',
            'header-font-size' => 8,
            'footer-right' => 'Página [page] de [toPage]',
        ]);

        return $pdf->stream();
    }

    public function reporteIstoricoAcademico() //INDEX
    {
        $gestions = DB::table('gestions')->where('estado', 1)->get();
        $carreras = DB::table('carreras')->where('estado', 1)->get();
        $materias = DB::table('materias')->where('estado', 1)->get();
        $estudiantes = DB::table('estudiantes')->where('estado', 1)->get();

        return view('reportes.reporte_historico_academico')->with([
            'gestions' => $gestions,
            'carreras' => $carreras,
            'materias' => $materias,
            'estudiantes' => $estudiantes,
        ]);
    }

    public function filtrarHistoricoAcademico(Request $request)
    {
        $gestions = Gestion::where('estado', 1)->get();
        $carreras = Carrera::where('estado', 1)->get();
        $materias = Materia::where('estado', 1)->get();
        $estudiantes = Estudiante::where('estado', 1)->get();

        $r_historicos = DB::table('notasgestions')->select('notasgestions.nota_final as nota_final', 'notasgestions.prueba_recuperatoria as prueba_recuperatoria', 'notasgestions.observaciones as observaciones', 'notasgestions.estudiante_id as estudiante_id', 'gestions.descripcion as gestion', 'gestions.anio as anio', 'materias.nivel as nivel', 'materias.sigla as sigla', 'materias.nombre_materia as nombre_materia', 'carreras.nombre as nombre_carrera', 'estudiantes.nombres as nombre_estudiante', 'estudiantes.apellidos as apellido_estudiante', 'estudiantes.id as id_estudiante', 'estudiantes.documento as documento')
            ->join('gestions', 'gestions.id', '=', 'notasgestions.gestion_id')
            ->join('carreras', 'carreras.id', '=', 'notasgestions.carrera_id')
            //       ->join('materias', 'materias.planestudio_id', '')
            ->join('materias', 'materias.id', '=', 'notasgestions.materia_id')
            ->join('estudiantes', 'estudiantes.id', '=', 'notasgestions.estudiante_id')
            ->where('notasgestions.estudiante_id', $request->estudiante_id);

        if ($request->gestion_id != '*') {
            $r_historicos->where('notasgestions.gestion_id', $request->gestion_id);
        }

        if ($request->carrera_id != '*') {
            $r_historicos->where('notasgestions.carrera_id', $request->carrera_id);
        }

        $resultados = $r_historicos->get();

        return view('reportes.reporte_historico_academico')->with([
            'r_historicos' => $resultados,
            'gestions' => $gestions,
            'carreras' => $carreras,
            'materias' => $materias,
            'estudiantes' => $estudiantes,
        ]);
    }
    public function reporteHistoricoAcademico(Request $request) //IMPRESION HISTORICO ACADEMICO
    {

        $empresa = Empresa::first();

        $r_historicos = DB::table('notasgestions')->select('notasgestions.nota_final as nota_final', 'notasgestions.prueba_recuperatoria as prueba_recuperatoria', 'notasgestions.observaciones as observaciones', 'notasgestions.estudiante_id as estudiante_id', 'gestions.descripcion as gestion', 'gestions.anio as anio', 'materias.nivel as nivel', 'materias.sigla as sigla', 'materias.nombre_materia as nombre_materia', 'carreras.nombre as nombre_carrera', 'estudiantes.nombres as nombre_estudiante', 'estudiantes.apellidos as apellido_estudiante', 'estudiantes.id as id_estudiante', 'estudiantes.documento as documento')
            ->join('gestions', 'gestions.id', '=', 'notasgestions.gestion_id')
            ->join('carreras', 'carreras.id', '=', 'notasgestions.carrera_id')
            ->join('materias', 'materias.id', '=', 'notasgestions.materia_id')
            ->join('estudiantes', 'estudiantes.id', '=', 'notasgestions.estudiante_id')
            ->where('notasgestions.estudiante_id', $request->estudiante_id);

        $r_historicos = $r_historicos->get();

        view()->share('empresa', $empresa);
        view()->share('r_historicos', $r_historicos);
        $pdf = PDF::loadView('pdf.historicoAcademico')->setOptions([
            'page-size' => 'Letter',
            'orientation' => 'portrait',
            'header-font-size' => 8,
            'footer-right' => 'Página [page] de [toPage]',
        ]);

        return $pdf->stream();
    }

    public function reporteCentralizador() //INDEX
    {
        $gestions = DB::table('gestions')->where('estado', 1)->orderBy('id', 'desc')->get();
        $niveles = DB::table('materias')->where('estado', 1)->get()->unique('nivel');
        $carreras = DB::table('carreras')->where('estado', 1)->get();
        $materia_gestions = DB::table('materias')->where('estado', 1)->get()->unique('orden'); //1MER AÑO 2DO AÑO Y 3CER AÑO

        return view('reportes.reporte_centralizador')->with([
            'gestions' => $gestions,
            'carreras' => $carreras,
            'niveles' => $niveles,
            'materia_gestions' => $materia_gestions,
        ]);
    }

    public function filtrarCentralizador(Request $request)
    {
        $request->validate([
            'gestion_id' => ['required'],
            'carrera_id' => ['required'],
            'nivel' => ['required'],
            'materia_gestion' => ['required'],
        ]);

        $gestions = DB::table('gestions')->where('estado', 1)->orderBy('id', 'desc')->get();
        $niveles = DB::table('materias')->where('estado', 1)->get()->unique('nivel');
        $carreras = DB::table('carreras')->where('estado', 1)->get();
        $materia_gestions = DB::table('materias')->where('estado', 1)->get()->unique('orden'); //1MER AÑO 2DO AÑO Y 3CER AÑO

        $r_centralizador = DB::table('notasgestions')->select('notasgestions.*', 'gestions.id as gestion_id', 'gestions.descripcion as nombre_gestion', 'gestions.anio as anio_gestion', 'carreras.id as carrera_id', 'carreras.nombre as nombre_carrera', 'materias.nivel as nivel_id', 'materias.orden as materia_gestion', 'materias.nombre_materia as nombre_materia', 'estudiantes.nombres as nombre_estudiante', 'estudiantes.apellidos as apellido_estudiante', 'estudiantes.documento as documento', 'turnos.descripcion as nombre_turno', 'libros.nro_libro as nro_libro', 'resolucions.numero_resolucion as numero_resolucion')
            ->join('gestions', 'gestions.id', '=', 'notasgestions.gestion_id')
            ->leftJoin('resolucions', 'resolucions.gestion_id', 'gestions.id')
            ->join('carreras', 'carreras.id', '=', 'notasgestions.carrera_id')
            ->join('materias', 'materias.id', '=', 'notasgestions.materia_id')
            ->join('estudiantes', 'estudiantes.id', '=', 'notasgestions.estudiante_id')
            ->join('inscripcions', 'inscripcions.estudiante_id', '=', 'estudiantes.id')
            ->join('turnos', 'turnos.id', '=', 'inscripcions.turno_id')
            ->join('libros', 'libros.gestion_id', '=', 'gestions.id')
            ->where('notasgestions.gestion_id', $request->gestion_id)
            ->where('notasgestions.carrera_id', $request->carrera_id)
            ->where('materias.nivel', $request->nivel)
            ->where('materias.orden', $request->materia_gestion);

        $r_centralizadors = $r_centralizador->get();
        //obtengo las materias de la carrera
        $materias = DB::table('materias')->where('carrera_id', $request->carrera_id)->where('nivel', $request->nivel)->where('orden', $request->materia_gestion)->get();

        return view('reportes.reporte_centralizador')->with([
            'r_centralizadors' => $r_centralizadors,
            'gestions' => $gestions,
            'niveles' => $niveles,
            'carreras' => $carreras,
            'materia_gestions' => $materia_gestions,
            'materias' => $materias,
        ]);
    }

    public function reportePDFCentralizador(Request $request) //IMPRESION HISTORICO ACADEMICO
    {
        $r_centralizador = DB::table('notasgestions')->select('notasgestions.*', 'gestions.id as gestion_id', 'gestions.descripcion as nombre_gestion', 'gestions.anio as anio_gestion', 'carreras.id as carrera_id', 'carreras.nombre as nombre_carrera', 'materias.nivel as nivel_id', 'materias.orden as materia_gestion', 'materias.nombre_materia as nombre_materia', 'estudiantes.nombres as nombre_estudiante', 'estudiantes.apellidos as apellido_estudiante', 'estudiantes.documento as documento', 'turnos.descripcion as nombre_turno', 'libros.nro_libro as nro_libro', 'resolucions.numero_resolucion as numero_resolucion')
            ->join('gestions', 'gestions.id', '=', 'notasgestions.gestion_id')
            ->leftJoin('resolucions', 'resolucions.gestion_id', 'gestions.id')
            ->join('carreras', 'carreras.id', '=', 'notasgestions.carrera_id')
            ->join('materias', 'materias.id', '=', 'notasgestions.materia_id')
            ->join('estudiantes', 'estudiantes.id', '=', 'notasgestions.estudiante_id')
            ->join('inscripcions', 'inscripcions.estudiante_id', '=', 'estudiantes.id')
            ->join('turnos', 'turnos.id', '=', 'inscripcions.turno_id')
            ->join('libros', 'libros.gestion_id', '=', 'gestions.id')
            ->where('notasgestions.gestion_id', $request->gestion_id)
            ->where('notasgestions.carrera_id', $request->carrera_id)
            ->where('materias.nivel', $request->nivel)
            ->where('materias.orden', $request->materia_gestion);

        $r_centralizadors = $r_centralizador->get();

        $empresa = Empresa::first();

        //obtengo las materias de la carrera
        $materias = DB::table('materias')->where('carrera_id', $request->carrera_id)->where('nivel', $request->nivel)->where('orden', $request->materia_gestion)->get();

        view()->share('empresa', $empresa);
        view()->share('r_centralizadors', $r_centralizadors);
        view()->share('materias', $materias);

        $pdf = PDF::loadView('pdf.printCentralizador')->setOptions([
            'page-size' => 'Letter',
            'orientation' => 'landscape',
            'header-font-size' => 8,
            'footer-right' => 'Página [page] de [toPage]',
        ]);

        return $pdf->stream();
    }
    public function toma_materia($id)
    {
        /* $estudiante_id = Notasgestion::where('estudiante_id', $id)->first()->estudiante_id ?? null;

        // Obtengo las materias tomadas por el estudiante
        $materias_tomadas = DB::table('notasgestions')
            ->select('notasgestions.id as id', 'notasgestions.nota1 as nota1', 'notasgestions.nota2 as nota2', 'notasgestions.nota3 as nota3', 'notasgestions.nota_final as nota_final', 'notasgestions.observaciones as observaciones', 'materias.nombre_materia as nombre_materia', 'materias.sigla as sigla', 'gestions.descripcion as gestion', 'gestions.anio as anio', 'carreras.nombre as nombre_carrera', 'carreras.id as carrera_id', 'estudiantes.nombres as nombre_estudiante', 'estudiantes.apellidos as apellido_estudiante', 'notasgestions.estudiante_id as estudiante_id')
            ->join('gestions', 'gestions.id', '=', 'notasgestions.gestion_id')
            ->join('carreras', 'carreras.id', '=', 'notasgestions.carrera_id')
            ->join('materias', 'materias.id', '=', 'notasgestions.materia_id')
            ->join('estudiantes', 'estudiantes.id', '=', 'notasgestions.estudiante_id')
            ->where('estudiante_id', $estudiante_id)
            ->get();

        // Obtengo las materias del estuidiante no tomadas y las materias tomadas con nota final <= 61
        $materias_no_tomadas = DB::table('materias')
            ->select('materias.*', 'prerequisitos.materia_prerequisito_id as materia_prerequisito_id')
            ->leftJoin('prerequisitos', 'prerequisitos.materia_id', '=', 'materias.id')
            ->where('materias.estado', 1)
            ->whereNotIn('materias.id', function ($query) use ($estudiante_id) {
                $query->select('materia_id')
                    ->from('notasgestions')
                    ->where('estudiante_id', $estudiante_id)
                    ->where(function ($query) {
                        $query->where('nota_final', '>=', 61)
                            //aqui no hay null se rellena con cero
                            ->orWhere('nota_final', '=', 0);
                    });
            })
            ->get();
            dd($materias_no_tomadas); */
        $estudiante_id = Notasgestion::where('estudiante_id', $id)->value('estudiante_id') ?? null;

        $materias_tomadas = DB::table('notasgestions')
            ->select('notasgestions.id as id', 'notasgestions.nota1 as nota1', 'notasgestions.nota2 as nota2', 'notasgestions.nota3 as nota3', 'notasgestions.nota_final as nota_final', 'notasgestions.observaciones as observaciones', 'materias.nombre_materia as nombre_materia', 'materias.sigla as sigla', 'gestions.descripcion as gestion', 'gestions.anio as anio', 'carreras.nombre as nombre_carrera', 'carreras.id as carrera_id', 'estudiantes.nombres as nombre_estudiante', 'estudiantes.apellidos as apellido_estudiante', 'notasgestions.estudiante_id as estudiante_id')
            ->join('gestions', 'gestions.id', '=', 'notasgestions.gestion_id')
            ->join('carreras', 'carreras.id', '=', 'notasgestions.carrera_id')
            ->join('materias', 'materias.id', '=', 'notasgestions.materia_id')
            ->join('estudiantes', 'estudiantes.id', '=', 'notasgestions.estudiante_id')
            ->where('estudiante_id', $estudiante_id)
            ->get();
        $carrera_id = Notasgestion::where('estudiante_id', $id)->value('carrera_id') ?? null;

        $materias_no_tomadas = DB::table('materias')
            ->select('materias.*', 'prerequisitos.materia_prerequisito_id as materia_prerequisito_id')
            ->leftJoin('prerequisitos', 'prerequisitos.materia_id', '=', 'materias.id')
            ->where('materias.estado', 1)
            ->where('materias.carrera_id', $carrera_id) // Agregado para filtrar por la carrera del estudiante
            ->whereNotIn('materias.id', function ($query) use ($estudiante_id) {
                $query->select('materia_id')
                    ->from('notasgestions')
                    ->where('estudiante_id', $estudiante_id)
                    ->where(function ($query) {
                        $query->where('nota_final', '>=', 61)
                            ->orWhere('nota_final', '=', 0);
                    });
            })
            ->get();


        //de materias no tomadas separo por materia->orden para listar en otro array
        foreach ($materias_no_tomadas as $materia) {
            $materias_no_tomadas_orden[$materia->orden][] = $materia;
        }

        $gestiones = DB::table('plazoinscripcions')->select('gestions.*', 'plazoinscripcions.fecha_inicio as fecha_inicio', 'plazoinscripcions.fecha_limite as fecha_limite')
            ->join('gestions', 'gestions.id', '=', 'plazoinscripcions.gestion_id')
            ->where('plazoinscripcions.estado', 1)->get();

        //voy a comparar las fecchas para ver si esta en el rango de inscripcion y si no estan hago update a estado 0
        foreach ($gestiones as $gestion) {
            $fecha_fin = date('Y-m-d 23:59:59', strtotime($gestion->fecha_limite));
            $fecha_inscripcion = date('Y-m-d H:i:s', strtotime(now()));
            //verificar si la fecha de inscripcion esta en el rango y si no esta hago update a estado 0
            if ($fecha_inscripcion >= $fecha_fin) {
                Plazoinscripcion::where('gestion_id', $gestion->id)->update(['estado' => 0]);
            }
        }

        $gestiones_encontradas = DB::table('plazoinscripcions')->select('gestions.*', 'plazoinscripcions.fecha_inicio as fecha_inicio', 'plazoinscripcions.fecha_limite as fecha_limite')
            ->join('gestions', 'gestions.id', '=', 'plazoinscripcions.gestion_id')
            ->where('plazoinscripcions.estado', 1)->get();

        $turnos = DB::table('turnos')->where('estado', 1)->get();
        //hago que no tome materias que ya estan tomadas por el estudiante
        $materia_gestions = DB::table('materias')->where('estado', 1)->whereNotIn('id', function ($query) use ($estudiante_id) {
            $query->select('materia_id')->from('notasgestions')->where('estudiante_id', $estudiante_id);
        })->get()->unique('orden'); //1MER AÑO 2DO AÑO Y 3CER AÑO

        return view('inscripciones.toma_materia')->with([
            'materias_tomadas' => $materias_tomadas,
            'gestiones' => $gestiones_encontradas,
            'turnos' => $turnos,
            'materia_gestions' => $materia_gestions,
            'materias_no_tomadas' => $materias_no_tomadas,
        ]);
    }
    public function new(Request $request)
    {
        //hago validaciones 
        /* $request->validate([
            'gestion_id' => ['required', 'numeric'],
            'turno_id' => ['required', 'numeric'],
        ]); */

        $plazo_inscripcion = Plazoinscripcion::where('gestion_id', $request->gestion_id)->where('estado', 1)->first() ?? null;

        if ($plazo_inscripcion != null) {
            $fecha_incio = date('Y-m-d 00:00:00', strtotime($plazo_inscripcion->fecha_inicio));
            $fecha_fin = date('Y-m-d 23:59:59', strtotime($plazo_inscripcion->fecha_limite));
            $fecha_inscripcion = date('Y-m-d H:i:s', strtotime(now()));
            //verificar si la fecha de inscripcion esta en el rango
            if ($fecha_inscripcion >= $fecha_incio && $fecha_inscripcion <= $fecha_fin) {

                $prerequisito = DB::table('prerequisitos')->where('materia_id', $request->materia_id)->first() ?? null;

                $nota_final_prerequisito = DB::table('notasgestions')
                    ->where('estudiante_id', $request->estudiante_id)
                    ->where('materia_id', $prerequisito->materia_prerequisito_id ?? 0)
                    ->value('nota_final');

                $ya_existe_materia = DB::table('notasgestions')->where('estudiante_id', $request->estudiante_id)->where('materia_id', $request->materia_id)->where('gestion_id', $request->gestion_id)->first() ?? null;

                if ($nota_final_prerequisito >= 61  && $nota_final_prerequisito > 0 && $ya_existe_materia == null) {
                    Notasgestion::create([
                        'gestion_id' => $request->gestion_id ?? null,
                        'carrera_id' => $request->carrera_id ?? null,
                        'libro_id' => Libro::where('gestion_id', $request->gestion_id)->first()->id ?? null,
                        'materia_id' => $request->materia_id ?? null,
                        'estudiante_id' => $request->estudiante_id ?? null,
                        'docente_id' => $request->docente_id ?? 1,
                        'nota1' => 0,
                        'nota2' => 0,
                        'nota3' => 0,
                        'promedio' => 0,
                        'prueba_recuperatoria' => 0,
                        'nota_final' => 0,
                        'observaciones' => 0,
                        'estado' => 1,
                        'usuario' => Auth::user()->first_name . ' ' . Auth::user()->last_name ?? null,
                    ]);

                    return redirect()->route('inscripciones.toma_materia', $request->estudiante_id)->with('success', 'Materia tomada correctamente');
                }
                return redirect()->route('inscripciones.toma_materia', $request->estudiante_id)->with('error', 'No se puede tomar la materia, no tiene el prerequisito aprobado');
            } else {
                return redirect()->route('inscripciones.toma_materia', $request->estudiante_id)->with('error', 'La fecha de inscripcion no esta en el rango');
            }
        } else {
            return redirect()->route('inscripciones.toma_materia', $request->estudiante_id)->with('error', 'No existe un plazo de inscripcion activo');
        }
    }

    public function excel_historico(Request $request)
    {
        return Excel::download(new HistoricoExport($request), 'historico.xlsx');
    }

    public function buscar_carreras_estudiante(Request $request)
    {
        //me llega el id del estudiante
        $estudiante_id = $request->estudiante_id;
        //obtengo las inscripciones del estudiante
        $inscripciones = Inscripcion::where('estudiante_id', $estudiante_id)->get();
        //obtengo las carreras de las inscripciones
        $carreras = Carrera::whereIn('id', $inscripciones->pluck('carrera_id'))->get();
        //retorno las carreras
        return response()->json($carreras);
    }

    public function eliminar_materia_tomada($id)
    {
        $materia_tomada = Notasgestion::where('id', $id)->first();
        $materia_tomada->delete();
        return redirect()->route('inscripciones.toma_materia', $materia_tomada->estudiante_id)->with('success', 'Materia eliminada correctamente');
    }
}
