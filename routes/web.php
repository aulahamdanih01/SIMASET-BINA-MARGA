<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('template');
});


Route::prefix('master/')->name('master.')->group(function () {

    Route::prefix('kategori')->name('category.')->group(function () {
        Route::get('/', function () {return view('master.category.index');});
        Route::get('edit', function () {return view('master.category.edit');});
        Route::get('detail', function () {return view('master.category.show');});
});
    Route::prefix('kondisi')->name('condition.')->group(function () {
        Route::get('/', function () {return view('master.condition.index');});
        Route::get('edit', function () {return view('master.condition.edit');});
        Route::get('detail', function () {return view('master.condition.show');});
});
    Route::prefix('satuan')->name('unit.')->group(function () {
        Route::get('/', function () {return view('master.unit.index');});
        Route::get('edit', function () {return view('master.unit.edit');});
        Route::get('detail', function () {return view('master.unit.show');});
});
    Route::prefix('pic')->name('pic.')->group(function () {
        Route::get('/', function () {return view('master.pic.index');});
        Route::get('edit', function () {return view('master.pic.edit');});
        Route::get('detail', function () {return view('master.pic.show');});
});
    
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
