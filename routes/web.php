<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BuyPackageController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\GestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\TrainingPackageController;
use App\Http\Controllers\TrainingSessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::prefix('')->middleware('auth:web,coach')->group(function () {
    Route::GET('/', [HomeController::class, 'index'])->name('dashboard');
});
// Route::get('/', [GestController::class, 'home'])->name('home');


// --------------- Auth -> Login & Register
Auth::routes();
Route::GET('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('coach/login', [CoachController::class, 'loginCoashView'])->name('coach.login_view');
Route::post('coach/login', [CoachController::class, 'loginCoash'])->name('coach.login');

Route::get('/home', [GestController::class, 'home'])->name('home');
Route::get('/service', [GestController::class, 'service'])->name('service');
Route::get('/service/{id}', [GestController::class, 'showService'])->name('show_service');
Route::get('/timeOfWork', [GestController::class, 'timeOfWork'])->name('time_of_work');
Route::get('/pricing', [GestController::class, 'pricing'])->name('pricing');
Route::get('/blog', [GestController::class, 'blog'])->name('blog');
Route::get('/blog/{id}', [GestController::class, 'showBlog'])->name('show_blog');
Route::get('/signin', [GestController::class, 'signinView'])->name('signIn');
Route::get('/signup', [GestController::class, 'signupView'])->name('signUp');
Route::group(['middleware' => 'auth', 'middleware' => 'role:client'], function () {
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/myCoach', [GestController::class, 'myCoach'])->name('clintCoach');
    Route::get('/clintSession', [GestController::class, 'session'])->name('clintSession');
    Route::get('/parchedPackage', [GestController::class, 'parchedPackage'])->name('parchedPackage');
    Route::post('client/logout', [UserController::class, 'logout'])->name('auth.logout');
});


// --------------- Blogs
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin'], function () {
    Route::resource('/blogs', BlogController::class);
    //    Route::GET('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    //    Route::GET('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    //    Route::GET('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
    //    Route::POST('/blogs/store', [BlogController::class, 'store'])->name('blogs.store');
    //    Route::GET('/blogs/edit/{blog}', [BlogController::class, 'edit'])->name('blogs.edit');
    //    Route::PUT('/blogs/update/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    //    Route::DELETE('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
});

Route::group(['middleware' => 'auth', 'middleware' => 'role:admin'], function () {
    Route::GET('/users/banned', [UserController::class, 'banView'])->name('users.banned');
});
// --------------- Users
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin|coach', 'middleware' => 'forbid-banned-user', 'middleware' => 'logs-out-banned-user'], function () {
    Route::GET('/users', [UserController::class, 'index'])->name('users.index');
    Route::GET('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::GET('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::GET('/users/{data}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::GET('/users/edit/{data}', [UserController::class, 'edit'])->name('users.edit');
    Route::POST('/users', [UserController::class, 'store'])->name('users.store');
    Route::PUT('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::DELETE('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::GET('/GET-users-my-datatables', [UserController::class, 'GETUsers'])->name('GET.users');

    Route::GET('/users/{user}/ban', [UserController::class, 'ban'])->name('users.ban');
    Route::GET('/users/{user}/unban', [UserController::class, 'unban'])->name('users.unban');
});


// --------------- Training Packages
Route::group(['middleware' => 'auth:web|coach', 'middleware' => 'role:admin|coach|client', 'middleware' => 'forbid-banned-user', 'middleware' => 'logs-out-banned-user'], function () {
    Route::GET('/trainingPackages', [TrainingPackageController::class, 'index'])->name('trainingPackages.index');
    Route::GET('/trainingPackages/create', [TrainingPackageController::class, 'create'])->name('trainingPackages.create');
    Route::GET('/trainingPackages/{package}', [TrainingPackageController::class, 'show'])->name('trainingPackages.show');
    Route::GET('/trainingPackages/{package}/edit', [TrainingPackageController::class, 'edit'])->name('trainingPackages.edit');
    Route::PUT('/trainingPackages/{package}', [TrainingPackageController::class, 'update'])->name('trainingPackages.update');
    Route::POST('/trainingPackages', [TrainingPackageController::class, 'store'])->name('trainingPackages.store');
    Route::DELETE('/trainingPackages/{package}', [TrainingPackageController::class, 'destroy'])->name('trainingPackages.destroy');
});


// --------------- Sessions
Route::group(['middleware' => 'auth:web|coach', 'middleware' => 'role:admin|coach|client', 'middleware' => 'forbid-banned-user', 'middleware' => 'logs-out-banned-user'], function () {
    Route::GET('/sessions', [TrainingSessionController::class, 'index'])->name('sessions.index');
    Route::GET('/sessions/create', [TrainingSessionController::class, 'create'])->name('sessions.create');
    Route::GET('/sessions/{id}', [TrainingSessionController::class, 'show'])->name('sessions.show');
    Route::POST('/sessions/attend/{session}', [TrainingSessionController::class, 'attend'])->name('session.attend');
    Route::POST('/sessions', [TrainingSessionController::class, 'store'])->name('sessions.store');
    Route::GET('/sessions/{id}/edit', [TrainingSessionController::class, 'edit'])->name('sessions.edit');
    Route::PUT('/sessions/{id}', [TrainingSessionController::class, 'update'])->name('sessions.update');
    Route::DELETE('/sessions/{id}', [TrainingSessionController::class, 'destroy'])->name('sessions.destroy');
});


// --------------- Coaches
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin', 'middleware' => 'forbid-banned-user', 'middleware' => 'logs-out-banned-user'], function () {
    Route::GET('/coaches', [CoachController::class, 'index'])->name('coaches.index');
    Route::GET('/coaches/create', [CoachController::class, 'create'])->name('coaches.create');
    Route::GET('/coaches/{id}', [CoachController::class, 'show'])->name('coaches.show');
    Route::POST('/coaches', [CoachController::class, 'store'])->name('coaches.store');
    Route::GET('/coaches/edit/{id}', [CoachController::class, 'edit'])->name('coaches.edit');
    Route::PUT('/coaches/{id}', [CoachController::class, 'update'])->name('coaches.update');
    Route::DELETE('/coaches/{id}', [CoachController::class, 'destroy'])->name('coaches.destroy');
});
Route::GET('/coach/password/reset', [CoachController::class, 'requestPassword'])->name('coaches.password.request');
Route::POST('/coach/password/email', [CoachController::class, 'passwordEmail'])->name('coach.password.email');


