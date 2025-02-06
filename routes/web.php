<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\TicketCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Manager\DashboardController as ManagerDashboard;

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


Route::get('/', [AuthController::class, 'showLoginFrom'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterFrom'])->name('register');
Route::post('/register-submit', [AuthController::class, 'registerSubmit'])->name('register.submit');

Route::group(['middleware' => 'role:1', 'prefix' => 'user'], function () {
    Route::get('/dashboard', [UserDashboard::class, 'dashboard'])->name('user.dashboard');
    Route::resource('tickets', TicketController::class);
    Route::get('get-items', [TicketController::class, 'getItems'])->name('getItems');
    Route::post('add-item', [TicketController::class, 'addItem'])->name('addItem');
});

Route::group(['middleware' => 'role:2', 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('departments', DepartmentController::class);
    Route::resource('designations', DesignationController::class);
    Route::resource('ticket-categories', TicketCategoryController::class);
    Route::resource('buildings', BuildingController::class);
    Route::resource('items', ItemController::class);
});

Route::group(['middleware' => 'role:3', 'prefix' => 'manager'], function () {
    Route::get('/dashboard', [ManagerDashboard::class, 'dashboard'])->name('manager.dashboard');
});

