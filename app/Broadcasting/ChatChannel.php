<?php

namespace App\Broadcasting;

use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Auth\Authenticatable;

class ChatChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return array|bool
     */
    public function join(Authenticatable $user)
    {
        return true; // Puedes personalizar la lógica de autorización aquí si es necesario
    }
}
