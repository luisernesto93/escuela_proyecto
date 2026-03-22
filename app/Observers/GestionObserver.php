<?php

namespace App\Observers;

use App\Models\Gestion;
use App\Models\Bitacora;

class GestionObserver
{
    /**
     * Handle the Gestion "created" event.
     *
     * @param  \App\Models\Gestion  $gestion
     * @return void
     */
    public function created(Gestion $gestion)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró la gestión: ' . json_encode($gestion),
            'tabla' => 'gestions'
        ]);
    }

    /**
     * Handle the Gestion "updated" event.
     *
     * @param  \App\Models\Gestion  $gestion
     * @return void
     */
    public function updated(Gestion $gestion)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó la gestión: ' . json_encode($gestion->getChanges()),
            'tabla' => 'gestions'
        ]);
    }

    /**
     * Handle the Gestion "deleted" event.
     *
     * @param  \App\Models\Gestion  $gestion
     * @return void
     */
    public function deleted(Gestion $gestion)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó la gestión: ' . json_encode($gestion),
            'tabla' => 'gestions'
        ]);
    }

    /**
     * Handle the Gestion "restored" event.
     *
     * @param  \App\Models\Gestion  $gestion
     * @return void
     */
    public function restored(Gestion $gestion)
    {
        //
    }

    /**
     * Handle the Gestion "force deleted" event.
     *
     * @param  \App\Models\Gestion  $gestion
     * @return void
     */
    public function forceDeleted(Gestion $gestion)
    {
        //
    }
}
