<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\RoomsController;
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

Route::get('/', [RoomsController::class, 'signInPage']);

Route::middleware(['super_admin_auth'])->group(function () {

    Route::get('/super/admin/dashboard', [RoomsController::class, 'superAdminDashboardPage']);

    Route::get('/add-motel-page', [RoomsController::class, 'addMotelPage']);

    Route::get('/add-admin', [RentalController::class, 'addAdminPage']);

    Route::post('/add-new-motel', [RoomsController::class, 'addNewMotel']);

    Route::get('/list-of-motels', [RoomsController::class, 'listOfMotels']);
});

Route::post('/login', [RoomsController::class, 'loginUser']);

Route::middleware(['user_auth'])->group(function () {

    Route::get('/admin-dashboard', [RoomsController::class, 'dashboardPage']);

    Route::get('/motel-rentals', [RoomsController::class, 'motelRentals']);

    Route::get('/motel-guests', [RoomsController::class, 'motelGuests']);

    Route::get('/list-of-rooms', [RoomsController::class, 'listOfRooms']);

    Route::get('/payment-list', [RoomsController::class, 'paymentList']);

    Route::get('/refund-list', [AdminController::class, 'refundList']);

    Route::get('/expenses-list', [AdminController::class, 'getMotelExpenses']);

    Route::get('/users-list', [AdminController::class, 'getAllUsers']);


    Route::get('/rent/{id}', [AdminController::class, 'editRent']);

    Route::post('/add-user', [AdminController::class, 'addUser']);

    Route::post('/add-expense', [AdminController::class, 'addExpense']);

    Route::post('/add-room', [AdminController::class, 'addRoom']);

    Route::post('/add-guest', [AdminController::class, 'addGuest']);

    Route::post('/add-rent', [AdminController::class, 'addRent']);

    Route::get('/edit-guest-{id}', [AdminController::class, 'editGuest']);

    Route::post('/update-guest', [AdminController::class, 'updateGuest']);

    Route::get('/edit-room-{id}', [AdminController::class, 'editRoom']);

    Route::post('/update-room', [AdminController::class, 'updateRoom']);

    Route::post('/add-payment', [RentalController::class, 'addPayment']);

    Route::post('/add-refund', [RentalController::class, 'addRefund']);

    Route::get('/logout', [RentalController::class, 'logOut']);

    Route::get('/change-password', [RentalController::class, 'changePassword']);

    Route::post('/update-password', [RentalController::class, 'updatePassword']);

    Route::post('/add-booking', [RentalController::class, 'addBookings']);

    Route::get('/motel-bookings', [RentalController::class, 'motelBookings']);

    Route::get('/reciept-{payment_id}', [RentalController::class, 'RecieptPage']);

    Route::get('/reports', [RentalController::class, 'reportsPage']);

    Route::post('/get/summaries', [RentalController::class, 'getSummaries']);
});
