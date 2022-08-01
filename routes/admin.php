<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Pages\EducationalStageController;
use App\Http\Controllers\Admin\Pages\InstructorController;
use App\Http\Controllers\Admin\Pages\EducationalClassController;
use App\Http\Controllers\Admin\Pages\ExamController;
use App\Http\Controllers\Admin\Pages\ExpenseController;
use App\Http\Controllers\Admin\Pages\FinancialRoleController;
use App\Http\Controllers\Admin\Pages\FreeSessionController;
use App\Http\Controllers\Admin\Pages\LabController;
use App\Http\Controllers\Admin\Pages\LibraryController;
use App\Http\Controllers\Admin\Pages\ParentController;
use App\Http\Controllers\Admin\Pages\ScheduleSessionController;
use App\Http\Controllers\Admin\Pages\StudentController;
use App\Http\Controllers\Admin\Pages\SubjectController;
use App\Http\Controllers\Admin\Pages\RewardsAndIncentivesController;
use App\Http\Controllers\Admin\Pages\SettingsController;

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

/* Start Educational Stage Pages */
Route::get('/educational-stages', [EducationalStageController::class, 'index'])->name('educational-stages');

// ajax call to view educational stages datatables
Route::get('/datatable/educational-stages', [EducationalStageController::class, 'datatable'])->name('datatable.educational-stages');
// ajax call to create new educational stage
Route::post('/ajax/educational-stage/create', [EducationalStageController::class, 'create'])->name('ajax.educational-stage.create');
// ajax call to update educational stage name
Route::post('/ajax/educational-stage/update-name', [EducationalStageController::class, 'updateName'])->name('ajax.educational-stage.update-name');
// ajax call to update educational stage description
Route::post('/ajax/educational-stage/update-description', [EducationalStageController::class, 'updateDescription'])->name('ajax.educational-stage.update-description');
// ajax call to delete educational stage
Route::post('/ajax/educational-stage/delete', [EducationalStageController::class, 'delete'])->name('ajax.educational-stage.delete');
/* End Educational Stage Pages */


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


/* Start Educational Classes Pages */
Route::get('/educational-classes', [EducationalClassController::class, 'index'])->name('educational-classes');
Route::get('/educational-class/{slug}/show', [EducationalClassController::class, 'show'])->name('educational-class.show');
Route::get('/educational-classes/{slug}/classrooms', [EducationalClassController::class, 'classrooms'])->name('educational-classe.classrooms');
Route::get('/educational-classes/{educational_class_id}/classroom/{slug}/students', [EducationalClassController::class, 'students'])->name('educational-class.classroom.students');

// ajax call to view educational classes datatables
Route::get('/datatable/educational-classes', [EducationalClassController::class, 'datatable'])->name('datatable.educational-classes');
// ajax call to create new educational class
Route::post('/ajax/educational-class/create', [EducationalClassController::class, 'create'])->name('ajax.educational-class.create');
// ajax call to update educational class data
Route::post('/ajax/educational-class/update', [EducationalClassController::class, 'update'])->name('ajax.educational-class.update');
// ajax call to update educational class name
Route::post('/ajax/educational-class/update-name', [EducationalClassController::class, 'updateName'])->name('ajax.educational-class.update-name');
// ajax call to delete educational class
Route::post('/ajax/educational-class/delete', [EducationalClassController::class, 'delete'])->name('ajax.educational-class.delete');
// ajax call to view classrooms datatables
Route::get('/datatable/educational-classe/{slug}/classrooms', [EducationalClassController::class, 'classroomsDatatable'])->name('datatable.educational-class.classrooms');
// ajax call to create classroom
Route::post('/ajax/educational-class/classroom/create', [EducationalClassController::class, 'createClassRoom'])->name('ajax.educational-class.classroom.create');
// ajax call to update classroom name
Route::post('/ajax/educational-class/classroom/update-name', [EducationalClassController::class, 'updateClassRoomName'])->name('ajax.educational-class.classroom.update-name');
// ajax call to delete classroom
Route::post('/ajax/educational-class/classroom/delete', [EducationalClassController::class, 'deleteClassRoom'])->name('ajax.educational-class.classroom.delete');
// ajax call to view all students in the classroom datatables
Route::get('/datatable/educational-class/{id}/classroom/{slug}/students', [EducationalClassController::class, 'classroomStudentsDatatable'])->name('datatable.educational-class.classroom.students');
// ajax call to view all students to append in the classroon
Route::post('/datatable/educational-class/classroom/students/preview', [EducationalClassController::class, 'previewStudents'])->name('ajax.educational-class.classroom.students.preview');
// ajax call to append students in the classroom
Route::post('/datatable/educational-class/classroom/students/append', [EducationalClassController::class, 'appendStudentsInClassroom'])->name('ajax.educational-class.classroom.students.append');
// ajax call to remove student from classroom
Route::post('/datatable/educational-class/classroom/students/remove', [EducationalClassController::class, 'removeStudentsInClassroom'])->name('ajax.educational-class.classroom.students.remove');
/* End Educational Classes Pages */


