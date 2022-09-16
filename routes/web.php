<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Middleware\IsAdmin;

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


Route::controller(UnitController::class)->group(function () {
    Route::get('unit', 'index')->name('index-unit');
    Route::get('create-unit', 'create')->name('create-unit');
    Route::get('unit/{id}', 'edit')->name('edit-unit');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::controller(TypeController::class)->group(function () {
    Route::get('type', 'index')->name('index-type');
});

//View Document Only
Route::get('document', [DocumentController::class, 'index'])->name('index-document');


Route::middleware([IsAdmin::class])->group(function () {
    // Router User Controller 
    Route::get('/users', [UserController::class, 'index'])->name('users');

    //Document Controller 
    Route::controller(DocumentController::class)->group(function () {
        // Route::get('document', 'index')->name('index-document');
        Route::get('data-document/{id}', 'document_data')->name('data-document');
        Route::get('add-document', 'create')->name('add-document');
        Route::get('act/{act}/{id}', 'restoreDelete')->name('resdel');
        Route::post('save-document', 'store')->name('save-document');
        Route::get('download/{slug}', function () {
            return "Download Page";
        })->name('download');
        Route::get('view/{slug}', 'show')->name('view');
        Route::get(
            'document/{id}',
            'edit'
        )->name('edit-document');
        Route::put(
            'document/{id}',
            'update'
        )->name('update-document');
        Route::get('confirm-delete/{slug}', 'confirmDelete')->name('confirm-delete');
        Route::delete('delete/{id}', 'destroy')->name('delete');
        Route::get('deleteAll/{id}', 'deleteAll')->name('deleteAll');
    });
});



require __DIR__ . '/auth.php';
