<?php

use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JobController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\CandidateRegisterController;
use App\Http\Controllers\Auth\EmployerRegisterController;
use App\Http\Controllers\SessionController;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', [JobController::class, 'index']);

Route::get('/search', SearchController::class);
Route::get('/tags/{tag:name}', TagController::class);

/*
|--------------------------------------------------------------------------
| Auth – goście
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // wybór typu konta
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    // rejestracja kandydata
    Route::get('/register/candidate', [CandidateRegisterController::class, 'create'])
        ->name('register.candidate');

    Route::post('/register/candidate', [CandidateRegisterController::class, 'store']);

    // rejestracja pracodawcy
    Route::get('/register/employer', [EmployerRegisterController::class, 'create'])
        ->name('register.employer');

    Route::post('/register/employer', [EmployerRegisterController::class, 'store']);

    // logowanie
    Route::get('/login', [SessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [SessionController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| Auth – wylogowanie
|--------------------------------------------------------------------------
*/

Route::delete('/logout', [SessionController::class, 'destroy'])
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Oferty pracy
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:employer'])->group(function () {
    Route::get('/jobs/create', [JobController::class, 'create']);
    Route::post('/jobs', [JobController::class, 'store']);

    Route::get('/employer/dashboard', function () {
        return view('employer.dashboard');
    })->name('employer.dashboard');
});

Route::middleware(['auth', 'role:candidate'])->group(function () {
    Route::get('/candidate/dashboard', function () {
        return view('candidate.dashboard');
    })->name('candidate.dashboard');

    Route::get('/jobs/{job}/apply', [ApplicationController::class, 'create'])
        ->name('applications.create');

    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])
        ->name('applications.store');
});

Route::get('/my-applications', [ApplicationController::class, 'myApplications'])
    ->middleware('auth')
    ->name('applications.my');

Route::resource('jobs', JobController::class);

Route::get('/employer/applications',
    [ApplicationController::class, 'employerApplications'])
    ->middleware('auth')
    ->name('employer.applications');

Route::patch('/applications/{application}/{status}',
    [ApplicationController::class, 'updateStatus'])
    ->middleware('auth')
    ->name('applications.status');

Route::middleware(['auth', 'role:employer'])->group(function () {

    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
        ->name('jobs.edit');

    Route::patch('/jobs/{job}', [JobController::class, 'update'])
        ->name('jobs.update');

    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])
        ->name('jobs.destroy');

});