/* Start Subject Pages */
Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects');

// ajax call to view educational classes datatables
Route::get('/datatable/subjects', [SubjectController::class, 'datatable'])->name('datatable.subjects');
// ajax call to create new subject
Route::post('/ajax/subject/create', [SubjectController::class, 'create'])->name('ajax.subject.create');
// ajax call to update subject name
Route::post('/ajax/subject/update-name', [SubjectController::class, 'updateName'])->name('ajax.subject.update-name');
// ajax call to delete subject
Route::post('/ajax/subject/delete', [SubjectController::class, 'delete'])->name('ajax.subject.delete');
/* End Subject Pages */


/* Start Instructors Pages */
Route::get('/instructors', [InstructorController::class, 'index'])->name('instructors');
Route::get('/instructor/create', [InstructorController::class, 'create'])->name('instructor.create');
Route::get('/instructor/{slug}', [InstructorController::class, 'show'])->name('instructor.show');

// ajax call to view instructors datatables
Route::get('/datatable/instructors', [InstructorController::class, 'datatable'])->name('datatable.instructors');
// ajax call to create new instructor
Route::post('/ajax/instructor/create', [InstructorController::class, 'createInstructor'])->name('ajax.instructor.create');
// ajax call to check if instructor can publish session
Route::post('/ajax/instructor/can-publish-sessions', [InstructorController::class, 'canPublishSessions'])->name('ajax.instructor.can-publish-sessions');
// ajax call to update instructor info
Route::post('/ajax/instructor/update/info', [InstructorController::class, 'updateInfo'])->name('ajax.instructor.update.info');
// ajax call to update instructor image
Route::post('/ajax/instructor/update/image', [InstructorController::class, 'updateImage'])->name('ajax.instructor.update.image');
// ajax call to remove instructor image
Route::post('/ajax/instructor/remove/image', [InstructorController::class, 'removeImage'])->name('ajax.instructor.remove.image');
// ajax call to update instructor password
Route::post('/ajax/instructor/update/password', [InstructorController::class, 'updatePassword'])->name('ajax.instructor.update.password');
// ajax call to change instructor permission to create a permission_to_create_book
Route::post('/ajax/instructor/permission_to_create_book', [InstructorController::class, 'permissionToCreateBook'])->name('ajax.instructor.permission_to_create_book');
// ajax call to delete instructor
Route::post('/ajax/instructor/delete', [InstructorController::class, 'delete'])->name('ajax.instructor.delete');
/* End Instructors Pages */


/* Start Parents Pages */
Route::get('/parents', [ParentController::class, 'index'])->name('parents');
Route::get('/parent/create', [ParentController::class, 'create'])->name('parent.create');
Route::get('/parent/{slug}', [ParentController::class, 'show'])->name('parent.show');

// ajax call to view parents datatables
Route::get('/datatable/parents', [ParentController::class, 'datatable'])->name('datatable.parents');
// ajax call to create new parent
Route::post('/ajax/parent/create', [ParentController::class, 'createParent'])->name('ajax.parent.create');
// ajax call to update parent info
Route::post('/ajax/parent/update/info', [ParentController::class, 'updateInfo'])->name('ajax.parent.update.info');
// ajax call to update parent image
Route::post('/ajax/parent/update/image', [ParentController::class, 'updateImage'])->name('ajax.parent.update.image');
// ajax call to remove parent image
Route::post('/ajax/parent/remove/image', [ParentController::class, 'removeImage'])->name('ajax.parent.remove.image');
// ajax call to update parent password
Route::post('/ajax/parent/update/password', [ParentController::class, 'updatePassword'])->name('ajax.parent.update.password');
// ajax call to delete parent
Route::post('/ajax/parent/delete', [ParentController::class, 'delete'])->name('ajax.parent.delete');
/* End Parents Pages */


/* Start Student Pages */
Route::get('/students', [StudentController::class, 'index'])->name('students');
Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
Route::get('/student/{slug}', [StudentController::class, 'show'])->name('student.show');

