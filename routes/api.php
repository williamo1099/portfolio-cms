<?php

use App\Http\Controllers\API\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:60,1')->group(function () {
    Route::get('/projects/{type?}', [ProjectController::class, 'getProjects']);
});
