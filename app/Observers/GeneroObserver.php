<?php

namespace App\Observers;

use App\Models\Genero;
use App\Models\Bitacora;

class GeneroObserver
{
    /**
     * Handle the Genero "created" event.
     *
     * @param  \App\Models\Genero  $genero
     * @return void
     */
    public function created(Genero $genero)
    {
        //
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró el género: ' . json_encode($genero),
            'tabla' => 'generos'
        ]);
    }

    /**
     * Handle the Genero "updated" event.
     *
     * @param  \App\Models\Genero  $genero
     * @return void
     */
    public function updated(Genero $genero)
    {
        //
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó el género ' . json_encode($genero->getChanges()),
            'tabla' => 'generos'
        ]);
    }

    /**
     * Handle the Genero "deleted" event.
     *
     * @param  \App\Models\Genero  $genero
     * @return void
     */
    public function deleted(Genero $genero)
    {
        //
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó el género ' . json_encode($genero),
            'tabla' => 'generos'
        ]);
    }

    /**
     * Handle the Genero "restored" event.
     *
     * @param  \App\Models\Genero  $genero
     * @return void
     */
    public function restored(Genero $genero)
    {
        //
    }

    /**
     * Handle the Genero "force deleted" event.
     *
     * @param  \App\Models\Genero  $genero
     * @return void
     */
    public function forceDeleted(Genero $genero)
    {
        //
    }
}
