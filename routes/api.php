<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PerfexController;
use App\Http\Controllers\WhmcsController;

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


Route::get('/whmcs/invoices', [WhmcsController::class, 'index'])->name('api.whmcs.invoices');
Route::get('/whmcs/clients', [WhmcsController::class, 'getClients'])->name('api.whmcs.clients');

Route::get('/perfex/invoices', [PerfexController::class, 'index'])->name('api.perfex.invoices');
Route::get('/perfex/clients', [PerfexController::class, 'getClients'])->name('api.perfex.clients');
