<?php

use App\Http\Controllers\AjaxController;
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

Route::get('currency', [AjaxController::class, 'currency']);
Route::get('caselist/{id}', [AjaxController::class, 'caselist']);
Route::get('insurance/{id}', [AjaxController::class, 'insurance']);
Route::get('autocomplete', [AjaxController::class, 'TheAutoCompleteFunc']);
Route::get('invoice/export', [AjaxController::class, 'invoiceExport'])->name('invoice.export');
Route::get('/chart/caselist', [AjaxController::class, 'ChartCaseList']);
Route::get('/count/{id}', [AjaxController::class, 'count']);