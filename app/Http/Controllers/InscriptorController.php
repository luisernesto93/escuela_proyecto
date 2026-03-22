<?php

namespace App\Http\Controllers;

use App\Models\Inscriptor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InscriptorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inscriptors = Inscriptor::paginate(10);
        return view('inscriptors.index', [ 'inscriptors' => $inscriptors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inscriptors.create');
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
            'name' => ['required', 'max:255'],
        ]);
        Inscriptor::create($request->all());
        return redirect()->route('inscriptors.index')
            ->with('success', 'Inscriptor creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inscriptor  $inscriptor
     * @return \Illuminate\Http\Response
     */
    public function show(Inscriptor $inscriptor)
    {
        return view('inscriptors.show', [
            'inscriptor' => $inscriptor
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inscriptor  $inscriptor
     * @return \Illuminate\Http\Response
     */
    public function edit(Inscriptor $inscriptor)
    {
        return view('inscriptors.edit', [
            'inscriptor' => $inscriptor
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inscriptor  $inscriptor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inscriptor $inscriptor)
    {
        //Valildaciones
        $request->validate([
            'name' => ['required', 'max:255'],
        ]);
        $inscriptor->update($request->all());
        return redirect()->route('inscriptors.index')
            ->with('success', 'Inscriptor actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inscriptor  $inscriptor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inscriptor $inscriptor)
    {
        if ($inscriptor->estado == 1) {
            return redirect()->route('inscriptors.index')
                ->with('error', 'No se puede eliminar una inscriptor activo');
        }
        $inscriptor->delete();
        return redirect()->route('inscriptors.index')
            ->with('success', 'Inscriptor eliminado satisfactoriamente');
    }
    public function actualizarEstado($inscriptor_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            Inscriptor::whereId($inscriptor_id)->update(['estado' => $estado]);

            DB::commit();
            return redirect()->route('inscriptors.index')->with('success', 'Estado del inscriptor actualizado correctamente!');
        } catch (\Throwable $th) {

            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
