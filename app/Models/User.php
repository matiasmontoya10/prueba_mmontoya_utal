<?php

namespace App\Models;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    protected $attributes;

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    public static function find($id)
    {
        $response = Http::get("https://677f46f70476123f76a5d30b.mockapi.io/api/users/{$id}");

        if ($response->successful()) {
            return new self($response->json());
        }

        return null;
    }

    public static function whereEmail($email)
    {
        $response = Http::get('https://677f46f70476123f76a5d30b.mockapi.io/api/users/', ['email' => $email]);

        if ($response->successful()) {
            $users = $response->json();
            $user = collect($users)->first(fn($user) => $user['email'] == $email);

            return $user ? new self($user) : null;
        }

        return null;
    }

    public static function allApiUsers()
    {
        $response = Http::get('https://677f46f70476123f76a5d30b.mockapi.io/api/users');
        return $response->json();
    }

    // Implementaciones requeridas por Authenticatable
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->attributes['id'] ?? null;
    }

    public function getAuthPassword()
    {
        return $this->attributes['password'] ?? null;
    }

    public function getRememberToken()
    {
        return $this->attributes['remember_token'] ?? null;
    }

    public function setRememberToken($value)
    {
        $this->attributes['remember_token'] = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function toArray()
    {
        return $this->attributes;
    }

    // Métodos requeridos por la interfaz JWTSubject
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function new($data)
    {
        $response = Http::post('https://677f46f70476123f76a5d30b.mockapi.io/api/users', $data);

        if ($response->successful()) {
            return [
                'success' => true,
                'message' => "Usuario creado exitosamente",
                'data' => $response->json()
            ];
        }else{
            return [
                'success' => false,
                'message' => "Error al crear el usuario",
                'data' => $response->json()
            ];
        }

        return $response->json();
    }

    public static function logout(){
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'success' => true,
                'message' => "Sesión cerrada exitosamente"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "No se pudo cerrar la sesión. Intenta nuevamente.",
            ], 500);
        }
    }
}
