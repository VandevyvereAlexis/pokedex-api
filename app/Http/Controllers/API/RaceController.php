<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRaceRequest;
use App\Http\Requests\UpdateRaceRequest;
use App\Models\race;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ControllerUtils;

class RaceController extends Controller
{

    use ControllerUtils;

    /*
    |--------------------------------------------------------------------------|
    |   INDEX | GET                                                            |
    |--------------------------------------------------------------------------|
    */
    public function index(): JsonResponse
    {
        $races = Race::paginate(10);
        $message = $races->isEmpty() ? 'Aucune race trouvée' : 'Races récupérées avec succès';
        $data = $races->isEmpty() ? [] : $races->items();

        return response()->json([
            'status'     => true,
            'message'    => $message,
            'data'       => $data,
            'pagination' => $this->formatPagination($races),
        ]);
    }





    /*
    |--------------------------------------------------------------------------|
    |   STORE | POST                                                           |
    |--------------------------------------------------------------------------|
    */
    public function store(StoreRaceRequest $request): JsonResponse
    {
        $race = Race::create([
            'name' => $request->input('name'),
        ]);

        // Réponse JSON après création
        return response()->json([
            'status'  => true,
            'message' => 'Race créée avec succès.',
            'data'    => $race,
        ], 201);
    }





    /*
    |--------------------------------------------------------------------------|
    |   SHOW | GET                                                             |
    |--------------------------------------------------------------------------|
    */
    public function show($id): JsonResponse
    {
        $race = Race::find($id);

        if ($race) {
            return response()->json([
                'status'   => true,
                'message'  => 'Race trouvée avec succès',
                'data'     => $race,
            ]);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Aucune race trouvée',
        ], 404);
    }





    /*
    |--------------------------------------------------------------------------|
    |   UPDATE | PUT / PATCH                                                   |
    |--------------------------------------------------------------------------|
    */
    public function update(UpdateRaceRequest $request, race $race): JsonResponse
    {
        $race->update($request->only(['name']));

        return response()->json([
            'status'  => true,
            'message' => 'Race mise à jour avec succès',
            'data'    => $race,
        ]);
    }





    /*
    |--------------------------------------------------------------------------|
    |   DESTROY   (Deletion)                                                   |
    |--------------------------------------------------------------------------|
    */
    public function destroy(race $race)
    {
        //
    }
}
