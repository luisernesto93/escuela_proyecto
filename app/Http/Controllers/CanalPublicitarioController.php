<?php

namespace App\Http\Controllers;

use App\Models\CanalPublicitario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CanalPublicitarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $canal_publicitarios = CanalPublicitario::paginate(9);
        return view('canal_publicitarios.index', [ 'canal_publicitarios' => $canal_publicitarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('canal_publicitarios.create'); //Carpeta.html
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Valildaciones
        $request->validate([
            'descripcion' => ['required', 'max:255'],
        ]);
        CanalPublicitario::create($request->all()); //Modelo es CanalPublicitario
        return redirect()->route('canal_publicitarios.index')
            ->with('success', 'Canal Publicitario creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CanalPublicitario  $canalPublicitario
     * @return \Illuminate\Http\Response
     */
    public function show(CanalPublicitario $canalPublicitario)
    {
        return view('canal_publicitarios.show', [
            'canal_publicitario' => $canalPublicitario //Esto debe coincidir con el acction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CanalPublicitario  $canalPublicitario
     * @return \Illuminate\Http\Response
     */
    public function edit(CanalPublicitario $canalPublicitario)
    {
        return view('canal_publicitarios.edit', [
            'canal_publicitario' => $canalPublicitario
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CanalPublicitario  $canalPublicitario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CanalPublicitario $canalPublicitario)
    {
        //Valildaciones
        $request->validate([
            'descripcion' => ['required', 'max:255'],
        ]);
        $canalPublicitario->update($request->all());
        return redirect()->route('canal_publicitarios.index')
            ->with('success', 'Canal Publicitario actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CanalPublicitario  $canalPublicitario
     * @return \Illuminate\Http\Response
     */
    public function destroy(CanalPublicitario $canalPublicitario)
    {
        if ($canalPublicitario->estado == 1) {
            return redirect()->route('canal_publicitarios.index')
                ->with('error', 'No se puede eliminar un canal publicitario activo');
        }
        $canalPublicitario->delete();
        return redirect()->route('canal_publicitarios.index')
            ->with('success', 'Canal Publicitario eliminado satisfactoriamente');
    }
    public function actualizarEstado($canal_publicitario_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            CanalPublicitario::whereId($canal_publicitario_id)->update(['estado' => $estado]);

            DB::commit();
            return redirect()->route('canal_publicitarios.index')->with('success', 'Canal Publicitario del estudiante actualizado correctamente!');
        } catch (\Throwable $th) {

            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

}
