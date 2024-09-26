<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ControllerUtils;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

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
    public function store(StoreUserRequest $request): JsonResponse
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
    public function show($id): JsonResponse
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
    |   UPDATE | PUT / PATCH                                                   |
    |--------------------------------------------------------------------------|
    */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $user->update($request->only(['pseudo', 'email']));

        if ($request->image) {

            $imageName = uploadImage($request['image']);
            $imagePath = 'images/' . $user->image;

            if (File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }

            $user->update(['image' => $imageName]);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Les informations ont été mises à jour avec succès.',
            'user'    => $user
        ]);
    }





    /*
    |--------------------------------------------------------------------------|
    |   UPDATE | PUT / PATCH                                                   |
    |--------------------------------------------------------------------------|
    */
    public function updatePassword(UpdatePasswordRequest $request, User $user): JsonResponse
    {
        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;

        $hashedCurrentPassword = $user->password;

        if (Hash::check($oldPassword, $hashedCurrentPassword))
        {
            if ($oldPassword !== $newPassword)
            {
                $user->password = Hash::make($newPassword);
                $user->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Le mot de passe a bien été modifié.'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'L\'ancien et le nouveau mot de passe ne peuvent pas être identiques.'
                ], 422);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Le mot de passe actuel est incorrect.'
            ], 422);
        }
    }





    /*
    |--------------------------------------------------------------------------|
    |   DESTROY   (Deletion)                                                   |
    |--------------------------------------------------------------------------|
    */
    public function destroy(User $user): JsonResponse
    {
        if ($user->image !== 'default.jpg') {
            $imagePath = 'images/' . $user->image;
            if (File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }
        }

        $user->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Utilisateur supprimé avec succès',
        ]);
    }
}
