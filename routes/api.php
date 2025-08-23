<?php

use App\Http\Resources\Api\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Middleware\CheckToken;

Route::get('/me', function (Request $request) {
    $user = $request->user();

    return response()->json([
        'content' => new UserResource($user),
        'message' => 'Data found'
    ]);
})->middleware(['auth:api',  CheckToken::using('email', 'profile')]);
