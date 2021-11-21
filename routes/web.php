<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\DashboardController;
//use App\Http\Controllers\Admin\InputInfoController;
use App\Http\Controllers\Admin\InputResultController;
use App\Http\Controllers\Admin\ResultController;
//use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\InfoLaboController;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->name('dashboard');
Route::middleware(['auth', 'verified'])
->prefix('dashboard')
->group(function(){
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
    Route::resource('/inputinfo','InputInfoController');
    Route::get('/inputresult',[InputResultController::class,'index'])->name('inputresult');
    Route::get('/infolabo',[InfoLaboController::class,'index'])->name('infolabo');
    Route::get('/result',[ResultController::class,'index'])->name('result');

    Route::resource('/menus','MenuController');
    Route::resource('/chilemenus','ChilemenuController');
    Route::resource('/menupermision','MenuPermisionController');
    Route::resource('/users','UserController');
    Route::put('/useredit','UserController@updateEdit');
    Route::resource('/roles','RoleController');
   
    Route::resource('/permissions','PermissionController');
    Route::resource('/addresses','AddressController');

   
    //Route::get('/users',[UserController::class,'index'])->name('users');
    Route::resource('/setting','SettingController');
    Route::post('/setting-about','SettingController@saveAbout')->name('setting.about');
    Route::post('/setting-contact','SettingController@saveContact')->name('setting.contact');
    Route::resource('/categories','CategoriesController');
    Route::resource('/articles','ArticleController');
});