<?php

namespace App\Observers;

use App\Models\Provincia;
use App\Models\Bitacora;

class ProvinciaObserver
{
    /**
     * Handle the Provincia "created" event.
     *
     * @param  \App\Models\Provincia  $provincia
     * @return void
     */
    public function created(Provincia $provincia)
    {
        //
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró el provi$provincia: ' . json_encode($provincia),
            'tabla' => 'provincias'
        ]);
    }

    /**
     * Handle the Provincia "updated" event.
     *
     * @param  \App\Models\Provincia  $provincia
     * @return void
     */
    public function updated(Provincia $provincia)
    {
        //
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó la provincia ' . json_encode($provincia->getChanges()),
            'tabla' => 'provincias'
        ]);
    }

    /**
     * Handle the Provincia "deleted" event.
     *
     * @param  \App\Models\Provincia  $provincia
     * @return void
     */
    public function deleted(Provincia $provincia)
    {
        //
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó la provincia ' . json_encode($provincia),
            'tabla' => 'provincias'
        ]);
    }

    /**
     * Handle the Provincia "restored" event.
     *
     * @param  \App\Models\Provincia  $provincia
     * @return void
     */
    public function restored(Provincia $provincia)
    {
        //
    }

    /**
     * Handle the Provincia "force deleted" event.
     *
     * @param  \App\Models\Provincia  $provincia
     * @return void
     */
    public function forceDeleted(Provincia $provincia)
    {
        //
    }
}
