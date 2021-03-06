<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InputInfoController;
//use App\Http\Controllers\Admin\InputResultController;
//use App\Http\Controllers\Admin\ResultController;
//use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\InfoLaboController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ClassesController;
use App\Http\Controllers\Admin\Postcontroller;
use App\Http\Controllers\Admin\UpdateCustommerController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\PDFController;
use App\Http\Controllers\Admin\PrintController;
use App\Http\Controllers\Admin\UploadImageController;
use App\Http\Controllers\Admin\ImagethinController;

use App\Http\Controllers\Admin\CheckCodeController;

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
Route::get('/backup', function(){
    Storage::disk('google')->put('example.txt','hello the world');
});
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
    //Route::get('/inputresult',[InputResultController::class,'index'])->name('inputresult');
    Route::get('/infolabo',[InfoLaboController::class,'index'])->name('infolabo');
    //Route::get('/results',[ResultController::class,'index'])->name('results');

    Route::get('/student',[StudentController::class,'index'])->name('student');
    Route::get('/search',[StudentController::class,'search'])->name('search');
    Route::delete('/destroystudent/{student}',[StudentController::class,'destroy'])->name('destroystudent');
    Route::delete('/massdetroy/{students}',[StudentController::class,'massdetroy'])->name('');

    Route::get('/classes',[ClassesController::class,'getClass'])->name('classes');
    Route::get('/post',[PostController::class,'index'])->name('posts');
    Route::get('/show/{id}',[PostController::class,'show'])->name('show');

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
    Route::resource('/ousents','OusentController');

    Route::resource('/labogroups','LabogroupController');
    Route::resource('/testnames','TestnameController');
    Route::resource('/testelements','TestelementController');
    Route::resource('/testunits','TestunitController');

    Route::resource('/custommers','CustommerController');
    //Route::get('/custommers','CustommerController@index')->name('custommerindex');
    Route::resource('/results','ResultController');
    Route::resource('/doctors','DoctorController');
    Route::get('/formsaigon','FormController@formsaigon')->name('formsaigon');
    Route::get('/formtudu','FormController@formtudu')->name('formtudu');
    Route::get('/formvigor','FormController@formvigor')->name('formvigor');

    Route::get('/print','PrintController@printOne')->name('print');
    Route::get('/printview',[PrintController::class,'showPrint'])->name('printview');

    Route::post('/updatebill',[UpdateCustommerController::class,'updatebill'])->name('updatebill');

    //Route::post('/updatecustommer',[updateCusBill::class,'updatecustommer'])->name('updatecustommer');
   // Route::post('/importprovince',[ImportController::class,'importProvince'])->name('importprovince');
    Route::post('/importdistrict',[ImportController::class,'importDistrict'])->name('importdistrict');
    Route::post('/importWard',[ImportController::class,'importWard'])->name('importWard');

    Route::post('/importcustommers',[ImportController::class,'importcustommers'])->name('importcustommers');
    Route::post('/importResult',[ImportController::class,'importResult'])->name('importResult');

    Route::resource('/images','UploadImageController');
    Route::post('/imagesRight','UploadImageController@storeRight');

    Route::get('/imagethins','ImagethinController@index')->name('imagethins');

    Route::post('/uploadthinlefts','ImagethinController@storeLeft')->name('uploadthinlefts');
    Route::post('/uploadthinrights','ImagethinController@storeRight')->name('uploadthinrights');

    Route::delete('/imagethinlefts/{id}','ImagethinController@detroyLeft')->name('imagethinlefts');


    Route::resource('/oureads','OureadController');
    Route::resource('/inputhpv','InputHpvController');

    Route::get('/tranbillids',[PDFController::class,'TransBillId'])->name('TransBillId');
    Route::get('/downloadPDF',[PDFController::class,'downloadPDF'])->name('downloadPDF');
    Route::get('/checkcodeoureads',[CheckCodeController::class,'checkcodeouread'])->name('checkcodeoureads');

    Route::get('/printThinprep',[PrintController::class,'printThinprep'])->name('printThinprep');
    Route::get('/printHpv',[PrintController::class,'printHpv'])->name('printHpv');
    Route::get('/printMutiThin',[PrintController::class,'printMutiThin'])->name('printMutiThin');

});