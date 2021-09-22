<?php

use App\Http\Controllers\{
    BankController,
    BrokerController,
    CaseListController,
    ClaimDocumentController,
    ExpenseController,
    FeeBasedController,
    FileSurveyController,
    IncidentController,
    InsuranceController,
    InvoiceController,
    PermissionController,
    PolicyController,
    ReportDuaController,
    ReportEmpatController,
    ReportLimaController,
    ReportSatuController,
    ReportTigaController,
    RoleController,
    UserController
};
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::post('/case-list/status', [CaseListController::class, 'status'])->name('caselist.status');
    Route::post('/case-list/ir-status', [CaseListController::class, 'irstatus']);
    Route::post('/case-list/getcase', [CaseListController::class, 'getcase']);
    Route::post('/case-list/laporan', [CaseListController::class, 'laporan'])->name('caselist.laporan');
    Route::post('/case-list/excel', [CaseListController::class, 'excel'])->name('caselist.excel');
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
    Route::post('/invoice/laporan', [InvoiceController::class, 'laporan'])->name('invoice.laporan');
    Route::post('/invoice/excel', [InvoiceController::class, 'excel'])->name('invoice.excel');
    Route::resource('invoice', InvoiceController::class);
    Route::resource('expense', ExpenseController::class);
    Route::resource('file-survey', FileSurveyController::class);
    Route::resource('claim-document', ClaimDocumentController::class);
    Route::resource('report-satu', ReportSatuController::class);
    Route::resource('report-dua', ReportDuaController::class);
    Route::resource('report-tiga', ReportTigaController::class);
    Route::resource('report-empat', ReportEmpatController::class);
    Route::resource('report-lima', ReportLimaController::class);
});
