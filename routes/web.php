<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UsersGestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return view('welcome');
});

Route::get('/shop', [ShopController::class, 'index'])->middleware(['auth', 'verified'])->name('shop');



Route::middleware('auth')->group(function () {
   Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
   Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
   Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/details', function () {
   return view('cart');
})->name('details');

Route::get('/shop/{id}', [ShopController::class, 'addProductToCart'])->name('add.to.cart');
Route::post('/checkout', [ShopController::class, 'checkOut'])->name('checkout');
Route::delete('/delete-cart-product', [ShopController::class, 'deleteProduct'])->name('delete.cart.product');
Route::get('/payment', function () {
   return view('payment');
})->name('payment');




Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin-create', [AdminController::class, 'create'])->name('product.create');
Route::post('/admin-update', [AdminController::class, 'editRequest'])->name('admin.update');
Route::get('/admin-edit', [AdminController::class, 'editUser'])->name('admin.edit');
Route::get('/admin-sales', [AdminController::class, 'salesUser'])->name('admin.sales');


Route::get('/admin-messages', [MessageController::class, 'index'])
   ->name('admin.messages')
   ->middleware('auth');

Route::patch('/admin/messages/{id}/read', [MessageController::class, 'markAsRead'])->middleware('auth');
Route::delete('/admin/messages/{id}', [MessageController::class, 'destroy'])->middleware('auth');
Route::post('/admin/messages/{id}/respond', [MessageController::class, 'respond'])->name('admin.messages.respond')->middleware('auth');




Route::get('/admin-users', [UsersGestionController::class, 'index'])->name('admin.users');
Route::get('/user/{id}', [UsersGestionController::class, 'edit'])->name('user.edit');
Route::post('/user-update/{id}', [UsersGestionController::class, 'editRequest'])->name('user.update');
Route::get('/user-create', [UsersGestionController::class, 'create'])->name('user.create');
Route::post('/user-add', [UsersGestionController::class, 'store'])->name('user.add');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');



Route::post('/add-product', [AdminController::class, 'store'])->name('create.product');
Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('product.edit');
Route::post('/update/{id}', [AdminController::class, 'update'])->name('product.update');
Route::delete('/delete', [AdminController::class, 'delete'])->name('product.delete');




Route::get('/purchase-history', [SalesController::class, 'showPurchaseHistory'])
   ->name('purchase.history')
   ->middleware('auth'); // Asegúrate de que solo los usuarios autenticados puedan acceder

Route::get('/user-history/{id}', [SalesController::class, 'showHistoryById'])
   ->name('purchase.history-id')
   ->middleware('auth');

Route::get('/reports', [ReportController::class, 'productSales'])
   ->name('reports.product_sales')
   ->middleware('auth');

Route::get('/least-sales', [ReportController::class, 'leastSales'])
   ->name('reports.least-sales')
   ->middleware('auth');

Route::get('/most-revenue', [ReportController::class, 'mostRevenue'])
   ->name('reports.most-revenue')
   ->middleware('auth');

Route::get('/least-revenue', [ReportController::class, 'leastRevenue'])
   ->name('reports.least-revenue')
   ->middleware('auth');

Route::get('/top-buyers', [ReportController::class, 'topBuyers'])
   ->name('reports.top-buyers')
   ->middleware('auth');

Route::get('/top-revenue', [ReportController::class, 'topRevenueCustomers'])
   ->name('reports.top-revenue')
   ->middleware('auth');

Route::get('/by-date', [ReportController::class, 'salesByDateRange'])
   ->name('reports.by-date')
   ->middleware('auth');


Route::get('/deliveries', [DeliveryController::class, 'index'])->middleware(['auth', 'verified'])->name('delivery.index');
Route::post('/save-address', [AddressController::class, 'saveAddress'])->name('save-address');


// web.php
Route::get('/delivery/{id}/agent/{agent_id}/assign', [DeliveryController::class, 'assignAgent'])->name('assign.agent');
Route::get('/deliveries/{id}/details', [DeliveryController::class, 'showDetails'])->name('delivery.details');
Route::get('/agent/deliveries', [DeliveryController::class, 'agentDeliveries'])->name('agent.deliveries');
Route::put('/deliveries/{id}/update-status', [DeliveryController::class, 'updateStatus'])->name('deliveries.updateStatus');

require __DIR__ . '/auth.php';
