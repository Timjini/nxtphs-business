<?php

use App\Http\Controllers\API\Camp\CampController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::get('status', function () {
        return response()->json(['status' => 'API is working']);
    });

    Route::apiResource('camps', CampController::class);
});