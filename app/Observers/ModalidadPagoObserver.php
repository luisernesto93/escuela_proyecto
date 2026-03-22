<?php

namespace App\Observers;

use App\Models\ModalidadPago;
use App\Models\Bitacora;

class ModalidadPagoObserver
{
    /**
     * Handle the ModalidadPago "created" event.
     *
     * @param  \App\Models\ModalidadPago  $modalidadPago
     * @return void
     */
    public function created(ModalidadPago $modalidadPago)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró la modalidad de Pago: ' . json_encode($modalidadPago),
            'tabla' => 'modalidad_pagos'
        ]);
    }

    /**
     * Handle the ModalidadPago "updated" event.
     *
     * @param  \App\Models\ModalidadPago  $modalidadPago
     * @return void
     */
    public function updated(ModalidadPago $modalidadPago)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó la modalidad de Pago: ' . json_encode($modalidadPago->getChanges()),
            'tabla' => 'modalidad_pagos'
        ]);
    }

    /**
     * Handle the ModalidadPago "deleted" event.
     *
     * @param  \App\Models\ModalidadPago  $modalidadPago
     * @return void
     */
    public function deleted(ModalidadPago $modalidadPago)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó la modalidad de Pago: ' . json_encode($modalidadPago),
            'tabla' => 'modalidad_pagos'
        ]);
    }

    /**
     * Handle the ModalidadPago "restored" event.
     *
     * @param  \App\Models\ModalidadPago  $modalidadPago
     * @return void
     */
    public function restored(ModalidadPago $modalidadPago)
    {
        //
    }

    /**
     * Handle the ModalidadPago "force deleted" event.
     *
     * @param  \App\Models\ModalidadPago  $modalidadPago
     * @return void
     */
    public function forceDeleted(ModalidadPago $modalidadPago)
    {
        //
    }
}
