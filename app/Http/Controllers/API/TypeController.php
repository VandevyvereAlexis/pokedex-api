<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ControllerUtils;

class TypeController extends Controller
{

    use ControllerUtils;

    /*
    |--------------------------------------------------------------------------|
    |   INDEX   (List)                                                         |
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
    |   STORE   (Creation)                                                     |
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
    |   SHOW   (Display)                                                       |
    |--------------------------------------------------------------------------|
    */
    public function show(Type $type)
    {
        //
    }

    /*
    |--------------------------------------------------------------------------|
    |   UPDATE   (Update)                                                      |
    |--------------------------------------------------------------------------|
    */
    public function update(Request $request, Type $type)
    {
        //
    }

    /*
    |--------------------------------------------------------------------------|
    |   DESTROY   (Deletion)                                                   |
    |--------------------------------------------------------------------------|
    */
    public function destroy(Type $type)
    {
        //
    }
}
