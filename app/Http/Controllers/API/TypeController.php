<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        try {

            $types = Type::paginate(10);

            // Si aucun type
            if ($types->isEmpty()) {
                return response()->json([
                    'status'     => true,
                    'message'    => 'Aucun type trouvé',
                    'data'       => [],
                    'pagination' => $this->formatPagination($types),
                ], 200);
            }

            // Si des types
            return response()->json([
                'status'     => true,
                'message'    => 'Types récupérés avec succès',
                'data'       => $types->items(),
                'pagination' => $this->formatPagination($types),
            ], 200);

        } catch (\Exception $error) {

            // Problème
            return response()->json([
                'status'  => false,
                'message' => 'Erreur lors de la récupération des types',
                'error'   => $error->getMessage(),
            ], 500);

        }
        // $types = Type::paginate(10);
        // return response()->json($types, 200);
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
