<?php

use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MentionController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'welcome'])->name('home');

Route::resource('etablissements', EtablissementController::class);
Route::resource('mentions', MentionController::class);

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/kpi/classement', [App\Http\Controllers\KpiClassementController::class, 'create'])->name('kpi.classement.create');
    Route::post('/kpi/classement', [App\Http\Controllers\KpiClassementController::class, 'store'])->name('kpi.classement.store');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/kpis', [App\Http\Controllers\KpiController::class, 'index'])->name('kpis.index');
    Route::get('/kpis/create', [App\Http\Controllers\KpiController::class, 'create'])->name('kpis.create');
    Route::post('/kpis', [App\Http\Controllers\KpiController::class, 'store'])->name('kpis.store');
    Route::get('/kpis/{kpi}/edit', [App\Http\Controllers\KpiController::class, 'edit'])->name('kpis.edit');
    Route::put('/kpis/{kpi}', [App\Http\Controllers\KpiController::class, 'update'])->name('kpis.update');
});