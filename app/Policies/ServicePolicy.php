<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;

    public function sale(User $user)
    {

        $user = auth()->user();

        // Verifica se o usuário tem a patente sudo para atribuir permissões
        if (! $user->hasPermissionTo('sale')) {
            return $this->deny('Você não tem esse nível de autorização');
        }

        return $this->allow();
    }
}
