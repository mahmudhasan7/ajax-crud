<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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
    return view('ajax-crud.ajax');
});


Route::get('ajax',[HomeController::class,'index'])->name('ajax.index');
Route::post('ajax/store',[HomeController::class,'ajaxStore'])->name('ajax.store');
Route::post('ajax/fetch-data',[HomeController::class,'studentFetchData'])->name('ajax.fetch-data');
Route::post('ajax/edit',[HomeController::class,'dataedit'])->name('ajax.edit');
Route::post('ajax/update',[HomeController::class,'dataUpdate'])->name('ajax.update');
Route::post('ajax/destroy',[HomeController::class,'dataDestroy'])->name('ajax.destroy');
