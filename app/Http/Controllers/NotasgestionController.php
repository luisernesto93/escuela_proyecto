<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Notasgestion;
use Illuminate\Http\Request;
use DB;

class NotasgestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request) //Request $request
    {

        $gestions = DB::table('gestions')->where('estado', 1)->get();
        $niveles = DB::table('materias')->where('estado', 1)->get()->unique('nivel');
        $carreras = DB::table('carreras')->where('estado', 1)->get();

        $notasgestions = DB::table('notasgestions')->select('notasgestions.*', 'gestions.id as gestion_id', 'gestions.descripcion as nombre_gestion', 'gestions.anio as anio_gestion', 'carreras.id as carrera_id', 'carreras.nombre as nombre_carrera', 'materias.nivel as nivel_id', 'materias.orden as materia_gestion', 'materias.nombre_materia as nombre_materia', 'estudiantes.nombres as nombre_estudiante', 'estudiantes.apellidos as apellido_estudiante')
            ->join('gestions', 'gestions.id', '=', 'notasgestions.gestion_id')
            ->join('carreras', 'carreras.id', '=', 'notasgestions.carrera_id')
            ->join('materias', 'materias.id', '=', 'notasgestions.materia_id')
            ->join('estudiantes', 'estudiantes.id', '=', 'notasgestions.estudiante_id')
            ->where('notasgestions.gestion_id', $request->gestion_id)
            ->where('notasgestions.carrera_id', $request->carrera_id)
            ->where('notasgestions.materia_id', $request->materia_id)
            ->where('notasgestions.estado', 1);

        $resultados = $notasgestions->get()->unique('estudiante_id');
        $selectedGestionId = $request->gestion_id;
        $selectedCarreraId = $request->carrera_id;
        $selectedNivel = $request->nivel_id;

        return view('notasgestions.index', [
            'notasgestions' => $resultados,
            'gestions' => $gestions,
            'carreras' => $carreras,
            'niveles' => $niveles,
            'selectedGestionId' => $selectedGestionId,
            'selectedCarreraId' => $selectedCarreraId,
            'selectedNivel' => $selectedNivel,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notasgestions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notasgestion  $notasgestion
     * @return \Illuminate\Http\Response
     */
    public function show(Notasgestion $notasgestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notasgestion  $notasgestion
     * @return \Illuminate\Http\Response
     */
    public function edit(Notasgestion $notasgestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notasgestion  $notasgestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notasgestion $notasgestion)
    {
        $gestions = DB::table('gestions')->where('estado', 1)->get();
        $niveles = DB::table('materias')->where('estado', 1)->get()->unique('nivel');
        $carreras = DB::table('carreras')->where('estado', 1)->get();

        $notasgestion->update([
            'nota1' => $request->nota1 ?? 0,
            'nota2' => $request->nota2 ?? 0,
            'nota3' => $request->nota3 ?? 0,
            'promedio' => ($request->nota1 + $request->nota2 + $request->nota3) / 3,
            'prueba_recuperatoria' => $request->prueba_recuperatoria ?? 0,

            'nota_final' => ($request->prueba_recuperatoria > 0) ? ($request->prueba_recuperatoria) : (($request->nota1 + $request->nota2 + $request->nota3) / 3),
            'observaciones' => ($request->prueba_recuperatoria > 0) ? (($request->prueba_recuperatoria) > 61 ? 'APROBADO' : 'REPROBADO') : ((($request->nota1 + $request->nota2 + $request->nota3) / 3) > 61 ? 'APROBADO' : 'REPROBADO'),

        ]);

        $selectedGestionId = $notasgestion->gestion_id;
        $selectedNivel = Materia::where('id', $notasgestion->materia_id)->first()->nivel;
        $selectedCarreraId = $notasgestion->carrera_id;

        return view('notasgestions.index', [
            'gestions' => $gestions,
            'carreras' => $carreras,
            'niveles' => $niveles,
            'selectedGestionId' => $selectedGestionId,
            'selectedCarreraId' => $selectedCarreraId,
            'selectedNivel' => $selectedNivel,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notasgestion  $notasgestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notasgestion $notasgestion)
    {
        //
    }
    public function buscar_materias(Request $request)
    {
        //me llega gestion_id, carrera_id
        $gestion_carreras = DB::table('notasgestions')->select('notasgestions.materia_id as materia_id', 'materias.nombre_materia as nombre_materia', 'materias.nivel as nivel_id', 'materias.orden as materia_gestion')
            ->join('gestions', 'gestions.id', '=', 'notasgestions.gestion_id')
            ->join('carreras', 'carreras.id', '=', 'notasgestions.carrera_id')
            ->join('materias', 'materias.id', '=', 'notasgestions.materia_id')
            ->where('notasgestions.gestion_id', $request->gestion_id)
            ->where('notasgestions.carrera_id', $request->carrera_id)
            ->where('notasgestions.estado', 1)
            ->groupBy('materias.id', 'materias.nombre_materia', 'materias.nivel', 'materias.orden');

        $materias = $gestion_carreras->get();

        return response()->json($materias);
    }

    public function notas_estudiantes(Request $request)
    {
        $gestions = DB::table('gestions')->where('estado', 1)->get();
        $niveles = DB::table('materias')->where('estado', 1)->get()->unique('nivel');
        $carreras = DB::table('carreras')->where('estado', 1)->get();
        //recorro el array de notas y voy actualizando cada nota de cada estudiante en la tabla notasgestions
        foreach ($request->notas as $key => $value) {
            $notasgestion = Notasgestion::where('id', $key)->first();
            $notasgestion->update([
                'nota1' => $value['nota1'] ?? 0,
                'nota2' => $value['nota2'] ?? 0,
                'nota3' => $value['nota3'] ?? 0,
                'promedio' => ($value['nota1'] + $value['nota2'] + $value['nota3']) / 3,
                'prueba_recuperatoria' => $value['prueba_recuperatoria'] ?? 0,

                'nota_final' => ($value['prueba_recuperatoria'] > 0) ? ($value['prueba_recuperatoria']) : (($value['nota1'] + $value['nota2'] + $value['nota3']) / 3),
                'observaciones' => ($value['prueba_recuperatoria'] > 0) ? (($value['prueba_recuperatoria']) > 61 ? 'APROBADO' : 'REPROBADO') : ((($value['nota1'] + $value['nota2'] + $value['nota3']) / 3) > 61 ? 'APROBADO' : 'REPROBADO'),

            ]);
        }

        $selectedGestionId = $request->gestion_id;
        $selectedNivel = Materia::where('id', $request->materia_id)->first()->nivel ?? null;
        $selectedCarreraId = $request->carrera_id;
        return view('notasgestions.index', [
            'gestions' => $gestions,
            'carreras' => $carreras,
            'niveles' => $niveles,
            'selectedGestionId' => $selectedGestionId,
            'selectedNivel' => $selectedNivel,
            'selectedCarreraId' => $selectedCarreraId,
        ]);
    }
}
