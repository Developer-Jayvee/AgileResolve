<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::prefix('v1')->group(function(){
    Route::prefix('user')->group(function(){
        Route::post('login',[AuthController::class,'login']);
    });

    Route::prefix('admin')->group(function(){
        Route::controller(AdminController::class)->prefix('project')->group(function(){
            Route::get('/list','projectList');
            Route::post('/create','projectCreate');
            Route::patch('/{project}/update','projectUpdate');
            Route::delete('/{project}/delete','projectDelete');
        });
    });
});

