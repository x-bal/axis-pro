<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\CaseListController;
use App\Http\Controllers\ClaimDocumentController;
use App\Http\Controllers\FeeBasedController;
use App\Http\Controllers\FileSurveyController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ReportDuaController;
use App\Http\Controllers\ReportEmpatController;
use App\Http\Controllers\ReportLimaController;
use App\Http\Controllers\ReportSatuController;
use App\Http\Controllers\ReportTigaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('/case-list', CaseListController::class);
    Route::resource('/cause-of-loss', IncidentController::class);
    Route::resource('/type-of-business', PolicyController::class);
    Route::resource('/broker', BrokerController::class);
    Route::resource('/fee-based', FeeBasedController::class);
    Route::resource('/bank', BankController::class);
    Route::resource('/insurance', InsuranceController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/permission', PermissionController::class);

    Route::resource('file-survey', FileSurveyController::class);
    Route::resource('claim-document', ClaimDocumentController::class);
    Route::resource('report-satu', ReportSatuController::class);
    Route::resource('report-dua', ReportDuaController::class);
    Route::resource('report-tiga', ReportTigaController::class);
    Route::resource('report-empat', ReportEmpatController::class);
    Route::resource('report-lima', ReportLimaController::class);
});