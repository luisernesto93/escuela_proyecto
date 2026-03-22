<?php

namespace App\Observers;

use App\Models\Inscripcion;
use App\Models\Bitacora;

class InscripcionObserver
{
    /**
     * Handle the Inscripcion "created" event.
     *
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return void
     */
    public function created(Inscripcion $inscripcion)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró la inscripción: ' . json_encode($inscripcion),
            'tabla' => 'inscripcions'
        ]);
    }

    /**
     * Handle the Inscripcion "updated" event.
     *
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return void
     */
    public function updated(Inscripcion $inscripcion)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó la inscripción: ' . json_encode($inscripcion->getChanges()),
            'tabla' => 'inscripcions'
        ]);
    }

    /**
     * Handle the Inscripcion "deleted" event.
     *
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return void
     */
    public function deleted(Inscripcion $inscripcion)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó la inscripción: ' . json_encode($inscripcion),
            'tabla' => 'inscripcions'
        ]);
    }

    /**
     * Handle the Inscripcion "restored" event.
     *
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return void
     */
    public function restored(Inscripcion $inscripcion)
    {
        //
    }

    /**
     * Handle the Inscripcion "force deleted" event.
     *
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return void
     */
    public function forceDeleted(Inscripcion $inscripcion)
    {
        //
    }
}
