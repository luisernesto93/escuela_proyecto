<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Carrera;
use App\Models\Planestudio;
use App\Models\Prerequisito;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materias = Materia::paginate(11);
        return view('materias.index', [
            'materias' => $materias
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plan_estudios = Planestudio::where('estado', 1)->get();
        $carreras = Carrera::where('estado', 1)->get();
        return view('materias.create', [
            'plan_estudios' => $plan_estudios,
            'carreras' => $carreras,
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
            'plan_estudio_id' => ['required', 'numeric'],
            'carrera_id' => ['required', 'numeric'],
            'sigla' => ['required', 'max:255'],
            'nombre_materia' => ['required', 'max:255'],
            'horas' => ['required', 'numeric'],
            'nivel' => ['required', 'numeric'],
            'orden' => ['required', 'numeric'],
        ]);

        Materia::create($request->all());

        Prerequisito::create([
            'materia_id' => Materia::latest('id')->first()->id,
            'materia_prerequisito_id' => $request->materia_pre_requisito ?? 0,
        ]);
        return redirect()->route('materias.index')
            ->with('success', 'Materia creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function show(Materia $materia)
    {
        return view('materias.show', [
            'materia' => $materia
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function edit(Materia $materia)
    {
        $plan_estudios = Planestudio::all();
        $carreras = Carrera::all();
        return view('materias.edit', [
            'materia' => $materia,
            'plan_estudios' => $plan_estudios,
            'carreras' => $carreras
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materia $materia)
    {
        $request->validate([
            'plan_estudio_id' => ['required', 'numeric'],
            'carrera_id' => ['required', 'numeric'],
            'sigla' => ['required', 'max:255'],
            'nombre_materia' => ['required', 'max:255'],
            'horas' => ['required', 'numeric'],
            'nivel' => ['required', 'numeric'],
            'orden' => ['required', 'numeric'],
            'estado' => ['required', 'numeric'],
        ]);
        $materia->update($request->all());

        Prerequisito::where('materia_id', $materia->id)->update([
            'materia_prerequisito_id' => $request->materia_pre_requisito ?? 0,
        ]);

        return redirect()->route('materias.index')
            ->with('success', 'Materia actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materia $materia)
    {
        if ($materia->estado == 1) {
            return redirect()->route('materias.index')
                ->with('error', 'No se puede eliminar una materia activa');
        }
        $materia->delete();
        return redirect()->route('materias.index')
            ->with('success', 'Materia eliminada satisfactoriamente');
    }
    public function actualizarEstado($materia_id, $estado)
    {
        Materia::whereId($materia_id)->update(['estado' => $estado]);
        return redirect()->route('materias.index')->with('success', 'Estado de la materia actualizado!');
    }
    public function buscar_materias(Request $request)
    {
        $materias = Materia::where('carrera_id', $request->carrera_id)->get();
        return response()->json($materias);
    }
}
