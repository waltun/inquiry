<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalculateCoilController;
use App\Http\Controllers\CalculateDamperController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionPartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\InquiryProductController;
use App\Http\Controllers\ModellController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\PartOfGroupController;
use App\Http\Controllers\PartOfModellController;
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
    Route::get('/models/{modell}/add-parts', [PartOfModellController::class, 'index'])->name('modells.parts.index');
    Route::post('/models/{modell}/{part}/parts', [PartOfModellController::class, 'store'])->name('modells.parts.store');
    Route::get('/models/{modell}/parts', [ModellController::class, 'parts'])->name('modells.parts');
    Route::delete('/models/{modell}/{part}/destroy-part', [ModellController::class, 'destroyPart'])->name('modells.destroyPart');
    Route::post('/models/{modell}/part-value', [ModellController::class, 'partValues'])->name('modells.partValues');

    //Group part routes
    Route::get('/groups/{group}/add-parts', [PartOfGroupController::class, 'index'])->name('group.parts.index');
    Route::post('/groups/{group}/{part}/parts', [PartOfGroupController::class, 'store'])->name('group.parts.store');

    //Group routes
    Route::get('/groups/{group}/parts', [GroupController::class, 'parts'])->name('group.parts');
    Route::delete('/groups/{group}/{part}/destroy-part', [GroupController::class, 'destroyPart'])->name('group.destroyPart');
    Route::post('/groups/{group}/part-value', [GroupController::class, 'partValues'])->name('group.partValues');
    Route::resource('groups', GroupController::class);

    //Part routes
    Route::get('/parts/price', [PartPriceController::class, 'index'])->name('parts.price.index');
    Route::patch('/parts/update-price', [PartPriceController::class, 'update'])->name('parts.price.update');
    Route::post('/parts/{part}/replicate', [PartController::class, 'replicate'])->name('parts.replicate');
    Route::post('/parts/getCategory', [PartController::class, 'getCategory'])->name('parts.getCategory');
    Route::resource('parts', PartController::class)->except(['show']);

    //Collection Part routes
    Route::get('/collection-parts', [CollectionPartController::class, 'index'])->name('collections.index');
    Route::get('/collection-parts/{parentPart}/add-parts', [CollectionPartController::class, 'create'])->name('collections.create');
    Route::post('/collection-parts/{parentPart}/{childPart}/parts', [CollectionPartController::class, 'store'])->name('collections.store');
    Route::delete('/collection-parts/{parentPart}/{childPart}/destroy-part', [CollectionPartController::class, 'destroyPart'])->name('collections.destroyPart');
    Route::get('/collection-parts/{parentPart}/parts', [CollectionPartController::class, 'parts'])->name('collections.parts');
    Route::delete('/collection-parts/{parentPart}/destroy', [CollectionPartController::class, 'destroy'])->name('collections.destroy');
    Route::get('/collection-parts/{parentPart}/amounts', [CollectionPartController::class, 'amounts'])->name('collections.amounts');
    Route::patch('/collection-parts/{parentPart}/store-amounts', [CollectionPartController::class, 'storeAmounts'])->name('collections.storeAmounts');
    Route::post('/collection-parts/{parentPart}/replicate', [CollectionPartController::class, 'replicate'])->name('collections.replicate');

    //Inquiry routes
    Route::post('/inquiries/create/change-model', [InquiryController::class, 'changeModelAjax'])->name('inquiries.create.changeModel');
    Route::patch('/inquiries/{inquiry}/submit', [InquiryController::class, 'submit'])->name('inquiries.submit');
    Route::get('/inquiries/submitted', [InquiryController::class, 'submitted'])->name('inquiries.submitted');
    Route::get('/inquiries/priced', [InquiryController::class, 'priced'])->name('inquiries.priced');
    Route::post('/inquiries/{inquiry}/copy', [InquiryController::class, 'copy'])->name('inquiries.copy');
    Route::patch('/inquiries/{inquiry}/correction', [InquiryController::class, 'correction'])->name('inquiries.correction');
    Route::delete('/inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');
    Route::get('/inquiries/products/{inquiry}', [InquiryController::class, 'products'])->name('inquiries.products');

    //Inquiry Product routes
    Route::get('/inquiries/{inquiry}/products', [InquiryProductController::class, 'index'])->name('inquiries.product.index');
    Route::get('/inquiries/{inquiry}/create-product', [InquiryProductController::class, 'create'])->name('inquiries.product.create');
    Route::post('/inquiries/{inquiry}/store-product', [InquiryProductController::class, 'store'])->name('inquiries.product.store');
    Route::get('/inquiries/{product}/product-amounts', [InquiryProductController::class, 'amounts'])->name('inquiries.product.amounts');
    Route::post('/inquiries/{product}/product-amounts', [InquiryProductController::class, 'storeAmounts'])->name('inquiries.product.storeAmounts');
    Route::get('/inquiries/{product}/product-details', [InquiryProductController::class, 'show'])->name('inquiries.product.show');
    Route::get('/inquiries/{product}/product-percent', [InquiryProductController::class, 'percent'])->name('inquiries.product.percent');
    Route::patch('/inquiries/{product}/product-percent', [InquiryProductController::class, 'storePercent'])->name('inquiries.product.storePercent');
    Route::get('/inquiries/{product}/edit-product', [InquiryProductController::class, 'edit'])->name('inquiries.product.edit');
    Route::patch('/inquiries/{product}/update-product', [InquiryProductController::class, 'update'])->name('inquiries.product.update');
    Route::delete('/inquiries/{product}/destroy', [InquiryProductController::class, 'destroy'])->name('inquiries.product.destroy');

    Route::resource('inquiries', InquiryController::class);

    //Category routes
    Route::resource('categories', CategoryController::class);

    //Calculate coil routes
    Route::get('/calculate/coil/evaperator/{part}/{product}', [CalculateCoilController::class, 'evaperator'])->name('calculateCoil.evaperator.index');
    Route::get('/calculate/coil/water-cold/{part}/{product}', [CalculateCoilController::class, 'waterCold'])->name('calculateCoil.waterCold.index');
    Route::get('/calculate/coil/water-warm/{part}/{product}', [CalculateCoilController::class, 'waterWarm'])->name('calculateCoil.waterWarm.index');
    Route::get('/calculate/coil/condensor/{part}/{product}', [CalculateCoilController::class, 'condensor'])->name('calculateCoil.condensor.index');
    Route::get('/calculate/coil/fancoil/{part}/{product}', [CalculateCoilController::class, 'fancoil'])->name('calculateCoil.fancoil.index');
    Route::post('/calculate/coil/{part}/{product}/post-evaperator', [CalculateCoilController::class, 'storeEvaperator'])
        ->name('calculateCoil.storeEvaperator');
    Route::post('/calculate/coil/{part}/{product}/post-condensor', [CalculateCoilController::class, 'storeCondensor'])
        ->name('calculateCoil.storeCondensor');
    Route::post('/calculate/coil/{part}/{product}/post-fancoil', [CalculateCoilController::class, 'storeFancoil'])
        ->name('calculateCoil.storeFancoil');
    Route::post('/calculate/coil/{part}/{product}/post-water-cold', [CalculateCoilController::class, 'storeWaterCold'])
        ->name('calculateCoil.storeWaterCold');
    Route::post('/calculate/coil/{part}/{product}/post-water-warm', [CalculateCoilController::class, 'storeWaterWarm'])
        ->name('calculateCoil.storeWaterWarm');
    Route::post('/calculate/coil/getData', [CalculateCoilController::class, 'getData'])->name('calculateCoil.getData');

    //Calculate damper routes
    Route::get('/calculate/damperTaze/{part}/{product}', [CalculateDamperController::class, 'taze'])->name('calculateDamper.taze.index');
    Route::get('/calculate/damperRaft/{part}/{product}', [CalculateDamperController::class, 'raft'])->name('calculateDamper.raft.index');
    Route::get('/calculate/damperBargasht/{part}/{product}', [CalculateDamperController::class, 'bargasht'])->name('calculateDamper.bargasht.index');
    Route::get('/calculate/damperExast/{part}/{product}', [CalculateDamperController::class, 'exast'])->name('calculateDamper.exast.index');
    Route::post('/calculate/damper/{part}/{product}/post', [CalculateDamperController::class, 'store'])->name('calculateDamper.store');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/notifications/read', [NotificationController::class, 'read'])->name('notifications.read');
    Route::delete('/notifications/{notification}/destroy', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});
