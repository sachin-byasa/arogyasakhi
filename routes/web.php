<?php

use Illuminate\Support\Facades\Route;
$CommonUtils = new \App\Library\CommonUtils();

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
    // return(\Hash::make('1234'));
    // return view('welcome');
    return Redirect::to('/login');
});


Auth::routes();


Route::get('/unauthenticated', function(){
    return view('unauthenticated');
})->name('unauthenticated');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@index')->name('admin.dashboard');
Route::get('/test', 'testController@index')->name('test.index');

Route::get('/admin/dashboard', 'HomeController@index')->name('home');


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => [ 'auth:arogyasakhi', 'user.control']], function($CommonUtils){
    
    Route::get('/user-master', 'UserMasterController@index');
    Route::post('/user-master', 'UserMasterController@index')->name('user-master.index');
    Route::get('/edit-user/{id}', 'UserMasterController@edit')->name('user-master.user.edit');
    Route::post('/user/update/{id}', 'UserMasterController@update')->name('user-master.user.update');
    Route::post('/add-user', 'UserMasterController@store')->name('user-master.add');
    
    Route::get('/group-master', 'GroupMasterController@index');
    Route::post('/group-master', 'GroupMasterController@index')->name('group-master.index');
    Route::get('/edit-group/{id}', 'GroupMasterController@edit')->name('group-master.group.edit');
    Route::post('/group/update/{id}', 'GroupMasterController@update')->name('group-master.group.update');
    Route::post('/add-group', 'GroupMasterController@store')->name('group-master.group.add');
    Route::get('/group-master/delete/{id}', 'GroupMasterController@destroy')->name('group-master.group.destroy');
    Route::get('/group-master/activate/{id}', 'GroupMasterController@activate')->name('group-master.group.activate');

    // Route::get('/state', '\App\Http\Controllers\HomeController@index')->name('state.index');
    Route::get('/district', 'DistrictController@index')->name('district.index');
    Route::get('/block', 'BlockController@index')->name('block.index');

    Route::get('/village', 'VillageController@index')->name('village.index');

    Route::resource('phc', 'PhcController',[
        'only' => [ 'index', 'create', 'store', 'show', 'edit', 'update']
    ]);
    Route::get('phc/disable/{id}', 'PhcController@disable')->name('phc.disable');
    Route::get('phc/enable/{id}', 'PhcController@enable')->name('phc.enable');
    
    Route::resource('sub-centre', 'SubCentreController',[
        'only' => [ 'index', 'create', 'store', 'show', 'edit', 'update']
        ]);
    Route::get('sub-centre/disable/{id}', 'SubCentreController@disable')->name('sub-centre.disable');
    Route::get('sub-centre/enable/{id}', 'SubCentreController@enable')->name('sub-centre.enable');

    
    Route::get('/question-manager', '\App\Http\Controllers\HomeController@index')->name('question-manager.index');
    Route::get('/user-management', '\App\Http\Controllers\HomeController@index')->name('user-management.index');
    Route::get('/my-profile', '\App\Http\Controllers\HomeController@index')->name('my-profile.index');
    
    Route::get('/group-menu', 'GroupMenuController@index');
    Route::post('/group-menu', 'GroupMenuController@index')->name('group-menu.index');







    // foreach (DB::table('menu_child')->get() as $menumaster) {
    //     $slug = Str::of($menumaster->child_name)->slug('-');
    //     $controller = $slug->singular()->camel()->ucfirst()->finish('Controller');
    //     Route::get($slug, $controller . '@index')->middleware('user.control');
    //     Route::post($slug, $controller . '@index')->middleware('user.control')->name($slug . '.index');
    //     Route::get($slug . '/edit', $controller . '@edit')->middleware('user.control');
    //     // Route::resource($slug, $controller)->middleware('user.control');
    // }

    Route::group(array('prefix' => 'states'), function()
    {
    Route::get('/', 'StateController@index')->name('state.index');
    Route::get('/create', 'StateController@create');
    Route::post('/store', 'StateController@store');
    Route::get('/edit/{id}', 'StateController@edit');
    Route::post('/update', 'StateController@update');
    Route::get('/delete/{id}', 'StateController@destroy');
    Route::get('/export', 'StateController@export');
    });
    Route::group(array('prefix' => 'districts'), function()
    {
    Route::get('/', 'DistrictController@index')->name('district.index');
    Route::get('/create', 'DistrictController@create');
    Route::post('/store', 'DistrictController@store');
    Route::get('/edit/{id}', 'DistrictController@edit');
    Route::post('/update', 'DistrictController@update');
    Route::get('/delete/{id}', 'DistrictController@destroy');
    Route::get('/export', 'DistrictController@export');
    });
   

    Route::resource('blocks', 'BlockController',[
        'only' => ['index', 'create','store','show','edit','update']
    ]);
    Route::group(array('prefix' => 'blocks'), function()
    {
    Route::get('/getDistrictFromState/{id}', 'BlockController@getDistrictFromState');
    Route::get('/getBlockFromDistrict/{id}', 'BlockController@getBlockFromDistrict');
    Route::get('/delete/{id}', 'BlockController@destroy');
    Route::get('/export/csv', 'BlockController@export');
    });

    Route::resource('villages', 'VillageController',['only' => ['index', 'create','store','show','edit','update']])
    ->parameters(['villages' => 'village_id']);

    Route::group(array('prefix' => 'villages'), function()
    {
    Route::get('/delete/{id}', 'VillageController@destroy');
    Route::get('/export/csv', 'VillageController@export');
    });

    Route::group(array('prefix' => 'question-manager'), function()
    {
    // Route::get('/', 'QuestionManagerController@index')->name('state.index');
    Route::get('/create', 'QuestionManagerController@create')->name('question-manager.create');
    Route::post('/store', 'QuestionManagerController@store')->name('question-manager.store');
    Route::get('/edit/{id}', 'QuestionManagerController@edit')->name('question-manager.edit');
    Route::post('/update', 'QuestionManagerController@update')->name('question-manager.update');
    Route::get('/delete/{id}', 'QuestionManagerController@destroy')->name('question-manager.destroy');
    // Route::get('/export', 'QuestionManagerController@export')->name('question-manager.create');
    });


});
Route::get('/admin/dashboard', 'HomeController@index')->name('home');


// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
