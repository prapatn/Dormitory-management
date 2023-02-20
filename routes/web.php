<?php

use App\Http\Controllers\AgreementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\DormitoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoomController;
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

Route::get('/', function () {
    return redirect('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/', [AuthController::class, 'authenticated']);

    // //Admin
    // Route::middleware(['roleChecker:admin'])->group(function () {
    //     Route::get('/dashboard', function () {
    //         return view('dashboard');
    //     })->name('dashboard');
    // });

    //  Owner
    Route::middleware(['roleChecker:owner'])->group(function () {
        //Dormitories
        Route::get('/dormitories', [DormitoryController::class, 'index'])->name('dorm');
        Route::get('/dormitories/create', [DormitoryController::class, 'create'])->name('dorm.create');
        Route::get('/dormitories/payment/{id}', [DormitoryController::class, 'payment'])->name('dorm.payment');
        Route::post('/dormitories/store', [DormitoryController::class, 'store'])->name('dorm.store');
        Route::get('/dormitories/edit/{id}', [DormitoryController::class, 'edit']);
        Route::post('/dormitories/update', [DormitoryController::class, 'update'])->name('dorm.update');
        Route::post('/dormitories/update/payment', [DormitoryController::class, 'updatePayment'])->name('dorm.update.payment');
        Route::get('/dormitories/show/{id}', [DormitoryController::class, 'show'])->name('dorm.show');
        Route::get('/dormitories/delete/{id}', [DormitoryController::class, 'delete']);

        //Room
        Route::get('/room/create/{id}', [RoomController::class, 'create'])->name('room.create');
        Route::post('/room/store', [RoomController::class, 'store'])->name('room.store');
        Route::get('/room/delete/{id}', [RoomController::class, 'delete'])->name('room.delete');
        Route::get('/room/edit/{id}', [RoomController::class, 'edit'])->name('room.edit');
        Route::post('/room/update', [RoomController::class, 'update'])->name('room.update');
        Route::get('/room/show/{id}', [RoomController::class, 'show'])->name('room.show');

        //Agreement
        Route::get('/agreement/create/{id}', [AgreementController::class, 'create'])->name('agreement.create');
        Route::post('/agreement/store', [AgreementController::class, 'store'])->name('agreement.store');
        Route::get('/agreement/index/{id}', [AgreementController::class, 'index'])->name('agreement.index');
        Route::get('/agreement/edit/{id}', [AgreementController::class, 'edit'])->name('agreement.edit');
        Route::get('/agreement/delete/{id}', [AgreementController::class, 'delete'])->name('agreement.delete');
        Route::post('/agreement/update', [AgreementController::class, 'update'])->name('agreement.update');
        Route::get('/agreement/exit/{id}', [AgreementController::class, 'exit'])->name('agreement.exit');
        Route::post('/agreement/status', [AgreementController::class, 'agreement_exit_status'])->name('agreement.exit.status');

        //Bill
        Route::get('/bill/create/{id}', [BillController::class, 'create'])->name('bill.create');
        Route::post('/bill/store', [BillController::class, 'store'])->name('bill.store');
        Route::get('/bill/delete/{id}', [BillController::class, 'delete'])->name('bill.delete');
        Route::get('/bill/edit/{id}', [BillController::class, 'edit'])->name('bill.edit');
        Route::post('/bill/update', [BillController::class, 'update'])->name('bill.update');

        Route::get('/payment/edit/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
    });

    // Renter
    Route::middleware(['roleChecker:renter'])->group(function () {
        Route::get('/agreement/notification_show', [AgreementController::class, 'notification_show'])->name('agreement.notification_show');
        Route::get('/agreement/status/{id}/{status}', [AgreementController::class, 'agreement_change_status'])->name('agreement.status');

        Route::get('/bill/index', [BillController::class, 'index'])->name('bill.index');

        Route::get('/payment/index', [PaymentController::class, 'index'])->name('payment.index');
        Route::get('/payment/create/{id}', [PaymentController::class, 'create'])->name('payment.create');
        Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');
    });

    Route::middleware(['roleChecker:renter,owner'])->group(function () {
        Route::get('/agreement/show/{id}', [AgreementController::class, 'show'])->name('agreement.show');
        Route::get('/bill/show/{id}', [BillController::class, 'show'])->name('bill.show');
    });

    // Route::get('/dash2', function () {
    //     return view('dash2');
    // })->middleware('roleChecker:renter')->name('dash2');
});
