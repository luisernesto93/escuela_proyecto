<?php

namespace App\Observers;

use App\Models\Pais;
use App\Models\Bitacora;

class PaisObserver
{
    /**
     * Handle the Pais "created" event.
     *
     * @param  \App\Models\Pais  $pais
     * @return void
     */
    public function created(Pais $pais)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró el país: ' . json_encode($pais),
            'tabla' => 'pais'
        ]);
    }

    /**
     * Handle the Pais "updated" event.
     *
     * @param  \App\Models\Pais  $pais
     * @return void
     */
    public function updated(Pais $pais)
    {
        //
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó el país ' . json_encode($pais->getChanges()),
            'tabla' => 'pais'
        ]);
    }

    /**
     * Handle the Pais "deleted" event.
     *
     * @param  \App\Models\Pais  $pais
     * @return void
     */
    public function deleted(Pais $pais)
    {
        //
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó el pais ' . json_encode($pais),
            'tabla' => 'pais'
        ]);
    }

    /**
     * Handle the Pais "restored" event.
     *
     * @param  \App\Models\Pais  $pais
     * @return void
     */
    public function restored(Pais $pais)
    {
        //
    }

    /**
     * Handle the Pais "force deleted" event.
     *
     * @param  \App\Models\Pais  $pais
     * @return void
     */
    public function forceDeleted(Pais $pais)
    {
        //
    }
}
