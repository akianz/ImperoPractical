<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\BusinessController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});

Route::resource('business', BusinessController::class);
Route::get('business_data', [BusinessController::class,'anydata'])->name('business.data');
Route::resource('branch', BranchController::class);
Route::get('branch_data', [BranchController::class,'anydata'])->name('branch.data');
Route::get('branch-time/{id}', [BranchController::class,'show_timing'])->name('branch.show_timing');
Route::get('branch-time-data/{id}', [BranchController::class,'branch_timing_list'])->name('branch_timing_list');
Route::get('branch_timing', [BranchController::class,'branch_timing_list'])->name('branch.timing');
