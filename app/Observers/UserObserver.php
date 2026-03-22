<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Bitacora;
class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id ?? 1,
            'accion' => 'Registró el user: ' . json_encode($user),
            'tabla' => 'users'
        ]);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Actualizó el user: ' . json_encode($user->getChanges()),
            'tabla' => 'users'
        ]);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 'Eliminó el user: ' . json_encode($user),
            'tabla' => 'users'
        ]);
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
