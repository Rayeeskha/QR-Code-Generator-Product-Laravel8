<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
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
Route::redirect('/','/Login');
Route::get('/Login', [LoginController::class,'index']);
Route::post('admin/auth', [LoginController::class,'authentication'])->name('admin.auth');
Route::get('admin/updatepassword', [LoginController::class,'updatepassword']);
Route::get('/user/signup', [LoginController::class,'signup']);

Route::post('/user/registeraccount', [LoginController::class,'registeraccount'])->name('user.registeraccount');

//Middleware Group data 
Route::group(['middleware'=>'admin_auth'], function(){
	Route::get('/admin/dashboard', [AdminController::class,'dashboard']);
	Route::get('admin/addusers', [AdminController::class,'addusers']);
	Route::get('admin/addqrcodes', [AdminController::class,'addqrcodes']);
	Route::get('admin/manageusers', [AdminController::class,'manageusers']);
	Route::post('admin/user/uploadusers', [AdminController::class,'uploadusers'])->name('user.uploadusers');
	Route::get('admin/user/changeuserstatus/{id}/{data}', [AdminController::class,'changeuserstatus']);
	Route::get('admin/user/editusers/{id}/', [AdminController::class,'editusers']);
	Route::get('admin/user/deleteuser/{id}/', [AdminController::class,'deleteuser']);
	Route::post('admin/updateusers', [AdminController::class,'updateusers'])->name('user.updateusers');
	Route::post('admin/user/uploadqrcodes', [AdminController::class,'uploadqrcodes'])->name('user.uploadqrcodes');
	Route::get('admin/manageqrcodes', [AdminController::class,'manageqrcodes']);
	Route::get('admin/user/editqrcode/{id}/', [AdminController::class,'editqrcode']);
	Route::post('admin/updateqrcodes', [AdminController::class,'updateqrcodes'])->name('user.updateqrcodes');
	Route::get('admin/user/deleteqrcode/{id}/', [AdminController::class,'deleteqrcode']);
	Route::get('admin/managesize', [AdminController::class,'managesize']);
	Route::post('admin/user/addsize', [AdminController::class,'addsize'])->name('user.addsize');
	Route::get('admin/user/deletesize/{id}/', [AdminController::class,'deletesize']);
	Route::get('admin/user/changesizestatus/{id}/{data}', [AdminController::class,'changesizestatus']);
	Route::get('admin/user/changeqrstatus/{id}/{data}', [AdminController::class,'changeqrstatus']);
	Route::get('admin/managecolor', [AdminController::class,'managecolor']);
	Route::post('admin/addcolors', [AdminController::class,'addcolors'])->name('user.addcolors');
	Route::get('admin/user/changecolorstatus/{id}/{data}', [AdminController::class,'changecolorstatus']);
	Route::get('admin/user/deletecolors/{id}/', [AdminController::class,'deletecolors']);
	Route::post('admin/updatecolors', [AdminController::class,'updatecolors'])->name('user.updatecolors');
	Route::get('admin/user/edit_colors/{id}/', [AdminController::class,'edit_colors']);
	Route::get('admin/user/edit_size/{id}/', [AdminController::class,'edit_size']);
	Route::post('admin/updatesizes', [AdminController::class,'updatesizes'])->name('user.updatesizes');
	Route::get('qr/qrtraffic/{id}/', [AdminController::class,'qrtraffic']);
	Route::get('qrcode/reports/{id}/', [AdminController::class,'reports']);
	Route::get('qrcode/detailsreports/{id}/', [AdminController::class,'detailsreports']);
	Route::get('profile/settings/', [AdminController::class,'settings']);
	Route::get('profile/changepassword/', [AdminController::class,'changepassword']);
	Route::post('admin/updateprofile', [AdminController::class,'updateprofile'])->name('user.updateprofile');
	Route::post('admin/passwordchangeprocess', [AdminController::class,'passwordchangeprocess'])->name('user.passwordchangeprocess');
});
//Middleware Group data 


Route::get('admin/logout', function () {
	session()->forget('USER_ID');
	session()->forget('USER_ROLE');
	session()->forget('USER_NAME');
	session()->forget('USER_EMAIL');
	session()->forget('USER_PASSWORD');
	session()->forget('USER_PROFILE');
	session()->forget('USER_LOGIN');
	return redirect('/');
});