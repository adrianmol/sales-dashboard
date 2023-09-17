<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SalesController;
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

//
//Route::prefix('dashboard')->group(function () {
//    Route::get('/analytics', function () {
//        return view('pages.dashboard.analytics', ['title' => 'CORK Admin - Multipurpose Bootstrap Dashboard Template', 'breadcrumb' => 'This Breadcrumb']);
//    })->name('analytics');
//
//    Route::get('/sales', [SalesController::class, 'index'])->name('dashboard.sales.index');
//});

Route::get('/', [SalesController::class, 'index'])->name('sales.index');
