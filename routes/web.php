<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AttributeGroupController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalculateCoilController;
use App\Http\Controllers\CalculateConverterController;
use App\Http\Controllers\CalculateDamperController;
use App\Http\Controllers\CalculateElectricalController;
use App\Http\Controllers\CategoryAttributeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientInvoiceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CollectionCoilController;
use App\Http\Controllers\CollectionPartController;
use App\Http\Controllers\CombineCodeController;
use App\Http\Controllers\Contract\AnalyzePartController;
use App\Http\Controllers\Contract\FinalContractController;
use App\Http\Controllers\Contract\GuaranteeController;
use App\Http\Controllers\Contract\MarketingController;
use App\Http\Controllers\Contract\PackingController;
use App\Http\Controllers\Contract\RecipeController;
use App\Http\Controllers\Contract\ProductController as ContractProduct;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\MarketingController as AllMarketings;
use App\Http\Controllers\Contract\MarketPaymentController;
use App\Http\Controllers\Contract\PaymentController;
use App\Http\Controllers\MarketerAccountController;
use App\Http\Controllers\MarketerController;
use App\Http\Controllers\PaymentController as AllPayments;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinalInvoiceController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\InquiryPartCoilController;
use App\Http\Controllers\InquiryPartController;
use App\Http\Controllers\InquiryPartConverterController;
use App\Http\Controllers\InquiryPartDamperController;
use App\Http\Controllers\InquiryPartElectricalController;
use App\Http\Controllers\InquiryPriceController;
use App\Http\Controllers\InquiryProductController;
use App\Http\Controllers\InquiryTermController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ModellAttributeController;
use App\Http\Controllers\ModellController;
use App\Http\Controllers\NewPartInquiryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PartAttributeController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\Contract\PartController as ContractPartController;
use App\Http\Controllers\Contract\InvoiceController as ContractInvoiceController;
use App\Http\Controllers\PartOfModellController;
use App\Http\Controllers\PartPriceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductAttributeController;
use App\Http\Controllers\ProductCurrentPriceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SeparateCalculateCoilController;
use App\Http\Controllers\SeparateCalculateConverter;
use App\Http\Controllers\SeparateCalculateDamperController;
use App\Http\Controllers\SeparateCalculateElectricalController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\System\CodingController;
use App\Http\Controllers\System\LetterController;
use App\Http\Controllers\System\PhonebookController;
use App\Http\Controllers\System\SerialController;
use App\Http\Controllers\System\StoreController;
use App\Http\Controllers\System\SystemCategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Auth routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'storeLogin'])->name('login.store');
Route::get('/login/phone', [AuthController::class, 'phone'])->name('login.phone');
Route::post('/login/phone', [AuthController::class, 'storePhone'])->name('login.phone.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'web'])->group(function () {

    Route::middleware('normal')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        //Users routes
        Route::get('/users/deleted', [UserController::class, 'deleted'])->name('users.deleted');
        Route::get('/users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
        Route::get('/users/{user}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');
        Route::get('/users/{user}/permissions', [UserController::class, 'permissions'])->name('users.permissions');
        Route::post('/users/{user}/permissions', [UserController::class, 'storePermissions'])->name('users.storePermissions');
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
        Route::get('/models/{modell}/children', [ModellController::class, 'children'])->name('modells.children');

        Route::get('/models/{modell}/attributes', [ModellAttributeController::class, 'index'])->name('modells.attributes.index');
        Route::post('/models/{modell}/attributes', [ModellAttributeController::class, 'store'])->name('modells.attributes.store');
        Route::post('/models/{modell}/replicate-attributes', [ModellAttributeController::class, 'replicate'])->name('modells.attributes.replicate');
        Route::patch('/models/{attribute}/attributes', [ModellAttributeController::class, 'update'])->name('modells.attributes.update');
        Route::delete('/models/{attribute}/attributes', [ModellAttributeController::class, 'destroy'])->name('modells.attributes.destroy');
        Route::post('/models/{modell}/sort-attributes', [ModellAttributeController::class, 'storeSort'])->name('modells.attributes.storeSort');

        //Group routes
        Route::get('/groups/{group}/children', [GroupController::class, 'children'])->name('groups.children');
        Route::resource('groups', GroupController::class);

        //Part routes
        Route::get('/parts/price', [PartPriceController::class, 'index'])->name('parts.price.index');
        Route::patch('/parts/update-price', [PartPriceController::class, 'update'])->name('parts.price.update');
        Route::post('/parts/{part}/replicate', [PartController::class, 'replicate'])->name('parts.replicate');
        Route::post('/parts/getCategory', [PartController::class, 'getCategory'])->name('parts.getCategory');
        Route::patch('/parts/price/{part}/update-date', [PartPriceController::class, 'updateDate'])->name('parts.price.updateDate');
        Route::post('/parts/price/multi-update-date', [PartPriceController::class, 'multiUpdateDate'])->name('parts.price.multi-update-date');

        //Part Attributes
        Route::get('/parts/{part}/attributes', [PartAttributeController::class, 'index'])->name('parts.attributes.index');
        Route::post('/parts/{part}/attributes', [PartAttributeController::class, 'store'])->name('parts.attributes.store');

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
        Route::post('/collection-coil/{part}/standard', [CollectionCoilController::class, 'standard'])->name('collectionCoil.standard');

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
        Route::post('/inquiries/{inquiry}/tmp-referral', [InquiryController::class, 'tmpReferral'])->name('inquiries.tmpReferral');
        Route::post('/inquiries/{product}/add-to-models', [InquiryController::class, 'addToModell'])->name('inquiries.addToModell');
        Route::post('/inquiries/{inquiry}/restore', [InquiryController::class, 'restore'])->name('inquiries.restore');
        Route::post('/inquiries/{inquiry}/final-submit', [InquiryController::class, 'finalSubmit'])->name('inquiries.finalSubmit');
        Route::post('/inquiries/{product}/add-product-to-inquiry', [InquiryController::class, 'addProductToInquiry'])->name('inquiries.addProductToInquiry');

        //Inquiry Product routes
        Route::get('/inquiries/{inquiry}/products', [InquiryProductController::class, 'index'])->name('inquiries.product.index');
        Route::get('/inquiries/{inquiry}/create-product', [InquiryProductController::class, 'create'])->name('inquiries.product.create');
        Route::post('/inquiries/{inquiry}/store-product', [InquiryProductController::class, 'store'])->name('inquiries.product.store');
        Route::get('/inquiries/{product}/product-amounts', [InquiryProductController::class, 'amounts'])->name('inquiries.product.amounts');
        Route::post('/inquiries/{product}/product-amounts', [InquiryProductController::class, 'storeAmounts'])->name('inquiries.product.storeAmounts');


        Route::get('/inquiries/{product}/product-attributes', [ProductAttributeController::class, 'index'])->name('inquiries.product.attributes');
        Route::post('/inquiries/{product}/product-attributes', [ProductAttributeController::class, 'store'])->name('inquiries.product.storeAttribute');


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
        Route::post('/inquiries/part-percent/ajax', [InquiryProductController::class, 'storePercentAjax'])->name('inquiries.part-percent.ajax');

        //New Part Inquiry routes
        Route::get('/inquiries/{product}/new-part-inquiry', [NewPartInquiryController::class, 'create'])->name('inquiries.newPart.create');
        Route::post('/inquiries/{product}/{part}/new-part-inquiry', [NewPartInquiryController::class, 'store'])->name('inquiries.newPart.store');
        Route::delete('/inquiries/{amount}/destroy-amount', [NewPartInquiryController::class, 'destroy'])->name('inquiries.newPart.destroy');

        //Inquiry Datasheet
        Route::get('/inquiries/{inquiry}/datasheet', [InquiryController::class, 'datasheet'])->name('inquiries.datasheet');
        Route::get('/inquiries/{inquiry}/print-datasheet', [InquiryController::class, 'printDatasheet'])->name('inquiries.printDatasheet');

        //Add Inquiry to Invoice
        Route::post('/inquiries/{inquiry}/add-to-invoice', [InquiryController::class, 'addToInvoice'])->name('inquiries.addToInvoice');

        Route::resource('inquiries', InquiryController::class);

        //Category Attributes
        Route::get('/categories/{category}/attributes', [CategoryAttributeController::class, 'index'])->name('categories.attributes.index');
        Route::post('/categories/{category}/attributes', [CategoryAttributeController::class, 'store'])->name('categories.attributes.store');
        Route::post('/categories/{category}/replicate-attributes', [CategoryAttributeController::class, 'replicate'])->name('categories.attributes.replicate');
        Route::patch('/categories/{attribute}/attributes', [CategoryAttributeController::class, 'update'])->name('categories.attributes.update');
        Route::delete('/categories/{attribute}/attributes', [CategoryAttributeController::class, 'destroy'])->name('categories.attributes.destroy');
        Route::post('/categories/{category}/sort-attributes', [CategoryAttributeController::class, 'storeSort'])->name('categories.attributes.storeSort');

        //Category routes
        Route::get('/categories/{category}/children', [CategoryController::class, 'children'])->name('categories.children');
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
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

        Route::get('/settings/price-color', [SettingController::class, 'priceColorIndex'])->name('settings.price-color.index');
        Route::get('/settings/price-color/create', [SettingController::class, 'priceColorCreate'])->name('settings.price-color.create');
        Route::post('/settings/price-color', [SettingController::class, 'priceColorStore'])->name('settings.price-color.store');
        Route::get('/settings/price-color/{setting}/edit', [SettingController::class, 'priceColorEdit'])->name('settings.price-color.edit');
        Route::patch('/settings/price-color/{setting}', [SettingController::class, 'priceColorUpdate'])->name('settings.price-color.update');
        Route::delete('/settings/price-color/{setting}', [SettingController::class, 'priceColorDestroy'])->name('settings.price-color.destroy');

        Route::get('/settings/delete-button', [SettingController::class, 'deleteButtonIndex'])->name('settings.delete-button.index');
        Route::get('/settings/delete-button/create', [SettingController::class, 'deleteButtonCreate'])->name('settings.delete-button.create');
        Route::post('/settings/delete-button', [SettingController::class, 'deleteButtonStore'])->name('settings.delete-button.store');
        Route::get('/settings/delete-button/{deleteButton}/edit', [SettingController::class, 'deleteButtonEdit'])->name('settings.delete-button.edit');
        Route::patch('/settings/delete-button/{deleteButton}', [SettingController::class, 'deleteButtonUpdate'])->name('settings.delete-button.update');
        Route::delete('/settings/delete-button/{deleteButton}', [SettingController::class, 'deleteButtonDestroy'])->name('settings.delete-button.destroy');

        Route::get('/settings/current-price/create', [SettingController::class, 'create'])->name('settings.currentPrice.create');
        Route::post('/settings/current-price/store', [SettingController::class, 'store'])->name('settings.currentPrice.store');

        Route::get('/settings/inquiry-terms', [InquiryTermController::class, 'index'])->name('settings.inquiryTerms.index');
        Route::get('/settings/inquiry-terms/create', [InquiryTermController::class, 'create'])->name('settings.inquiryTerms.create');
        Route::post('/settings/inquiry-terms', [InquiryTermController::class, 'store'])->name('settings.inquiryTerms.store');
        Route::get('/settings/inquiry-terms/{inquiryTerm}/edit', [InquiryTermController::class, 'edit'])->name('settings.inquiryTerms.edit');
        Route::patch('/settings/inquiry-terms/{inquiryTerm}', [InquiryTermController::class, 'update'])->name('settings.inquiryTerms.update');
        Route::delete('/settings/inquiry-terms/{inquiryTerm}', [InquiryTermController::class, 'destroy'])->name('settings.inquiryTerms.destroy');

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

        //Inquiry Part Dampers
        Route::post('/inquiry-part-damper/{inquiry}', [InquiryPartDamperController::class, 'index'])->name('inquiryPart.damper.index');
        Route::post('/inquiry-part-damper/{inquiry}/{part}/store', [InquiryPartDamperController::class, 'store'])->name('inquiryPart.damper.store');

        Route::get('/inquiry-part-damper/{inquiry}/{part}/bargasht', [InquiryPartDamperController::class, 'bargasht'])->name('inquiryPart.damper.bargasht');
        Route::post('/inquiry-part-damper/calculate/bargasht', [InquiryPartDamperController::class, 'calculateBargasht'])->name('inquiryPart.damper.calculateBargasht');

        Route::get('/inquiry-part-damper/{inquiry}/{part}/exast', [InquiryPartDamperController::class, 'exast'])->name('inquiryPart.damper.exast');
        Route::post('/inquiry-part-damper/calculate/exast', [InquiryPartDamperController::class, 'calculateExast'])->name('inquiryPart.damper.calculateExast');

        Route::get('/inquiry-part-damper/{inquiry}/{part}/raft', [InquiryPartDamperController::class, 'raft'])->name('inquiryPart.damper.raft');
        Route::post('/inquiry-part-damper/calculate/raft', [InquiryPartDamperController::class, 'calculateRaft'])->name('inquiryPart.damper.calculateRaft');

        Route::get('/inquiry-part-damper/{inquiry}/{part}/taze', [InquiryPartDamperController::class, 'taze'])->name('inquiryPart.damper.taze');
        Route::post('/inquiry-part-damper/calculate/taze', [InquiryPartDamperController::class, 'calculateTaze'])->name('inquiryPart.damper.calculateTaze');

        //Inquiry Part Converter
        Route::post('/inquiry-part-converter/{inquiry}', [InquiryPartConverterController::class, 'index'])->name('inquiryPart.converter.index');

        Route::get('/inquiry-part-converter/{inquiry}/{part}/evaporator', [InquiryPartConverterController::class, 'evaporator'])->name('inquiryPart.converter.evaporator');
        Route::post('/inquiry-part-converter/calculate/evaporator', [InquiryPartConverterController::class, 'calculateEvaporator'])->name('inquiryPart.converter.calculateEvaporator');
        Route::post('/inquiry-part-converter/{inquiry}/{part}/store-evaporator', [InquiryPartConverterController::class, 'storeEvaporator'])->name('inquiryPart.converter.storeEvaporator');

        Route::get('/inquiry-part-converter/{inquiry}/{part}/condensor', [InquiryPartConverterController::class, 'condensor'])->name('inquiryPart.converter.condensor');
        Route::post('/inquiry-part-converter/calculate/condensor', [InquiryPartConverterController::class, 'calculateCondensor'])->name('inquiryPart.converter.calculateCondensor');
        Route::post('/inquiry-part-converter/{inquiry}/{part}/store-condensor', [InquiryPartConverterController::class, 'storeCondensor'])->name('inquiryPart.converter.storeCondensor');

        //Inquiry Price Routes
        Route::get('/inquiry-price', [InquiryPriceController::class, 'index'])->name('inquiryPrice.index');
        Route::patch('/inquiry-price/{inquiry}/update', [InquiryPriceController::class, 'update'])->name('inquiryPrice.update');
        Route::patch('/inquiry-price/{modell}/updateProduct', [InquiryPriceController::class, 'updateProduct'])->name('inquiryPrice.updateProduct');
        Route::patch('/inquiry-price/{part}/update-date', [InquiryPriceController::class, 'updateDate'])->name('inquiryPrice.updateDate');
        Route::post('/inquiry-price/multi-update-date', [InquiryPriceController::class, 'multiUpdateDate'])->name('inquiryPrice.multiUpdateDate');

        //Product Current Price Rotues
        Route::get('/products/current-price', [ProductCurrentPriceController::class, 'index'])->name('products.currentPrice');
        Route::post('/products/current-price', [ProductCurrentPriceController::class, 'store'])->name('products.currentPrice.store');

        //Permissions
        Route::resource('permissions', PermissionController::class);

        //Roles
        Route::resource('roles', RoleController::class);

        //Invoices
        Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
        Route::get('/invoices/{invoice}/products', [InvoiceController::class, 'products'])->name('invoices.products');
        Route::post('/invoices/store-products', [InvoiceController::class, 'storeProducts'])->name('invoices.products.store');
        Route::post('/invoices/store-parts', [InvoiceController::class, 'storeParts'])->name('invoices.parts.store');
        Route::post('/invoices/products/delete-product', [InvoiceController::class, 'destroyProduct'])->name('invoices.products.destroy');
        Route::patch('/invoices/{invoice}/restore-product', [InvoiceController::class, 'restoreProduct'])->name('invoices.products.restore');
        Route::patch('/invoices/{invoice}/complete', [InvoiceController::class, 'complete'])->name('invoices.complete');
        Route::delete('/invoices/{invoice}/destroy', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
        Route::get('/invoices/{invoice}/settings', [InvoiceController::class, 'settings'])->name('invoices.settings');
        Route::patch('/invoices/{invoice}/settings', [InvoiceController::class, 'storeSettings'])->name('invoices.storeSettings');

        Route::get('/final-invoices', [FinalInvoiceController::class, 'index'])->name('invoices.final.index');
        Route::get('/final-invoices/{invoice}/print', [FinalInvoiceController::class, 'print'])->name('invoices.final.print');
        Route::post('/final-invoices/print/show-price', [FinalInvoiceController::class, 'showPrice'])->name('invoices.final.showPrice');
        Route::get('/final-invoices/{invoice}/print-page', [FinalInvoiceController::class, 'printPage'])->name('invoices.final.printPage');
        Route::patch('/final-invoices/{invoice}/restore', [FinalInvoiceController::class, 'restore'])->name('invoices.final.restore');
        Route::get('/final-invoices/{invoice}/datasheet', [FinalInvoiceController::class, 'datasheet'])->name('invoices.final.datasheet');
        Route::get('/final-invoices/{invoice}/print-datasheet', [FinalInvoiceController::class, 'printDatasheet'])->name('invoices.final.printDatasheet');
        Route::post('/final-invoices/{invoice}/add-to-contract', [FinalInvoiceController::class, 'addToContract'])->name('invoices.final.addToContract');
        Route::post('/final-invoices/{invoice}/sms/{user}', [FinalInvoiceController::class, 'invoiceSMS'])->name('invoices.final.sms');
        Route::post('/final-invoices/{invoice}/referral', [FinalInvoiceController::class, 'referral'])->name('invoices.final.referral');

        Route::resource('attribute-groups', AttributeGroupController::class)->except(['create', 'edit', 'show']);

        Route::get('/contracts', [ContractController::class, 'index'])->name('contracts.index');
        Route::get('/contracts/{contract}/products', [ContractController::class, 'products'])->name('contracts.products');
        Route::delete('/contracts/products/{contractProduct}/delete', [ContractController::class, 'destroyProduct'])->name('contracts.destroy-product');
        Route::post('/contracts/products/update', [ContractController::class, 'updateProducts'])->name('contracts.update-products');
        Route::get('/contracts/{contract}', [ContractController::class, 'show'])->name('contracts.show');
        Route::delete('/contracts/{contract}/products/delete-all', [ContractController::class, 'deleteAll'])->name('contracts.products.delete-all');
        Route::post('contracts/{contract}/complete', [ContractController::class, 'complete'])->name('contracts.complete');

        Route::get('final-contracts', [FinalContractController::class, 'index'])->name('final-contracts.index');

        Route::get('/contracts/{contract}/payments', [PaymentController::class, 'index'])->name('contracts.payments.index');
        Route::get('/contracts/{contract}/create-payments', [PaymentController::class, 'create'])->name('contracts.payments.create');
        Route::post('/contracts/{contract}/create-payments', [PaymentController::class, 'store'])->name('contracts.payments.store');
        Route::get('/contracts/{payment}/edit-payments', [PaymentController::class, 'edit'])->name('contracts.payments.edit');
        Route::patch('/contracts/{payment}/edit-payments', [PaymentController::class, 'update'])->name('contracts.payments.update');
        Route::post('/contracts/payments/delete-payments', [PaymentController::class, 'destroy'])->name('contracts.payments.destroy');
        Route::post('/contracts/{contract}/confirm-payments', [PaymentController::class, 'confirm'])->name('contracts.payments.confirm');

        Route::get('/contracts/{contract}/guarantees', [GuaranteeController::class, 'index'])->name('contracts.guarantees.index');
        Route::get('/contracts/{contract}/create-guarantees', [GuaranteeController::class, 'create'])->name('contracts.guarantees.create');
        Route::post('/contracts/{contract}/create-guarantees', [GuaranteeController::class, 'store'])->name('contracts.guarantees.store');
        Route::get('/contracts/{guarantee}/edit-guarantees', [GuaranteeController::class, 'edit'])->name('contracts.guarantees.edit');
        Route::patch('/contracts/{guarantee}/edit-guarantees', [GuaranteeController::class, 'update'])->name('contracts.guarantees.update');
        Route::post('/contracts/delete-guarantees', [GuaranteeController::class, 'destroy'])->name('contracts.guarantees.destroy');
        Route::post('/contracts/{contract}/confirm-guarantees', [GuaranteeController::class, 'confirm'])->name('contracts.guarantees.confirm');

        Route::resource('customers', CustomerController::class)->except(['show']);

        Route::resource('accounts', AccountController::class)->except(['show']);

        Route::get('/payments', [AllPayments::class, 'index'])->name('payments.index');

        Route::resource('marketers', MarketerController::class)->except(['show']);
        Route::get('/marketers/{marketer}/accounts', [MarketerAccountController::class, 'index'])->name('marketers.accounts.index');
        Route::get('/marketers/{marketer}/create-accounts', [MarketerAccountController::class, 'create'])->name('marketers.accounts.create');
        Route::post('/marketers/{marketer}/create-accounts', [MarketerAccountController::class, 'store'])->name('marketers.accounts.store');
        Route::get('/marketers/{marketerAccount}/edit-accounts', [MarketerAccountController::class, 'edit'])->name('marketers.accounts.edit');
        Route::patch('/marketers/{marketerAccount}/edit-accounts', [MarketerAccountController::class, 'update'])->name('marketers.accounts.update');
        Route::delete('/marketers/{marketerAccount}/accounts', [MarketerAccountController::class, 'destroy'])->name('marketers.accounts.destroy');

        Route::get('/contracts/new/create', [ContractController::class, 'create'])->name('contracts.create');
        Route::post('/contracts/new/create', [ContractController::class, 'store'])->name('contracts.store');

        Route::get('/contracts/{contract}/edit', [ContractController::class, 'edit'])->name('contracts.edit');
        Route::patch('/contracts/{contract}/edit', [ContractController::class, 'update'])->name('contracts.update');

        Route::delete('/contracts/{contract}/delete', [ContractController::class, 'destroy'])->name('contracts.destroy');

        Route::post('/contracts/{contract}/select-invoice', [ContractController::class, 'selectInvoice'])->name('contracts.select-invoice');

        Route::get('/contracts/{contract}/marketings', [MarketingController::class, 'index'])->name('contracts.marketings.index');
        Route::get('/contracts/{contract}/create-marketings', [MarketingController::class, 'create'])->name('contracts.marketings.create');
        Route::post('/contracts/{contract}/create-marketings', [MarketingController::class, 'store'])->name('contracts.marketings.store');
        Route::get('/contracts/{marketing}/edit-marketings', [MarketingController::class, 'edit'])->name('contracts.marketings.edit');
        Route::patch('/contracts/{marketing}/edit-marketings', [MarketingController::class, 'update'])->name('contracts.marketings.update');
        Route::post('/contracts/delete-marketings', [MarketingController::class, 'destroy'])->name('contracts.marketings.destroy');
        Route::post('/contracts/{contract}/confirm-marketings', [MarketingController::class, 'confirm'])->name('contracts.marketings.confirm');

        Route::get('/contract-marketing/{marketing}/payments', [MarketPaymentController::class, 'index'])->name('contracts.marketings.payments.index');
        Route::get('/contract-marketing/{marketing}/create-payments', [MarketPaymentController::class, 'create'])->name('contracts.marketings.payments.create');
        Route::post('/contract-marketing/{marketing}/create-payments', [MarketPaymentController::class, 'store'])->name('contracts.marketings.payments.store');
        Route::get('/contract-marketing/{marketPayment}/edit-payments', [MarketPaymentController::class, 'edit'])->name('contracts.marketings.payments.edit');
        Route::patch('/contract-marketing/{marketPayment}/edit-payments', [MarketPaymentController::class, 'update'])->name('contracts.marketings.payments.update');
        Route::post('/contract-marketing/market-payment/delete-payments', [MarketPaymentController::class, 'destroy'])->name('contracts.marketings.payments.destroy');
        Route::post('/contract-marketing/{marketing}/confirm-payments', [MarketPaymentController::class, 'confirm'])->name('contracts.marketings.payments.confirm');

        Route::get('/marketings', [AllMarketings::class, 'index'])->name('marketings.index');

        Route::get('/contracts/{contract}/parts', [ContractPartController::class, 'index'])->name('contracts.parts.index');
        Route::post('/contracts/{contract}/parts', [ContractPartController::class, 'storeAmounts'])->name('contracts.parts.store-amounts');
        Route::post('/contracts/{contract}/parts-recipe', [ContractPartController::class, 'storeRecipe'])->name('contracts.parts.store-recipe');
        Route::post('/contracts/{contract}/destroy-recipe', [ContractPartController::class, 'destroyRecipe'])->name('contracts.parts.destroy-recipe');
        Route::get('/contracts/{contract}/add-part/{product}', [ContractPartController::class, 'addPart'])->name('contracts.parts.add-part');
        Route::post('/contracts/{contract}/add-part/{product}', [ContractPartController::class, 'storePart'])->name('contracts.parts.store-part');
        Route::post('/contracts/analyze/parts/delete', [ContractPartController::class, 'destroyPart'])->name('contracts.parts.destroy');

        Route::post('/contracts/{contract}/products', [ContractPartController::class, 'storeProduct'])->name('contracts.products.store-product');

        Route::get('/contracts/analyze-parts/all-parts', [AnalyzePartController::class, 'index'])->name('contracts.analyze-parts.index');
        Route::post('/contracts/analyze-parts/all-parts', [AnalyzePartController::class, 'store'])->name('contracts.analyze-parts.store');
        Route::post('/contracts/analyze-parts/all-parts/purchase', [AnalyzePartController::class, 'purchase'])->name('contracts.analyze-parts.purchase');

        Route::get('/contracts/analyze-parts/shopping-parts', [AnalyzePartController::class, 'shopping'])->name('contracts.analyze-parts.shopping-parts');
        Route::post('/contracts/analyze-parts/shopping-parts', [AnalyzePartController::class, 'complete'])->name('contracts.analyze-parts.shopping-parts.complete');

        Route::get('/contracts/{contract}/recipe', [RecipeController::class, 'index'])->name('contracts.recipe.index');
        Route::get('/contracts/{contract}/recipe/parts', [RecipeController::class, 'parts'])->name('contracts.recipe.parts');
        Route::post('/contracts/{contract}/recipe/parts', [RecipeController::class, 'storeParts'])->name('contracts.recipe.store-parts');
        Route::patch('/contracts/{contract}/recipe/{product}/end-of-production', [RecipeController::class, 'endProduction'])->name('contracts.recipe.end-of-production');
        Route::patch('/contracts/{contract}/recipe/{product}/add-to-packing', [RecipeController::class, 'addToPacking'])->name('contracts.recipe.add-to-packing');
        Route::patch('/contracts/{contract}/recipe/{product}/add-factory-text', [RecipeController::class, 'addFactoryText'])->name('contracts.recipe.add-factory-text');

        Route::get('/contracts/{contract}/choose-product', [ContractProduct::class, 'choose'])->name('contracts.choose-product');
        Route::get('/contracts/{contract}/choose-product/{invoice}', [ContractProduct::class, 'invoice'])->name('contracts.choose-product.invoice');
        Route::post('/contracts/{contract}/choose-product/{invoice}', [ContractProduct::class, 'storeInvoice'])->name('contracts.choose-product.store-invoice');
        Route::post('/contracts/{contract}/store-product-amount', [ContractProduct::class, 'storeAmounts'])->name('contracts.store-product-amount');
        Route::delete('/contracts/{contract}/destroy-product-amount', [ContractProduct::class, 'destroyAmounts'])->name('contracts.destroy-product-amount');
        Route::post('/contracts/{contract}/products/{contractProduct}/recipe', [ContractProduct::class, 'storeRecipe'])->name('contracts.products.recipe');

        Route::resource('contracts/{contract}/packings', PackingController::class);
        Route::get('/contracts/{contract}/packings/list/print', [PackingController::class, 'print'])->name('contracts.packings.print');
        Route::get('/contracts/{contract}/packings/{packing}/choose', [PackingController::class, 'choose'])->name('contracts.packings.choose');
        Route::post('/contracts/{contract}/packings/{packing}/choose', [PackingController::class, 'storeChoose'])->name('contracts.packings.store-choose');
        Route::delete('/contracts/{contract}/packings/{packing}/delete-product', [PackingController::class, 'deleteProduct'])->name('contracts.packings.delete-product');

        Route::get('/client-invoices', [ClientInvoiceController::class, 'index'])->name('client-invoices.index');

        Route::resource('settings/information', InformationController::class)->except(['show']);

        Route::get('/contracts/{contract}/invoices', [ContractInvoiceController::class, 'index'])->name('contracts.invoices.index');

        Route::resource('todos', TodoController::class)->except('show');
        Route::post('todos/{todo}/mark-as-done', [TodoController::class, 'markAsDone'])->name('todos.mark-as-done');

        Route::resource('tasks', TaskController::class)->except('show');
        Route::post('tasks/{task}/mark-as-done', [TaskController::class, 'markAsDone'])->name('tasks.mark-as-done');
        Route::post('tasks/{task}/review', [TaskController::class, 'review'])->name('tasks.review');

        Route::resource('leaves', LeaveController::class)->except(['show']);

        //System Routes
        Route::resource('phonebook', PhonebookController::class)->except(['show']);

        Route::resource('letters', LetterController::class)->except(['show']);

        Route::resource('serials', SerialController::class)->except(['show']);
        Route::post('/serials/{serial}/replicate', [SerialController::class, 'replicate'])->name('serials.replicate');

        Route::resource('coding', CodingController::class);
        Route::post('/coding/getCategory', [CodingController::class, 'category'])->name('coding.category');
        Route::post('/coding/{coding}/replicate', [CodingController::class, 'replicate'])->name('coding.replicate');
        Route::get('/coding/export/all', [CodingController::class, 'exportPage'])->name('coding.exportPage');
        Route::post('/coding/export/all', [CodingController::class, 'export'])->name('coding.export');

        Route::resource('system-categories', SystemCategoryController::class);
        Route::get('/system-categories/{system_category}/children', [SystemCategoryController::class, 'children'])->name('system-categories.children');

        Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');
        Route::get('/stores/{store}/edit', [StoreController::class, 'edit'])->name('stores.edit');
        Route::post('/stores', [StoreController::class, 'store'])->name('stores.store');
        Route::patch('/stores/{store}', [StoreController::class, 'update'])->name('stores.update');
        Route::delete('/stores/delete-store', [StoreController::class, 'destroy'])->name('stores.destroy');
        Route::patch('/stores/edit/change-status', [StoreController::class, 'changeStatus'])->name('stores.changeStatus');
        Route::post('/stores/search/category', [StoreController::class, 'searchCategory'])->name('stores.searchCategory');
        Route::post('/stores/search/text', [StoreController::class, 'searchText'])->name('stores.searchText');

        Route::get('/combine-codes', [CombineCodeController::class, 'index'])->name('combine-codes.index');
    });

    Route::middleware('client')->group(function () {
        Route::get('/clients/{user}', [ClientController::class, 'dashboard'])->name('clients.dashboard');
        Route::get('/clients/{user}/invoices', [ClientController::class, 'invoice'])->name('clients.invoices');
        Route::get('/clients/{user}/invoices/{invoice}', [ClientController::class, 'showInvoice'])->name('clients.invoices.show');
        Route::get('/clients/{user}/print-invoices/{invoice}', [ClientController::class, 'printInvoice'])->name('clients.invoices.print');
        Route::get('/clients/{user}/print-datasheet/{invoice}', [ClientController::class, 'printDatasheet'])->name('clients.invoices.printDatasheet');
    });

});
