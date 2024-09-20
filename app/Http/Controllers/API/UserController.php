<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ControllerUtils;

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
        try {

            $users = User::paginate(10);

            // Si aucun user
            if ($users->isEmpty()) {
                return response()->json([
                    'status'     => true,
                    'message'    => 'Aucun user trouvé',
                    'data'       => [],
                    'pagination' => $this->formatPagination($users),
                ], 200);
            }

            // Si des users
            return response()->json([
                'status'     => true,
                'message'    => 'Users récupérés avec succès',
                'data'       => $users->items(),
                'pagination' => $this->formatPagination($users),
            ], 200);

        } catch (\Exception $error) {

            // Problème
            return response()->json([
                'status'  => false,
                'message' => 'Erreur lors de la récupération des users',
                'error'   => $error->getMessage(),
            ], 500);

        }
        // $users = User::paginate(10);
        // return response()->json($users, 200);
    }





    /*
    |--------------------------------------------------------------------------|
    |   STORE   (Creation)                                                     |
    |--------------------------------------------------------------------------|
    */
    public function store(Request $request)
    {
        //
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
