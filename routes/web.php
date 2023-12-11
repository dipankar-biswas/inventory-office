<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CapacityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\reportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/test', function () {
    return view('pages.pdf.stock_pdf');
});
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});
Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


Route::middleware('auth')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');
    });


    // User Route 
    Route::get('/users', [AuthController::class,'index'])->middleware(['auth', 'verified'])->name('user.list');
    Route::get('/user-add', [AuthController::class,'create'])->middleware(['auth', 'verified'])->name('user.create');
    Route::post('/user-store', [AuthController::class,'store'])->middleware(['auth', 'verified'])->name('user.store');
    Route::get('/user-show/{id}', [AuthController::class,'show'])->middleware(['auth', 'verified'])->name('user.show');
    Route::post('/user-update/{id}', [AuthController::class,'update'])->middleware(['auth', 'verified'])->name('user.update');
    Route::get('/user-delete/{id}', [AuthController::class,'delete'])->middleware(['auth', 'verified'])->name('user.delete');

    // Model Route 
    Route::get('/models', [ModelController::class,'index'])->middleware(['auth', 'verified'])->name('model.list');
    Route::get('/model-add', [ModelController::class,'create'])->middleware(['auth', 'verified'])->name('model.create');
    Route::post('/model-store', [ModelController::class,'store'])->middleware(['auth', 'verified'])->name('model.store');
    Route::get('/model-show/{id}', [ModelController::class,'show'])->middleware(['auth', 'verified'])->name('model.show');
    Route::post('/model-update/{id}', [ModelController::class,'update'])->middleware(['auth', 'verified'])->name('model.update');
    Route::get('/model-delete/{id}', [ModelController::class,'destroy'])->middleware(['auth', 'verified'])->name('model.delete');

    // Brand Route 
    Route::get('/brands', [BrandController::class,'index'])->middleware(['auth', 'verified'])->name('brand.list');
    Route::get('/brand-add', [BrandController::class,'create'])->middleware(['auth', 'verified'])->name('brand.create');
    Route::post('/brand-store', [BrandController::class,'store'])->middleware(['auth', 'verified'])->name('brand.store');
    Route::get('/brand-show/{id}', [BrandController::class,'show'])->middleware(['auth', 'verified'])->name('brand.show');
    Route::post('/brand-update/{id}', [BrandController::class,'update'])->middleware(['auth', 'verified'])->name('brand.update');
    Route::get('/brand-delete/{id}', [BrandController::class,'destroy'])->middleware(['auth', 'verified'])->name('brand.delete');

    // Category Route 
    Route::get('/categories', [CategoryController::class,'index'])->middleware(['auth', 'verified'])->name('category.list');
    Route::get('/category-add', [CategoryController::class,'create'])->middleware(['auth', 'verified'])->name('category.create');
    Route::post('/category-store', [CategoryController::class,'store'])->middleware(['auth', 'verified'])->name('category.store');
    Route::get('/category-show/{id}', [CategoryController::class,'show'])->middleware(['auth', 'verified'])->name('category.show');
    Route::post('/category-update/{id}', [CategoryController::class,'update'])->middleware(['auth', 'verified'])->name('category.update');
    Route::get('/category-delete/{id}', [CategoryController::class,'destroy'])->middleware(['auth', 'verified'])->name('category.delete');

    // Capacity Route 
    Route::get('/capacities', [CapacityController::class,'index'])->middleware(['auth', 'verified'])->name('capacity.list');
    Route::get('/capacity-add', [CapacityController::class,'create'])->middleware(['auth', 'verified'])->name('capacity.create');
    Route::post('/capacity-store', [CapacityController::class,'store'])->middleware(['auth', 'verified'])->name('capacity.store');
    Route::get('/capacity-show/{id}', [CapacityController::class,'show'])->middleware(['auth', 'verified'])->name('capacity.show');
    Route::post('/capacity-update/{id}', [CapacityController::class,'update'])->middleware(['auth', 'verified'])->name('capacity.update');
    Route::get('/capacity-delete/{id}', [CapacityController::class,'destroy'])->middleware(['auth', 'verified'])->name('capacity.delete');

    // Color Route 
    Route::get('/colors', [ColorController::class,'index'])->middleware(['auth', 'verified'])->name('color.list');
    Route::get('/color-add', [ColorController::class,'create'])->middleware(['auth', 'verified'])->name('color.create');
    Route::post('/color-store', [ColorController::class,'store'])->middleware(['auth', 'verified'])->name('color.store');
    Route::get('/color-show/{id}', [ColorController::class,'show'])->middleware(['auth', 'verified'])->name('color.show');
    Route::post('/color-update/{id}', [ColorController::class,'update'])->middleware(['auth', 'verified'])->name('color.update');
    Route::get('/color-delete/{id}', [ColorController::class,'destroy'])->middleware(['auth', 'verified'])->name('color.delete');

    // Size Route 
    Route::get('/sizes', [SizeController::class,'index'])->middleware(['auth', 'verified'])->name('size.list');
    Route::get('/size-add', [SizeController::class,'create'])->middleware(['auth', 'verified'])->name('size.create');
    Route::post('/size-store', [SizeController::class,'store'])->middleware(['auth', 'verified'])->name('size.store');
    Route::get('/size-show/{id}', [SizeController::class,'show'])->middleware(['auth', 'verified'])->name('size.show');
    Route::post('/size-update/{id}', [SizeController::class,'update'])->middleware(['auth', 'verified'])->name('size.update');
    Route::get('/size-delete/{id}', [SizeController::class,'destroy'])->middleware(['auth', 'verified'])->name('size.delete');


    // Stock Route 
    Route::get('/stocks', [StockController::class,'index'])->middleware(['auth', 'verified'])->name('stock.list');
    Route::get('/stock-add', [StockController::class,'create'])->middleware(['auth', 'verified'])->name('stock.create');
    Route::get('/stockadd', [StockController::class,'extrastockadd'])->middleware(['auth', 'verified'])->name('stockadd.extrastockadd');
    Route::post('/stockinsert', [StockController::class,'extrastockinsert'])->middleware(['auth', 'verified'])->name('stockinsert.extrastockinsert');
    Route::get('/stockin', [StockController::class,'stockinlist'])->middleware(['auth', 'verified'])->name('stockin.list');



    Route::post('/stock-stores', [StockController::class,'store'])->middleware(['auth', 'verified'])->name('stock.store');
    Route::get('/stock-show/{id}', [StockController::class,'show'])->middleware(['auth', 'verified'])->name('stock.show');
    Route::post('/stock-update/{id}', [StockController::class,'update'])->middleware(['auth', 'verified'])->name('stock.update');
    Route::get('/stock-delete/{id}', [StockController::class,'destroy'])->middleware(['auth', 'verified'])->name('stock.delete');

    Route::get('/stockout-list', [StockController::class,'stockoutList'])->middleware(['auth', 'verified'])->name('stockout.list');
    Route::get('/stockout-all', [StockController::class,'stockoutAll'])->middleware(['auth', 'verified'])->name('stockout.all');


    Route::get('/stockout-idbydata', [StockController::class,'stockoutbydata'])->middleware(['auth', 'verified'])->name('stockout-idbydata.stockoutbydata');

    //Stockout store
    Route::post('/stockout-store', [StockController::class,'stockoutstore'])->middleware(['auth', 'verified'])->name('stockout.stockoutstore');


    // Refund Route 
    Route::get('/refund-list', [RefundController::class,'index'])->middleware(['auth', 'verified'])->name('refund.list');
    Route::get('/refund-add', [RefundController::class,'create'])->middleware(['auth', 'verified'])->name('refund.add');
    Route::post('/refund-store', [RefundController::class,'refundStockadd'])->middleware(['auth', 'verified'])->name('refund.store');





    // Product Route 
    Route::get('/products', [ProductController::class,'index'])->middleware(['auth', 'verified'])->name('product.list');
    Route::get('/product-add', [ProductController::class,'create'])->middleware(['auth', 'verified'])->name('product.create');
    Route::post('/product-store', [ProductController::class,'store'])->middleware(['auth', 'verified'])->name('product.store');
    Route::get('/product-show/{id}', [ProductController::class,'show'])->middleware(['auth', 'verified'])->name('product.show');
    Route::post('/product-update/{id}', [ProductController::class,'update'])->middleware(['auth', 'verified'])->name('product.update');
    Route::get('/product-delete/{id}', [ProductController::class,'destroy'])->middleware(['auth', 'verified'])->name('product.delete');


    // Site Setting Route
    Route::get('/settings', [SettingController::class,'SettingPage'])->middleware(['auth', 'verified'])->name('settings.page');
    Route::post('/settings-update/header', [SettingController::class,'SettingHeaderUpdate'])->middleware(['auth', 'verified'])->name('settings.update.header');
    Route::post('/settings-update/information', [SettingController::class,'SettingInformationUpdate'])->middleware(['auth', 'verified'])->name('settings.update.information');
    Route::post('/settings-update/social', [SettingController::class,'SettingSocialUpdate'])->middleware(['auth', 'verified'])->name('settings.update.social');
    Route::post('/settings-update/footer', [SettingController::class,'SettingFooterUpdate'])->middleware(['auth', 'verified'])->name('settings.update.footer');
    Route::post('/settings-update/copyright', [SettingController::class,'SettingCopyrightUpdate'])->middleware(['auth', 'verified'])->name('settings.update.copyright');



    //For report controller
    Route::get('/today', [reportController::class,'todaygetData'])->middleware(['auth', 'verified'])->name('today.todaygetData');
    Route::get('/daterange', [reportController::class,'dateRangeReport'])->middleware(['auth', 'verified'])->name('daterange.getdata');
    Route::get('/product-wise', [reportController::class,'productWiseReport'])->middleware(['auth', 'verified'])->name('product.wise.report');
    // Route::post('/gettoday', [reportController::class,'findTodayData'])->middleware(['auth', 'verified'])->name('gettoday.findTodayData');




    //For PDF file
    Route::get('/todayPDF', [reportController::class,'getTodayPDF'])->middleware(['auth', 'verified'])->name('todayPDF.todayPDF');
    Route::get('/dateRangePDF', [reportController::class,'getDateRangePDF'])->middleware(['auth', 'verified'])->name('dateRangePDF.getDateRangePDF');
    Route::get('/prdocutwish', [reportController::class,'productwishpdf'])->middleware(['auth', 'verified'])->name('prdocutwish.productwishpdf');
});

