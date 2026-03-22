<?php

namespace App\Observers;

use App\Models\Carrera;
use App\Models\Bitacora;

class CarreraObserver
{
    /**
     * Handle the Carrera "created" event.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return void
     */
    public function created(Carrera $carrera)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró la carrera: ' . json_encode($carrera),
            'tabla' => 'carreras'
        ]);
    }

    /**
     * Handle the Carrera "updated" event.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return void
     */
    public function updated(Carrera $carrera)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó la carrera: ' . json_encode($carrera->getChanges()),
            'tabla' => 'carreras'
        ]);
    }

    /**
     * Handle the Carrera "deleted" event.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return void
     */
    public function deleted(Carrera $carrera)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó la carrera: ' . json_encode($carrera),
            'tabla' => 'carreras'
        ]);
    }

    /**
     * Handle the Carrera "restored" event.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return void
     */
    public function restored(Carrera $carrera)
    {
        //
    }

    /**
     * Handle the Carrera "force deleted" event.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return void
     */
    public function forceDeleted(Carrera $carrera)
    {
        //
    }
}
