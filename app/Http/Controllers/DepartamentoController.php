<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pais;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamento::all();
        //$paises = Pais::all();
        return view('departamentos.index', [
            'departamentos' => $departamentos,
            //'paises' => $paises
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises = Pais::where('estado', 1)->get();
        return view('departamentos.create', [
            'paises' => $paises
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
            'pais_id' => ['required','numeric'],
        ]);
        Departamento::create($request->all());
        return redirect()->route('departamentos.index')
            ->with('success', 'Departamento creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show(Departamento $departamento)
    {
        //$paises = Pais::where('estado', 1)->get();
        return view('departamentos.show', [
            'departamento' => $departamento,
            //'paises'=>$paises
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Departamento $departamento)
    {
        $paises = Pais::where('estado', 1)->get();
        return view('departamentos.edit', [
            'departamento' => $departamento,
            'paises' => $paises
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departamento $departamento)
    {
        //Validaciones
        $request->validate([
            'nombre' => ['required','max:255'],
            'pais_id' => ['required','numeric'],
        ]);
        $departamento->update($request->all());
        return redirect()->route('departamentos.index')
            ->with('success', 'Departamento actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamento $departamento)
    {
        if ($departamento->estado == 1) {
            return redirect()->route('departamentos.index')
                ->with('error', 'No se puede eliminar el departamento porque está activo');
        }
        $departamento->delete();

        return redirect()->route('departamentos.index')
            ->with('success', 'Departamento eliminado satisfactoriamente');
    }
    public function actualizarEstado($departamento_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            Departamento::whereId($departamento_id)->update(['estado' => $estado]);
            DB::commit();
            return redirect()->route('departamentos.index')->with('success', 'Estado del Departamento actualizado correctamente!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
