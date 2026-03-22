<?php

namespace App\Observers;

use App\Models\Departamento;
use App\Models\Bitacora;

class DepartamentoObserver
{
    /**
     * Handle the Departamento "created" event.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return void
     */
    public function created(Departamento $departamento)
    {
        //
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró el departamento: ' . json_encode($departamento),
            'tabla' => 'departamentos'
        ]);
    }

    /**
     * Handle the Departamento "updated" event.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return void
     */
    public function updated(Departamento $departamento)
    {
        //
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó el departamento ' . json_encode($departamento->getChanges()),
            'tabla' => 'departamentos'
        ]);
    }

    /**
     * Handle the Departamento "deleted" event.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return void
     */
    public function deleted(Departamento $departamento)
    {
        //
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó el departamento ' . json_encode($departamento),
            'tabla' => 'departamentos'
        ]);
    }

    /**
     * Handle the Departamento "restored" event.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return void
     */
    public function restored(Departamento $departamento)
    {
        //
    }

    /**
     * Handle the Departamento "force deleted" event.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return void
     */
    public function forceDeleted(Departamento $departamento)
    {
        //
    }
}
