<?php


use Illuminate\Support\Facades\Route;
use Modules\Area\Http\Controllers\Api\AreaController;

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


Route::prefix('v1/Area')->middleware(['checkApiKey'])->group(function () {

    Route::post('createZipCode', [AreaController::class, 'CreateNewZipCode']);
    Route::put('updateZipCode', [AreaController::class, 'UpdateZipCode']);
    Route::delete('deleteZipCode', [AreaController::class, 'DeleteZipCode']);

    Route::get('getStates', [AreaController::class, 'getStates']);
    Route::get('getAreas', [AreaController::class, 'getAreas']);
    Route::get('getZipCodes', [AreaController::class, 'getZipCodes']);

});


