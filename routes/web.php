<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DormitoryController;
use App\Http\Controllers\RoomController;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Middleware;
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
        Route::get('/dormitories/show/{id}', [DormitoryController::class, 'show']);
        Route::get('/dormitories/delete/{id}', [DormitoryController::class, 'delete']);

        //Room
        Route::get('/room/create/{id}', [RoomController::class, 'create'])->name('room.create');
        Route::post('/room/store', [RoomController::class, 'store'])->name('room.store');
    });

    // Renter
    Route::middleware(['roleChecker:renter'])->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });

    // Route::get('/dash2', function () {
    //     return view('dash2');
    // })->middleware('roleChecker:renter')->name('dash2');
});
