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

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/

Route::get('/admin', function () {
    return view('auth.login');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admindash', function () {
        return view('admin.dashboard');
    })->name('admindash');

    Route::get('/results', function () {
        return view('admin.exam-results');
    })->name('results'); 

    Route::get('/faculties', [\App\Http\Controllers\FacultyController::class, 'show'])->name('faculties');
    Route::post('/faculties', [\App\Http\Controllers\FacultyController::class, 'create'])->name('faculties');
    Route::get('/faculty/{name}', [\App\Http\Controllers\FacultyController::class, 'showDetails'])->name('faculty');
    Route::put('/faculty/{name}', [\App\Http\Controllers\FacultyController::class, 'update'])->name('faculty');
    Route::delete('/faculty/{name}', [\App\Http\Controllers\FacultyController::class, 'destroy'])->name('faculty');

    Route::post('/departments', [\App\Http\Controllers\DepartmentController::class, 'create'])->name('departments');

    Route::get('/staff', [\App\Http\Controllers\StaffController::class, 'show'])->name('staff');

    Route::get('/students', [\App\Http\Controllers\StudentController::class, 'show'])->name('students');

    Route::get('/courses', [\App\Http\Controllers\CourseController::class, 'show'])->name('courses');
    Route::post('/courses', [\App\Http\Controllers\CourseController::class, 'create'])->name('courses');
    Route::post('/deps/{fac}', [\App\Http\Controllers\CourseController::class, 'fetchDeps'])->name('deps');

    Route::view(uri: 'profile', view: 'profile')->name(name: 'profile');

    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])
    ->name('profile.update');

    Route::resource(name: 'tasks', controller: \App\Http\Controllers\TaskController::class);
});

require __DIR__.'/auth.php';
