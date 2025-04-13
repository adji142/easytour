<?php
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
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
use App\Http\Controllers\TourTypeController;
use App\Http\Controllers\TourDetailController;
use App\Http\Controllers\TopServicesController;
use App\Http\Controllers\EasyTourSettingController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BestPartnerController;
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

// Route::get('/', function () {
//     return Inertia::render('Home');
// })->name('home');
Route::get('/', [HomeController::class, 'index'])->name('index');

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
Route::get('/admin', [VendorDashboardController::class, 'dashboardadmin'])->name('admin')->middleware('auth');
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


/*
|--------------------------------------------------------------------------
| Tour Type
|--------------------------------------------------------------------------
|
*/
Route::get('/tourtypes', [TourTypeController::class,'View'])->name('tourtypes')->middleware('auth');
Route::get('/tourtypes/form/{id}', [TourTypeController::class,'Form'])->name('tourtypes-form')->middleware('auth');
Route::post('/tourtypes/store', [TourTypeController::class, 'store'])->name('tourtypes-store')->middleware('auth');
Route::post('/tourtypes/edit', [TourTypeController::class, 'edit'])->name('tourtypes-edit')->middleware('auth');
Route::delete('/tourtypes/delete/{id}', [TourTypeController::class, 'deletedata'])->name('tourtypes-delete')->middleware('auth');
Route::get('/tourtypes/export', [TourTypeController::class,'Export'])->name('tourtypes-export')->middleware('auth');


/*
|--------------------------------------------------------------------------
| Tour Type
|--------------------------------------------------------------------------
|
*/
Route::get('/tourdestionation', [TourDetailController::class, 'index'])->name('tourdestionation');
Route::get('/tour', [TourDetailController::class,'View'])->name('tour')->middleware('auth');
Route::get('/tour/form/{id}', [TourDetailController::class,'Form'])->name('tour-form')->middleware('auth');
Route::post('/tour/store', [TourDetailController::class, 'store'])->name('tour-store')->middleware('auth');
Route::post('/tour/edit', [TourDetailController::class, 'edit'])->name('tour-edit')->middleware('auth');
Route::delete('/tour/delete/{id}', [TourDetailController::class, 'deletedata'])->name('tour-delete')->middleware('auth');
Route::get('/tour/export', [TourDetailController::class,'Export'])->name('tour-export')->middleware('auth');


/*
|--------------------------------------------------------------------------
| Top Services
|--------------------------------------------------------------------------
|
*/
Route::get('/topservices', [TopServicesController::class,'View'])->name('topservices')->middleware('auth');
Route::get('/topservices/form/{id}', [TopServicesController::class,'Form'])->name('topservices-form')->middleware('auth');
Route::post('/topservices/store', [TopServicesController::class, 'store'])->name('topservices-store')->middleware('auth');
Route::post('/topservices/edit', [TopServicesController::class, 'edit'])->name('topservices-edit')->middleware('auth');
Route::delete('/topservices/delete/{id}', [TopServicesController::class, 'deletedata'])->name('topservices-delete')->middleware('auth');
Route::get('/topservices/export', [TopServicesController::class,'Export'])->name('topservices-export')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Easy Tour Setting
|--------------------------------------------------------------------------
|
*/
Route::get('/easytoursetting', [EasyTourSettingController::class,'Form'])->name('easytoursetting')->middleware('auth');
Route::post('/easytoursetting/store', [EasyTourSettingController::class, 'edit'])->name('easytoursetting-store')->middleware('auth');


/*
|--------------------------------------------------------------------------
| Testimonial
|--------------------------------------------------------------------------
|
*/
// Testimonial Routes
Route::get('/testimonial', [TestimonialController::class, 'View'])->name('testimonial')->middleware('auth');
Route::get('/testimonial/form/{id}', [TestimonialController::class, 'Form'])->name('testimonial-form')->middleware('auth');
Route::post('/testimonial/store', [TestimonialController::class, 'store'])->name('testimonial-store')->middleware('auth');
Route::post('/testimonial/edit', [TestimonialController::class, 'edit'])->name('testimonial-edit')->middleware('auth');
Route::delete('/testimonial/delete/{id}', [TestimonialController::class, 'deletedata'])->name('testimonial-delete')->middleware('auth');
Route::get('/testimonial/export', [TestimonialController::class, 'Export'])->name('testimonial-export')->middleware('auth');


/*
|--------------------------------------------------------------------------
| Testimonial
|--------------------------------------------------------------------------
|
*/
// Testimonial Routes
Route::get('/bestpartner', [BestPartnerController::class, 'View'])->name('bestpartner')->middleware('auth');
Route::get('/bestpartner/form/{id}', [BestPartnerController::class, 'Form'])->name('bestpartner-form')->middleware('auth');
Route::post('/bestpartner/store', [BestPartnerController::class, 'store'])->name('bestpartner-store')->middleware('auth');
Route::post('/bestpartner/edit', [BestPartnerController::class, 'edit'])->name('bestpartner-edit')->middleware('auth');
Route::delete('/bestpartner/delete/{id}', [BestPartnerController::class, 'deletedata'])->name('bestpartner-delete')->middleware('auth');
Route::get('/bestpartner/export', [BestPartnerController::class, 'Export'])->name('bestpartner-export')->middleware('auth');

