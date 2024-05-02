<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function permission()
    {
        $user = auth()->user();

        // Verifica se o usuário tem a patente sudo para atribuir permissões
        if (! $user->hasRole('sudo')) {
            return $this->deny('Você não tem esse nível de autorização');
        }

        return $this->allow();
    }
}
