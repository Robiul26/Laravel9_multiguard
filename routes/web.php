<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DashboarController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UnitController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\WarhouseController;
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
    return view('welcome');
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

// Route::get('/admin/dashboard', function () {
//     return view('backend.dashboard');
// })->middleware(['auth:admin', 'verified'])->name('admin.dashboard');






Route::get('/admin/dashboard', [DashboarController::class,'index'])->name('admin.dashboard')->middleware(['auth:admin', 'verified']);
require __DIR__ . '/adminauth.php';

Route::resource('users', UserController::class)->middleware(['auth:admin', 'verified']);
Route::resource('admins', AdminController::class)->middleware(['auth:admin', 'verified']);

Route::resource('customers', CustomerController::class)->middleware(['auth:admin', 'verified']);
Route::resource('warhouses', WarhouseController::class)->middleware(['auth:admin', 'verified']);
Route::resource('units', UnitController::class)->middleware(['auth:admin', 'verified']);
Route::resource('categories', CategoryController::class)->middleware(['auth:admin', 'verified']);
Route::resource('roles', RoleController::class)->middleware(['auth:admin', 'verified']);
Route::resource('permissions', PermissionController::class)->middleware(['auth:admin', 'verified']);

// Login 
// Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');
// Route::post('/admin/login/submit', [AuthenticatedSessionController::class, 'store'])->name('admin.login.submit');
// // Logout
// Route::post('/admin/logout/submit', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout.submit');
// Forget Password
// Route::get('/admin/password/reset', [NewPasswordController::class, 'create'])->name('admin.password.reset');
// Route::post('/admin/password/submit', [NewPasswordController::class, 'store'])->name('admin.password.reset.submit');
