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
    |   INDEX | GET                                                            |
    |--------------------------------------------------------------------------|
    */
    public function index(): JsonResponse
    {
        $users = User::with(['creatures'])->paginate(10);
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
    |   STORE | POST                                                           |
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
    |   SHOW | GET                                                             |
    |--------------------------------------------------------------------------|
    */
    public function show($id)
    {
        $user = User::with(['creatures'])->find($id);

        if ($user) {
            return response()->json([
                'status'   => true,
                'message'  => 'User trouvé avec succès',
                'data'     => $user,
            ]);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Aucun user trouvé',
        ], 404);
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
