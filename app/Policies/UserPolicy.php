<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;

class UserPolicy
{

    public function viewAny(User $user): Response
    {
        return $user->isAdmin() ? Response::allow() : Response::deny('Você não tem acesso a essa página.');
    }

    public function create(User $user): Response
    {
        return $user->isAdmin() ? Response::allow() : Response::deny('Você não tem permissão para executar essa ação!');
    }

    public function update(User $user, Model $model): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user): bool
    {
        return $user->isAdmin();
    }

}
