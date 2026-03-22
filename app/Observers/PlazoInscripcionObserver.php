<?php

namespace App\Observers;

use App\Models\Plazoinscripcion;
use App\Models\Bitacora;

class PlazoInscripcionObserver
{
    /**
     * Handle the PlazoInscripcion "created" event.
     *
     * @param  \App\Models\PlazoInscripcion  $plazoInscripcion
     * @return void
     */
    public function created(Plazoinscripcion $plazoInscripcion)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró el plazo de inscripción: ' . json_encode($plazoInscripcion),
            'tabla' => 'plazoinscripcions'
        ]);
    }

    /**
     * Handle the PlazoInscripcion "updated" event.
     *
     * @param  \App\Models\PlazoInscripcion  $plazoInscripcion
     * @return void
     */
    public function updated(Plazoinscripcion $plazoInscripcion)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó el plazo de inscripción: ' . json_encode($plazoInscripcion->getChanges()),
            'tabla' => 'plazoinscripcions'
        ]);
    }

    /**
     * Handle the PlazoInscripcion "deleted" event.
     *
     * @param  \App\Models\PlazoInscripcion  $plazoInscripcion
     * @return void
     */
    public function deleted(Plazoinscripcion $plazoInscripcion)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó el plazo de inscripción: ' . json_encode($plazoInscripcion),
            'tabla' => 'plazoinscripcions'
        ]);
    }

    /**
     * Handle the PlazoInscripcion "restored" event.
     *
     * @param  \App\Models\PlazoInscripcion  $plazoInscripcion
     * @return void
     */
    public function restored(Plazoinscripcion $plazoInscripcion)
    {
        //
    }

    /**
     * Handle the PlazoInscripcion "force deleted" event.
     *
     * @param  \App\Models\PlazoInscripcion  $plazoInscripcion
     * @return void
     */
    public function forceDeleted(Plazoinscripcion $plazoInscripcion)
    {
        //
    }
}
