<?php

namespace App\Http\Controllers;

use App\Models\Facultad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class FacultadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facultads = Facultad::paginate(10);
        return view('facultads.index', [
            'facultads' => $facultads
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
        return view('facultads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'descripcion' => ['required', 'max:255'],
        // ]);
        Facultad::create($request->all());
        return redirect()->route('facultads.index')
        ->with('success', 'Facultad creada satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function show(Facultad $facultad)
    {
        return view('facultads.show', [
            'facultad' => $facultad
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function edit(Facultad $facultad)
    {
        //
        return view('facultads.edit', [
            'facultad' => $facultad
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facultad $facultad)
    {
        //
        $request->validate([
            'descripcion' => ['required', 'max:255'],
        ]);
        $facultad->update($request->all());
        return redirect()->route('facultads.index')
        ->with('success', 'Fcaultad actualizada satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facultad $facultad)
    {
        //
        if ($facultad->estado == 1) {
            return redirect()->route('facultads.index')
            ->with('error', 'No se puede eliminar la Facultad porque está activa');
        }
        $facultad->delete();

        return redirect()->route('facultads.index')
        ->with('success', 'Facultad eliminada satisfactoriamente');
    }
    public function actualizarEstado($facultad_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            Facultad::whereId($facultad_id)->update(['estado' => $estado]);
            DB::commit();
            return redirect()->route('facultads.index')->with('success', 'Estado de la Facultad actualizada correctamente!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
