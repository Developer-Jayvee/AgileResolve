<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
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

    });

    Route::controller(ProjectController::class)->prefix('project')->group(function(){
        Route::get('/list','projectList');
        Route::post('/create','projectCreate');
        Route::patch('/{project}/update','projectUpdate')->missing(function (Request $request) {
           return response()->json(['message' => 'Project does not exists.'],500);
        });
        Route::delete('/{project}/delete','projectDelete')->missing(function (Request $request) {
           return response()->json(['message' => 'Project does not exists.'],500);
        });
    });
    Route::controller(RoleController::class)->prefix('role')->group(function(){
        Route::get('/list','roleList');
        Route::post('/create','roleCreate');
        Route::patch('/{role}/update','roleUpdate')->missing(function (Request $request) {
           return response()->json(['message' => 'Role does not exists.'],500);
        });
        Route::delete('/{role}/delete','roleDelete')->missing(function (Request $request) {
           return response()->json(['message' => 'Role does not exists.'],500);
        });
    });

    Route::controller(UserController::class)->prefix('user')->group(function(){
        Route::get('/list','userList');
        Route::post('/create','userCreate');
        Route::patch('/{user}/update','userUpdate')->missing(function (Request $request) {
           return response()->json(['message' => 'User does not exists.'],500);
        });
        Route::delete('/{user}/delete','userDelete')->missing(function (Request $request) {
           return response()->json(['message' => 'User does not exists.'],500);
        });
    });
});

