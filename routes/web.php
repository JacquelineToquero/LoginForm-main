<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;


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

Route::get('/', function () {
    return view('home');
})->name('home');

// About Route
Route::get('/about', [UserController::class, 'about'])->name('about');

// Auth Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
    Route::get('logout', 'logout')->middleware('auth')->name('logout');

    // Forgot password Route
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->middleware('guest')->name('password.request');

    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    })->middleware('guest')->name('password.email');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset-password', ['token' => $token]);
    })->middleware('guest')->name('password.reset');

    // reset password
    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    })->middleware('guest')->name('password.update');
});

// Normal Users Routes
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [UserController::class, 'userprofile'])->name('profile');
    Route::post('/profile/user/{id}', [UserController::class, 'updateRole'])->name('users.update');
});

// Admin Routes
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/profile', [AdminController::class, 'profilepage'])->name('admin.profile');
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/admin/user/store', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('/admin/users/show/{id}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/admin/users/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/edit/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/destroy/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::post('/admin/{user}/verifyadmin', [UserController::class, 'adminverify'])->name('admin.adminverify');
