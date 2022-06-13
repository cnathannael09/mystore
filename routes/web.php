<?php

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
Route::view('/selamatdatang', 'welcome');

Route::get("helloworld",function(){
    return "Hello World";
});

Route::get('user/{id}', function($id){
    return 'User '.$id;
});

Route::get('user/{name?}', function($name='John'){
    return $name;
});

Route::get('foo1', function(){
    return 'Foo1';
})->name('namaroute');

Route::get('greeting', function(){
    return view('user', ['name' => 'Samantha']);
});

Route::get('wfp/{kelas?}', function($name='B'){
    if ( $kelas === "B" || $kelas === "b"){
        return "Kelas Saya";
    }
    else return "Bukan kelas saya";
    return "WFP kelas" . $kelas;
});

Route::view('/catalog', 'catalog');

Route::view('/catalog/medicines', 'medicines');

Route::view('/catalog/med_equip', 'medequip');

Route::get('medicines/{id}', function($id){
    return view('detail', ['id' => $id]);
});

Route::get('equipments/{id}', function($id){
    return view('detail', ['id' => $id]);
});

// Route::get('formnewproduct','ProductController@create');
// Route::get('formupdateproduct','ProductController@update');

// Route::resource('product','ProductResController');

Route::resource('obat','MedicineController');

Route::get('/report/listmedicine/{id}','CategoryController@showlist')->name('reportShowMedicine');
Route::resource('transactions','TransactionController');
Route::get('showModal/{id}','TransactionController@showTransaction')->name('transaction.showModal');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth'])->group(function(){
    Route::resource('kategori','CategoryController');
    Route::post('kategori/getEditForm','CategoryController@getEditForm')->name('kategori.getEditForm');
    Route::post('kategori/getEditForm2','CategoryController@getEditForm2')->name('kategori.getEditForm2');
    Route::post('kategori/saveData','CategoryController@saveData')->name('kategori.saveData');
    Route::post('kategori/deleteData','CategoryController@deleteData')->name('kategori.deleteData');
    Route::post('kategori/saveDataField','CategoryController@saveDataField')->name('kategori.saveDataField');
    Route::post('kategori/changeLogo','CategoryController@changeLogo')->name('kategori.changeLogo');
});

Route::get('/', 'ProductController@front_index');
Route::get('cart', 'ProductController@cart');
Route::get('add-to-cart/{id}', 'ProductController@addToCart');

Route::get('/checkout', 'TransactionController@form_submit_front')->middleware(['auth']);
Route::get('/submit_checkout', 'TransactionController@submit_front')->name('submitcheckout')->middleware(['auth']);