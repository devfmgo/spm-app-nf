<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\DocumentController;

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

Route::controller(DocumentController::class)->group(function () {
    Route::get('document', 'index')->name('index-document');
    Route::get('data-document', 'document_data')->name('data-document');
    Route::get('add-document', 'create')->name('add-document');
    Route::post('save-document', 'store')->name('save-document');
    Route::get('download/{slug}', function () {
        return "Download Page";
    })->name('download');
    Route::get('view/{slug}', 'show')->name('view');
    Route::get('document/{id}', 'edit')->name('edit-document');
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


require __DIR__ . '/auth.php';
