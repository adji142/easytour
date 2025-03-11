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
use App\Http\Controllers\BedTypeController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\HotelRoomController;

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
| BedType
|--------------------------------------------------------------------------
|
*/
Route::get('/bedtypes', [BedTypeController::class,'View'])->name('bedtypes')->middleware('auth');
Route::get('/bedtypes/form/{id}', [BedTypeController::class,'Form'])->name('bedtypes-form')->middleware('auth');
Route::post('/bedtypes/store', [BedTypeController::class, 'store'])->name('bedtypes-store')->middleware('auth');
Route::post('/bedtypes/edit', [BedTypeController::class, 'edit'])->name('bedtypes-edit')->middleware('auth');
Route::delete('/bedtypes/delete/{id}', [BedTypeController::class, 'deletedata'])->name('bedtypes-delete')->middleware('auth');
Route::get('/bedtypes/export', [BedTypeController::class,'Export'])->name('bedtypes-export')->middleware('auth');


/*
|--------------------------------------------------------------------------
| RoomType
|--------------------------------------------------------------------------
|
*/
Route::get('/roomtypes', [RoomTypeController::class,'View'])->name('roomtypes')->middleware('auth');
Route::get('/roomtypes/form/{id}', [RoomTypeController::class,'Form'])->name('roomtypes-form')->middleware('auth');
Route::post('/roomtypes/store', [RoomTypeController::class, 'store'])->name('roomtypes-store')->middleware('auth');
Route::post('/roomtypes/edit', [RoomTypeController::class, 'edit'])->name('roomtypes-edit')->middleware('auth');
Route::delete('/roomtypes/delete/{id}', [RoomTypeController::class, 'deletedata'])->name('roomtypes-delete')->middleware('auth');
Route::get('/roomtypes/export', [RoomTypeController::class,'Export'])->name('roomtypes-export')->middleware('auth');

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


/*
|--------------------------------------------------------------------------
| Hotels Rooms
|--------------------------------------------------------------------------
|
*/
Route::get('/hotelroom', [HotelRoomController::class,'View'])->name('hotelroom')->middleware('auth');
Route::get('/hotelroom/form/{id}', [HotelRoomController::class,'Form'])->name('hotelroom-form')->middleware('auth');
Route::post('/hotelroom/store', [HotelRoomController::class, 'store'])->name('hotelroom-store')->middleware('auth');
Route::post('/hotelroom/edit', [HotelRoomController::class, 'edit'])->name('hotelroom-edit')->middleware('auth');
Route::delete('/hotelroom/delete/{id}', [HotelRoomController::class, 'deletedata'])->name('hotelroom-delete')->middleware('auth');
Route::get('/hotelroom/export', [HotelRoomController::class,'Export'])->name('hotelroom-export')->middleware('auth');