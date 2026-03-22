<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::all();
        return view('empresas.index', [
            'empresas' => $empresas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->file('image1')) {

            $logoImage1 = $request->file('image1');
            $nombre_image1 = $logoImage1->getClientOriginalName();
            $logoImage1->move(public_path() . '/images/', $nombre_image1);
        }
        if ($request->file('image2')) {

            $logoImage2 = $request->file('image2');
            $nombre_image2 = $logoImage2->getClientOriginalName();
            $logoImage2->move(public_path() . '/images/', $nombre_image2);

        }

        Empresa::create([
            'fecha_registro' => now(),
            'image1' => $nombre_image1 ?? null,
            'image2' => $nombre_image2 ?? null,
        ] + $request->all());

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresa  $docente
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        return view('empresas.show', [
            'empresa' => $empresa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empresa  $docente
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        return view('empresas.edit', [
            'empresa' => $empresa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresa  $docente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        //  dd($request->all());
        $request->validate([
            'nombre' => ['required', 'max:255'],
            'nit' => ['required', 'max:255'],
            'direccion' => ['required', 'max:255'],
            'telefono' => ['required', 'max:255'],
            'imagen1' => ['required', 'max:255'],
            'imagen2' => ['required', 'max:255'],
        ]);
        $empresa->update($request->all());

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresa  $docente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        if ($empresa->estado == 1) {
            return redirect()->route('empresas.index')
                ->with('error', 'No se puede eliminar la empresa porque está activo');
        }
        $empresa->delete();

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa eliminado satisfactoriamente');
    }
    public function actualizarEstado($empresa_id, $estado)
    {
        try {
            DB::beginTransaction();

            // Update Status
            Empresa::whereId($empresa_id)->update(['estado' => $estado]);

            DB::commit();
            return redirect()->route('empresas.index')->with('success', 'Estado de la Empresa actualizado correctamente!');
        } catch (\Throwable $th) {

            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
