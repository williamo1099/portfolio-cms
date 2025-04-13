<?php

use App\Http\Controllers\API\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/projects/{type?}', [ProjectController::class, 'getProjects']);
