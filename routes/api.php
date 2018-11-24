<?php

use Illuminate\Http\Request;

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

Route::post("/create", "Engine@createContainer");
Route::post("/pageload", "Engine@pageLoad");
Route::post("/run", "Engine@run");
Route::post("/reset", "Engine@resetUserCode");
Route::post("/final", "Engine@setFinalCode");
Route::post("/update", "Engine@updateContainerRunnerApplication");

