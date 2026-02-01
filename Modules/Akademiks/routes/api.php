<?php

use Illuminate\Support\Facades\Route;
use Modules\Akademiks\Http\Controllers\AkademiksController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('akademiks', AkademiksController::class)->names('akademiks');
});
