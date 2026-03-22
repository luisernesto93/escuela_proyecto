<?php

namespace App\Http\Controllers;

use App\Models\Gestion;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libros = Libro::paginate(11);
        //$gestiones = Gestion::all();
        return view('libros.index', [
            'libros' => $libros,
            //'gestiones' => $gestiones
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gestiones = Gestion::where('estado', 1)->get();
        return view('libros.create', [
            'gestiones' => $gestiones
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
        $request->validate([
            'nro_libro' => ['required', 'numeric'],
            'gestion_id' => ['required', 'numeric'],
        ]);
        Libro::create($request->all());
        return redirect()->route('libros.index')
        ->with('success', 'Libro creada satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show(Libro $libro)
    {
        //
        return view('libros.show', [
            'libro' => $libro,
            //'gestiones' => $gestiones
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit(Libro $libro)
    {
        //
        $gestiones = Gestion::where('estado', 1)->get();
        return view('libros.edit', [
            'libro' => $libro,
            'gestiones' => $gestiones
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libro $libro)
    {
        //
        $request->validate([
            'nro_libro' => ['required', 'numeric'],
            'gestion_id' => ['required', 'numeric'],
        ]);
        $libro->update($request->all());
        return redirect()->route('libros.index')
        ->with('success', 'Libro actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Libro $libro)
    {
        if ($libro->estado == 1) {
            return redirect()->route('libros.index')
            ->with('error', 'No se puede eliminar la Libro porque está activo');
        }
        $libro->delete();

        return redirect()->route('libros.index')
        ->with('success', 'Libro eliminado satisfactoriamente');
    }
    public function actualizarEstado($gestion_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            Libro::whereId($gestion_id)->update(['estado' => $estado]);
            DB::commit();
            return redirect()->route('libros.index')->with('success', 'Estado del Libro actualizado correctamente!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
