<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JobApiController;

Route::get('/jobs', [JobApiController::class, 'index']);
Route::get('/jobs/{id}', [JobApiController::class, 'show']);