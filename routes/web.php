<?php

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
    return view('auth.login');
})->middleware('guest');

Route::get('/hehet', function () {
    return view('testing');
});

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->middleware('status')->middleware('user')->middleware('terminal')->middleware('sv')->middleware('payroll')->middleware('admin');

//->middleware('status')

// Route::get('/terminal', function () {
//     return view('pages.terminal');
// })->middleware('auth')->middleware('user')->middleware('admin')->middleware('payroll');

// Route::get('/canteenSV', function () {
//     return view('pages.canteensv');
// })->middleware('auth')->middleware('user')->middleware('admin')->middleware('payroll');

// Route::get('/logs', function () {
//     return view('pages.logs');
// })->middleware('auth')->middleware('user')->middleware('terminal')->middleware('payroll');

Route::get('/scan', function () {
    return view('pages.test');
})->middleware('auth')->middleware('user')->middleware('admin')->middleware('payroll');

Auth::routes();

Route::resource('transaction', 'App\Http\Controllers\TransactionController');
Route::resource('Canteen', 'App\Http\Controllers\AddCanteenController');
Route::resource('userRole', 'App\Http\Controllers\userRoleController');
Route::resource('Rfid', 'App\Http\Controllers\RfidController');
Route::resource('dateFillter', 'App\Http\Controllers\dateFillterController');
Route::get('/logs', [App\Http\Controllers\LogsController::class, 'index'])->middleware('auth')->middleware('user')->middleware('terminal')->middleware('payroll');
Route::get('/user', [App\Http\Controllers\TransactionController::class, 'userDisplay'])->name('user')->middleware('terminal');
Route::get('/cps', [App\Http\Controllers\TransactionController::class, 'cpsDisplay'])->name('cps')->middleware('auth')->middleware('terminal')->middleware('user');
Route::get('/terminal', [App\Http\Controllers\TransactionController::class, 'index'])->middleware('auth')->middleware('user')->middleware('admin')->middleware('payroll');
// Route::get('/test', [App\Http\Controllers\userRoleController::class, 'store']);
// Route::get('/terminal', [App\Http\Controllers\TransactionController::class, 'searchRFID'])->middleware('auth')->middleware('user')->middleware('admin')->middleware('payroll');

Route::post('/cashier', [App\Http\Controllers\AddCashierController::class, 'create'])->name('AddCashier');
Route::post('/cps', [App\Http\Controllers\AddCashierController::class, 'create'])->name('AddCashier');

// Route::get('add-to-log', [App\Http\Controllers\HomeController::class, 'myTestAddToLog']);
// Route::get('logActivity', [App\Http\Controllers\HomeController::class, 'logActivity']);
Route::get('/canteen', [App\Http\Controllers\AddCanteenController::class, 'index'])->name('AddCanteen');
Route::get('/cashier', [App\Http\Controllers\AddCashierController::class, 'index'])->name('AddCashier');
Route::get('/roles', [App\Http\Controllers\userRoleController::class, 'index'])->name('userRole');
Route::get('/canteenSV', [App\Http\Controllers\CanteenSVController::class, 'index'])->name('canteenSV')->middleware('auth')->middleware('user')->middleware('admin')->middleware('payroll');

// Route::get('/canteen', function () {
//     return view('pages.canteen');
// })->middleware('auth');


// Route::get('add-to-log', [App\Http\Controllers\HomeController::class, 'myTestAddToLog']);
// Route::get('logActivity', [App\Http\Controllers\HomeController::class, 'logActivity']);



























// Route::get('/home', function () {
//     return view('home');
// })->middleware('auth')->middleware('status')->middleware('terminal')->middleware('user')->middleware('payroll')->middleware('admin');

// Route::get('/terminal', function () {
//     return view('pages.terminal');
// })->middleware('auth')->middleware('user')->middleware('payroll');

// Route::get('/user', function () {
//     return view('pages.user');
// })->middleware('auth')->middleware('terminal');

// Route::get('/logs', function () {
//     return view('pages.logs');
// })->middleware('auth')->middleware('terminal')->middleware('user')->middleware('payroll');
// // si terminal wala syang logs, si user wala syang logs, si payroll wala syang logs

// Route::get('/cps', function () {
//     return view('pages.cps');
// })->middleware('auth')->middleware('terminal')->middleware('user');

// Auth::routes();

// Route::resource('transaction', 'App\Http\Controllers\TransactionController');
// Route::get('/user', [App\Http\Controllers\TransactionController::class, 'userDisplay'])->name('user');
// Route::get('/cps', [App\Http\Controllers\TransactionController::class, 'cpsDisplay'])->name('cps');

