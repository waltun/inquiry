<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalculateCoilController;
use App\Http\Controllers\CalculateConverterController;
use App\Http\Controllers\CalculateDamperController;
use App\Http\Controllers\CalculateElectricalController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionCoilController;
use App\Http\Controllers\CollectionPartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\InquiryPartCoilController;
use App\Http\Controllers\InquiryPartController;
use App\Http\Controllers\InquiryPartElectricalController;
use App\Http\Controllers\InquiryPriceController;
use App\Http\Controllers\InquiryProductController;
use App\Http\Controllers\ModellController;
use App\Http\Controllers\NewPartInquiryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\PartOfGroupController;
use App\Http\Controllers\PartOfModellController;
use App\Http\Controllers\PartPriceController;
use App\Http\Controllers\SeparateCalculateCoilController;
use App\Http\Controllers\SeparateCalculateConverter;
use App\Http\Controllers\SeparateCalculateDamperController;
use App\Http\Controllers\SeparateCalculateElectricalController;
use App\Http\Controllers\SettingController;
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
    Route::patch('/parts/price/{part}/update-date', [PartPriceController::class, 'updateDate'])->name('parts.price.updateDate');
    Route::post('/parts/price/multi-update-date', [PartPriceController::class, 'multiUpdateDate'])->name('parts.price.multi-update-date');
    Route::resource('parts', PartController::class)->except(['show']);

    //Collection Part routes
    Route::get('/collection-parts', [CollectionPartController::class, 'index'])->name('collections.index');
    Route::get('/collection-parts/{parentPart}/add-parts', [CollectionPartController::class, 'create'])->name('collections.create');
    Route::post('/collection-parts/{parentPart}/{childPart}/parts', [CollectionPartController::class, 'store'])->name('collections.store');
    Route::post('/collection-parts/{parentPart}/{childPart}/destroy-part', [CollectionPartController::class, 'destroyPart'])->name('collections.destroyPart');
    Route::get('/collection-parts/{parentPart}/parts', [CollectionPartController::class, 'parts'])->name('collections.parts');
    Route::delete('/collection-parts/{parentPart}/destroy', [CollectionPartController::class, 'destroy'])->name('collections.destroy');
    Route::get('/collection-parts/{parentPart}/amounts', [CollectionPartController::class, 'amounts'])->name('collections.amounts');
    Route::patch('/collection-parts/{parentPart}/store-amounts', [CollectionPartController::class, 'storeAmounts'])->name('collections.storeAmounts');
    Route::post('/collection-parts/{parentPart}/replicate', [CollectionPartController::class, 'replicate'])->name('collections.replicate');
    Route::post('/collection-parts/{parentPart}/change-parts', [CollectionPartController::class, 'changeParts'])->name('collections.changeParts');
    Route::get('/collection-parts/{parentPart}/print', [CollectionPartController::class, 'print'])->name('collections.print');

    //Collection Coils routes
    Route::get('/collection-coil', [CollectionCoilController::class, 'index'])->name('collectionCoil.index');
    Route::post('/collection-coil/multi-delete', [CollectionCoilController::class, 'multiDelete'])->name('collectionCoil.multiDelete');

    //Inquiry routes
    Route::post('/inquiries/create/select-model-group', [InquiryController::class, 'selectModelByGroup'])->name('inquiries.create.selectModelByGroup');
    Route::post('/inquiries/create/select-model-model', [InquiryController::class, 'selectModelByModel'])->name('inquiries.create.selectModelByModel');
    Route::patch('/inquiries/{inquiry}/submit', [InquiryController::class, 'submit'])->name('inquiries.submit');
    Route::get('/inquiries/submitted', [InquiryController::class, 'submitted'])->name('inquiries.submitted');
    Route::get('/inquiries/priced', [InquiryController::class, 'priced'])->name('inquiries.priced');
    Route::post('/inquiries/{inquiry}/copy', [InquiryController::class, 'copy'])->name('inquiries.copy');
    Route::patch('/inquiries/{inquiry}/correction', [InquiryController::class, 'correction'])->name('inquiries.correction');
    Route::patch('/inquiries/{inquiry}/submit-correction', [InquiryController::class, 'submittedCorrection'])->name('inquiries.submittedCorrection');
    Route::delete('/inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');
    Route::get('/inquiries/products/{inquiry}', [InquiryController::class, 'products'])->name('inquiries.products');
    Route::get('/inquiries/products/{inquiry}/print-page', [InquiryController::class, 'printProduct'])->name('inquiries.products.print');
    Route::get('/inquiries/{inquiry}/print-page', [InquiryController::class, 'print'])->name('inquiries.print');
    Route::get('/inquiries/{inquiry}/description', [InquiryController::class, 'description'])->name('inquiries.description');
    Route::patch('/inquiries/{inquiry}/description', [InquiryController::class, 'storeDescription'])->name('inquiries.storeDescription');
    Route::get('/inquiries/{inquiry}/show-description', [InquiryController::class, 'showDescription'])->name('inquiries.showDescription');
    Route::post('/inquiries/{inquiry}/referral', [InquiryController::class, 'referral'])->name('inquiries.referral');
    Route::post('/inquiries/{product}/add-to-models', [InquiryController::class, 'addToModell'])->name('inquiries.addToModell');

    //Inquiry Product routes
    Route::get('/inquiries/{inquiry}/products', [InquiryProductController::class, 'index'])->name('inquiries.product.index');
    Route::get('/inquiries/{inquiry}/create-product', [InquiryProductController::class, 'create'])->name('inquiries.product.create');
    Route::post('/inquiries/{inquiry}/store-product', [InquiryProductController::class, 'store'])->name('inquiries.product.store');
    Route::get('/inquiries/{product}/product-amounts', [InquiryProductController::class, 'amounts'])->name('inquiries.product.amounts');
    Route::post('/inquiries/{product}/product-amounts', [InquiryProductController::class, 'storeAmounts'])->name('inquiries.product.storeAmounts');
    Route::post('/inquiries/product-amounts/change-part', [InquiryProductController::class, 'changePart'])->name('inquiries.product.changePart');
    Route::post('/inquiries/product-amounts/change-price', [InquiryProductController::class, 'changePrice'])->name('inquiries.product.changePrice');
    Route::post('/inquiries/product-amounts/get-part', [InquiryProductController::class, 'getPart'])->name('inquiries.product.getPart');
    Route::get('/inquiries/{product}/product-details', [InquiryProductController::class, 'show'])->name('inquiries.product.show');
    Route::get('/inquiries/{product}/product-percent', [InquiryProductController::class, 'percent'])->name('inquiries.product.percent');
    Route::patch('/inquiries/{product}/product-percent', [InquiryProductController::class, 'storePercent'])->name('inquiries.product.storePercent');
    Route::post('/inquiries/product-percent/multi-product-percent', [InquiryProductController::class, 'multiPercent'])->name('inquiries.product.multiPercent');
    Route::get('/inquiries/{product}/edit-product', [InquiryProductController::class, 'edit'])->name('inquiries.product.edit');
    Route::patch('/inquiries/{product}/update-product', [InquiryProductController::class, 'update'])->name('inquiries.product.update');
    Route::delete('/inquiries/{product}/destroy', [InquiryProductController::class, 'destroy'])->name('inquiries.product.destroy');
    Route::post('/inquiries/{product}/replicate', [InquiryProductController::class, 'replicate'])->name('inquiries.product.replicate');

    //Inquiry Part routes
    Route::get('/inquiries/{inquiry}/parts', [InquiryPartController::class, 'index'])->name('inquiries.parts.index');
    Route::get('/inquiries/{inquiry}/create-part', [InquiryPartController::class, 'create'])->name('inquiries.parts.create');
    Route::post('/inquiries/{inquiry}/{part}/store-part', [InquiryPartController::class, 'store'])->name('inquiries.parts.store');
    Route::post('/inquiries/product-percent/multi-part-percent', [InquiryPartController::class, 'multiPercent'])->name('inquiries.parts.multiPercent');
    Route::post('/inquiries/{inquiry}/part-amounts', [InquiryPartController::class, 'storeAmounts'])->name('inquiries.parts.storeAmounts');
    Route::delete('/inquiries/{inquiry}/{part}/destroy-part', [InquiryPartController::class, 'destroy'])->name('inquiries.parts.destory');

    //New Part Inquiry routes
    Route::get('/inquiries/{product}/new-part-inquiry', [NewPartInquiryController::class, 'create'])->name('inquiries.newPart.create');
    Route::post('/inquiries/{product}/{part}/new-part-inquiry', [NewPartInquiryController::class, 'store'])->name('inquiries.newPart.store');
    Route::delete('/inquiries/{amount}/destroy-amount', [NewPartInquiryController::class, 'destroy'])->name('inquiries.newPart.destroy');

    Route::get('/inquiries/temporary', [InquiryController::class, 'temporary'])->name('inquiries.temporary');
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
    Route::post('/calculate/fancoil-coil', [CalculateCoilController::class, 'calculateFancoilCoil'])->name('calculateFancoilCoil');
    Route::post('/calculate/condensor-coil', [CalculateCoilController::class, 'calculateCondensorCoil'])->name('calculateCondensorCoil');
    Route::post('/calculate/evaperator-coil', [CalculateCoilController::class, 'calculateEvaperatorCoil'])->name('calculateEvaperatorCoil');
    Route::post('/calculate/coldWater-coil', [CalculateCoilController::class, 'calculateColdCoil'])->name('calculateColdCoil');
    Route::post('/calculate/warmWater-coil', [CalculateCoilController::class, 'calculateWarmCoil'])->name('calculateWarmCoil');

    //Calculate damper routes
    Route::get('/calculate/damperTaze/{part}/{product}', [CalculateDamperController::class, 'taze'])->name('calculateDamper.taze.index');
    Route::get('/calculate/damperRaft/{part}/{product}', [CalculateDamperController::class, 'raft'])->name('calculateDamper.raft.index');
    Route::get('/calculate/damperBargasht/{part}/{product}', [CalculateDamperController::class, 'bargasht'])->name('calculateDamper.bargasht.index');
    Route::get('/calculate/damperExast/{part}/{product}', [CalculateDamperController::class, 'exast'])->name('calculateDamper.exast.index');
    Route::post('/calculate/damper/{part}/{product}/post', [CalculateDamperController::class, 'store'])->name('calculateDamper.store');
    Route::post('/calculate/damper-taze', [CalculateDamperController::class, 'calculateTaze'])->name('calculateTazeDamper');
    Route::post('/calculate/damper-exast', [CalculateDamperController::class, 'calculateExast'])->name('calculateExastDamper');
    Route::post('/calculate/damper-raft', [CalculateDamperController::class, 'calculateRaft'])->name('calculateRaftDamper');
    Route::post('/calculate/damper-bargasht', [CalculateDamperController::class, 'calculateBargasht'])->name('calculateBargashtDamper');

    //Calculate converter routes
    Route::get('/calculate/converter/{part}/{product}/evaporator', [CalculateConverterController::class, 'evaporator'])
        ->name('calculateConverter.evaporator.index');
    Route::post('/calculate/evaporator-converter', [CalculateConverterController::class, 'calculateEvaporator'])
        ->name('calculateEvaporatorConverter');
    Route::post('/calculate/converter/{part}/{product}/post-evaporator', [CalculateConverterController::class, 'storeEvaporator'])
        ->name('calculateConverter.storeEvaporator');

    Route::get('/calculate/converter/{part}/{product}/condensor', [CalculateConverterController::class, 'condensor'])
        ->name('calculateConverter.condensor.index');
    Route::post('/calculate/condensor-converter', [CalculateConverterController::class, 'calculateCondensor'])
        ->name('calculateCondensorConverter');
    Route::post('/calculate/converter/{part}/{product}/post-condensor', [CalculateConverterController::class, 'storeCondensor'])
        ->name('calculateConverter.storeCondensor');

    //Calculate Electrical routes
    Route::get('/calculate/electrical/{part}/{product}/panel', [CalculateElectricalController::class, 'panel'])
        ->name('calculateElectrical.panel.index');
    Route::post('/calculate/panel-electrical', [CalculateElectricalController::class, 'calculatePanel'])
        ->name('calculatePanelElectrical');
    Route::post('/calculate/electrical/{part}/{product}/post-panel', [CalculateElectricalController::class, 'storePanel'])
        ->name('calculateElectrical.storePanel');

    Route::get('/calculate/electrical/{part}/{product}/chiller', [CalculateElectricalController::class, 'chiller'])
        ->name('calculateElectrical.chiller.index');
    Route::post('/calculate/chiller-electrical', [CalculateElectricalController::class, 'calculateChiller'])
        ->name('calculateChillerElectrical');
    Route::post('/calculate/electrical/{part}/{product}/post-chiller', [CalculateElectricalController::class, 'storeChiller'])
        ->name('calculateElectrical.storeChiller');

    Route::get('/calculate/electrical/{part}/{product}/air-condition', [CalculateElectricalController::class, 'air'])
        ->name('calculateElectrical.air.index');
    Route::post('/calculate/air-condition-electrical', [CalculateElectricalController::class, 'calculateAir'])
        ->name('calculateAirElectrical');
    Route::post('/calculate/electrical/{part}/{product}/post-air-condition', [CalculateElectricalController::class, 'storeAir'])
        ->name('calculateElectrical.storeAir');

    Route::get('/calculate/electrical/{part}/{product}/zent', [CalculateElectricalController::class, 'zent'])
        ->name('calculateElectrical.zent.index');
    Route::post('/calculate/zent-electrical', [CalculateElectricalController::class, 'calculateZent'])
        ->name('calculateZentElectrical');
    Route::post('/calculate/electrical/{part}/{product}/post-zent', [CalculateElectricalController::class, 'storeZent'])
        ->name('calculateElectrical.storeZent');

    Route::get('/calculate/electrical/{part}/{product}/mini-chiller', [CalculateElectricalController::class, 'mini'])
        ->name('calculateElectrical.mini.index');
    Route::post('/calculate/mini-chiller-electrical', [CalculateElectricalController::class, 'calculateMini'])
        ->name('calculateMiniElectrical');
    Route::post('/calculate/electrical/{part}/{product}/post-mini-chiller', [CalculateElectricalController::class, 'storeMini'])
        ->name('calculateElectrical.storeMini');

    //Notification routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/notifications/read', [NotificationController::class, 'read'])->name('notifications.read');
    Route::delete('/notifications/{notification}/destroy', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::delete('/notifications/destroy-all', [NotificationController::class, 'destroyAll'])->name('notifications.destroyAll');

    //Setting routes
    Route::resource('settings', SettingController::class);

    //Separate Coil Routes
    Route::get('/separate-calculate-coil', [SeparateCalculateCoilController::class, 'index'])->name('separate.coil.index');
    Route::get('/separate-calculate-coil/{part}/fancoil', [SeparateCalculateCoilController::class, 'fancoil'])->name('separate.coil.fancoil');
    Route::post('/separate-calculate-coil/fancoil', [SeparateCalculateCoilController::class, 'calculateFancoil'])->name('separate.coil.calculateFancoil');
    Route::post('/separate-calculate-coil/{part}/store-fancoil', [SeparateCalculateCoilController::class, 'storeFancoil'])->name('separate.coil.storeFancoil');
    Route::get('/separate-calculate-coil/{part}/warm', [SeparateCalculateCoilController::class, 'warm'])->name('separate.coil.warm');
    Route::post('/separate-calculate-coil/warm', [SeparateCalculateCoilController::class, 'calculateWarm'])->name('separate.coil.calculateWarm');
    Route::post('/separate-calculate-coil/{part}/store-warm', [SeparateCalculateCoilController::class, 'storeWarm'])->name('separate.coil.storeWarm');
    Route::get('/separate-calculate-coil/{part}/cold', [SeparateCalculateCoilController::class, 'cold'])->name('separate.coil.cold');
    Route::post('/separate-calculate-coil/cold', [SeparateCalculateCoilController::class, 'calculateCold'])->name('separate.coil.calculateCold');
    Route::post('/separate-calculate-coil/{part}/store-cold', [SeparateCalculateCoilController::class, 'storeCold'])->name('separate.coil.storeCold');
    Route::get('/separate-calculate-coil/{part}/condensor', [SeparateCalculateCoilController::class, 'condensor'])->name('separate.coil.condensor');
    Route::post('/separate-calculate-coil/condensor', [SeparateCalculateCoilController::class, 'calculateCondensor'])->name('separate.coil.calculateCondensor');
    Route::post('/separate-calculate-coil/{part}/store-condensor', [SeparateCalculateCoilController::class, 'storeCondensor'])->name('separate.coil.storeCondensor');
    Route::get('/separate-calculate-coil/{part}/evaperator', [SeparateCalculateCoilController::class, 'evaperator'])->name('separate.coil.evaperator');
    Route::post('/separate-calculate-coil/evaperator', [SeparateCalculateCoilController::class, 'calculateEvaperator'])->name('separate.coil.calculateEvaperator');
    Route::post('/separate-calculate-coil/{part}/store-evaperator', [SeparateCalculateCoilController::class, 'storeEvaperator'])->name('separate.coil.storeEvaperator');

    //Separate Damper Routes
    Route::get('/separate-calculate-damper', [SeparateCalculateDamperController::class, 'index'])->name('separate.damper.index');
    Route::get('/separate-calculate-damper/{part}/bargasht', [SeparateCalculateDamperController::class, 'bargasht'])->name('separate.damper.bargasht');
    Route::post('/separate-calculate-damper/bargasht', [SeparateCalculateDamperController::class, 'calculateBargasht'])->name('separate.damper.calculateBargasht');
    Route::get('/separate-calculate-damper/{part}/exast', [SeparateCalculateDamperController::class, 'exast'])->name('separate.damper.exast');
    Route::post('/separate-calculate-damper/exast', [SeparateCalculateDamperController::class, 'calculateExast'])->name('separate.damper.calculateExast');
    Route::get('/separate-calculate-damper/{part}/raft', [SeparateCalculateDamperController::class, 'raft'])->name('separate.damper.raft');
    Route::post('/separate-calculate-damper/raft', [SeparateCalculateDamperController::class, 'calculateRaft'])->name('separate.damper.calculateRaft');
    Route::get('/separate-calculate-damper/{part}/taze', [SeparateCalculateDamperController::class, 'taze'])->name('separate.damper.taze');
    Route::post('/separate-calculate-damper/taze', [SeparateCalculateDamperController::class, 'calculateTaze'])->name('separate.damper.calculateTaze');
    Route::post('/separate-calculate-damper/{part}/post', [SeparateCalculateDamperController::class, 'store'])->name('separate.damper.store');

    //Separate Converter Routes
    Route::get('/separate-calculate-converter', [SeparateCalculateConverter::class, 'index'])->name('separate.converter.index');
    Route::get('/separate-calculate-converter/{part}/evaporator', [SeparateCalculateConverter::class, 'evaporator'])->name('separate.converter.evaporator');
    Route::post('/separate-calculate-converter/evaporator', [SeparateCalculateConverter::class, 'calculateEvaporator'])->name('separate.converter.calculateEvaporator');
    Route::post('/separate-calculate-converter/{part}/store-evaporator', [SeparateCalculateConverter::class, 'storeEvaporator'])->name('separate.converter.storeEvaporator');
    Route::get('/separate-calculate-converter/{part}/condensor', [SeparateCalculateConverter::class, 'condensor'])->name('separate.converter.condensor');
    Route::post('/separate-calculate-converter/condensor', [SeparateCalculateConverter::class, 'calculateCondensor'])->name('separate.converter.calculateCondensor');
    Route::post('/separate-calculate-converter/{part}/store-condensor', [SeparateCalculateConverter::class, 'storeCondensor'])->name('separate.converter.storeCondensor');

    //Separate Electrical Routes
    Route::get('/separate-calculate-electrical', [SeparateCalculateElectricalController::class, 'index'])->name('separate.electrical.index');

    //Separate Electrical Panel Routes
    Route::get('/separate-calculate-electrical/{part}/panel', [SeparateCalculateElectricalController::class, 'panel'])->name('separate.electrical.panel');
    Route::post('/separate-calculate-electrical/panel', [SeparateCalculateElectricalController::class, 'calculatePanel'])->name('separate.electrical.calculatePanel');
    Route::post('/separate-calculate-electrical/{part}/store-panel', [SeparateCalculateElectricalController::class, 'storePanel'])->name('separate.electrical.storePanel');

    //Separate Electrical Chiller Routes
    Route::get('/separate-calculate-electrical/{chiller}/chiller', [SeparateCalculateElectricalController::class, 'chiller'])->name('separate.electrical.chiller');
    Route::post('/separate-calculate-electrical/chiller', [SeparateCalculateElectricalController::class, 'calculateChiller'])->name('separate.electrical.calculateChiller');
    Route::post('/separate-calculate-electrical/{chiller}/store-chiller', [SeparateCalculateElectricalController::class, 'storeChiller'])->name('separate.electrical.storeChiller');

    //Separate Electrical Air Condition Routes
    Route::get('/separate-calculate-electrical/{part}/air-condition', [SeparateCalculateElectricalController::class, 'air'])->name('separate.electrical.air');
    Route::post('/separate-calculate-electrical/air-condition', [SeparateCalculateElectricalController::class, 'calculateAir'])->name('separate.electrical.calculateAir');
    Route::post('/separate-calculate-electrical/{part}/store-air-condition', [SeparateCalculateElectricalController::class, 'storeAir'])->name('separate.electrical.storeAir');

    //Separate Electrical Zent Routes
    Route::get('/separate-calculate-electrical/{part}/zent', [SeparateCalculateElectricalController::class, 'zent'])->name('separate.electrical.zent');
    Route::post('/separate-calculate-electrical/zent', [SeparateCalculateElectricalController::class, 'calculateZent'])->name('separate.electrical.calculateZent');
    Route::post('/separate-calculate-electrical/{part}/store-zent', [SeparateCalculateElectricalController::class, 'storeZent'])->name('separate.electrical.storeZent');

    //Separate Electrical Mini Chiller Routes
    Route::get('/separate-calculate-electrical/{part}/mini-chiller', [SeparateCalculateElectricalController::class, 'mini'])->name('separate.electrical.mini');
    Route::post('/separate-calculate-electrical/mini-chiller', [SeparateCalculateElectricalController::class, 'calculateMini'])->name('separate.electrical.calculateMini');
    Route::post('/separate-calculate-electrical/{part}/store-mini-chiller', [SeparateCalculateElectricalController::class, 'storeMini'])->name('separate.electrical.storeMini');

    //Inquiry Part Coils
    Route::post('/inquiry-part-coil/{inquiry}', [InquiryPartCoilController::class, 'index'])->name('inquiryPart.coil.index');
    Route::get('/inquiry-part-coil/{inquiry}/{part}/fancoil', [InquiryPartCoilController::class, 'fancoil'])->name('inquiryPart.coil.fancoil');
    Route::post('/inquiry-part-coil/calculate/fancoil', [InquiryPartCoilController::class, 'calculateFancoil'])->name('inquiryPart.coil.calculateFancoil');
    Route::post('/inquiry-part-coil/{inquiry}/{part}/store-fancoil', [InquiryPartCoilController::class, 'storeFancoil'])->name('inquiryPart.coil.storeFancoil');
    Route::get('/inquiry-part-coil/{inquiry}/{part}/warm', [InquiryPartCoilController::class, 'warm'])->name('inquiryPart.coil.warm');
    Route::post('/inquiry-part-coil/calculate/warm', [InquiryPartCoilController::class, 'calculateWarm'])->name('inquiryPart.coil.calculateWarm');
    Route::post('/inquiry-part-coil/{inquiry}/{part}/store-warm', [InquiryPartCoilController::class, 'storeWarm'])->name('inquiryPart.coil.storeWarm');
    Route::get('/inquiry-part-coil/{inquiry}/{part}/cold', [InquiryPartCoilController::class, 'cold'])->name('inquiryPart.coil.cold');
    Route::post('/inquiry-part-coil/calculate/cold', [InquiryPartCoilController::class, 'calculateCold'])->name('inquiryPart.coil.calculateCold');
    Route::post('/inquiry-part-coil/{inquiry}/{part}/store-cold', [InquiryPartCoilController::class, 'storeCold'])->name('inquiryPart.coil.storeCold');
    Route::get('/inquiry-part-coil/{inquiry}/{part}/condensor', [InquiryPartCoilController::class, 'condensor'])->name('inquiryPart.coil.condensor');
    Route::post('/inquiry-part-coil/calculate/condensor', [InquiryPartCoilController::class, 'calculateCondensor'])->name('inquiryPart.coil.calculateCondensor');
    Route::post('/inquiry-part-coil/{inquiry}/{part}/store-condensor', [InquiryPartCoilController::class, 'storeCondensor'])->name('inquiryPart.coil.storeCondensor');
    Route::get('/inquiry-part-coil/{inquiry}/{part}/evaperator', [InquiryPartCoilController::class, 'evaperator'])->name('inquiryPart.coil.evaperator');
    Route::post('/inquiry-part-coil/calculate/evaperator', [InquiryPartCoilController::class, 'calculateEvaperator'])->name('inquiryPart.coil.calculateEvaperator');
    Route::post('/inquiry-part-coil/{inquiry}/{part}/store-evaperator', [InquiryPartCoilController::class, 'storeEvaperator'])->name('inquiryPart.coil.storeEvaperator');

    //Inquiry Part Electricals
    Route::post('/inquiry-part-electrical/{inquiry}', [InquiryPartElectricalController::class, 'index'])->name('inquiryPart.electrical.index');
    Route::get('/inquiry-part-electrical/{inquiry}/{part}/air', [InquiryPartElectricalController::class, 'air'])->name('inquiryPart.electrical.air');
    Route::post('/inquiry-part-electrical/calculate/air', [InquiryPartElectricalController::class, 'calculateAir'])->name('inquiryPart.electrical.calculateAir');
    Route::post('/inquiry-part-electrical/{inquiry}/{part}/store-air', [InquiryPartElectricalController::class, 'storeAir'])->name('inquiryPart.electrical.storeAir');

    Route::get('/inquiry-part-electrical/{inquiry}/{part}/chiller', [InquiryPartElectricalController::class, 'chiller'])->name('inquiryPart.electrical.chiller');
    Route::post('/inquiry-part-electrical/calculate/chiller', [InquiryPartElectricalController::class, 'calculateChiller'])->name('inquiryPart.electrical.calculateChiller');
    Route::post('/inquiry-part-electrical/{inquiry}/{part}/store-chiller', [InquiryPartElectricalController::class, 'storeChiller'])->name('inquiryPart.electrical.storeChiller');

    Route::get('/inquiry-part-electrical/{inquiry}/{part}/mini', [InquiryPartElectricalController::class, 'mini'])->name('inquiryPart.electrical.mini');
    Route::post('/inquiry-part-electrical/calculate/mini', [InquiryPartElectricalController::class, 'calculateMini'])->name('inquiryPart.electrical.calculateMini');
    Route::post('/inquiry-part-electrical/{inquiry}/{part}/store-mini', [InquiryPartElectricalController::class, 'storeMini'])->name('inquiryPart.electrical.storeMini');

    Route::get('/inquiry-part-electrical/{inquiry}/{part}/panel', [InquiryPartElectricalController::class, 'panel'])->name('inquiryPart.electrical.panel');
    Route::post('/inquiry-part-electrical/calculate/panel', [InquiryPartElectricalController::class, 'calculatePanel'])->name('inquiryPart.electrical.calculatePanel');
    Route::post('/inquiry-part-electrical/{inquiry}/{part}/store-panel', [InquiryPartElectricalController::class, 'storePanel'])->name('inquiryPart.electrical.storePanel');

    Route::get('/inquiry-part-electrical/{inquiry}/{part}/zent', [InquiryPartElectricalController::class, 'zent'])->name('inquiryPart.electrical.zent');
    Route::post('/inquiry-part-electrical/calculate/zent', [InquiryPartElectricalController::class, 'calculateZent'])->name('inquiryPart.electrical.calculateZent');
    Route::post('/inquiry-part-electrical/{inquiry}/{part}/store-zent', [InquiryPartElectricalController::class, 'storeZent'])->name('inquiryPart.electrical.storeZent');

    //Inquiry Price Routes
    Route::get('/inquiry-price', [InquiryPriceController::class, 'index'])->name('inquiryPrice.index');
    Route::post('/inquiry-price/{part}/{inquiry}/store', [InquiryPriceController::class, 'store'])->name('inquiryPrice.store');
    Route::patch('/inquiry-price/{inquiry}/update', [InquiryPriceController::class, 'update'])->name('inquiryPrice.update');
    Route::patch('/inquiry-price/{part}/update-date', [InquiryPriceController::class, 'updateDate'])->name('inquiryPrice.updateDate');
    Route::post('/inquiry-price/multi-update-date', [InquiryPriceController::class, 'multiUpdateDate'])->name('inquiryPrice.multiUpdateDate');
});
