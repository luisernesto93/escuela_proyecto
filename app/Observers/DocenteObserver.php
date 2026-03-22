<?php

namespace App\Observers;

use App\Models\Docente;
use App\Models\Bitacora;

class DocenteObserver
{
    /**
     * Handle the Docente "created" event.
     *
     * @param  \App\Models\Docente  $docente
     * @return void
     */
    public function created(Docente $docente)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró el docente: ' . json_encode($docente),
            'tabla' => 'docentes'
        ]);
    }

    /**
     * Handle the Docente "updated" event.
     *
     * @param  \App\Models\Docente  $docente
     * @return void
     */
    public function updated(Docente $docente)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó el docente: ' . json_encode($docente->getChanges()),
            'tabla' => 'docentes'
        ]);
    }

    /**
     * Handle the Docente "deleted" event.
     *
     * @param  \App\Models\Docente  $docente
     * @return void
     */
    public function deleted(Docente $docente)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó el docente: ' . json_encode($docente),
            'tabla' => 'docentes'
        ]);
    }

    /**
     * Handle the Docente "restored" event.
     *
     * @param  \App\Models\Docente  $docente
     * @return void
     */
    public function restored(Docente $docente)
    {
        //
    }

    /**
     * Handle the Docente "force deleted" event.
     *
     * @param  \App\Models\Docente  $docente
     * @return void
     */
    public function forceDeleted(Docente $docente)
    {
        //
    }
}
