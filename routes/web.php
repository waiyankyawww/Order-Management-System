<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchRequestController;
use App\Http\Controllers\BranchRequestControllerNew;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RechargeRequestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::group(['middleware' => 'checkAdmin'], function () {

    Route::get('/home',[DashboardController::class,'index']);
    Route::get('/',[DashboardController::class,'index']);
    Route::get('/admin/dashboard',[DashboardController::class,'index'])->name('home');
    Route::get('/admin/dashboard/branches',[DashboardController::class,'branchData'])->name('allApprovedBranch');



    //Admin
    Route::resource('admins', AdminController::class);
    Route::get('admin/delete-admins',[AdminController::class,'getDeleteAdmin'])->name('getDeleteAdmin');
    Route::post('admins/update', [AdminController::class, 'update'])->name('Admin-update');
    Route::get('admin/profile-detail/{id}', [AdminController::class, 'profileDetails'])->name('profileDetails');
    Route::get('admins/{id}/restore', [AdminController::class, 'restore']);


    //Owner
    Route::resource('owners', OwnerController::class);
    Route::get('admin/delete-owners',[OwnerController::class,'getDeleteOwner'])->name('getDeleteOwner');
    Route::post('/admin/confirm-add-owner',[OwnerController::class,'store'])->name('confirm-add-owner');
    Route::post('owners/update', [OwnerController::class, 'update'])->name('Owner-update');
    Route::get('owner/profile-detail/{id}', [OwnerController::class, 'profileDetails'])->name('profileDetail');
    Route::get('owners/{id}/restore', [OwnerController::class, 'restore']);



    //Invoice
    Route::get('/admin/invoice/{id}',[InvoiceController::class,'index'])->name('invoice');
    Route::get('/admin/invoice-list',[InvoiceController::class,'invoice_list'])->name('invoice-list');

    //Branch Request
    Route::get('/admin/branch-request',[BranchRequestController::class, 'index'])->name('branch-request');
    Route::get('/admin/approve-shop',[BranchRequestController::class, 'approve_shop'])->name('approve-shop');
    Route::get('/admin/cancel-shop',[BranchRequestController::class, 'cancel_shop'])->name('cancel-shop');
    Route::get('/admin/pending-shop',[BranchRequestController::class, 'pending_shop'])->name('pending-shop');

    //Recharge Request
    Route::get('admin/recharge-request',[RechargeRequestController::class, 'index'])->name('recharge-request');
    Route::get('admin/recharge-confirm/{id}',[RechargeRequestController::class, 'confirmRecharge'])->name('recharge-confirm');

    //Profile
    Route::get('admin/profile-edit',[AdminController::class,'editProfile'])->name('editProfile');
    Route::post('admin/profile-update',[AdminController::class,'updateProfile'])->name('updateProfile');
    Route::post('admin/upload-profilePhoto', [AdminController::class, 'uploadProfilePhoto'])->name('uploadPhoto');
    Route::post('admin/update-password',[AdminController::class,'updatePassword'])->name('updatePassword');


    //Notification
    Route::get('admin/notification',[NotificationController::class,'index'])->name('noti');

    //GettingTownship
    Route::get('admin/getTownship',[AdminController::class,'getTownship'])->name('getTownship');


});


Auth::routes();


