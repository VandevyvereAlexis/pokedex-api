<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ControllerUtils;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    use ControllerUtils;

    /*
    |--------------------------------------------------------------------------|
    |   INDEX   (List)                                                         |
    |--------------------------------------------------------------------------|
    */
    public function index(): JsonResponse
    {
        $users = User::paginate(10);
        $message = $users->isEmpty() ? 'Aucun user trouvée' : 'Users récupérés avec succès';
        $data = $users->isEmpty() ? [] : $users->items();

        return response()->json([
            'status'     => true,
            'message'    => $message,
            'data'       => $data,
            'pagination' => $this->formatPagination($users),
        ]);
    }





    /*
    |--------------------------------------------------------------------------|
    |   STORE   (Creation)                                                     |
    |--------------------------------------------------------------------------|
    */
    public function store(StoreUserRequest $request)
    {
        $imageName = $request->hasFile('image') ? uploadImage($request->file('image')) : 'default.jpg';

        $user = User::create([
            'pseudo'   => $request['pseudo'],
            'email'    => $request['email'],
            'password' => Hash::make($request['password']),
            'image'    => $imageName,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Utilisateur créé avec succès.',
            'data'    => $user,
        ], 201);
    }





    /*
    |--------------------------------------------------------------------------|
    |   SHOW   (Display)                                                       |
    |--------------------------------------------------------------------------|
    */
    public function show(User $user)
    {
        //
    }

    /*
    |--------------------------------------------------------------------------|
    |   UPDATE   (Update)                                                      |
    |--------------------------------------------------------------------------|
    */
    public function update(Request $request, User $user)
    {
        //
    }

    /*
    |--------------------------------------------------------------------------|
    |   DESTROY   (Deletion)                                                   |
    |--------------------------------------------------------------------------|
    */
    public function destroy(User $user)
    {
        //
    }
}
