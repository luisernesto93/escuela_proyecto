<?php

namespace App\Http\Controllers;

use App\Models\Resolucion;
use App\Models\Gestion;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResolucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resoluciones = Resolucion::paginate(11);
        return view('resoluciones.index', [
            'resoluciones' => $resoluciones //La clave 'resoluciones' influye es los parámetros de los métodos, menos en actualizar estado
        ]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gestiones = Gestion::where('estado', 1)->get();
        $carreras = Carrera::where('estado', 1)->get();
        return view('resoluciones.create', [
            'gestiones' => $gestiones,
            'carreras' => $carreras,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validaciones
        $request->validate([
            'numero_resolucion' => ['required', 'max:255'],
            'gestion_id' => ['required', 'numeric'],
            'carrera_id' => ['required', 'numeric']
        ]);

        Resolucion::create($request->all());
        return redirect()->route('resoluciones.index')
            ->with('success', 'Resolucion creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resolucion  $resolucion
     * @return \Illuminate\Http\Response
     */
    public function show(Resolucion $resolucione)
    {
        return view('resoluciones.show', [
            'resolucion' => $resolucione
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resolucion  $resolucion
     * @return \Illuminate\Http\Response
     */
    public function edit(Resolucion $resolucione)
    {
        $gestiones = Gestion::where('estado', 1)->get();
        $carreras = Carrera::where('estado', 1)->get();
        return view('resoluciones.edit', [
            'resolucion' => $resolucione,
            'gestiones' => $gestiones,
            'carreras' => $carreras
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resolucion  $resolucion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resolucion $resolucione) //Debe escribirse en singular de la clave enviada en el method index
    {
        $request->validate([
            'numero_resolucion' => ['required', 'max:255'],
            'gestion_id' => ['required', 'numeric'],
            'carrera_id' => ['required', 'numeric'],
        ]);
        $resolucione->update($request->all());

        return redirect()->route('resoluciones.index')
            ->with('success', 'Resolucion actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resolucion  $resolucion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resolucion $resolucione) //Variable que va en la clave del modadl
    {
        if ($resolucione->estado == 1) {
            return redirect()->route('resoluciones.index')
                ->with('error', 'No se puede eliminar una Resolucion activo');
        }
        $resolucione->delete();
        return redirect()->route('resoluciones.index')
            ->with('success', 'Resolucion eliminado satisfactoriamente');
    }
    public function actualizarEstado($resolucion_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            Resolucion::whereId($resolucion_id)->update(['estado' => $estado]);
            DB::commit();
            return redirect()->route('resoluciones.index')->with('success', 'Estado de la Resolucion actualizado correctamente!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
