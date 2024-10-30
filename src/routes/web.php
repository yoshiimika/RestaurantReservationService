<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShopOwnerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/thanks', [PageController::class, 'thanks'])
    ->name('thanks');

Route::name('shops.')->group(function () {
    Route::get('/', [ShopController::class, 'index'])
    ->name('index');
    Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])
    ->name('detail');
});

Route::get('/search', [SearchController::class, 'search'])
    ->name('search');

Route::get('/mypage', [UserController::class, 'index'])
    ->middleware(['auth', 'verified', 'role:user'])
    ->name('users.mypage');

Route::post('/favorites/toggle/{shopId}', [FavoriteController::class, 'toggle'])
    ->middleware(['auth', 'verified', 'role:user'])
    ->name('favorite.toggle');

Route::middleware(['auth', 'verified', 'role:user'])->prefix('reservations')->name('reservations.')->group(function () {
    Route::post('/confirm', [ReservationController::class, 'confirm'])
    ->name('confirm');
    Route::post('/add', [ReservationController::class, 'add'])
    ->name('add');
    Route::get('/done', [ReservationController::class, 'done'])
    ->name('done');
    Route::prefix('edit/{reservation}')->name('edit.')->group(function () {
        Route::get('/', [ReservationController::class, 'edit'])
        ->name('edit');
        Route::post('/confirm', [ReservationController::class, 'updateConfirm'])
        ->name('confirm');
        Route::patch('/update', [ReservationController::class, 'update'])
        ->name('update');
    });
    Route::get('/edit-done', [ReservationController::class, 'updateDone'])
    ->name('edit.done');
    Route::prefix('delete/{reservation}')->name('delete.')->group(function () {
        Route::post('/confirm', [ReservationController::class, 'deleteConfirm'])
        ->name('confirm');
        Route::delete('/', [ReservationController::class, 'delete'])
        ->name('delete');
    });
    Route::get('/delete-done', [ReservationController::class, 'deleteDone'])
    ->name('delete.done');
});

Route::middleware(['auth', 'verified', 'role:user'])->prefix('reviews')->name('reviews.')->group(function () {
    Route::get('/create/{shop}', [ReviewController::class, 'create'])
    ->name('create');
    Route::post('/confirm/{shop}', [ReviewController::class, 'confirm'])
    ->name('confirm');
    Route::post('/store/{shop}', [ReviewController::class, 'store'])
    ->name('store');
    Route::get('/done', [ReviewController::class, 'done'])
    ->name('done');
    Route::prefix('edit/{review}')->name('edit.')->group(function () {
        Route::get('/', [ReviewController::class, 'edit'])
        ->name('edit');
        Route::post('/confirm', [ReviewController::class, 'updateConfirm'])
        ->name('confirm');
        Route::patch('/update', [ReviewController::class, 'update'])
        ->name('update');
    });
    Route::get('/edit-done', [ReviewController::class, 'updateDone'])
    ->name('edit.done');
    Route::prefix('delete/{review}')->name('delete.')->group(function () {
        Route::post('/confirm', [ReviewController::class, 'deleteConfirm'])
        ->name('confirm');
        Route::delete('/', [ReviewController::class, 'delete'])
        ->name('delete');
    });
    Route::get('/delete-done', [ReviewController::class, 'deleteDone'])
    ->name('delete.done');
});

Route::middleware(['auth', 'verified', 'role:user'])->prefix('payment')->name('payment.')->group(function () {
    Route::get('/input-amount', [PaymentController::class, 'showAmountInputForm'])
    ->name('input-amount');
    Route::get('/checkout', [PaymentController::class, 'checkout'])
    ->name('checkout');
    Route::get('/success', [PaymentController::class, 'success'])
    ->name('success');
    Route::get('/cancel', [PaymentController::class, 'cancel'])
    ->name('cancel');
});

Route::middleware(['auth', 'role:shop_owner'])->prefix('shop_owner')->name('shop_owner.')->group(function () {
    Route::get('/reservations', [ShopOwnerController::class, 'viewReservations'])
    ->name('reservations');
    Route::post('/reservations/date', [ShopOwnerController::class, 'filterByDate'])
    ->name('per.date');
    Route::prefix('shop')->name('shop.')->group(function () {
        Route::get('/create', [ShopOwnerController::class, 'create'])
        ->name('create');
        Route::post('/confirm', [ShopOwnerController::class, 'confirm'])
        ->name('confirm');
        Route::post('/store', [ShopOwnerController::class, 'store'])
        ->name('store');
        Route::get('/done', [ShopOwnerController::class, 'done'])
        ->name('done');
    });
    Route::prefix('shop/edit/{shop}')->name('shop.edit.')->group(function () {
        Route::get('/', [ShopOwnerController::class, 'edit'])
        ->name('edit');
        Route::post('/confirm', [ShopOwnerController::class, 'updateConfirm'])
        ->name('confirm');
        Route::patch('/update', [ShopOwnerController::class, 'update'])
        ->name('update');
    });
    Route::get('/edit-done', [ShopOwnerController::class, 'updateDone'])
    ->name('shop.edit.done');
    Route::prefix('notification')->name('notification.')->group(function () {
        Route::get('/create', [MailController::class, 'create'])
        ->name('create');
        Route::post('/confirm', [MailController::class, 'confirm'])
        ->name('confirm');
        Route::post('/send', [MailController::class, 'send'])
        ->name('send');
        Route::get('/done', [MailController::class, 'done'])
        ->name('done');
    });
    Route::get('/reservation/{id}/check', [MailController::class, 'checkReservation'])
    ->name('check');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/shop_owners', [AdminController::class, 'shopOwnersList'])
    ->name('shop_owners');
    Route::get('/create', [AdminController::class, 'create'])
    ->name('create');
    Route::post('/confirm', [AdminController::class, 'confirm'])
    ->name('confirm');
    Route::post('/store', [AdminController::class, 'store'])
    ->name('store');
    Route::get('/done', [AdminController::class, 'done'])
    ->name('done');
    Route::prefix('edit/{shopOwner}')->name('edit.')->group(function () {
        Route::get('/', [AdminController::class, 'edit'])
        ->name('edit');
        Route::post('/confirm', [AdminController::class, 'updateConfirm'])
        ->name('confirm');
        Route::patch('/update', [AdminController::class, 'update'])
        ->name('update');
    });
    Route::get('/edit-done', [AdminController::class, 'updateDone'])
    ->name('edit.done');
    Route::prefix('delete/{shopOwner}')->name('delete.')->group(function () {
        Route::post('/confirm', [AdminController::class, 'deleteConfirm'])
        ->name('confirm');
        Route::delete('/', [AdminController::class, 'delete'])
        ->name('delete');
    });
    Route::get('/delete-done', [AdminController::class, 'deleteDone'])
    ->name('delete.done');
});
