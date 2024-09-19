<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


/*
|--------------------------------------------------------------------------|
|   Configuration Dynamique des Routes API                                 |
|--------------------------------------------------------------------------|
*/
$resources = [
    'creatures' => App\Http\Controllers\API\CreatureController::class,
    'races' => App\Http\Controllers\API\RaceController::class,
    'types' => App\Http\Controllers\API\TypeController::class,
    'users' => App\Http\Controllers\API\UserController::class,
];

foreach ($resources as $resource => $controller) {
    Route::apiResource($resource, $controller);
}


/*
|--------------------------------------------------------------------------|
|   Définition Manuelle des Routes API                                     |
|--------------------------------------------------------------------------|
*/
// Route::apiResource("creatures", App\Http\Controllers\API\CreatureController::class);
// Route::apiResource("races", App\Http\Controllers\API\RaceController::class);
// Route::apiResource("types", App\Http\Controllers\API\TypeController::class);
// Route::apiResource("users", App\Http\Controllers\API\UserController::class);
