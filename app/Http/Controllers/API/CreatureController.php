<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

        try {

            $creatures = Creature::with(['type', 'race'])->paginate(10);

            // Si aucune créature
            if ($creatures->isEmpty()) {
                return response()->json([
                    'status'     => true,
                    'message'    => 'Aucune créature trouvée',
                    'data'       => [],
                    'pagination' => $this->formatPagination($creatures),
                ], 200);
            }

            // Si des créatures
            return response()->json([
                'status'     => true,
                'message'    => 'Créatures récupérées avec succès',
                'data'       => $creatures->items(),
                'pagination' => $this->formatPagination($creatures),
            ], 200);

        } catch (\Exception $error) {

            // Problème
            return response()->json([
                'status'  => false,
                'message' => 'Erreur lors de la récupération des créatures',
                'error'   => $error->getMessage(),
            ], 500);

        }
        // $creatures = Creature::paginate(10);
        // return response()->json($creatures);
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
