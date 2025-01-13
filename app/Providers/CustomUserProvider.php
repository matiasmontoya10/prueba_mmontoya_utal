<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\User;

class CustomUserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
        return User::find($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {

    }

    public function updateRememberToken(Authenticatable $user, $token)
    {

    }

    public function retrieveByCredentials(array $credentials)
    {
        return User::whereEmail($credentials['email']);
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // Para contraseñas hasheadas
        //return password_verify($credentials['password'], $user->getAuthPassword());

        // Para contraseñas en texto plano (solo para pruebas)
        return $credentials['password'] == $user->getAuthPassword();
    }
}
