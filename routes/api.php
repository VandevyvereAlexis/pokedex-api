<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



$resources = [
    'creatures' => App\Http\Controllers\API\CreatureController::class,
    'races' => App\Http\Controllers\API\RaceController::class,
    'types' => App\Http\Controllers\API\TypeController::class,
    'users' => App\Http\Controllers\API\UserController::class,
];

foreach ($resources as $resource => $controller) {
    Route::apiResource($resource, $controller);
}



// Modification Password
Route::put('users/{user}/password', [App\Http\Controllers\API\UserController::class, 'updatePassword'])->name('users.updatePassword');



// Search
Route::get('/creature/search', [App\Http\Controllers\API\CreatureController::class, 'search'])->name('creatures.search');
Route::get('/race/search', [App\Http\Controllers\API\RaceController::class, 'search'])->name('races.search');
Route::get('/type/search', [App\Http\Controllers\API\TypeController::class, 'search'])->name('types.search');
Route::get('/user/search', [App\Http\Controllers\API\UserController::class, 'search'])->name('users.search');



// Définition Manuelle des Routes :
// Route::apiResource("creatures", App\Http\Controllers\API\CreatureController::class);
// Route::apiResource("races", App\Http\Controllers\API\RaceController::class);
// Route::apiResource("types", App\Http\Controllers\API\TypeController::class);
// Route::apiResource("users", App\Http\Controllers\API\UserController::class);
