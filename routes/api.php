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
Route::get('projects', [ProjectController::class,('index')]);
Route::Post('projects', [ProjectController::class,('store')]);
//Route::delete('projects',[ProjectController::class,('destroy')]);
Route::delete('projects/{id}', [TodoController::class, 'destroy']);
Route::post('projects/{id}',[ProjectController::class,('update')]);
Route::get('projects/{id}', [ProjectController::class,('show')]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {


    return $request->user();
});
