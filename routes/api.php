<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\VersionController;
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

Route::prefix('project')->group(function () {
    Route::get('', [ProjectController::class,('view')]);
    Route::get('s', [ProjectController::class,('viewAll')]);
    Route::Post('', [ProjectController::class,('store')]);
    Route::get('/{id}', [ProjectController::class,('show')]);
    //Route::post('/{id}',[ProjectController::class,('update')]);
    //Route::delete('projects/{id}', [TodoController::class, 'destroy']);
    //Route::delete('projects',[ProjectController::class,('destroy')]);
});

// Route::get('project', [ProjectController::class,('view')]);
// Route::get('projects', [ProjectController::class,('viewAll')]);
// Route::Post('project', [ProjectController::class,('store')]);
// Route::get('project/{id}', [ProjectController::class,('show')]);

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
Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');

Route::middleware('auth:sanctum')->group(function(){

    Route::get('/projects/{project_id}/eval', [RequestController::class,('viewEval')]);
    Route::get('/projects/{project_id}/uneval',[RequestController::class,('viewUneval')]);

    Route::get('projects/requests/{version_id}',[VersionController::class,('show')]);
    Route::get('projects/{project_id}/form/{form_id}/{request_id?}',[RequestController::class,('projectDetails')]);

    Route::post('projects/{project_id}/form/{form_id}/{request_id?}',[RequestController::class,('createRequest')]);

    Route::post('responses/version/{versoin_id}',[ResponseController::class,('createResponse')]);
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

//     return $request->user();
// });

//Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');

