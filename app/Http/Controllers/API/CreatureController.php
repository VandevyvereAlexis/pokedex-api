<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCreatureRequest;
use App\Http\Requests\UpdateCreatureRequest;
use App\Models\Creature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ControllerUtils;
use Illuminate\Support\Facades\File;

class CreatureController extends Controller
{
    use ControllerUtils;

    /*
    |--------------------------------------------------------------------------|
    |   __CONSTRUC   middleware                                                |
    |--------------------------------------------------------------------------|
    */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show', 'search']);
    }





    /*
    |--------------------------------------------------------------------------|
    |   INDEX | GET                                                            |
    |--------------------------------------------------------------------------|
    */
    public function index(): JsonResponse
    {
        $this->authorize('index', Creature::class);

        $creatures = Creature::with(['type', 'race', 'user'])->paginate(10);

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
    |   STORE | POST                                                           |
    |--------------------------------------------------------------------------|
    */
    public function store(StoreCreatureRequest $request): JsonResponse
    {
        $this->authorize('store', Creature::class);

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
    |   SHOW | GET                                                             |
    |--------------------------------------------------------------------------|
    */
    public function show($id): JsonResponse
    {
        $this->authorize('show', Creature::class);

        $creature = Creature::with(['user', 'race', 'type'])->find($id);

        if ($creature) {
            return response()->json([
                'status'   => true,
                'message'  => 'Créature trouvée avec succès',
                'data'     => $creature,
            ]);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Aucune créature trouvée',
        ], 404);
    }





    /*
    |--------------------------------------------------------------------------|
    |   UPDATE | PUT / PATCH                                                   |
    |--------------------------------------------------------------------------|
    */
    public function update(UpdateCreatureRequest $request, Creature $creature): JsonResponse
    {
        $this->authorize('update', $creature);

        $creature->update($request->only(['name', 'pv', 'atk', 'def', 'speed', 'capture_rate', 'type_id', 'race_id']));

        if ($request->image) {

            $imageName = uploadImage($request['image']);
            $imagePath = 'images/' . $creature->image;

            if (File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }

            $creature->update(['image' => $imageName]);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Creature modifiée avec succès',
            'data' => $creature,
        ]);
    }





    /*
    |--------------------------------------------------------------------------|
    |   DESTROY | DELETE                                                       |
    |--------------------------------------------------------------------------|
    */
    public function destroy(Creature $creature): JsonResponse
    {
        $this->authorize('destroy', $creature);

        if ($creature->image !== 'default.jpg') {
            $imagePath = 'images/' . $creature->image;
            if (File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }
        }

        $creature->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Créature supprimée avec succès',
        ]);
    }





    /*
    |--------------------------------------------------------------------------|
    |   SEARCH | GET                                                           |
    |--------------------------------------------------------------------------|
    */
    public function search(Request $request): JsonResponse
    {
        $name = $request->query('name');
        $minPv = $request->query('minPv');
        $maxPv = $request->query('maxPv');

        $creatures = Creature::searchByName($name, $minPv, $maxPv)
            ->with(['user', 'type', 'race'])
            ->get();

        if ($creatures->isNotEmpty()) {
            return response()->json([
                'status'   => true,
                'message'  => 'Créature(s) trouvée(s) avec succès',
                'data'     => $creatures,
            ]);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Aucune créature trouvée',
        ], 404);
    }
}
