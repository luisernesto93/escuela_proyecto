<?php

namespace App\Http\Controllers;

use App\Models\Beca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BecaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $becas = Beca::all();
        return view('becas.index', [ 'becas' => $becas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('becas.create');
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
            'descripcion' => ['required','max:255'],
            'porcentaje' => ['required','max:255'],
        ]);
        Beca::create($request->all());
        return redirect()->route('becas.index')
            ->with('success', 'Beca creada satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Beca  $beca
     * @return \Illuminate\Http\Response
     */
    public function show(Beca $beca)
    {
        return view('becas.show', [
            'beca' => $beca
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Beca  $beca
     * @return \Illuminate\Http\Response
     */
    public function edit(Beca $beca)
    {
        return view('becas.edit', [
            'beca' => $beca
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Beca  $beca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beca $beca)
    {
        //Validaciones
        $request->validate([
            'descripcion' => ['required','max:255'],
            'porcentaje' => ['required','max:255'],
        ]);
        $beca->update($request->all());

        return redirect()->route('becas.index')
            ->with('success', 'Beca actualizada satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Beca  $beca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beca $beca)
    {
        if ($beca->estado == 1) {
            return redirect()->route('becas.index')
                ->with('error', 'No se puede eliminar una beca activa');
        }
        $beca->delete();
        return redirect()->route('becas.index')
            ->with('success', 'Beca eliminada satisfactoriamente');
    }

    public function actualizarEstado($beca_id, $estado)
    {
        try {
            DB::beginTransaction();

            // Update Status
            Beca::whereId($beca_id)->update(['estado' => $estado]);

            DB::commit();
            return redirect()->route('becas.index')->with('success', 'Estado de la beca actualizado correctamente!');
        } catch (\Throwable $th) {

            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
