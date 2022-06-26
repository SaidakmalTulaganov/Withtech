<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SmartphoneController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\TvController;
use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\WashingmachineController;
use App\Http\Controllers\ElectricstoveController;
use App\Http\Controllers\GasstoveController;
use App\Http\Controllers\DishwasherController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FeatureSetController;
use App\Http\Controllers\ManufacturersController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ClientOrderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderAdminController;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\UserController;

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

Auth::routes();

Route::get('shipments/export/', [App\Http\Controllers\ShipmentController::class, 'export'])->name('shipments.export');

Route::get('ordersadmin/export/', [App\Http\Controllers\OrderAdminController::class, 'export'])->name('ordersadmin.export');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('home.search');

Route::get('/Search', [App\Http\Controllers\ClientOrderController::class, 'Search'])->name('clientorders.Search');

Route::resources([
    'products' => ProductController::class,
]);

Route::resources([
    'basketProducts' => BasketController::class,
]);

Route::resources([
    'orders' => OrderController::class,
]);

Route::resources([
    'smartphones' => SmartphoneController::class,
]);

Route::resources([
    'computers' => ComputerController::class,
]);

Route::resources([
    'laptops' => LaptopController::class,
]);

Route::resources([
    'tvs' => TvController::class,
]);

Route::resources([
    'households' => HouseholdController::class,
]);

Route::resources([
    'washingmachines' => WashingmachineController::class,
]);

Route::resources([
    'electricstoves' => ElectricstoveController::class,
]);

Route::resources([
    'gasstoves' => GasstoveController::class,
]);

Route::resources([
    'dishwashers' => DishwasherController::class,
]);

Route::resources([
    'categories' => CategoriesController::class,
]);

Route::resources([
    'manufacturers' => ManufacturersController::class,
]);

Route::resources([
    'productsadmin' => ProductAdminController::class,
]);

Route::resources([
    'suppliers' => SupplierController::class,
]);

Route::resources([
    'shipments' => ShipmentController::class,
]);

Route::resources([
    'featuresets' => FeatureSetController::class,
]);

Route::resources([
    'productspages' => ProductPageController::class,
]);

Route::resources([
    'clientorders' => ClientOrderController::class,
]);

Route::resources([
    'clients' => ClientController::class,
]);

Route::resources([
    'ordersadmin' => OrderAdminController::class,
]);

Route::resources([
    'selects' => SelectController::class,
]);

Route::resources([
    'states' => StatesController::class,
]);

Route::resources([
    'users' => UserController::class,
]);
