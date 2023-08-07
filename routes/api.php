<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Models\Project;
use App\Models\Request as ModelsRequest;

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

Route::prefix('projects')->group(function () {
    Route::get('', [ProjectController::class,('view')]);
    Route::Post('', [ProjectController::class,('store')]);
    Route::get('/{id}', [ProjectController::class,('show')]);
    //Route::post('/{id}',[ProjectController::class,('update')]);
    //Route::delete('projects/{id}', [TodoController::class, 'destroy']);
    //Route::delete('projects',[ProjectController::class,('destroy')]);
});

Route::prefix('users')->group(function () {
    //Route::get('', [ProjectController::class,('index')]);
    //Route::Post('', [ProjectController::class,('store')]);
    Route::post('/{id}',[UserController::class,('update')]);
    Route::get('/{id}', [UserController::class,('show')]);
    //Route::delete('projects/{id}', [TodoController::class, 'destroy']);
    //Route::delete('projects',[ProjectController::class,('destroy')]);

});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::get('logout', 'logout');
    //Route::post('refresh', 'refresh');
});

Route::get('/evel', [RequestController::class,('view')]);
Route::get('/uneval',[RequestController::class,('view')]);
Route::get('/{id}',[RequestController::class,('show')]);

Route::get('projects/{project_id}/form/{form_id}/{request_id?}',[RequestController::class,('projectDetails')]);
Route::post('projects/{id}/SNA',[RequestController::class,('create')]);

Route::get('/WIR',[RequestController::class,('projectDetails')]);
Route::post('/WIR',[RequestController::class,('create')]);


Route::prefix('responses')
->group(function () {
Route::get('/{id}',[ResponseController::class,('show')]);

Route::get('/SNA',[ResponseController::class,('projectDetails')]);
Route::get('/SNA',[ResponseController::class,('create')]);

Route::get('/WIR',[ResponseController::class,('projectDetails')]);
Route::get('/WIR',[ResponseController::class,('create')]);

});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});

//Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');