// --------------- Attendance
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin|coach|client', 'middleware' => 'forbid-banned-user', 'middleware' => 'logs-out-banned-user'], function () {
    Route::GET('/attendance', [AttendanceController::class, 'index'])->name('attendance.index')->middleware('auth');
});

// --------------- Buy Package
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin|client', 'middleware' => 'forbid-banned-user', 'middleware' => 'logs-out-banned-user'], function () {

    Route::GET('/buyPackage', [BuyPackageController::class, 'index'])->name('buyPackage.index');
    Route::GET('/buyPackage/create', [BuyPackageController::class, 'create'])->name('buyPackage.create');
    Route::GET('/buyPackage/{package}', [BuyPackageController::class, 'show'])->name('buyPackage.show');
    Route::GET('/buyPackage/{package}/edit', [BuyPackageController::class, 'edit'])->name('buyPackage.edit');
    Route::PUT('/buyPackage/{package}', [BuyPackageController::class, 'update'])->name('buyPackage.update');
    Route::POST('/buy', [BuyPackageController::class, 'store'])->name('buyPackage.store');
    Route::DELETE('/buyPackage/{package}', [BuyPackageController::class, 'destroy'])->name('buyPackage.destroy');

    Route::POST('/create-checkout-session', [PaymentController::class, 'stripe'])->name('payment.stripe');
    Route::GET('/buyPackage/create/success', [PaymentController::class, 'success'])->name('buyPackage.success');
    Route::GET('/buyPackage/create/cancel', [PaymentController::class, 'cancel'])->name('buyPackage.cancel');

    Route::POST('/payment', [PaymentController::class, 'store'])->name('payment.store');
});


// --------------- Revenue
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin', 'middleware' => 'forbid-banned-user', 'middleware' => 'logs-out-banned-user'], function () {
    Route::GET('/revenue', [RevenueController::class, 'index'])->name('revenue.index');
    Route::GET('/revenue/{id}', [RevenueController::class, 'show'])->name('revenue.show');
    Route::DELETE('/revenue/{id}', [RevenueController::class, 'destroy'])->name('revenue.destroy');
});


// --------------- Edit Profile
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin|coach|client'], function () {
    Route::GET('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::PUT('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::GET('/profile/editPassword', [UserController::class, 'editPassword'])->name('profile.editPassword');
    Route::PUT('/profile', [UserController::class, 'updatePassword'])->name('profile.updatePassword');
});

Route::group(['middleware' => 'auth:coach'], function () {
    Route::GET('/dashboard', [App\Http\Controllers\HomeController::class, 'indexCoach'])->name('dashboardCoach');
    Route::GET('coach/profile/edit', [CoachController::class, 'editProfile'])->name('coach.profile.edit');
    Route::PUT('coach/profile/update', [CoachController::class, 'updateProfile'])->name('coach.profile.update');
    Route::GET('coach/profile/editPassword', [CoachController::class, 'editPassword'])->name('profile.editCoachPassword');
    Route::PUT('coach/profile', [CoachController::class, 'updatePassword'])->name('profile.updateCoachPassword');
});
