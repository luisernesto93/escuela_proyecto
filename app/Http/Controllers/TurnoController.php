<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $turnos = Turno::all();

        return view('turnos.index', [
            'turnos' => $turnos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('turnos.create');
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
            'descripcion' => ['required','max:255']
        ]);
        Turno::create($request->all());
        return redirect()->route('turnos.index')
            ->with('success', 'Turno creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function show(Turno $turno)
    {
        return view('turnos.show', [
            'turno' => $turno
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function edit(Turno $turno)
    {
        return view('turnos.edit', [
            'turno' => $turno
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Turno $turno)
    {
        //Validaciones
        $request->validate([
            'descripcion' => ['required','max:255']
        ]);
        $turno->update($request->all());
        return redirect()->route('turnos.index')
            ->with('success', 'Turno actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Turno $turno)
    {
        //
        if ($turno->estado == 1) {
            return redirect()->route('turnos.index')
                ->with('error', 'No se puede eliminar un turno activo');
        }
        $turno->delete();

        return redirect()->route('turnos.index')
            ->with('success', 'Turno eliminado satisfactoriamente');
    }
    public function actualizarEstado($turno_id, $estado)
    {
        try {
            DB::beginTransaction();

            // Update Status
            Turno::whereId($turno_id)->update(['estado' => $estado]);

            DB::commit();
            return redirect()->route('turnos.index')->with('success', 'Turno del estudiante actualizado correctamente!');
        } catch (\Throwable $th) {

            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
