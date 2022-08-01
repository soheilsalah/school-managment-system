<?php

use App\Http\Controllers\Financial\Pages\ExpenseController;
use App\Http\Controllers\Financial\Pages\ParentController;
use App\Http\Controllers\Financial\Pages\RewardsAndIncentivesController;
use App\Http\Controllers\Financial\Pages\StudentController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', 'HomeController@index')->name('home');

// Login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Reset Password
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Confirm Password
Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

// Verify Email
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');


/* -------------------------------------------------- My Pages -------------------------------------------------- */


/* Start Parents Pages */
Route::get('/parents', [ParentController::class, 'index'])->name('parents');

// ajax call to view parents datatables
Route::get('/datatable/parents', [ParentController::class, 'datatable'])->name('datatable.parents');
/* End Parents Pages */


/* Start Student Pages */
Route::get('/students', [StudentController::class, 'index'])->name('students');

// ajax call to view students datatables
Route::get('/datatable/students', [StudentController::class, 'datatable'])->name('datatable.students');
/* End Student Pages */


/* Start Rewards and Incentives Pages */
Route::get('/rewards-and-incentives-for-instructors', [RewardsAndIncentivesController::class, 'index'])->name('rewards-and-incentives-for-instructors');
Route::get('/instructor/{slug}/rewards', [RewardsAndIncentivesController::class, 'show'])->name('instructor.rewards');

// ajax call to view all rewards and incentives for instructors datatables
Route::get('/datatable/rewards-and-incentives-for-instructors', [RewardsAndIncentivesController::class, 'datatable'])->name('datatable.rewards-and-incentives-for-instructors');
// ajax call to view all instructor rewards datatables
Route::get('/datatable/instructor/{slug}/rewards', [RewardsAndIncentivesController::class, 'instructorRewardDatatable'])->name('datatable.instructor.rewards');
/* End Rewards and Incentives Pages */


/* Start Expenses Pages */
Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses');

// ajax call to view all expenses datatables
Route::get('/datatable/expenses', [ExpenseController::class, 'datatable'])->name('datatable.expenses');
/* End Expenses Pages */