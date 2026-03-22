<?php

namespace App\Observers;

use App\Models\Beca;
use App\Models\Bitacora;

class BecaObserver //Es para ejecutar eventos al ejecutar un metodo CRUD
{
    /**
     * Handle the Beca "created" event.
     *
     * @param  \App\Models\Beca  $beca
     * @return void
     */
    public function created(Beca $beca)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró la beca: ' . json_encode($beca),
            'tabla' => 'becas'
        ]);
    }
    /**
     * Handle the Beca "updated" event.
     *
     * @param  \App\Models\Beca  $beca
     * @return void
     */
    public function updated(Beca $beca)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó la beca ' . json_encode($beca->getChanges()),
            'tabla' => 'becas'
        ]);
    }
    /**
     * Handle the Beca "deleted" event.
     *
     * @param  \App\Models\Beca  $beca
     * @return void
     */
    public function deleted(Beca $beca)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó la beca ' . json_encode($beca),
            'tabla' => 'becas'
        ]);
    }
    /**
     * Handle the Beca "restored" event.
     *
     * @param  \App\Models\Beca  $beca
     * @return void
     */
    public function restored(Beca $beca)
    {
        //
    }
    /**
     * Handle the Beca "force deleted" event.
     *
     * @param  \App\Models\Beca  $beca
     * @return void
     */
    public function forceDeleted(Beca $beca)
    {
        //
    }
}
