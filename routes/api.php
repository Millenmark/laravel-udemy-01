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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Sample Routes
Route::post('/samples', 'SampleController@store')->name('sample');
Route::post('/samples/{sample}', 'SampleController@update')->name('sample-update');
Route::delete('/samples/{sample}', 'SampleController@destroy')->name('sample-destroy');
