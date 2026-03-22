<?php

namespace App\Observers;

use App\Models\Localidad;
use App\Models\Bitacora;

class LocalidadObserver
{
    /**
     * Handle the Localidad "created" event.
     *
     * @param  \App\Models\Localidad  $localidad
     * @return void
     */
    public function created(Localidad $localidad)
    {
        //
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró el localidad: ' . json_encode($localidad),
            'tabla' => 'localidads'
        ]);
    }

    /**
     * Handle the Localidad "updated" event.
     *
     * @param  \App\Models\Localidad  $localidad
     * @return void
     */
    public function updated(Localidad $localidad)
    {
        //
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó la localidad ' . json_encode($localidad->getChanges()),
            'tabla' => 'localidads'
        ]);
    }

    /**
     * Handle the Localidad "deleted" event.
     *
     * @param  \App\Models\Localidad  $localidad
     * @return void
     */
    public function deleted(Localidad $localidad)
    {
        //
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó la localidad ' . json_encode($localidad),
            'tabla' => 'localidads'
        ]);
    }

    /**
     * Handle the Localidad "restored" event.
     *
     * @param  \App\Models\Localidad  $localidad
     * @return void
     */
    public function restored(Localidad $localidad)
    {
        //
    }

    /**
     * Handle the Localidad "force deleted" event.
     *
     * @param  \App\Models\Localidad  $localidad
     * @return void
     */
    public function forceDeleted(Localidad $localidad)
    {
        //
    }
}
