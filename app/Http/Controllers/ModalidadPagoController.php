<?php

namespace App\Http\Controllers;

use App\Models\ModalidadPago;
use Illuminate\Http\Request;
use App\Models\Gestion;
use Illuminate\Support\Facades\DB;

class ModalidadPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modalidadpagos = ModalidadPago::all();
        //$gestiones = Gestion::all();
        return view('modalidadpagos.index', [
            'modalidadpagos' => $modalidadpagos,
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
        return view('modalidadpagos.create', [
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
        //Validaciones
        $request->validate([
            'gestion_id' => ['required', 'numeric'],
            'descripcion' => ['required', 'max:255'],
            'monto_pagar' => ['required', 'max:255'],
        ]);
        ModalidadPago::create($request->all());
        return redirect()->route('modalidadpagos.index')
            ->with('success', 'Modalidad de Pago creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModalidadPago  $modalidadPago
     * @return \Illuminate\Http\Response
     */
    public function show(ModalidadPago $modalidadpago)
    {
        //$gestiones = Gestion::where('estado', 1)->get();
        return view('modalidadpagos.show', [
            'modalidadpago' => $modalidadpago,
            //'gestiones'=>$gestiones
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ModalidadPago  $modalidadPago
     * @return \Illuminate\Http\Response
     */
    public function edit(ModalidadPago $modalidadpago)
    {
        $gestiones = Gestion::where('estado', 1)->get();
        return view('modalidadpagos.edit', [
            'modalidadpago' => $modalidadpago,
            'gestiones' => $gestiones
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ModalidadPago  $modalidadPago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModalidadPago $modalidadpago)
    {
        //Validaciones
        $request->validate([
            'gestion_id' => ['required', 'numeric'],
            'descripcion' => ['required', 'max:255'],
            'monto_pagar' => ['required', 'max:255'],
        ]);
        $modalidadpago->update($request->all());
        return redirect()->route('modalidadpagos.index')
            ->with('success', 'Modalidad de Pagos actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModalidadPago  $modalidadPago
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModalidadPago $modalidadpago)
    {
        if ($modalidadpago->estado == 1) {
            return redirect()->route('modalidadpagos.index')
                ->with('error', 'No se puede eliminar la Modalidad porque está activo');
        }
        $modalidadpago->delete();

        return redirect()->route('modalidadpagos.index')
            ->with('success', 'Modalidad de Pagos eliminado satisfactoriamente');
    }

    public function actualizarEstado($modalidadpago_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            ModalidadPago::whereId($modalidadpago_id)->update(['estado' => $estado]);
            DB::commit();
            return redirect()->route('modalidadpagos.index')->with('success', 'Estado de la Modalidad actualizado correctamente!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