// ajax call to view students datatables
Route::get('/datatable/students', [StudentController::class, 'datatable'])->name('datatable.students');
// ajax call to create new student
Route::post('/ajax/student/create', [StudentController::class, 'createStudent'])->name('ajax.student.create');
// ajax call to update student info
Route::post('/ajax/student/update/info', [StudentController::class, 'updateInfo'])->name('ajax.student.update.info');
// ajax call to preview all educational stage classess
Route::post('/ajax/student/preview/educational-stage/classess', [StudentController::class, 'previewEducationalClassClassRooms'])->name('ajax.student.preview.educational-stage.classess');
// ajax call to update student image
Route::post('/ajax/student/update/image', [StudentController::class, 'updateImage'])->name('ajax.student.update.image');
// ajax call to remove student image
Route::post('/ajax/student/remove/image', [StudentController::class, 'removeImage'])->name('ajax.student.remove.image');
// ajax call to update student parent
Route::post('/ajax/student/update/parent', [StudentController::class, 'updateParent'])->name('ajax.student.update.parent');
// ajax call to update student educational class
Route::post('/ajax/student/update/educational-class', [StudentController::class, 'updateEducationalClass'])->name('ajax.student.update.educational-class');
// ajax call to update student password
Route::post('/ajax/student/update/password', [StudentController::class, 'updatePassword'])->name('ajax.student.update.password');
// ajax call to delete student
Route::post('/ajax/student/delete', [StudentController::class, 'delete'])->name('ajax.student.delete');
/* End Student Pages */


/* Start Financial Roles Pages */
Route::get('/financial-roles', [FinancialRoleController::class, 'index'])->name('financial-roles');
Route::get('/financial-role/create', [FinancialRoleController::class, 'create'])->name('financial-role.create');
Route::get('/financial-role/show/{slug}', [FinancialRoleController::class, 'show'])->name('financial-role.show');

// ajax call to view financial roles datatables
Route::get('/datatable/financial-roles', [FinancialRoleController::class, 'datatable'])->name('datatable.financial-roles');
// ajax call to create new financial role
Route::post('/ajax/financial-role/create', [FinancialRoleController::class, 'createFinancialRole'])->name('ajax.financial-role.create');
// ajax call to update financial role info
Route::post('/ajax/financial-role/update/info', [FinancialRoleController::class, 'updateInfo'])->name('ajax.financial-role.update.info');
// ajax call to update financial role image
Route::post('/ajax/financial-role/update/image', [FinancialRoleController::class, 'updateImage'])->name('ajax.financial-role.update.image');
// ajax call to remove financial role image
Route::post('/ajax/financial-role/remove/image', [FinancialRoleController::class, 'removeImage'])->name('ajax.financial-role.remove.image');
// ajax call to update financial role password
Route::post('/ajax/financial-role/update/password', [FinancialRoleController::class, 'updatePassword'])->name('ajax.financial-role.update.password');
// ajax call to delete financial role
Route::post('/ajax/financial-role/delete', [FinancialRoleController::class, 'delete'])->name('ajax.financial-role.delete');
/* End Financial Roles Pages */


/* Start Labs Labs Pages */
Route::get('/labs', [LabController::class, 'index'])->name('labs');
Route::get('/lab/{slug}/show', [LabController::class, 'show'])->name('lab.show');
Route::get('/lab/create', [LabController::class, 'create'])->name('lab.create');

// ajax call to view financial roles datatables
Route::get('/datatable/labs', [LabController::class, 'datatable'])->name('datatable.labs');
// ajax to preview educational classess when choosing an educational stage before creating a lab
Route::post('/ajax/lab/preview/educational-classes', [LabController::class, 'previewEducationalClasses'])->name('ajax.lab.preview.educational-classes');
// ajax call to create new lab
Route::post('/ajax/lab/create', [LabController::class, 'createLab'])->name('ajax.lab.create');
// ajax call to update lab info
Route::post('/ajax/lab/update/info', [LabController::class, 'updateInfo'])->name('ajax.lab.update.info');
// ajax call to update lab thumbnail
Route::post('/ajax/lab/update/thumbnail', [LabController::class, 'updateThumbnail'])->name('ajax.lab.update.thumbnail');
// ajax call to update lab link
Route::post('/ajax/lab/update/link', [LabController::class, 'updateLink'])->name('ajax.lab.update.link');
// ajax call to delete lab thumbnail
Route::post('/ajax/lab/delete/thumbnail', [LabController::class, 'deleteThumbnail'])->name('ajax.lab.delete.thumbnail');
// ajax call to delete lab
Route::post('/ajax/lab/delete', [LabController::class, 'delete'])->name('ajax.lab.delete');
/* End Labs Labs Pages */


/* Start Recorded Courses Pages */
/* End Recorded Courses Pages */


