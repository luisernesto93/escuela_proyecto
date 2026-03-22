<?php

namespace App\Observers;

use App\Models\ExpedicionCi;
use App\Models\Bitacora;

class ExpedicionCiObserver
{
    /**
     * Handle the ExpedicionCi "created" event.
     *
     * @param  \App\Models\ExpedicionCi  $expedicionCi
     * @return void
     */
    public function created(ExpedicionCi $expedicionCi)
    {
        //
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró la expedición de CI: ' . json_encode($expedicionCi),
            'tabla' => 'expedicion_cis',
        ]);
    }

    /**
     * Handle the ExpedicionCi "updated" event.
     *
     * @param  \App\Models\ExpedicionCi  $expedicionCi
     * @return void
     */
    public function updated(ExpedicionCi $expedicionCi)
    {
        //
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó la expedición de CI ' . json_encode($expedicionCi->getChanges()),
            'tabla' => 'expedicion_cis'
        ]);
    }

    /**
     * Handle the ExpedicionCi "deleted" event.
     *
     * @param  \App\Models\ExpedicionCi  $expedicionCi
     * @return void
     */
    public function deleted(ExpedicionCi $expedicionCi)
    {
        //
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó la expedición de CI ' . json_encode($expedicionCi),
            'tabla' => 'expedicion_cis'
        ]);
    }

    /**
     * Handle the ExpedicionCi "restored" event.
     *
     * @param  \App\Models\ExpedicionCi  $expedicionCi
     * @return void
     */
    public function restored(ExpedicionCi $expedicionCi)
    {
        //
    }

    /**
     * Handle the ExpedicionCi "force deleted" event.
     *
     * @param  \App\Models\ExpedicionCi  $expedicionCi
     * @return void
     */
    public function forceDeleted(ExpedicionCi $expedicionCi)
    {
        //
    }
}
