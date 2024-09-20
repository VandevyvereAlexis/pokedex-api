<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\race;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ControllerUtils;

class RaceController extends Controller
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

            $races = Race::paginate(10);

            // Si aucune race
            if ($races->isEmpty()) {
                return response()->json([
                    'status'     => true,
                    'message'    => 'Aucune race trouvée',
                    'data'       => [],
                    'pagination' => $this->formatPagination($races),
                ], 200);
            }

            // Si des races
            return response()->json([
                'status'     => true,
                'message'    => 'Races récupérées avec succès',
                'data'       => $races->items(),
                'pagination' => $this->formatPagination($races),
            ], 200);

        } catch (\Exception $error) {

            // Problème
            return response()->json([
                'status'  => false,
                'message' => 'Erreur lors de la récupération des races',
                'error'   => $error->getMessage(),
            ], 500);

        }
        // $races = Race::paginate(10);
        // return response()->json($races, 200);
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
    public function show(race $race)
    {
        //
    }

    /*
    |--------------------------------------------------------------------------|
    |   UPDATE   (Update)                                                      |
    |--------------------------------------------------------------------------|
    */
    public function update(Request $request, race $race)
    {
        //
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
