<?php



use Facade\FlareClient\View;
use Illuminate\Http\Request;
use App\Exports\PickingExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Generator;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\PickingController;
use App\Http\Controllers\SortingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegisterPartController;
use App\Http\Controllers\DashboardHelpController;
use App\Http\Controllers\ResetPasswordController;





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
Route::get('/login',[LoginController::class, 'index'])->name('login'); //->middleware('guest'); // penamaan route login
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']); // method lgogout
Route::get('/login/reset_password',[ResetPasswordController::class, 'index']);

Route::post('/login/reset_password',[ResetPasswordController::class, 'resetPassword']);

// Routing Register User
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);


// FORGOT PASSWORD
// Route::get('/forgot_password', [ForgotController::class, 'index'])->middleware('auth');
// Route::resource('/dashboard/help', DashboardHelpController::class)->middleware('auth');



// -------ROUTE AKSES LIST PART ROG---------------------------------------------------------------
// Route::resource('/register_part', RegisterPartController::class);

Route::get('/register_part', [RegisterPartController::class,'index'])->name('register.part')->middleware('auth');
Route::resource('/register_part', RegisterPartController::class)->middleware('auth');
Route::post('/register_part/create/', [RegisterPartController::class,'create'])->middleware('auth');

// CREATE REGISTER PART WITH MODEL
Route::post('/register_part/createPart/', [RegisterPartController::class,'createPart'])->middleware('auth');

Route::post('/register_part/update/{id}', [RegisterPartController::class,'update'])->middleware('auth');
// ROUTE CONFIRM
Route::post('/register_part/confirm/', [RegisterPartController::class,'confirm'])->middleware('auth');



// -------ROUTE AKSES LIST PART PICKING---------------------------------------------------------------
Route::get('/picking',[PickingController::class,'index']);
// ROUTE TAMPILKAN DETAIL PICKING PART
Route::get('/picking/detail/{id}', [PickingController::class,'detail']);
//ROUTE COMPARE(INSERT DATA KEDATABASE)
Route::post('/picking/detail/', [PickingController::class,'storeData']);
//ROUTE view hasil compare)
Route::get('/picking/detail/{id}/result/', [PickingController::class,'resultCompare']);



// -------ROUTE SORTING--------------------------------------------------------------
Route::get('/sorting', [SortingController::class,'index']);
Route::post('/sorting/filter', [RecordController::class,'filter']);
// INPUTAN SPLIT LABEL AND INSERT TO TABLE SPLIT_LABEL
Route::get('/sorting/view/{id}', [SortingController::class,'view']);
Route::get('/sorting/view_test/{id}', [SortingController::class,'view_test']);
// ROUTE UNTUK SPLIT LABEL
// Route::post('/sorting/view/{id}',    [SortingController::class,'splitLabel']);
Route::post('/sorting/view/split',    [SortingController::class,'splitLabelnew']);
// Route::get('/sorting/view/printLabel',    [SortingController::class,'printLabel']);


// UPDATE TABLE SPLIT_LABEL AND INSERT BALANCE SCAN
// Route::get('/sorting/view/{id}/generate/update', [SortingController::class,'scanBalance']);


// -------ROUTE BALANCE--------------------------------------------------------------
Route::get('/balance', [BalanceController::class,'index'])->middleware('auth');
Route::get('/balance/view/{id}', [BalanceController::class,'view']);
Route::post('/balance/view/{id}/insert', [BalanceController::class,'insert']);








// -------ROUTE RECORD--------------------------------------------------------------
Route::get('/record', [RecordController::class,'index']);
Route::post('/record/filter', [RecordController::class,'filter']);
Route::get('/record/download', [RecordController::class, 'exportCSV']);











// Route::get('/picking',[PickingController::class,'show'] );
// Route::resource('/picking',PickingController::class);

// route get => register_part => Index
// route get=>register_part/create=>Create
// route post=>register_part=>Store

// route put=>register_part/{id}=>update
// route delete=>register_part/{id}=>delete
// route get=>register_part/{id}/edit=>edit
