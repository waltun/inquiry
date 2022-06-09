<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\InquiryController;
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

    //Group part routes
    Route::get('/groups/{group}/all-parts', [PartOfGroupController::class, 'index'])->name('group.parts.index');
    Route::post('/groups/{group}/{part}/parts', [PartOfGroupController::class, 'store'])->name('group.parts.store');

    //Group routes
    Route::get('/groups/{group}/parts', [GroupController::class, 'parts'])->name('group.parts');
    Route::delete('/groups/{group}/{part}/destroy-part', [GroupController::class, 'destroyPart'])->name('group.destroyPart');
    Route::resource('groups', GroupController::class);

    //Part routes
    Route::get('/parts/price', [PartPriceController::class, 'index'])->name('parts.price.index');
    Route::get('/parts/{part}/price', [PartPriceController::class, 'edit'])->name('parts.price.edit');
    Route::patch('/parts/{part}/price', [PartPriceController::class, 'update'])->name('parts.price.update');
    Route::resource('parts', PartController::class);

    //Inquiry routes
    Route::post('/inquiries/create/change-model', [InquiryController::class, 'changeModelAjax'])->name('inquiries.create.changeModel');
    Route::get('/inquiries/{inquiry}/amounts', [InquiryController::class, 'amounts'])->name('inquiries.amounts');
    Route::post('/inquiries/{inquiry}/amounts', [InquiryController::class, 'storeAmounts'])->name('inquiries.storeAmounts');
    Route::resource('inquiries', InquiryController::class);
});
