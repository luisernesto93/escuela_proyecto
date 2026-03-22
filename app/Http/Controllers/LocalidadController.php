<?php

namespace App\Http\Controllers;

//use App\Models\Departamento;
use App\Models\Localidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Provincia;


class LocalidadController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $localidades = Localidad::paginate(11);
        //$provincias = Provincia::all();
        return view('localidades.index', [
            'localidades' => $localidades,
            //'provincias' => $provincias
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provincias = Provincia::where('estado', 1)->get();
        return view('localidades.create', [
            'provincias' => $provincias
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
            'provincia_id' => ['required','numeric'],
        ]);
        Localidad::create($request->all());
        return redirect()->route('localidades.index')
            ->with('success', 'Localidad creada satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Localidad  $localidad
     * @return \Illuminate\Http\Response
     */
    public function show(Localidad $localidade)
    {
        //$provincias = Provincia::where('estado', 1)->get();
        return view('localidades.show', [
            'localidade' => $localidade,
            //'provincias'=>$provincias
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Localidad  $localidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Localidad $localidade)
    {
        $provincias = Provincia::where('estado', 1)->get();
        return view('localidades.edit', [
            'localidade' => $localidade,
            'provincias' => $provincias
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Localidad  $localidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Localidad $localidade)
    {
        //Validaciones
        $request->validate([
            'nombre' => ['required','max:255'],
            'provincia_id' => ['required','numeric'],
        ]);
        $localidade->update($request->all());
        return redirect()->route('localidades.index')
            ->with('success', 'Localidad actualizada satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Localidad  $localidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Localidad $localidade)
    {
        if ($localidade->estado == 1) {
            return redirect()->route('localidades.index')
                ->with('error', 'No se puede eliminar la Localidad porque está activo');
        }
        $localidade->delete();

        return redirect()->route('localidades.index')
            ->with('success', 'Localidad eliminada satisfactoriamente');
    }
    public function actualizarEstado($localidad_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            Localidad::whereId($localidad_id)->update(['estado' => $estado]);
            DB::commit();
            return redirect()->route('localidades.index')->with('success', 'Estado de la Localidad actualizada correctamente!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
