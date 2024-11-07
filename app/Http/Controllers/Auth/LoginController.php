<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------|
    |   __CONSTRUC   middleware                                                |
    |--------------------------------------------------------------------------|
    */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['login']);
    }





    /*
    |--------------------------------------------------------------------------|
    |   LOGIN | POST                                                           |
    |--------------------------------------------------------------------------|
    */
    public function login(LoginRequest $request): JsonResponse
    {
        $dataUser = $request->only(['email', 'password']);

        if (Auth::attempt($dataUser)) {
            $authUser = User::with('role')->find(Auth::id());

            return response()->json([
                'status' => true,
                'user' => $authUser,
                'message' => 'Vous êtes connecté'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Échec de la connexion. Utilisateur ou mot de passe incorrect.'
        ], 401);
    }





    /*
    |--------------------------------------------------------------------------|
    |   LOGOUT | POST                                                          |
    |--------------------------------------------------------------------------|
    */
    public function logout(Request $request): JsonResponse
    {
        Auth::guard('web')->logout();

        return response()->json([
            'status'  => true,
            'message' => 'Déconnexion réussie'
        ]);
    }
}
