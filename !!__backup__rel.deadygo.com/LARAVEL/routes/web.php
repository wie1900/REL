<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ExpController;
use App\Http\Controllers\RevController;
use App\Http\Controllers\ContController;
use App\Http\Controllers\CustController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\ItemTypeController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Event;

Auth::routes(['register'=>false]);
Route::get('logindemo/{user}', [DemoController::class, 'logindemo']);

Route::group(['middleware' => 'auth'], function(){

    Route::get('/', function () {
        return redirect('/rel');
    })->name('home');

    Route::controller(PdfController::class)->group(function () {
        Route::get('pdfs', 'index');
        Route::get('clearpdfs', 'clear');
    });

    Route::controller(BalanceController::class)->group(function () {
        Route::get('rel', 'index');
        Route::get('total', 'total');
        Route::get('year/{id}', 'year');
        Route::get('month/{id}', 'month');
    });

    Route::controller(RevController::class)->group(function () {
        Route::prefix('revenues')->group(function () {
            Route::get('/', 'index')->name('revenues');
            Route::get('/{id}/edit', 'edit')->name('revenues_edit');
            Route::post('/update', 'update');
            Route::get('/{id}/create', 'create');
            Route::post('/store', 'store');
            Route::get('/{id}/showpdf', 'showpdf')->name('showpdf');
            Route::get('/{id}/printpdf', 'printpdf')->name('printpdf');
            Route::get('/{id}/warning', 'warning')->name('revenues_warning');
            Route::get('/{id}/{backurl}/delete', 'destroy');
        });
    });

    Route::controller(ExpController::class)->group(function () {
        Route::prefix('expenses')->group(function () {
            Route::get('/', 'index')->name('expenses');
            Route::get('/{id}/edit', 'edit')->name('expenses_edit');
            Route::post('/update', 'update');
            Route::get('/{id}/create', 'create');
            Route::post('/store', 'store');
            Route::get('/{id}/warning', 'warning');
            Route::get('/{id}/{backurl}/delete', 'destroy');
        });
    });

    Route::controller(CustController::class)->group(function () {
        Route::prefix('customers')->group(function () {
            Route::get('/', 'index')->name('customers');
            Route::get('/create', 'create');
            Route::get('/{id}/edit', 'edit');
            Route::post('/store', 'store');
            Route::post('/update', 'update');
            Route::get('/{id}/warning', 'warning');
            Route::get('/{id}/delete', 'destroy');
        });
    });

    Route::controller(ContController::class)->group(function () {
        Route::prefix('contractors')->group(function () {
            Route::get('/', 'index')->name('contractors');
            Route::get('/create', 'create');
            Route::get('/{id}/edit', 'edit');
            Route::post('/store', 'store');
            Route::post('/update', 'update');
            Route::get('/{id}/warning', 'warning');
            Route::get('/{id}/delete', 'destroy');
        });
    });

    Route::controller(ItemTypeController::class)->group(function () {
        Route::prefix('itemtypes')->group(function () {
            Route::get('/', 'index')->name('itemtypes');
            Route::get('/create', 'create');
            Route::post('/update', 'update');
            Route::get('/{id}/edit', 'edit');
            Route::post('/store', 'store');
            Route::get('/{id}/warning', 'warning');
            Route::get('/{id}/delete', 'destroy');
        });
    });
});

Route::get('/{any}', function() {
    return redirect()->route('login');
})->where('any', '.*');
