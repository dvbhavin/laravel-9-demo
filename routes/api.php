<?php
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\API\LoginApiController;
use App\Http\Controllers\MakeApiRequestController;
  
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
  
Route::post('login', [LoginApiController::class, 'login']);
Route::post('store_student',[MakeApiRequestController::class,'store']);
Route::middleware('auth:api')->group( function () {
    Route::post('logout', [LoginApiController::class, 'logout']);
});