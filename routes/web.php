<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetConditionController;
use App\Http\Controllers\AssetInventoryController;
use App\Http\Controllers\AssetInventoryUnitController;


Route::get('/', function () {
    return view('template');
});


Route::prefix('master')->name('master.')->group(function () {
    // KATEGORI ASET
    Route::prefix('kategori')->name('categories.')->group(function () {
        Route::get('/', [AssetCategoryController::class, 'index'])->name('index');
        Route::post('/', [AssetCategoryController::class, 'store'])->name('store');
        #Route::get('edit/{category}', [AssetCategoryController::class, 'edit'])->name('edit');
        Route::put('{category}', [AssetCategoryController::class, 'update'])->name('update');
        Route::get('detail/{category}', [AssetCategoryController::class, 'show'])->name('show');
    });

    // KONDISI ASET
    Route::prefix('kondisi')->name('conditions.')->group(function () {
        Route::get('/', [AssetConditionController::class, 'index'])->name('index');
        Route::post('/', [AssetConditionController::class, 'store'])->name('store');
        #Route::get('edit/{condition}', [AssetConditionController::class, 'edit'])->name('edit');
        Route::put('{condition}', [AssetConditionController::class, 'update'])->name('update');
        Route::get('detail/{condition}', [AssetConditionController::class, 'show'])->name('show');
    });

    // SATUAN INVENTORY
    Route::prefix('satuan')->name('units.')->group(function () {
        Route::get('/', [AssetInventoryUnitController::class,'index'])->name('index');
        Route::post('/', [AssetInventoryUnitController::class,'store'])->name('store');
        #Route::get('edit/{unit}', [AssetInventoryUnitController::class, 'edit'])->name('edit');
        Route::put('{unit}', [AssetInventoryUnitController::class,'update'])->name('update');
        Route::get('detail/{unit}', [AssetInventoryUnitController::class,'show'])->name('show');
    });

    // PIC / USER
    Route::prefix('pic')->name('pic.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::put('{user}', [UserController::class, 'update'])->name('update');
        Route::get('detail/{user}', [UserController::class, 'show'])->name('show');
        Route::get('{user}', [UserController::class, 'destroy'])->name('destroy');
    });

});

Route::prefix('inventori')->name('inventories.')->group(function () {
    Route::get('/', [AssetInventoryController::class, 'index'])->name('index');
    Route::get('create', [AssetInventoryController::class, 'create'])->name('create');
    Route::post('/', [AssetInventoryController::class, 'store'])->name('store');
    Route::put('{asset}', [AssetInventoryController::class, 'update'])->name('update');

    Route::prefix('stok')->name('stocks.')->group(function () {

        Route::prefix('/masuk')->name('in.')->group(function () {
            Route::get('/', [StockController::class, 'index_in'])->name('create');
            Route::post('/', [StockController::class, 'store'])->name('store');
        });

        Route::prefix('/keluar')->name('out.')->group(function () {
            Route::get('/', [StockController::class, 'index_out'])->name('create');
            Route::post('/', [StockController::class, 'store'])->name('store');
        });
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('master')->name('master.')->group(function () {
    // KATEGORI ASET
        Route::prefix('kategori')->name('categories.')->group(function () {
            Route::get('/', [AssetCategoryController::class, 'index'])->name('index');
            Route::post('/', [AssetCategoryController::class, 'store'])->name('store');
            #Route::get('edit/{category}', [AssetCategoryController::class, 'edit'])->name('edit');
            Route::put('{category}', [AssetCategoryController::class, 'update'])->name('update');
            Route::get('detail/{category}', [AssetCategoryController::class, 'show'])->name('show');
        });

        // KONDISI ASET
        Route::prefix('kondisi')->name('conditions.')->group(function () {
            Route::get('/', [AssetConditionController::class, 'index'])->name('index');
            Route::post('/', [AssetConditionController::class, 'store'])->name('store');
            #Route::get('edit/{condition}', [AssetConditionController::class, 'edit'])->name('edit');
            Route::put('{condition}', [AssetConditionController::class, 'update'])->name('update');
            Route::get('detail/{condition}', [AssetConditionController::class, 'show'])->name('show');
        });

        // SATUAN INVENTORY
        Route::prefix('satuan')->name('units.')->group(function () {
            Route::get('/', [AssetInventoryUnitController::class,'index'])->name('index');
            Route::post('/', [AssetInventoryUnitController::class,'store'])->name('store');
            #Route::get('edit/{unit}', [AssetInventoryUnitController::class, 'edit'])->name('edit');
            Route::put('{unit}', [AssetInventoryUnitController::class,'update'])->name('update');
            Route::get('detail/{unit}', [AssetInventoryUnitController::class,'show'])->name('show');
        });

        // PIC / USER
        Route::prefix('pic')->name('pic.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::put('{user}', [UserController::class, 'update'])->name('update');
            Route::get('detail/{user}', [UserController::class, 'show'])->name('show');
            Route::get('{user}', [UserController::class, 'destroy'])->name('destroy');
        });

    });

});


require __DIR__.'/auth.php';
