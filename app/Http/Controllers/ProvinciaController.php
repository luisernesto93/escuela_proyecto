<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Departamento;

class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provincias = Provincia::paginate(11);
        //$departamentos = Departamento::all();
        return view('provincias.index', [
            'provincias' => $provincias,
            //'departamentos' => $departamentos
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
        $departamentos = Departamento::where('estado', 1)->get();
        return view('provincias.create', [
            'departamentos' => $departamentos
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
            'nombre' => ['required','max:255'],
            'departamento_id' => ['required','numeric'],
        ]);
        Provincia::create($request->all());
        return redirect()->route('provincias.index')
            ->with('success', 'Provincia creada satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provincia  $provincia
     * @return \Illuminate\Http\Response
     */
    public function show(Provincia $provincia)
    {
        //$departamentos = Departamento::where('estado', 1)->get();
        return view('provincias.show', [
            'provincia'=>$provincia,
            //'departamentos' => $departamentos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provincia  $provincia
     * @return \Illuminate\Http\Response
     */
    public function edit(Provincia $provincia)
    {
        $departamentos = Departamento::where('estado', 1)->get();
        return view('provincias.edit', [
            'provincia' => $provincia,
            'departamentos' => $departamentos
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provincia  $provincia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provincia $provincia)
    {
        //Validaciones
        $request->validate([
            'nombre' => ['required','max:255'],
            'departamento_id' => ['required','numeric'],
        ]);
        $provincia->update($request->all());
        return redirect()->route('provincias.index')
            ->with('success', 'Provincia actualizada satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provincia  $provincia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provincia $provincia)
    {
        if ($provincia->estado == 1) {
            return redirect()->route('provincias.index')
                ->with('error', 'No se puede eliminar la Provincia porque está activa');
        }
        $provincia->delete();

        return redirect()->route('provincias.index')
            ->with('success', 'Provincia eliminada satisfactoriamente');
    }
    public function actualizarEstado($provincia_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            Provincia::whereId($provincia_id)->update(['estado' => $estado]);
            DB::commit();
            return redirect()->route('provincias.index')->with('success', 'Estado de la Provincia actualizada correctamente!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
