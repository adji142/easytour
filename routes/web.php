<?php
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DemografiController;
use App\Http\Controllers\VendorDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\HotelDetailController;

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
    return Inertia::render('Home');
})->name('home');

Route::get('/admin', function () {
    return Inertia::render('Admin/Dashboard');
})->name('admin.dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/admin', function () {
//         return Inertia::render('Admin/Dashboard')->withView('admin');
//     })->name('admin.dashboard');
// });

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/profile', function () {
    return Inertia::render('Profile', [
        'user' => auth()->user(), // Kirim data user (jika sudah login)
    ]);
})->name('profile');

Route::resource('posts', PostController::class);

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// Aunthentication
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/verifyOTP', [AuthController::class, 'verifyOTP'])->name('verifyOTP');
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
// end Authentication

// Landing Page
Route::get('/becomevendor', [LandingPageController::class, 'becomevendor'])->name('becomevendor');
// End Landing Page

// Demografi
Route::get('/provinsi/{negara_id}', [DemografiController::class, 'getProvinsi']);
Route::get('/kota/{provinsi_id}', [DemografiController::class, 'getKota']);
// Demografi

// Vendor Registration
Route::post('/vendorregistration', [AuthController::class, 'VendorRegistrationAction'])->name('vendorregistration');
Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');
// End Vendor Registration

Route::get('/dashboard', [VendorDashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::post('/action-login', [AuthController::class, 'action_login'])->name('action-login');
// Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| KelompokAkses
|--------------------------------------------------------------------------
|
*/
Route::get('/roles', [RolesController::class,'View'])->name('roles')->middleware('auth');
Route::get('/roles/form/{id}', [RolesController::class,'Form'])->name('roles-form')->middleware('auth');
Route::post('/roles/store', [RolesController::class, 'store'])->name('roles-store')->middleware('auth');
Route::post('/roles/edit', [RolesController::class, 'edit'])->name('roles-edit')->middleware('auth');
Route::delete('/roles/delete/{id}', [RolesController::class, 'deletedata'])->name('roles-delete')->middleware('auth');
Route::get('/roles/export', [RolesController::class,'Export'])->name('roles-export')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Users
|--------------------------------------------------------------------------
|
*/
Route::get('/user', [UserController::class,'View'])->name('user')->middleware('auth');
Route::get('/user/form/{id}', [UserController::class,'Form'])->name('user-form')->middleware('auth');
Route::post('/user/store', [UserController::class, 'store'])->name('user-store')->middleware('auth');
Route::post('/user/edit', [UserController::class, 'edit'])->name('user-edit')->middleware('auth');
Route::delete('/user/delete/{id}', [UserController::class, 'deletedata'])->name('user-delete')->middleware('auth');
Route::get('/user/export', [UserController::class,'Export'])->name('user-export')->middleware('auth');


/*
|--------------------------------------------------------------------------
| Hotels
|--------------------------------------------------------------------------
|
*/
Route::get('/hotels', [HotelDetailController::class,'View'])->name('hotels')->middleware('auth');
Route::get('/hotels/form/{id}', [HotelDetailController::class,'Form'])->name('hotels-form')->middleware('auth');
Route::post('/hotels/store', [HotelDetailController::class, 'store'])->name('hotels-store')->middleware('auth');
Route::post('/hotels/edit', [HotelDetailController::class, 'edit'])->name('hotels-edit')->middleware('auth');
Route::delete('/hotels/delete/{id}', [HotelDetailController::class, 'deletedata'])->name('hotels-delete')->middleware('auth');
Route::get('/hotels/export', [HotelDetailController::class,'Export'])->name('hotels-export')->middleware('auth');