<?php

namespace App\Http\Controllers;

use App\Models\EstadoVerificacion;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EstadoVerificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estado_verificaciones = EstadoVerificacion::all();
        //$estudiantes = Estudiante::all();
        return view('estado_verificaciones.index', [
            'estado_verificaciones' => $estado_verificaciones//,
            //'estudiantes' => $estudiantes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EstadoVerificacion  $estadoVerificacion
     * @return \Illuminate\Http\Response
     */
    public function show(EstadoVerificacion $estado_verificacione)
    {
        //$estudiantes = Estudiante::where('estado', 1)->get();
        return view('estado_verificaciones.show', [
            'estado_verificacione' => $estado_verificacione//,
            //'estudiantes' => $estudiantes
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EstadoVerificacion  $estadoVerificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(EstadoVerificacion $estado_verificacione/*, $estado_verificacion*/)
    {
        //$estadoVerificacion = EstadoVerificacion::where('id', $estado_verificacion)->first();
        //$estudiantes = Estudiante::where('estado', 1)->get();
        return view('estado_verificaciones.edit', [
            'estado_verificacione' => $estado_verificacione//,
            //'estudiante' => $estudiantes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EstadoVerificacion  $estadoVerificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EstadoVerificacion $estado_verificacione)
    {
        $estado_verificacione->update($request->all());
        return redirect()->route('estado_verificaciones.index')
            ->with('success', 'Estado Verificaciones actualizado satisfactoriamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EstadoVerificacion  $estadoVerificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(EstadoVerificacion $estado_verificacione)
    {
        if ($estado_verificacione->estado == 1) {
            return redirect()->route('$estado_verificaciones.index')
                ->with('error', 'No se puede eliminar las verificaciones de un estudiante activo');
        }
        $estado_verificacione->delete();

        return redirect()->route('estado_verificaciones.index')
            ->with('success', 'Verificaciones eliminadas satisfactoriamente');
    }
    public function actualizarEstado($estado_verificacion_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            EstadoVerificacion::whereId($estado_verificacion_id)->update(['estado' => $estado]);

            DB::commit();
            return redirect()->route('estado_verificaciones.index')->with('success', 'Estado Verificación del estudiante actualizado correctamente!');
        } catch (\Throwable $th) {

            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
