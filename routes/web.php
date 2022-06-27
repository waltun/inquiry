<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionPartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\InquiryProductController;
use App\Http\Controllers\ModellController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\PartOfGroupController;
use App\Http\Controllers\PartPriceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Authenticate routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'storeLogin'])->name('login.store');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.sore');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'web'])->group(function () {
    //Dashboard routes
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //Users routes
    Route::get('/users/deleted', [UserController::class, 'deleted'])->name('users.deleted');
    Route::get('/users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::get('/users/{user}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');
    Route::resource('users', UserController::class);

    //Modell routes
    Route::get('/groups/{group}/models', [ModellController::class, 'index'])->name('modells.index');
    Route::get('/groups/{group}/models/create', [ModellController::class, 'create'])->name('modells.create');
    Route::post('/groups/{group}/models', [ModellController::class, 'store'])->name('modells.store');
    Route::get('/models/{modell}/edit', [ModellController::class, 'edit'])->name('modells.edit');
    Route::patch('/models/{modell}', [ModellController::class, 'update'])->name('modells.update');
    Route::delete('/models/{modell}', [ModellController::class, 'destroy'])->name('modells.destroy');
    Route::post('/models/{modell}/replicate', [ModellController::class, 'replicate'])->name('modells.replicate');

    //Group part routes
    Route::get('/groups/{group}/add-parts', [PartOfGroupController::class, 'index'])->name('group.parts.index');
    Route::post('/groups/{group}/{part}/parts', [PartOfGroupController::class, 'store'])->name('group.parts.store');

    //Group routes
    Route::get('/groups/{group}/parts', [GroupController::class, 'parts'])->name('group.parts');
    Route::delete('/groups/{group}/{part}/destroy-part', [GroupController::class, 'destroyPart'])->name('group.destroyPart');
    Route::resource('groups', GroupController::class);

    //Part routes
    Route::get('/parts/price', [PartPriceController::class, 'index'])->name('parts.price.index');
    Route::patch('/parts/update-price', [PartPriceController::class, 'update'])->name('parts.price.update');
    Route::resource('parts', PartController::class);

    //Collection Part routes
    Route::get('/collection-parts', [CollectionPartController::class, 'index'])->name('collections.index');
    Route::get('/collection-parts/{parentPart}/add-parts', [CollectionPartController::class, 'create'])->name('collections.create');
    Route::post('/collection-parts/{parentPart}/{childPart}/parts', [CollectionPartController::class, 'store'])->name('collections.store');
    Route::get('/collection-parts/{parentPart}/parts', [CollectionPartController::class, 'parts'])->name('collections.parts');
    Route::delete('/collection-parts/{parentPart}/{childPart}/destroy', [CollectionPartController::class, 'destroy'])->name('collections.destroy');
    Route::get('/collection-parts/{parentPart}/amounts', [CollectionPartController::class, 'amounts'])->name('collections.amounts');
    Route::patch('/collection-parts/{parentPart}/store-amounts', [CollectionPartController::class, 'storeAmounts'])->name('collections.storeAmounts');

    //Inquiry routes
    Route::post('/inquiries/create/change-model', [InquiryController::class, 'changeModelAjax'])->name('inquiries.create.changeModel');
    Route::patch('/inquiries/{inquiry}/submit', [InquiryController::class, 'submit'])->name('inquiries.submit');
    Route::get('/inquiries/submitted', [InquiryController::class, 'submitted'])->name('inquiries.submitted');
    Route::get('/inquiries/priced', [InquiryController::class, 'priced'])->name('inquiries.priced');
    Route::patch('/inquiries/{inquiry}/restore', [InquiryController::class, 'restore'])->name('inquiries.restore');
    Route::delete('/inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');

    //Inquiry Product routes
    Route::get('/inquiries/{inquiry}/products', [InquiryProductController::class, 'index'])->name('inquiries.product.index');
    Route::get('/inquiries/{inquiry}/create-product', [InquiryProductController::class, 'create'])->name('inquiries.product.create');
    Route::post('/inquiries/{inquiry}/store-product', [InquiryProductController::class, 'store'])->name('inquiries.product.store');
    Route::get('/inquiries/{product}/product-amounts', [InquiryProductController::class, 'amounts'])->name('inquiries.product.amounts');
    Route::post('/inquiries/{product}/product-amounts', [InquiryProductController::class, 'storeAmounts'])->name('inquiries.product.storeAmounts');
    Route::get('/inquiries/{product}/product-details', [InquiryProductController::class, 'show'])->name('inquiries.product.show');
    Route::get('/inquiries/{product}/product-percent', [InquiryProductController::class, 'percent'])->name('inquiries.product.percent');
    Route::patch('/inquiries/{product}/product-percent', [InquiryProductController::class, 'storePercent'])->name('inquiries.product.storePercent');
    Route::delete('/inquiries/{product}/destroy', [InquiryProductController::class, 'destroy'])->name('inquiries.product.destroy');

    Route::resource('inquiries', InquiryController::class);

    //Category routes
    Route::resource('categories', CategoryController::class);
});
