<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => view('login'))->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    Route::get('/register', fn () => view('register'))->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/explore', [PageController::class, 'explore'])->name('explore');
    
    Route::get('/profileclient/{id?}', [PageController::class, 'profileClient'])->name('profileclient');
    Route::get('/profilefreelancer/{id?}', [PageController::class, 'profileFreelancer'])->name('profilefreelancer');
});

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/dashboardclient', [PageController::class, 'dashboardClient'])->name('dashboardclient');
    Route::get('/editprofileclient', [PageController::class, 'editProfileClient'])->name('editprofileclient');
    Route::put('/profileclient', [ProfileController::class, 'updateClient'])->name('profileclient.update');
    
    Route::get('/make-project', [PageController::class, 'makeProject'])->name('make-project');
    Route::get('/edit-project/{project}', [PageController::class, 'editProject'])->name('edit-project');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::patch('/projects/{project}/close', [ProjectController::class, 'close'])->name('projects.close');
    Route::patch('/projects/{project}/choose-winner/{bid}', [ProjectController::class, 'chooseWinner'])->name('projects.choose-winner');
    Route::post('/projects/{project}/complete', [ProjectController::class, 'markCompleted'])->name('projects.complete');
    
    Route::get('/projectdetailclient/{project?}', [PageController::class, 'projectDetailClient'])->name('projectdetailclient');
});

Route::middleware(['auth', 'role:freelancer'])->group(function () {
    Route::get('/dashboardfreelancer', [PageController::class, 'dashboardFreelancer'])->name('dashboardfreelancer');
    Route::get('/editprofilefreelancer', [PageController::class, 'editProfileFreelancer'])->name('editprofilefreelancer');
    Route::put('/profilefreelancer', [ProfileController::class, 'updateFreelancer'])->name('profilefreelancer.update');
    
    Route::get('/projectdetailfreelancer/{project?}', [PageController::class, 'projectDetailFreelancer'])->name('projectdetailfreelancer');
    Route::post('/projects/{project}/bids', [BidController::class, 'store'])->name('bids.store');
    Route::delete('/bids/{bid}', [BidController::class, 'destroy'])->name('bids.destroy');
    Route::post('/projects/{project}/review', [ProjectController::class, 'leaveReview'])->name('projects.review');
});
