<?php

use App\Http\Controllers\Project\UserController;
use App\Http\Middleware\auth\IsLoggin;
use App\Http\Middleware\auth\IsLogout;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect ('/login');
});

// Route::middleware([IsLoggin::class])->group(function () {



// });

Route::get('auth/register', [UserController::class, 'index']);
Route::post('auth/register-post', [UserController::class, 'register'])->name('register');
Route::get('auth/referal-register', [UserController::class, 'loadReefrences']);
Route::get('auth/email-verification/{token}', [UserController::class, 'emailVerify']);
Route::get('/login', [UserController::class, 'loadLogin']);
Route::post('/login', [UserController::class, 'userLogin'])->name('logged');
Route::get('/dashboard', [UserController::class, 'dashboard']);   
  



// Route::middleware([IsLogout::class])->group(function () {
// });

