<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Facultad;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carreras = Carrera::paginate(10);//Modelo
        return view('carreras.index', ['carreras'=>$carreras]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   //
        $facultades = Facultad::where('estado', 1)->get();
        return view('carreras.create',[
                'facultades' => $facultades
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
        //
        Carrera::create($request->all());
        return redirect()->route('carreras.index')->with('success','Carrera creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function show(Carrera $carrera)
    {   //
        return view('carreras.show', ['carrera'=>$carrera]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function edit(Carrera $carrera)
    {   //
        $facultades = Facultad::where('estado', 1)->get();
        return view('carreras.edit', [
            'carrera'=>$carrera,
            'facultades'=>$facultades
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carrera $carrera)
    {    //
        $carrera->update($request->all());
        return redirect()->route('carreras.index')->with('success','Carrera atualizada correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carrera $carrera)
    {
        if ($carrera->estado == 1) {
            return redirect()->route('carreras.index')
                ->with('error', 'No se puede eliminar una carrera activa');
        }
        $carrera->delete();
        return redirect()->route('carreras.index')
            ->with('success', 'Carrera eliminada satisfactoriamente');
    }
    public function actualizarEstado($carrera_id, $estado){
        Carrera::whereId($carrera_id)->update( ['estado'=>$estado] );
        return redirect()-> route('carreras.index')->with('success','Estado de carrera actualizado!');
    }
}
