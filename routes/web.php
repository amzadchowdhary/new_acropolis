<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchRegister;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ViewUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TaxController;



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

//**** User Panel Middleware Route ****//

Route::middleware(['auth','verified','User'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



//**** Admin Panel Middleware Route ****//

Route::middleware(['auth','verified','Admin'])->group(function () {

    // **** admin routes **** //

    Route::get('/admin_dashboard', function () {
        return view('admin_dashboard');
    })->name('admin_dashboard');
    Route::get('admin-user-register', [RegisteredUserController::class, 'admincreateuser'])->name('admin-user-register');
    Route::post('/admin-user-register', [RegisteredUserController::class, 'adminstoreuser']);

    // ****Admin Routes users ****//

    Route::get('users',[ViewUserController::class,'show'])->name('users');
    Route::get('user/profile/{id}',[ViewUserController::class,'showProfile'])->name('user.profile');
    Route::get('edit/user/{id}',[ViewUserController::class,'edit'])->name('edit.user');
    Route::post('update/user/{id}',[ViewUserController::class,'update']);
    Route::post('delete/user',[ViewUserController::class,'delete'])->name('delete.user');

    // ***** Branch Routes ***** //

    Route::get('branches',[BranchRegister::class, 'show']);
    Route::get('branch_register',function (){
        return view('auth.branch-register');
    })->name('branch_register');
    Route::post('branch_register',[BranchRegister::class, 'store']);
    Route::get('edit/branch/{id}',[BranchRegister::class,'edit'])->name('edit.branch');
    Route::post('update/branch/{id}',[BranchRegister::class,'update']);
    Route::post('delete/branch',[BranchRegister::class,'delete'])->name('delete.branch');



    //*******    tax rate routes    ******//

    Route::get('tax/register',function (){
        return view('auth.tax-register');
    })->name('tax.register');
    Route::get('tax/rate',[TaxController::class,'show'])->name('tax.rate');
    Route::post('tax/register',[TaxController::class,'store'])->name('tax.register');
    Route::get('tax/edit/{id}',[TaxController::class,'edit'])->name('edit.tax');
    Route::post('tax/update/{id}',[TaxController::class,'update']);
    Route::post('tax/delete',[TaxController::class,'delete'])->name('tax.delete');


    //***** Product Routes *****//

    Route::get('products',[ProductController::class,'show'])->name('products');
    Route::get('product/register',[ProductController::class,'create'])->name('product.register');
    Route::post('product/register',[ProductController::class,'store'])->name('product.register');
    Route::get('edit/product/{id}',[ProductController::class,'edit'])->name('product.edit');
    Route::post('update/product/{id}',[ProductController::class,'update']);
    Route::post('delete/product',[ProductController::class,'delete'])->name('product.delete');


});


require __DIR__.'/auth.php';
