<?php

namespace App\Http\Controllers;

use App\Models\Plazoinscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Gestion;

class PlazoinscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plazoinscripcions = Plazoinscripcion::all();
        $gestiones = Gestion::all();
        return view('plazoinscripcions.index', [
            'plazoinscripcions' => $plazoinscripcions,
            'gestiones' => $gestiones
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gestiones = Gestion::where('estado', 1)->get();
        return view('plazoinscripcions.create', [
            'gestiones' => $gestiones
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //Es para Guardar
    {
        //Validaciones
        $request->validate([
            'gestion_id' => ['required', 'numeric'],
            'fecha_inicio' => ['required', 'max:255'],
            'fecha_limite' => ['required', 'max:255']
        ]);
        Plazoinscripcion::create($request->all());

        return redirect()->route('plazoinscripcions.index')
            ->with('success', 'Plazo Inscripciones creado satisfactoriamente.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plazoinscripcion  $plazoinscripcion
     * @return \Illuminate\Http\Response
     */
    public function show(Plazoinscripcion $plazoinscripcion)
    {
        //$gestiones = Gestion::all();
        return view('plazoinscripcions.show', [
            'plazoinscripcion' => $plazoinscripcion, //'plazoinscripcions' nombre de la variable que estoy pasando a la views show
            //'gestiones' => $gestiones
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plazoinscripcion  $plazoinscripcion
     * @return \Illuminate\Http\Response
     */
    public function edit(Plazoinscripcion $plazoinscripcion)
    {
        $gestiones = Gestion::all();
        return view('plazoinscripcions.edit', [
            'plazoinscripcion' => $plazoinscripcion,
            'gestiones' => $gestiones
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plazoinscripcion  $plazoinscripcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plazoinscripcion $plazoinscripcion)
    {
        //Validaciones
        $request->validate([
            'gestion_id' => ['required', 'numeric'],
            'fecha_inicio' => ['required', 'max:255'],
            'fecha_limite' => ['required', 'max:255']
        ]);
        $plazoinscripcion->update($request->all());
        return redirect()->route('plazoinscripcions.index')
            ->with('success', 'Plaza Inscripciones actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plazoinscripcion  $plazoinscripcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plazoinscripcion $plazoinscripcion)
    {
        if ($plazoinscripcion->estado == 1) {
            return redirect()->route('plazoinscripcions.index')
                ->with('error', 'No se puede eliminar el Plazo de Inscripción porque está activo');
        }
        $plazoinscripcion->delete();

        return redirect()->route('plazoinscripcions.index')
            ->with('success', 'Plazo de Inscripción eliminado satisfactoriamente');
    }
    public function actualizarEstado($plazo_inscripcion_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            Plazoinscripcion::whereId($plazo_inscripcion_id)->update(['estado' => $estado]);

            DB::commit();
            return redirect()->route('plazoinscripcions.index')->with('success', 'Estado Verificación del plazo actualizado correctamente!');
        } catch (\Throwable $th) {

            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    //
}
