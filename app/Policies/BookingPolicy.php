<?php

namespace App\Policies;

use App\Models\Booking;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    public function userPermission()
    {
        $user = auth()->user();

        // Verifica se o usuário tem a patente sudo para atribuir permissões
        if (! $user->hasPermissionTo('teste')) {
            return $this->deny('Você não tem esse nível de autorização');
        }

        return $this->allow();
    }
}