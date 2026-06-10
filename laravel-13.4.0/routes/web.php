<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/login', fn () => view('login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', fn () => view('register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/dashboardclient', [PageController::class, 'dashboardClient'])->name('dashboardclient');
Route::get('/dashboardfreelancer', [PageController::class, 'dashboardFreelancer'])->name('dashboardfreelancer');
Route::get('/editprofilefreelancer', [PageController::class, 'editProfileFreelancer'])->name('editprofilefreelancer');
Route::put('/profilefreelancer', [ProfileController::class, 'updateFreelancer'])->name('profilefreelancer.update');

Route::get('/explore', [PageController::class, 'explore'])->name('explore');
Route::get('/make-project', [PageController::class, 'makeProject'])->name('make-project');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::patch('/projects/{project}/close', [ProjectController::class, 'close'])->name('projects.close');

Route::get('/profileclient', [PageController::class, 'profileClient'])->name('profileclient');
Route::get('/profilefreelancer', [PageController::class, 'profileFreelancer'])->name('profilefreelancer');
Route::get('/projectdetailclient/{project?}', [PageController::class, 'projectDetailClient'])->name('projectdetailclient');
Route::get('/projectdetailfreelancer/{project?}', [PageController::class, 'projectDetailFreelancer'])->name('projectdetailfreelancer');
Route::post('/projects/{project}/bids', [BidController::class, 'store'])->name('bids.store');
