<?php

namespace App\Observers;

use App\Models\Estudiante;
use App\Models\Bitacora;

class EstudianteObserver
{
    /**
     * Handle the Estudiante "created" event.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return void
     */
    public function created(Estudiante $estudiante)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró el estudiante: ' . json_encode($estudiante),
            'tabla' => 'estudiantes'
        ]);
    }

    /**
     * Handle the Estudiante "updated" event.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return void
     */
    public function updated(Estudiante $estudiante)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó el estudiante: ' . json_encode($estudiante->getChanges()),
            'tabla' => 'estudiantes'
        ]);
    }

    /**
     * Handle the Estudiante "deleted" event.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return void
     */
    public function deleted(Estudiante $estudiante)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó el estudiante: ' . json_encode($estudiante),
            'tabla' => 'estudiantes'
        ]);
    }

    /**
     * Handle the Estudiante "restored" event.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return void
     */
    public function restored(Estudiante $estudiante)
    {
        //
    }

    /**
     * Handle the Estudiante "force deleted" event.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return void
     */
    public function forceDeleted(Estudiante $estudiante)
    {
        //
    }
}
