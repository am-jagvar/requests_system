<?php

use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserControllser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    if(Auth::check()){
        return redirect(route('dashboard'));
    }
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard',[UserControllser::class, 'dashboard'])->name('dashboard');
    Route::post('/verifyrequest',[RequestController::class, 'verify_request'])->middleware('can:verify-request')->name('verify.request');
});

Route::get('/user/index',[UserControllser::class, 'index']);
Route::get('/request/index',[UserControllser::class, 'blog']);

Route::get('/users/create',[UserControllser::class, 'create'])->middleware('can:create-users');
Route::get('/request/create',[UserControllser::class, 'create'])->middleware('can:create-request');

Route::get('image/upload',[FileUploadController::class,'fileCreate']);
Route::post('image/upload/store',[FileUploadController::class,'fileStore']);
Route::post('image/delete',[FileUploadController::class,'fileDestroy']);
