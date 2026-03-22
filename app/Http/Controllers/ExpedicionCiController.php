<?php

namespace App\Http\Controllers;

use App\Models\ExpedicionCi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpedicionCiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $expedicion_cis = ExpedicionCi::paginate(11);
        return view('expedicion_cis.index', [
            'expedicion_cis' => $expedicion_cis
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
        return view('expedicion_cis.create');
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
            'sigla' => ['required','max:255'],
            'descripcion' => ['required','max:255'],
        ]);
        ExpedicionCi::create($request->all());
        return redirect()->route('expedicion_cis.index')
            ->with('success', 'Expedición creada satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpedicionCi  $expedicionCi
     * @return \Illuminate\Http\Response
     */
    public function show(ExpedicionCi $expedicionCi)
    {
        //
        return view('expedicion_cis.show', [
            'expedicion_ci'=>$expedicionCi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpedicionCi  $expedicionCi
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpedicionCi $expedicionCi)
    {
        //
        return view('expedicion_cis.edit', [
            'expedicion_ci' => $expedicionCi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpedicionCi  $expedicionCi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpedicionCi $expedicionCi)
    {
         //Validaciones
        $request->validate([
            'sigla' => ['required','max:255'],
            'descripcion' => ['required','max:255'],
        ]);
        $expedicionCi->update($request->all());
        return redirect()->route('expedicion_cis.index')
            ->with('success', 'Expedición actualizada satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpedicionCi  $expedicionCi
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpedicionCi $expedicionCi)
    {
        //
        if ($expedicionCi->estado == 1) {
            return redirect()->route('expedicion_cis.index')
                ->with('error', 'No se puede eliminar la Expedición porque está activo');
        }
        $expedicionCi->delete();

        return redirect()->route('expedicion_cis.index')
            ->with('success', 'Expedición eliminada satisfactoriamente');
    }
    public function actualizarEstado($expedicion_ci_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            ExpedicionCi::whereId($expedicion_ci_id)->update(['estado' => $estado]);
            DB::commit();
            return redirect()->route('expedicion_cis.index')->with('success', 'Estado de la Expedición actualizada correctamente!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
