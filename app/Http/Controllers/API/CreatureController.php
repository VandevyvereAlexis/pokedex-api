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
    // public function store(StoreCreatureRequest $request): JsonResponse
    // {
    //     // $creatures = Creature::create([
    //     //     'name'         =>
    //     //     'pv'           =>
    //     //     'atk'          =>
    //     //     'def'          =>
    //     //     'speed'        =>
    //     //     'capture_rate' =>
    //     //     'image'        => isset($request['image']) ? uploadImage($request['image']) : 'user.png',
    //     //     'user_id'      => Auth::user()->id,
    //     //     'user_id'      => Auth::user()->id,
    //     //     'user_id' => Auth::user()->id,
    //     // ]);

    //     return response()->json([
    //         'status'  => true,
    //         'message' => 'Post créé avec succès',
    //         'post'    => $post,
    //     ], 201);
    // }





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
