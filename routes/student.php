<?php

use App\Http\Controllers\Student\HomeController;
use App\Http\Controllers\Student\Pages\AttendanceController;
use App\Http\Controllers\Student\Pages\ExamController;
use App\Http\Controllers\Student\Pages\LabController;
use App\Http\Controllers\Student\Pages\LibraryController;
use App\Http\Controllers\Student\Pages\OnlineSessionController;
use App\Http\Controllers\Student\Pages\ScheduleSessionController;
use App\Http\Controllers\Student\Pages\SubscriptionController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', 'HomeController@index')->name('home');
Route::post('/ajax/preview-schedule-session', 'HomeController@previewScheduleSession')->name('ajax.preview-schedule-session');

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

/* Start Home Page */
Route::get('schedule-session/join-session/{join_url}', [ScheduleSessionController::class, 'joinSession'])->name('session.join');

// ajax call to leave session
Route::post('ajax/session/leave', [ScheduleSessionController::class, 'leaveSession'])->name('ajax.session.leave');
/* End Home Page */


/* Start Subscription Page */
Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions');
Route::get('/subscription/checkout/{plan_type}', [SubscriptionController::class, 'checkout'])->name('subscription.checkout');

// ajax call to preview subscription plans
Route::post('/ajax/subscriptions/preview-plans', [SubscriptionController::class, 'previewSubscriptionPlans'])->name('ajax.subscription.preview-plans');
// ajax call to get selected specific session to purchase
Route::post('/ajax/subscriptions/selected-sesssions', [SubscriptionController::class, 'selectedSesssions'])->name('ajax.subscription.selected-sesssions');
// ajax call to get selected specific subjects to purchase
Route::post('/ajax/subscriptions/selected-subjects', [SubscriptionController::class, 'selectedSubjects'])->name('ajax.subscription.selected-subjects');
/* Start Subscription Page */


/* Start Online Session Pages */
Route::get('/online-sessions', [OnlineSessionController::class, 'index'])->name('online-sessions');
Route::get('/online-session/show/{slug}', [OnlineSessionController::class, 'show'])->name('online-session.show');

// ajax to display all schedule sessions datatables
Route::get('/datatable/schedule-sessions/{educational_class_id}', [OnlineSessionController::class, 'datatable'])->name('datatable.schedule-sessions');
/* End Online Session Pages *


/* Start Exams Pages */
Route::get('/exams', [ExamController::class, 'index'])->name('exams');

// ajax call to view exams datatables
Route::get('/datatable/exams/{educational_class_id}', [ExamController::class, 'datatable'])->name('datatable.exams');
/* End Exams Pages */


/* Start Labs Pages */
Route::get('/labs', [LabController::class, 'index'])->name('labs');
Route::get('/lab/{slug}/show', [LabController::class, 'show'])->name('lab.show');
/* End Labs Pages */


/* Start Attendance Pages */
Route::get('/attendance', [AttendanceController::class, 'attendance'])->name('attendance');
Route::get('/abscences', [AttendanceController::class, 'abscences'])->name('abscences');
/* End Attendance Pages */


/* Start Library Pages */
Route::get('/library', [LibraryController::class, 'index'])->name('library');
Route::get('/library/book/show/{slug}', [LibraryController::class, 'show'])->name('library.book.show');
/* End Library Pages */