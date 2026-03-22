<?php

namespace App\Observers;

use App\Models\Turno;
use App\Models\Bitacora;

class TurnoObserver
{
    /**
     * Handle the Turno "created" event.
     *
     * @param  \App\Models\Turno  $turno
     * @return void
     */
    public function created(Turno $turno)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró el turno: ' . json_encode($turno),
            'tabla' => 'turnos'
        ]);
    }

    /**
     * Handle the Turno "updated" event.
     *
     * @param  \App\Models\Turno  $turno
     * @return void
     */
    public function updated(Turno $turno)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó el Turno ' . json_encode($turno->getChanges()),
            'tabla' => 'turnos'
        ]);
    }

    /**
     * Handle the Turno "deleted" event.
     *
     * @param  \App\Models\Turno  $turno
     * @return void
     */
    public function deleted(Turno $turno)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó el turno ' . json_encode($turno),
            'tabla' => 'turnos'
        ]);
    }

    /**
     * Handle the Turno "restored" event.
     *
     * @param  \App\Models\Turno  $turno
     * @return void
     */
    public function restored(Turno $turno)
    {
        //
    }

    /**
     * Handle the Turno "force deleted" event.
     *
     * @param  \App\Models\Turno  $turno
     * @return void
     */
    public function forceDeleted(Turno $turno)
    {
        //
    }
}
