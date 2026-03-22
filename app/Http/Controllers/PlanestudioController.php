<?php

namespace App\Http\Controllers;

use App\Models\Planestudio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Resolucion;

class PlanestudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plan_estudios = Planestudio::paginate(11);
        //$departamentos = Departamento::all();
        return view('plan_estudios.index', [
            'plan_estudios' => $plan_estudios,
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
        $resoluciones = Resolucion::where('estado', 1)->get();
        return view('plan_estudios.create', [
            'resoluciones' => $resoluciones
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
        Planestudio::create($request->all());
        return redirect()->route('plan_estudios.index')
        ->with('success', 'Plan de Estudio creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Planestudio  $planestudio
     * @return \Illuminate\Http\Response
     */
    public function show(Planestudio $plan_estudio)
    {
        return view('plan_estudios.show', [
            'plan_estudio' => $plan_estudio,
            //'departamentos' => $departamentos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Planestudio  $planestudio
     * @return \Illuminate\Http\Response
     */
    public function edit(Planestudio $plan_estudio)
    {
        //
        $resoluciones = Resolucion::where('estado', 1)->get();
        return view('plan_estudios.edit', [
            'plan_estudio' => $plan_estudio,
            'resoluciones' => $resoluciones
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planestudio  $planestudio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planestudio $plan_estudio)
    {
        //
        $plan_estudio->update($request->all());
        return redirect()->route('plan_estudios.index')
        ->with('success', 'Plan de Estudio actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Planestudio  $planestudio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Planestudio $plan_estudio)
    {
        //
        if ($plan_estudio->estado == 1) {
            return redirect()->route('plan_estudios.index')
            ->with('error', 'No se puede eliminar el Plan de Estudios porque está activo');
        }
        $plan_estudio->delete();

        return redirect()->route('plan_estudios.index')
        ->with('success', 'Plan de Estudio eliminado satisfactoriamente');
    }
    public function actualizarEstado($plan_estudios_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            Planestudio::whereId($plan_estudios_id)->update(['estado' => $estado]);
            DB::commit();
            return redirect()->route('plan_estudios.index')->with('success', 'Estado del Plan de Estudio actualizado correctamente!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
