<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodosController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/getalltodos',[TodosController::class,'index']);
Route::get('/gettodo/{todo}',[TodosController::class,'show']);
Route::post('/createtodo',[TodosController::class,'create']);
Route::post('/edit/{todoId}',[TodosController::class,'edit']);
Route::delete('/delete/{todoId}',[TodosController::class,'destroy']);
Route::post('/finishtodo/{todoId}',[TodosController::class,'finish']);