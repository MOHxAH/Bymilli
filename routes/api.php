<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Project;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('projects')
->group(function () {
    Route::get('', [ProjectController::class,('view')]);
    Route::Post('', [ProjectController::class,('store')]);
    Route::get('/{id}', [ProjectController::class,('show')]);
    //Route::post('/{id}',[ProjectController::class,('update')]);
    //Route::delete('projects/{id}', [TodoController::class, 'destroy']);
    //Route::delete('projects',[ProjectController::class,('destroy')]);

});

Route::prefix('users')
->group(function () {
    //Route::get('', [ProjectController::class,('index')]);
    //Route::Post('', [ProjectController::class,('store')]);
    Route::post('/{id}',[UserController::class,('update')]);
    Route::get('/{id}', [UserController::class,('show')]);
    //Route::delete('projects/{id}', [TodoController::class, 'destroy']);
    //Route::delete('projects',[ProjectController::class,('destroy')]);

});





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});
