<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Traits\ResponseTrait;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::prefix('v1')->group(function(){
    Route::prefix('user')->group(function(){
        Route::post('login',[AuthController::class,'login']);
    });

    Route::prefix('admin')->group(function(){
        Route::apiResource('role',RoleController::class);
        Route::apiResource('project',ProjectController::class);
        Route::apiResource('user',UserController::class);
        Route::apiResource('ticket',TicketController::class);
    });
    Route::prefix('client')->group(function () {
        Route::apiResource('project',ProjectController::class);
        Route::apiResource('ticket',TicketController::class);
    });

    
    Route::apiResource('role',RoleController::class);
    Route::apiResource('project',ProjectController::class);
    Route::apiResource('user',UserController::class);
    Route::apiResource('ticket',TicketController::class);
});

