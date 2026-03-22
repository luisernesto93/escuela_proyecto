<?php

namespace App\Http\Controllers;

use App\Models\Gestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gestions = Gestion::paginate(5);
        return view('gestions.index', [ 'gestions' => $gestions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gestions.create');
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
            'descripcion' => ['required', 'max: 255'],
            'anio' => ['required', 'max: 255']
        ]);
        Gestion::create($request->all());
        return redirect()->route('gestions.index')
            ->with('success', 'Gestión creada satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function show(Gestion $gestion)
    {
        return view('gestions.show', [
            'gestion' => $gestion
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function edit(Gestion $gestion)
    {
        return view('gestions.edit', [
            'gestion' => $gestion
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gestion $gestion)
    {
        //Validaciones
        $request->validate([
            'descripcion' => ['required', 'max:255'],
            'anio' => ['required', 'max:255']
        ]);
        $gestion->update($request->all());
        return redirect()->route('gestions.index')
            ->with('success', 'Gestión actualizada satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gestion $gestion)
    {
        if ($gestion->estado == 1) {
            return redirect()->route('gestions.index')
                ->with('error', 'No se puede eliminar una gestión activa');
        }
        $gestion->delete();
        return redirect()->route('gestions.index')
            ->with('success', 'Gestión eliminada satisfactoriamente');
    }
    public function actualizarEstado($gestion_id, $estado)
    {
        try {
            DB::beginTransaction();

            // Update Status
            Gestion::whereId($gestion_id)->update(['estado' => $estado]);

            DB::commit();
            return redirect()->route('gestions.index')->with('success', 'Estado de la Gestión actualizado correctamente!');
        } catch (\Throwable $th) {

            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    //
}
