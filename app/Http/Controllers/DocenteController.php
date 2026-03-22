<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docentes = Docente::all();
        return view('docentes.index', [
            'docentes' => $docentes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('docentes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo_interno'=>['required','max:255'],
            'documento'=>['required','max:255'],
            'nombres'=>['required','max:255'],
            'apellidos'=>['required','max:255'],
            'telefono'=>['required','max:255']
        ]);
        Docente::create([
            'fecha_registro' => now(),
        ] + $request->all());

        return redirect()->route('docentes.index')
            ->with('success', 'Docente creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function show(Docente $docente)
    {
        return view('docentes.show', [
            'docente' => $docente
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function edit(Docente $docente)
    {
        return view('docentes.edit', [
            'docente' => $docente
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Docente $docente)
    {
        //  dd($request->all());
        $request->validate([
            'codigo_interno'=>['required','max:255'],
            'documento'=>['required','max:255'],
            'nombres'=>['required','max:255'],
            'apellidos'=>['required','max:255'],
            'telefono'=>['required','max:255'],
            'fecha_registro'=>['required','max:255'],
        ]);
        $docente->update($request->all());

        return redirect()->route('docentes.index')
            ->with('success', 'Docente actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Docente $docente)
    {
        if ($docente->estado == 1) {
            return redirect()->route('docentes.index')
                ->with('error', 'No se puede eliminar el docente porque está activo');
        }
        $docente->delete();

        return redirect()->route('docentes.index')
            ->with('success', 'Docente eliminado satisfactoriamente');
    }
    public function actualizarEstado($docente_id, $estado)
    {
        try {
            DB::beginTransaction();

            // Update Status
            Docente::whereId($docente_id)->update(['estado' => $estado]);

            DB::commit();
            return redirect()->route('docentes.index')->with('success', 'Estado del docente actualizado correctamente!');
        } catch (\Throwable $th) {

            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
