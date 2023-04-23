<?php

use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ReleaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentinfoController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Usercontroller;
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


Route::controller(Usercontroller::class)->group(function () {
    Route::get('/', 'index');
    Route::get('register', 'showRegister')->name('register');
    Route::post('register/submit', 'userStore')->name('user.store');
    Route::get('login', 'showLogin')->name('login');
    Route::post('user/auth', 'authenticateUser')->name('user.auth');

    Route::post('user/add', 'addUser')->name('user.add');
    Route::post('user/update/{id}', 'editUser')->name('user.update');
    Route::get('show-users', 'showUsers')->name('users.show');
    Route::get('user/destroy/{id}', 'destroy')->name('user.destroy');
    Route::get('user/default/password/{id}', 'default')->name('user.default.password');
});

Route::controller(Dashboardcontroller::class)->group(function () {
    Route::get('dashboard', 'index')->name('dashboard');
    Route::post('user/logout', 'logout')->name('logout');
    Route::get('data-management', 'dataManagement')->name('data.management');
    Route::get('data-management/subjects', 'subjectManage')->name('subject.manage');
    Route::get('settings', 'settings')->name('settings');
    Route::post('settings/basicinfo/update', 'basicInfo')->name('basicinfo.update');
    Route::post('settings/passwordInfo/update', 'passwordInfo')->name('passwordinfo.update');
    Route::post('settings/resetInfo/update', 'resetInfo')->name('resetinfo.update');
    Route::get('manage-user', 'manageUser')->name('manage.user');
    Route::get('reports', 'reports')->name('report');
});

Route::controller(ReleaseController::class)
    ->prefix('release')
    ->group(function () {
        Route::get('', 'release')->name('release');
        Route::get('/print/{lrn}/{name_of_school}/{school_id}', 'print')->name('release.print');
        Route::post('release/store', 'store')->name('release.store');
    });

Route::controller(SubjectController::class)->group(function () {
    Route::post('subject/add', 'store')->name('subject.store');
    Route::post('subject/update/{id}', 'update')->name('subject.update');
    Route::get('subject/get', 'get')->name('subject.get');
    Route::get('subject/destroy/{id}', 'destroy')->name('subject.destroy');
});

Route::controller(StudentinfoController::class)->group(function () {
    Route::get('student', 'index')->name('student.get');
    Route::get('data-management/student/{lrn}/edit-info', 'edit')->name('student.edit');
    Route::post('student/add', 'store')->name('studentinfo.store');
    Route::post('student/update/{id}', 'update')->name('studentinfo.update');
    Route::post('student/other-info/add/{lrn}', 'store_other')->name('otherinfo.store');
    Route::get('student/other-info/destroy/{lrn}', 'destroy')->name('studentinfo.destroy');
    Route::get('data-management/student/{lrn}/show', 'show')->name('student.show');
});

Route::controller(RecordController::class)
    ->prefix('data-management')
    ->middleware(['auth'])->group(function () {
        Route::get('student/{lrn}/academics', 'show')->name('record.show');
        Route::get('student/{lrn}/{id}/edit', 'edit')->name('record.edit');
        Route::post('student/store/academic-record', 'store')->name('record.store');
        Route::post('student/update/academic-record/{id}', 'update')->name('record.update');
        Route::get('student/record-list/{lrn}', 'index')->name('academic_record.show');
        Route::get('student/destroy/{id}', 'destroy')->name('record.destroy');
    });

Route::controller(ResetPasswordController::class)
    ->prefix('reset-password')
    ->group(function () {
        Route::post('request', 'check_email')->name('password.reset');
        Route::get('verify/{token}', 'verify')->name('user.verify');
        Route::post('verify/submit', 'verify_submit')->name('submit.verify');
        Route::get('showForm/{token}', 'EditPassword')->name('password.reset.show');
        Route::post('saved/password', 'saved_new_password')->name('password.saved');
        Route::post('save/other', 'other')->name('other.save'); //  admin name
        Route::post('save/other-information', 'otherInformation')->name('otherinformation.save'); // school information
    });

Route::controller(SectionController::class)
    ->prefix('class-management')
    ->group(function () {

        Route::get('/', 'index')->name('class.management');
        Route::get('/class/get', 'show')->name('class.get');
        Route::post('/class/store', 'store')->name('class.store');
        Route::post('/class/update/{id}', 'update')->name('class.update');
        Route::post('/class/subject/store', 'storeSubject')->name('class.subject.store');
        Route::get('/class/destroy/{id}', 'destroy')->name('class.destroy');
        Route::get('/class/subject/get/{id}', 'getSubjects')->name('class.subject.get');
        Route::get('/class/subject/destroy/{id}', 'destroySubjects')->name('class.subject.destroy');
        Route::get('/class/subject/destroy/all/{id}', 'destroySubjectsAll')->name('class.subject.destroy.all');

        Route::get('/class/subject/usedefault/{id}', 'useDefaultSubjects')->name('class.usedefault');
        Route::post('/class/student/store', 'storeStudent')->name('class.student.store');
        Route::get('/class/student/get/{id}', 'getStudents')->name('class.student.get');
        Route::get('/class/student/destroy/{id}', 'destroyStudents')->name('class.student.destroy');
        Route::get('/class/student/destroy/all/{id}', 'destroyStudentAll')->name('class.student.destroy.all');
    });

Route::controller(TeacherController::class)
    ->prefix('my-class')
    ->group(function () {
        Route::get('/class-info/{id}', 'index')->name('teacher.class.index');
        Route::get('/{id}', 'show')->name('teacher.class.get');

        Route::get('/student-data/{lrn}/{section_id}', 'showRecord')->name('student.showRecord');
        Route::post('/student-data/store', 'store')->name('teacher.record.store');
    });

Route::controller(ReportController::class)
    ->prefix('get')
    ->group(function () {

        Route::post('/report/data', 'index')->name('report.data.get');
    });
