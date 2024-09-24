<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCreatureRequest;
use App\Models\Creature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ControllerUtils;

class CreatureController extends Controller
{
    use ControllerUtils;

    /*
    |--------------------------------------------------------------------------|
    |   INDEX   (List)                                                         |
    |--------------------------------------------------------------------------|
    */
    public function index(): JsonResponse
    {
        $creatures = Creature::with(['type', 'race'])->paginate(10);

        $message = $creatures->isEmpty() ? 'Aucune créature trouvée' : 'Créatures récupérées avec succès';
        $data = $creatures->isEmpty() ? [] : $creatures->items();

        return response()->json([
            'status'     => true,
            'message'    => $message,
            'data'       => $data,
            'pagination' => $this->formatPagination($creatures),
        ]);
    }





    /*
    |--------------------------------------------------------------------------|
    |   STORE   (Creation)                                                     |
    |--------------------------------------------------------------------------|
    */
    public function store(StoreCreatureRequest $request): JsonResponse
    {
        $imageName = $request->hasFile('image') ? uploadImage($request->file('image')) : 'default.jpg';

        $creatureData = $request->only(['name', 'pv', 'atk', 'def', 'speed', 'capture_rate', 'user_id', 'type', 'race']);
        $creatureData['image'] = $imageName;
        $creatureData['type_id'] = $request->type;
        $creatureData['race_id'] = $request->race;

        $creature = Creature::create($creatureData);

        return response()->json([
            'status'  => true,
            'message' => 'Créature créée avec succès',
            'data'    => $creature,
        ], 201);
    }





    /*
    |--------------------------------------------------------------------------|
    |   SHOW   (Display)                                                       |
    |--------------------------------------------------------------------------|
    */
    public function show(Creature $creature)
    {
        //
    }

    /*
    |--------------------------------------------------------------------------|
    |   UPDATE   (Update)                                                      |
    |--------------------------------------------------------------------------|
    */
    public function update(Request $request, Creature $creature)
    {
        //
    }

    /*
    |--------------------------------------------------------------------------|
    |   DESTROY   (Deletion)                                                   |
    |--------------------------------------------------------------------------|
    */
    public function destroy(Creature $creature)
    {
        //
    }
}
