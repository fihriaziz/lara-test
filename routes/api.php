<?php

use App\Http\Controllers\api\GoalController;
use App\Http\Controllers\api\HomeController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\ProfileController;
use App\Http\Controllers\api\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', [ProfileController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index']);
    Route::post('/goal', [GoalController::class, 'goal']);
    Route::get('/goal-detail/{id}', [GoalController::class, 'goalDetail']);
    Route::post('/task', [TaskController::class, 'task']);

    Route::get('/up-comming', [GoalController::class, 'upcommingGoal']);

});

Route::post('/login', [LoginController::class,'login']);
