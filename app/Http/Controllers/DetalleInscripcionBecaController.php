<?php

namespace App\Http\Controllers;

use App\Models\Beca;
use App\Models\DetalleInscripcionBeca;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetalleInscripcionBecaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detalle_inscripcion_becas = DetalleInscripcionBeca::paginate(11);
        return view('detalle_inscripcion_becas.index', [
            'detalle_inscripcion_becas' => $detalle_inscripcion_becas //La clave 'resoluciones' influye es los parámetros de los métodos, menos en actualizar estado
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\DetalleInscripcionBeca  $detalleInscripcionBeca
     * @return \Illuminate\Http\Response
     */
    public function show(DetalleInscripcionBeca $detalleInscripcionBeca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetalleInscripcionBeca  $detalleInscripcionBeca
     * @return \Illuminate\Http\Response
     */
    public function edit(DetalleInscripcionBeca $detalleInscripcionBeca)
    {
        //
        $inscripciones = Inscripcion::where('estado', 1)->get();
        $becas = Beca::where('estado', 1)->get();
        return view('detalle_inscripcion_becas.edit', [
            'detalle_inscripcion_beca' => $detalleInscripcionBeca,
            'inscripciones' => $inscripciones,
            'becas' => $becas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetalleInscripcionBeca  $detalleInscripcionBeca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleInscripcionBeca $detalleInscripcionBeca)
    {
        //
        $request->validate([
            //'inscripcion_id' => ['required', 'numeric'],
            //'beca_id' => ['required', 'numeric'],
            'porcentaje' => ['required', 'numeric'],
        ]);
        $detalleInscripcionBeca->update($request->all());

        return redirect()->route('detalle_inscripcion_becas.index')
        ->with('success', 'Detalle Inscripción con Beca actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetalleInscripcionBeca  $detalleInscripcionBeca
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetalleInscripcionBeca $detalleInscripcionBeca)
    {
        //
    }
    public function actualizarEstado($detalle_inscripcion_beca_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            DetalleInscripcionBeca::whereId($detalle_inscripcion_beca_id)->update(['estado' => $estado]);
            DB::commit();
            return redirect()->route('detalle_inscripcion_becas.index')->with('success', 'Estado actualizado correctamente!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
