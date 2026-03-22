<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paises = Pais::paginate(10);
        return view('paises.index', [
            'paises' => $paises
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paises.create');
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
        ]);
        Pais::create($request->all());
        return redirect()->route('paises.index')
            ->with('success', 'Pais creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function show(Pais $paise)
    {
        return view('paises.show', [
            'paise'=>$paise
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function edit(Pais $paise)
    {
        return view('paises.edit', [
            'paise' => $paise
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pais $paise)
    {
        //Validaciones
        $request->validate([
            'nombre' => ['required','max:255'],
        ]);
        $paise->update($request->all());
        return redirect()->route('paises.index')
            ->with('success', 'Pais actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pais $paise)
    {
        if ($paise->estado == 1) {
            return redirect()->route('paises.index')
                ->with('error', 'No se puede eliminar el Pais porque está activo');
        }
        $paise->delete();

        return redirect()->route('paises.index')
            ->with('success', 'Pais eliminado satisfactoriamente');
    }
    public function actualizarEstado($pais_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            Pais::whereId($pais_id)->update(['estado' => $estado]);
            DB::commit();
            return redirect()->route('paises.index')->with('success', 'Estado del Pais actualizado correctamente!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
