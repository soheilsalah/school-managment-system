<?php

use App\Http\Controllers\StudentParent\Pages\LibraryController;
use App\Http\Controllers\StudentParent\Pages\StudentController;
use App\Http\Controllers\StudentParent\Pages\SubscriptionController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', 'HomeController@index')->name('home');

// Login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Register
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

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


/* Start Student Subscription Pages */
Route::get('/student/{slug}/{subscription}', [SubscriptionController::class, 'index'])->name('student.subscription');
/* End Student Subscription Pages */

/* Start Subscription Page */
Route::get('/subscriptions/{student_slug}', [SubscriptionController::class, 'index'])->name('subscriptions');
Route::get('/subscription/checkout/{plan_type}', [SubscriptionController::class, 'checkout'])->name('subscription.checkout');

// ajax call to preview subscription plans
Route::post('/ajax/subscriptions/preview-plans', [SubscriptionController::class, 'previewSubscriptionPlans'])->name('ajax.subscription.preview-plans');
// ajax call to get selected specific session to purchase
Route::post('/ajax/subscriptions/selected-sesssions', [SubscriptionController::class, 'selectedSesssions'])->name('ajax.subscription.selected-sesssions');
// ajax call to get selected specific subjects to purchase
Route::post('/ajax/subscriptions/selected-subjects', [SubscriptionController::class, 'selectedSubjects'])->name('ajax.subscription.selected-subjects');
/* Start Subscription Page */

/* Start Student Pages */
Route::get('/students', [StudentController::class, 'index'])->name('students');

// ajax call to view students datatables
Route::get('/datatable/students', [StudentController::class, 'datatable'])->name('datatable.students');
// ajax call to view all student session
Route::get('/student/{slug}/sessions', [StudentController::class, 'studentSession'])->name('student.sessions');
// ajax call to preview classroom session
Route::post('/ajax/schedule-sessions/educational-class/preview-classroom-sessions', [StudentController::class, 'previewClassroomSessions'])->name('ajax.schedule-sessions.educational-class.preview-classroom-sessions');
/* End Student Pages */

/* Start Library Pages */
Route::get('/library', [LibraryController::class, 'index'])->name('library');
Route::get('/library/book/show/{slug}', [LibraryController::class, 'show'])->name('library.book.show');
/* End Library Pages */