<?php

namespace App\Observers;

use App\Models\CanalPublicitario;
use App\Models\Bitacora;

class CanalPublicitarioObserver
{
    /**
     * Handle the CanalPublicitario "created" event.
     *
     * @param  \App\Models\CanalPublicitario  $canalPublicitario
     * @return void
     */
    public function created(CanalPublicitario $canalPublicitario)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró el canal publicitario: ' . json_encode($canalPublicitario),
            'tabla' => 'canal_publicitarios',
        ]);
    }

    /**
     * Handle the CanalPublicitario "updated" event.
     *
     * @param  \App\Models\CanalPublicitario  $canalPublicitario
     * @return void
     */
    public function updated(CanalPublicitario $canalPublicitario)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó el canal publicitario: ' . json_encode($canalPublicitario->getChanges()),
            'tabla' => 'canal_publicitarios',
        ]);
    }

    /**
     * Handle the CanalPublicitario "deleted" event.
     *
     * @param  \App\Models\CanalPublicitario  $canalPublicitario
     * @return void
     */
    public function deleted(CanalPublicitario $canalPublicitario)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó el canal publicitario: ' . json_encode($canalPublicitario),
            'tabla' => 'canal_publicitarios',
        ]);
    }

    /**
     * Handle the CanalPublicitario "restored" event.
     *
     * @param  \App\Models\CanalPublicitario  $canalPublicitario
     * @return void
     */
    public function restored(CanalPublicitario $canalPublicitario)
    {
        //
    }

    /**
     * Handle the CanalPublicitario "force deleted" event.
     *
     * @param  \App\Models\CanalPublicitario  $canalPublicitario
     * @return void
     */
    public function forceDeleted(CanalPublicitario $canalPublicitario)
    {
        //
    }
}
