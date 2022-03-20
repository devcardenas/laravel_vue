<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

//

Route::post('login', [App\Http\Controllers\V1\Auth\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [App\Http\Controllers\V1\Auth\AuthController::class, 'logout']);

//Route::middleware('auth:sanctum')->get('user/permissions', [App\Http\Controllers\V1\UserController::class, 'getPermissions']);

/**
 * Los usuarios administrativos deberán:
 * a. Crear, modificar y eliminar (CRUD) los libros de la biblioteca
 * b. Saber que usuario tiene libros en préstamo
 */
Route::group(['middleware' => ['role:administrativo']], function () {
    Route::middleware('auth:sanctum')->post('v1/books', [App\Http\Controllers\V1\BookController::class, 'store']);
    Route::middleware('auth:sanctum')->get('v1/books/{id}', [App\Http\Controllers\V1\BookController::class, 'show']);
    Route::middleware('auth:sanctum')->put('v1/books/{id}', [App\Http\Controllers\V1\BookController::class, 'update']);
    Route::middleware('auth:sanctum')->delete('v1/books/{id}', [App\Http\Controllers\V1\BookController::class, 'destroy']);
    Route::middleware('auth:sanctum')->get('v1/admin/loans', [App\Http\Controllers\V1\BookController::class, 'getBooksOnLoan']);
});

/**
 * Tanto el rol administrativo como el rol de prestatario pueden:
 * a. Ver los libros
 */
Route::group(['middleware' => ['role:administrativo|prestatario']], function () {
    Route::middleware('auth:sanctum')->get('v1/books', [App\Http\Controllers\V1\BookController::class, 'index']);
});

/**
 * Los usuarios prestatarios deberán:
 * a. Poder pedir libros a préstamo
 * b. Regresar los libros que se tengan prestados
 */
Route::group(['middleware' => ['role:prestatario']], function () {
    Route::middleware('auth:sanctum')->post('v1/loans', [App\Http\Controllers\V1\BookOnLoanController::class, 'store']);
    Route::middleware('auth:sanctum')->get('v1/loans', [App\Http\Controllers\V1\BookOnLoanController::class, 'index']);
    Route::middleware('auth:sanctum')->put('v1/loans/{id}', [App\Http\Controllers\V1\BookOnLoanController::class, 'update']);
});

Route::middleware('auth:sanctum')->get('v1/user', [App\Http\Controllers\V1\UserController::class, 'show']);
Route::middleware('auth:sanctum')->get('v1/user/permissions', [App\Http\Controllers\V1\UserController::class, 'getPermissions']);