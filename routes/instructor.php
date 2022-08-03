<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Instructor\Pages\EducationalClassController;
use App\Http\Controllers\Instructor\Pages\LibraryController;
use App\Http\Controllers\Instructor\Pages\OnlineSessionController;
use App\Http\Controllers\Instructor\Pages\ProfitController;
use App\Http\Controllers\Instructor\Pages\RewardsAndIncentivesController;
use App\Http\Controllers\Instructor\Pages\ScheduleSessionController;
use App\Http\Controllers\Instructor\Pages\SessionExcersiceController;

// Dashboard
Route::get('/', 'HomeController@index')->name('home');
Route::post('/ajax/preview-schedule-session', 'HomeController@previewScheduleSession')->name('ajax.preview-schedule-session');

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


/* Start Educational Classes Pages */
Route::get('/educational-classes', [EducationalClassController::class, 'index'])->name('educational-classes');

// ajax call to view educational classes datatables
Route::get('/datatable/educational-classes', [EducationalClassController::class, 'datatable'])->name('datatable.educational-classes');
/* End Educational Classes Pages */


/* Start Schedule Sessions Pages */
Route::get('schedule-sessions', [ScheduleSessionController::class, 'index'])->name('schedule-sessions');
Route::get('create-session', [ScheduleSessionController::class, 'create'])->name('create-session');
Route::get('schedule-session/show/{slug}', [ScheduleSessionController::class, 'show'])->name('schedule-session.show');
Route::get('schedule-session/start-session/{start_url}', [ScheduleSessionController::class, 'startSession'])->name('session.start');
Route::get('schedule-session/join-session/{join_url}', [ScheduleSessionController::class, 'joinSession'])->name('session.join');

// ajax to display all schedule sessions datatables
Route::get('/datatable/schedule-sessions', [ScheduleSessionController::class, 'datatable'])->name('datatable.schedule-sessions');
// ajax to display all educational classes when change educational stage
Route::post('ajax/create-session/display-all-educational-classes', [ScheduleSessionController::class, 'displayEducationalClasses'])->name('ajax.create-session.display-all-educational-classes');
// ajax to check if session is recurrsive or not
Route::post('ajax/is-session-recurrsive', [ScheduleSessionController::class, 'isSessionRecurrsive'])->name('ajax.is-session-recurrsive');
// ajax to create new schedule session
Route::post('ajax/create-session', [ScheduleSessionController::class, 'createSession'])->name('ajax.create-session');
// ajax to delete schedule session
Route::post('ajax/delete-session', [ScheduleSessionController::class, 'deleteSession'])->name('ajax.delete-session');
// ajax call to start sesison
Route::post('ajax/start-session', [ScheduleSessionController::class, 'ajaxStartSession'])->name('ajax.start-session');
// ajax call to end sesison
Route::post('ajax/end-session', [ScheduleSessionController::class, 'endSession'])->name('ajax.end-session');
/* End Schedule Sessions Pages */



/* Start Recorded Courses Pages */
/* End Recorded Courses Pages */


/* Start Exam Pages */
/* End Exam Pages */


/* Start Excercies Pages */
Route::get('/session-excersices', [SessionExcersiceController::class, 'index'])->name('session-excersices');
/* End Excercies Pages */


/* Start Rewards and Incentives Pages */
Route::get('/rewards-and-incentives-for-instructors', [RewardsAndIncentivesController::class, 'index'])->name('rewards-and-incentives-for-instructors');

// ajax call to view all rewards and incentives for instructor datatables
Route::get('/datatable/rewards-and-incentives-for-instructors', [RewardsAndIncentivesController::class, 'instructorRewardDatatable'])->name('datatable.instructor.rewards');
/* End Rewards and Incentives Pages */


/* Start Certificates Pages */
/* End Certificates Pages */


/* Start Attendance Pages */
/* End Attendance Pages */


/* Start Library Pages */
Route::get('/library', [LibraryController::class, 'index'])->name('library');
Route::get('/library/book/create', [LibraryController::class, 'create'])->name('library.book.create');
Route::get('/library/book/show/{slug}', [LibraryController::class, 'show'])->name('library.book.show');
Route::get('/library/my-books', [LibraryController::class, 'myBooks'])->name('library.my-books');
Route::get('/library/my-book/show/{slug}', [LibraryController::class, 'myBook'])->name('library.my-book.show');

// ajax call to view all instructor books datatable
Route::get('/datatable/library/my-books', [LibraryController::class, 'myBooksDatatable'])->name('datatable.library.my-books');
// ajax call to preview book category input option
Route::post('/ajax/library/book/book-category/preview', [LibraryController::class, 'previewBookCatgory'])->name('ajax.library.book.book-category.preview');
// ajax call to preview book price option
Route::post('/ajax/library/book/price-options/preview', [LibraryController::class, 'previewPriceOption'])->name('ajax.library.book.price-options.preview');
// ajax call to create new book
Route::post('/ajax/library/book/create', [LibraryController::class, 'createNewBook'])->name('ajax.library.book.create');
// ajax call to update book info
Route::post('/ajax/library/book/info/update', [LibraryController::class, 'updateBookInfo'])->name('ajax.library.book.info.update');
// ajax call to update book price
Route::post('/ajax/library/book/price/update', [LibraryController::class, 'updateBookPrice'])->name('ajax.library.book.price.update');
// ajax call to update book thumbnail
Route::post('/ajax/library/book/thumbnail/update', [LibraryController::class, 'updateBookThumbnail'])->name('ajax.library.book.thumbnail.update');
// ajax call to update book pdf
Route::post('/ajax/library/book/pdf/update', [LibraryController::class, 'updateBookPDF'])->name('ajax.library.book.pdf.update');
// ajax call to delete book
Route::post('/ajax/library/book/delete', [LibraryController::class, 'delete'])->name('ajax.library.book.delete');
/* End Library Pages */


/* Start Profit Pages */
Route::get('/profits/my-sessions', [ProfitController::class, 'sessions'])->name('profits.my-sessions');
Route::get('/profits/my-books', [ProfitController::class, 'books'])->name('profits.my-books');

// ajax call to view all instructor books profits
Route::get('/datatable/profits/my-books', [ProfitController::class, 'myBooksProfitDatatable'])->name('datatable.profits.my-books');
// ajax call to view all instructor sessions profits
Route::get('/datatable/profits/my-sessions/{instructor_id}', [ProfitController::class, 'mySessionsProfitDatatable'])->name('datatable.profits.my-sessions');
/* End Profit Pages */
