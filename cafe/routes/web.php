<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Man\BillController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\StoresController;
use App\Http\Controllers\PosoneController;
use App\Http\Controllers\Man\TableController;
use App\Http\Controllers\Man\AreaController;
use App\Http\Controllers\Man\PeopleController;
use App\Http\Controllers\Man\MenuController;
use App\Http\Controllers\Man\CateController;
use App\Http\Controllers\Man\ProductController;
use App\Http\Controllers\Man\BallotController;
use App\Http\Controllers\Man\ReceiptController;
use App\Http\Controllers\Man\PaymentController;
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
    return view('welcome');
});


Route::get('pos', function () {
    return view('Pos.index');
});

Route::get('ka', 'StoresController@hi');

Route::post('append',  [PosoneController::class,'append'])->name('append');

Route::post('load_cate', [PosoneController::class,'load_cate'])->name('load_cate');
Route::get('load_pos', [PosoneController::class,'load_pos'])->name('load_pos');
Route::post('pay', [PosoneController::class,'pay'])->name('pay');
Route::post('save', [PosoneController::class,'save'])->name('save');
Route::post('table', [PosoneController::class,'table'])->name('table');
Route::post('dd', [PosoneController::class,'searchcus'])->name('kaka');
Route::post('ajax', [PosoneController::class,'searchmenu'])->name('searchmenu');






// Route::get('/admin',function(){
//     return view('Man.index');
// })->name('vv');

Route::prefix('/admin')->as('admin.')->group(function () {
    Route::get('Bills',[BillController::class,'bill'])->name('bill');
    Route::get('pagination_bill',[BillController::class,'pagination'])->name('pagination_bill');

    Route::get('',function(){
        return view('Man.dashboard');
    })->name('das');

    Route::get('receipts',[ReceiptController::class,'index'])->name('receipts');
    Route::get('pagination_re',[ReceiptController::class,'pagination_re'])->name('pagination_re');

    Route::get('payment',[PaymentController::class,'index'])->name('payment');
    Route::get('pagination_pay',[PaymentController::class,'pagination_pay'])->name('pagination_pay');

    Route::get('warehouse',[BallotController::class,'ballot'])->name('ware');
    Route::get('pagination_ballot',[BallotController::class,'pagination'])->name('pagination_ballot');
  

    Route::get('merchandise',[ProductController::class,'index1'])->name('merc');
    Route::get('pagination_pro',[ProductController::class,'pagination_pro'])->name('pagination_pro');
    Route::post('keypro',[ProductController::class,'key1'])->name('keypro');
    Route::post('save_pro',[ProductController::class,'save1'])->name('pro');

    Route::get('product',[ProductController::class,'index'])->name('kk');
    Route::post('pro_append',  [ProductController::class,'append'])->name('pro_append');
    Route::post('pro_search', [ProductController::class,'searchmenu'])->name('pro_searchmenu');
    Route::post('pro_save', [ProductController::class,'save'])->name('save_pro');


    Route::get('Menu',[MenuController::class,'index'])->name('product1');
    Route::get('pagination_menu',[MenuController::class,'pagination_menu'])->name('pagination_menu');
    Route::get('searchmenu',[MenuController::class,'search_option'])->name('searchmenu');
    Route::post('keymenu',[MenuController::class,'key'])->name('keymenu');
    Route::post('save',[MenuController::class,'save'])->name('product');

    Route::get('customer',[PeopleController::class,'index'])->name('cus');
    Route::get('pagination_cus',[PeopleController::class,'pagination_cus'])->name('pagination_cus');
    Route::get('pagination_sup',[PeopleController::class,'pagination_sup'])->name('pagination_sup');
    Route::get('peo1',[PeopleController::class,'destroy1'])->name('peo1');

    Route::get('table',[TableController::class,'index'])->name('table');
    Route::get('pagination',[TableController::class,'pagination'])->name('pagination');
    Route::get('searchtab',[TableController::class,'search_option'])->name('searchtab');
    Route::post('key',[TableController::class,'key'])->name('key');
});

Route::resource('tab', TableController::class);
Route::resource('are', AreaController::class);
Route::resource('peo', PeopleController::class);
Route::resource('menure', MenuController::class);
Route::resource('cate', CateController::class);
Route::resource('pro', ProductController::class);
Route::resource('receipt', ReceiptController::class);
Route::resource('payment', PaymentController::class);