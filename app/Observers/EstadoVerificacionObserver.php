<?php

namespace App\Observers;

use App\Models\EstadoVerificacion;
use App\Models\Bitacora;
class EstadoVerificacionObserver
{
    /**
     * Handle the EstadoVerificacion "created" event.
     *
     * @param  \App\Models\EstadoVerificacion  $estadoVerificacion
     * @return void
     */
    public function created(EstadoVerificacion $estadoVerificacion)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró las verificaciones: ' . json_encode($estadoVerificacion),
            'tabla' => 'estado_verificacions'
        ]);
    }

    /**
     * Handle the EstadoVerificacion "updated" event.
     *
     * @param  \App\Models\EstadoVerificacion  $estadoVerificacion
     * @return void
     */
    public function updated(EstadoVerificacion $estadoVerificacion)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó las verificaciones: ' . json_encode($estadoVerificacion->getChanges()),
            'tabla' => 'estado_verificacions'
        ]);
    }

    /**
     * Handle the EstadoVerificacion "deleted" event.
     *
     * @param  \App\Models\EstadoVerificacion  $estadoVerificacion
     * @return void
     */
    public function deleted(EstadoVerificacion $estadoVerificacion)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó las verificaciones: ' . json_encode($estadoVerificacion),
            'tabla' => 'estado_verificacions'
        ]);
    }

    /**
     * Handle the EstadoVerificacion "restored" event.
     *
     * @param  \App\Models\EstadoVerificacion  $estadoVerificacion
     * @return void
     */
    public function restored(EstadoVerificacion $estadoVerificacion)
    {
        //
    }

    /**
     * Handle the EstadoVerificacion "force deleted" event.
     *
     * @param  \App\Models\EstadoVerificacion  $estadoVerificacion
     * @return void
     */
    public function forceDeleted(EstadoVerificacion $estadoVerificacion)
    {
        //
    }
}
