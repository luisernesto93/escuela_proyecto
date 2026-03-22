<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $generos = Genero::paginate(10);
        return view('generos.index', [
            'generos' => $generos
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
        return view('generos.create');
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
            'genero' => ['required', 'max:255'],
            'sigla' => ['required', 'max:255']
        ]);
        Genero::create($request->all());
        return redirect()->route('generos.index')
            ->with('success', 'Género creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Http\Response
     */
    public function show(Genero $genero)
    {
        //
        return view('generos.show', [
            'genero'=>$genero
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Http\Response
     */
    public function edit(Genero $genero)
    {
        //
        return view('generos.edit', [
            'genero' => $genero
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genero $genero)
    {
        //Validaciones
        $request->validate([
            'genero' => ['required', 'max:255'],
            'sigla' => ['required', 'max:255']
        ]);
        $genero->update($request->all());
        return redirect()->route('generos.index')
            ->with('success', 'Género actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genero $genero)
    {
        //
        if ($genero->estado == 1) {
            return redirect()->route('generos.index')
                ->with('error', 'No se puede eliminar el Género porque está activo');
        }
        $genero->delete();

        return redirect()->route('generos.index')
            ->with('success', 'Género eliminado satisfactoriamente');
    }
    public function actualizarEstado($genero_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            Genero::whereId($genero_id)->update(['estado' => $estado]);
            DB::commit();
            return redirect()->route('generos.index')->with('success', 'Estado del Género actualizado correctamente!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
