<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validación de campos
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 422);
        }

        if ($access_token = JWTAuth::attempt($credentials)) {
            $user = JWTAuth::user();
            return response()->json([
                'access_token' => $access_token,
                'user' => $user,
                'success' => true,
                'message' => "Autenticación exitosa"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Credenciales incorrectas"
            ]);
        }
    }

    public function logout()
    {
        $respuesta_api = User::logout();
        return $respuesta_api;
    }
    public function list()
    {
        $users = User::allApiUsers();
        return datatables()->of($users)->toJson();
    }

    public function new(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $respuesta_email = User::whereEmail($request->email);

        if ($respuesta_email != null) {
            return response()->json([
                'success' => false,
                'message' => "El correo ya existe",
            ], 422);
        }

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 422);
        }

        $respuesta_api = User::new($request->all());

        if ($respuesta_api['success'] == true) {
            return response()->json([
                'success' => true,
                'message' => $respuesta_api['message'],
                'data' => $respuesta_api['data']
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => $respuesta_api['message'],
                'data' => $respuesta_api['data']
            ]);
        }
    }
}
