<?php


use App\Models\MasterPart;
use App\Models\RegisterPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\PickingController;
use App\Http\Controllers\SortingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegisterPartController;
use App\Http\Controllers\DashboardHelpController;
use App\Http\Controllers\RecordController;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PickingExport;



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
    return view(
        'home',
        ["title" => "Home"]
    );
});


route::get('/register_part/index', function () {
    return view('register_part.index');    
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');// penggunaan middleware untuk akses ke class

Route::get('/home', function() {
    return view('home'); })->name('home')->middleware('auth');

// LOGIN
Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest'); // penamaan route login
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']); // method lgogout
// Routing Register User
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// FORGOT PASSWORD
Route::get('/forgot_password', [ForgotController::class, 'index'])->middleware('auth');
Route::resource('/dashboard/help', DashboardHelpController::class)->middleware('auth');



// -------ROUTE AKSES LIST PART ROG---------------------------------------------------------------
Route::resource('/register_part', RegisterPartController::class);
Route::post('/register_part/create/', [RegisterPartController::class,'create']);
// ROUTE CreatePart
Route::post('/register_part/createPart/', [RegisterPartController::class,'createPart']);
// ROUTE CONFIRM
Route::post('/register_part/confirm/', [RegisterPartController::class,'confirm']);



// -------ROUTE AKSES LIST PART PICKING---------------------------------------------------------------
Route::resource('/picking',PickingController::class);
// ROUTE TAMPILKAN DETAIL PICKING PART
Route::get('/picking/detail/{id}', [PickingController::class,'detail']);
//ROUTE COMPARE(INSERT DATA KEDATABASE)
Route::post('/picking/detail/', [PickingController::class,'storeData']);
//ROUTE view hasil compare)
Route::get('/picking/detail/{id}/result/', [PickingController::class,'resultCompare']);



// -------ROUTE SORTING--------------------------------------------------------------
Route::resource('/sorting', SortingController::class);
Route::post('/sorting/view/',    [SortingController::class,'splitLabel']);
Route::get('/sorting/view/{id}', [SortingController::class,'view']);
Route::get('/picking/view/{id}/splitLabel/', [SortingController::class,'split']);


// -------ROUTE RECORD--------------------------------------------------------------
Route::get('export-csv', function () {
    return Excel::download(new PickingExport, 'picking.csv');
});

Route::resource('/record', RecordController::class);








// Route::get('/picking',[PickingController::class,'show'] );
// Route::resource('/picking',PickingController::class);

// route get => register_part => Index
// route get=>register_part/create=>Create
// route post=>register_part=>Store

// route put=>register_part/{id}=>update
// route delete=>register_part/{id}=>delete

// route get=>register_part/{id}/edit=>edit
