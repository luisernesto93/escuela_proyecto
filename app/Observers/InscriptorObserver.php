<?php

namespace App\Observers;

use App\Models\Inscriptor;
use App\Models\Bitacora;

class InscriptorObserver
{
    /**
     * Handle the Inscriptor "created" event.
     *
     * @param  \App\Models\Inscriptor  $inscriptor
     * @return void
     */
    public function created(Inscriptor $inscriptor)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró inscriptor: ' . json_encode($inscriptor),
            'tabla' => 'inscriptors'
        ]);
    }

    /**
     * Handle the Inscriptor "updated" event.
     *
     * @param  \App\Models\Inscriptor  $inscriptor
     * @return void
     */
    public function updated(Inscriptor $inscriptor)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó inscriptor: ' . json_encode($inscriptor->getChanges()),
            'tabla' => 'inscriptors'
        ]);
    }

    /**
     * Handle the Inscriptor "deleted" event.
     *
     * @param  \App\Models\Inscriptor  $inscriptor
     * @return void
     */
    public function deleted(Inscriptor $inscriptor)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó inscriptor: ' . json_encode($inscriptor),
            'tabla' => 'inscriptors'
        ]);
    }

    /**
     * Handle the Inscriptor "restored" event.
     *
     * @param  \App\Models\Inscriptor  $inscriptor
     * @return void
     */
    public function restored(Inscriptor $inscriptor)
    {
        //
    }

    /**
     * Handle the Inscriptor "force deleted" event.
     *
     * @param  \App\Models\Inscriptor  $inscriptor
     * @return void
     */
    public function forceDeleted(Inscriptor $inscriptor)
    {
        //
    }
}
