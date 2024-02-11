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


Route::get('/login',function (){
    return view('pages.login');
})->name('login');

Route::get('/register',function (){
    return view('pages.register');
})->name('register');

Route::post('/register',[\App\Http\Controllers\PagesController::class,'register'])->name('registration');

Route::get('/register/driver',function (){
    return view('pages.driverRegister');
})->name('driverRegister');

Route::post('/register/driver',[\App\Http\Controllers\PagesController::class,'driverRegistration'])->name('driverRegistration');
Route::post('/login',[\App\Http\Controllers\PagesController::class,'login'])->name('loginOperation');

Route::group(['middleware' => 'role:driver'] , function (){
    Route::get('/driver/dashboard',[\App\Http\Controllers\DriverController::class,'index'])->name('driverDashboard');
    Route::get('/driver/profile/update',[\App\Http\Controllers\DriverController::class,'edit'])->name('editDriver');
    Route::post('/driver/logout',[\App\Http\Controllers\DriverController::class,'logout'])->name('driverLogout');
    Route::post('/driver/profile/update',[\App\Http\Controllers\DriverController::class,'update'])->name('updateDriver');
});

Route::group(['middleware' => 'role:passenger'] , function (){
    Route::get('/passenger/dashboard',[\App\Http\Controllers\PassengerController::class,'index'])->name('passengerDashboard');
    Route::get('/passenger/profile/update',[\App\Http\Controllers\PassengerController::class,'edit'])->name('editPassenger');
    Route::post('/passenger/profile/update',[\App\Http\Controllers\PassengerController::class,'update'])->name('updatePassenger');
    Route::post('/logout',[\App\Http\Controllers\PassengerController::class,'logout'])->name('passengerLogout');
});