/* Start Exam Pages */
Route::get('/exams', [ExamController::class, 'index'])->name('exams');
Route::get('/exam/create', [ExamController::class, 'create'])->name('exam.create');
Route::get('/exam/show/{slug}', [ExamController::class, 'show'])->name('exam.show');
Route::get('/exam/preview/{slug}', [ExamController::class, 'preview'])->name('exam.preview');

// ajax call to view exams datatables
Route::get('/datatable/exams', [ExamController::class, 'datatable'])->name('datatable.exams');
// ajax to display all educational classes when change educational stage
Route::post('ajax/exam/display-all-educational-classes', [ExamController::class, 'displayEducationalClasses'])->name('ajax.exam.display-all-educational-classes');
// ajax call to create new exam
Route::post('/ajax/exam/create', [ExamController::class, 'createExams'])->name('ajax.exam.create');
// ajax call to publish exam
Route::post('/ajax/exam/publish', [ExamController::class, 'publish'])->name('ajax.exam.publish');
/* End Exam Pages */


/* Start Excercies Pages */
/* End Excercies Pages */


/* Start Rewards and Incentives Pages */
Route::get('/rewards-and-incentives-for-instructors', [RewardsAndIncentivesController::class, 'index'])->name('rewards-and-incentives-for-instructors');
Route::get('/instructor/{slug}/rewards', [RewardsAndIncentivesController::class, 'show'])->name('instructor.rewards');

// ajax call to view all rewards and incentives for instructors datatables
Route::get('/datatable/rewards-and-incentives-for-instructors', [RewardsAndIncentivesController::class, 'datatable'])->name('datatable.rewards-and-incentives-for-instructors');
// ajax call to view all instructor rewards datatables
Route::get('/datatable/instructor/{slug}/rewards', [RewardsAndIncentivesController::class, 'instructorRewardDatatable'])->name('datatable.instructor.rewards');
// ajax call to create reward(s) for instructor
Route::post('/ajax/instructor/rewards/create', [RewardsAndIncentivesController::class, 'createInstructorReward'])->name('ajax.instructor.rewards.create');
// ajax call to remove reward from instructor
Route::post('/ajax/instructor/rewards/remove', [RewardsAndIncentivesController::class, 'removeInstructorReward'])->name('ajax.instructor.reward.remove');
/* End Rewards and Incentives Pages */


/* Start Free Sessions Pages */
Route::get('/free-sessions-for-students', [FreeSessionController::class, 'index'])->name('free-sessions-for-students');

// ajax call to view all free sessions for students datatables
Route::get('/datatable/free-sessions-for-students', [FreeSessionController::class, 'datatable'])->name('datatable.free-sessions-for-students');
// ajax call to create free sessions for students
Route::post('/ajax/give-free-sessions-for-students', [FreeSessionController::class, 'giveFreeSession'])->name('ajax.give-free-sessions-for-students');
// ajax call to update number of free sessions for student
Route::post('/ajax/free-session/update/number_of_sessions', [FreeSessionController::class, 'updateNumberOfFreeSessions'])->name('ajax.free-session.update.number_of_sessions');

/* End Free Sessions Pages */


/* Start Certificates Pages */
/* End Certificates Pages */


/* Start Attendance Pages */
/* End Attendance Pages */


/* Start Library Pages */
Route::get('/library', [LibraryController::class, 'index'])->name('library');
Route::get('/library/book/create', [LibraryController::class, 'create'])->name('library.book.create');
Route::get('/library/book/show/{slug}', [LibraryController::class, 'show'])->name('library.book.show');

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


/* Start Expenses Pages */
Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses');
Route::get('/expense/create', [ExpenseController::class, 'create'])->name('expense.create');
Route::get('/expense/service/{slug}', [ExpenseController::class, 'show'])->name('expense.service');

// ajax call to view all expenses datatables
Route::get('/datatable/expenses', [ExpenseController::class, 'datatable'])->name('datatable.expenses');
// ajax call to create new expense
Route::post('/ajax/expense/create', [ExpenseController::class, 'createExpense'])->name('ajax.expense.create');
// ajax call to update expense service
Route::post('/ajax/expense/update', [ExpenseController::class, 'updateExpense'])->name('ajax.expense.update');
// ajax call to delete expense service
Route::post('/ajax/expense/delete', [ExpenseController::class, 'delete'])->name('ajax.expense.delete');
/* End Expenses Pages */


/* Start Settings Pages */
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

// ajax call to update admin info username or email
Route::post('/ajax/settings/update-info', [SettingsController::class, 'updateInfo'])->name('ajax.settings.update-info');
// ajax call to update admin password
Route::post('/ajax/settings/update-password', [SettingsController::class, 'updatePassword'])->name('ajax.settings.update-password');
/* End Settings Pages */
