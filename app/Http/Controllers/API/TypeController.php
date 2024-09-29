<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ControllerUtils;

class TypeController extends Controller
{

    use ControllerUtils;

    /*
    |--------------------------------------------------------------------------|
    |   __CONSTRUC   middleware                                                |
    |--------------------------------------------------------------------------|
    */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index, show');
    }





    /*
    |--------------------------------------------------------------------------|
    |   INDEX | GET                                                            |
    |--------------------------------------------------------------------------|
    */
    public function index(): JsonResponse
    {
        $types = Type::paginate(10);
        $message = $types->isEmpty() ? 'Aucun type trouvée' : 'Types récupérés avec succès';
        $data = $types->isEmpty() ? [] : $types->items();

        return response()->json([
            'status'     => true,
            'message'    => $message,
            'data'       => $data,
            'pagination' => $this->formatPagination($types),
        ]);
    }





    /*
    |--------------------------------------------------------------------------|
    |   STORE | POST                                                           |
    |--------------------------------------------------------------------------|
    */
    public function store(StoreTypeRequest $request): JsonResponse
    {
        $type = Type::create([
            'name' => $request->input('name'),
        ]);

        // Réponse JSON après création
        return response()->json([
            'status'  => true,
            'message' => 'Type créé avec succès.',
            'data'    => $type,
        ], 201);
    }





    /*
    |--------------------------------------------------------------------------|
    |   SHOW | GET                                                             |
    |--------------------------------------------------------------------------|
    */
    public function show($id): JsonResponse
    {
        $type = Type::find($id);

        if ($type) {
            return response()->json([
                'status'   => true,
                'message'  => 'Type trouvé avec succès',
                'data'     => $type,
            ]);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Aucun type trouvée',
        ], 404);
    }





    /*
    |--------------------------------------------------------------------------|
    |   UPDATE | PUT / PATCH                                                   |
    |--------------------------------------------------------------------------|
    */
    public function update(UpdateTypeRequest $request, Type $type): JsonResponse
    {
        $type->update($request->only(['name']));

        return response()->json([
            'status'  => true,
            'message' => 'Type mise à jour avec succès',
            'data'    => $type,
        ]);
    }





    /*
    |--------------------------------------------------------------------------|
    |   DESTROY   (Deletion)                                                   |
    |--------------------------------------------------------------------------|
    */
    public function destroy(Type $type): JsonResponse
    {
        $type->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Type supprimé avec succès',
        ]);
    }
}
