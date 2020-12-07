<?php

use Illuminate\Support\Facades\Route;

$CommonUtils = \App\Library\CommonUtils::class;
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

Route::get('/test', 'TestController@index');

Route::get('/', function () {

    // foreach (DB::table('menu_child')->get() as $menumaster) {
    //             $slug = Str::of($menumaster->child_name)->slug('-');
    //             // Route::resource($slug, $slug->camel()->ucfirst());

    //             print($slug.'     ---------------       '. $slug->singular()->camel()->ucfirst()->finish('Controller'));
    //             echo "<br>";
    //         }
    // return \Hash::make('Sachin@282');

    return Redirect::to('/login');
    // return Redirect::to('/admin/dashboard');
    // return $string = Str::of('foo Bar bAz')->slug('_');
});


Auth::routes(['verify' => false]);

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth:arogyasakhi']], function () {

    Route::get('/user-master', 'UserMasterController@index')->name('usermaster.user.list');
    Route::post('/user-master', 'UserMasterController@index')->name('usermaster.user.list');
    Route::get('/edit-user/{id}', 'UserMasterController@edit')->name('usermaster.user.edit');
    Route::post('/user/update/{id}', 'UserMasterController@update')->name('usermaster.user.update');
    Route::post('/add-user', 'UserMasterController@store')->name('usemaster.user.add');

    Route::get('/group-master', 'GroupMasterController@index')->name('groupmaster.group.list');
    Route::post('/group-master', 'GroupMasterController@index')->name('groupmaster.group.list');
    Route::get('/edit-group/{id}', 'GroupMasterController@edit')->name('groupmaster.group.edit');
    Route::post('/group/update/{id}', 'GroupMasterController@update')->name('groupmaster.group.update');
    Route::post('/add-group', 'GroupMasterController@store')->name('usemaster.group.add');

    Route::group(['middleware' => ['auth:arogyasakhi']], function ($CommonUtils) {
        Route::get('/test', function ($CommonUtils) {

            dd($CommonUtils->getMenuChild());
        });

        //     foreach ($CommonUtils->getMenuChild() as $menumaster) {

        //         $slug = $CommonUtils->getSlug($menumaster);
        //         // $controller = $CommonUtils->getController($slug);

        //         Route::get($slug, $menumaster->controllername.'@index');
        //         Route::post($slug, $menumaster->controllername.'@index')->name($slug.'.index');

        //         Route::get($slug.'/edit', $menumaster->controllername.'@edit');
        //         // Route::resource($slug, $controller)->middleware('user.control');
        //     }

        // });
    });









    // Route::group( ['middleware' => [ 'auth:arogyasakhi']] ,function($CommonUtils) {
    //     Route::get('/test', function($CommonUtils){

    //         dd($CommonUtils->getMenuChild());
    //     });

    //     //     foreach ($CommonUtils->getMenuChild() as $menumaster) {

    //     //         $slug = $CommonUtils->getSlug($menumaster);
    //     //         // $controller = $CommonUtils->getController($slug);

    //     //         Route::get($slug, $menumaster->controllername.'@index');
    //     //         Route::post($slug, $menumaster->controllername.'@index')->name($slug.'.index');

    //     //         Route::get($slug.'/edit', $menumaster->controllername.'@edit');
    //     //         // Route::resource($slug, $controller)->middleware('user.control');
    //     //     }

    //     });
    // });






    foreach (DB::table('menu_child')->get() as $menumaster) {
        $slug = Str::of($menumaster->child_name)->slug('-');
        $controller = $slug->singular()->camel()->ucfirst()->finish('Controller');
        Route::get($slug, $controller . '@index')->middleware('user.control');
        Route::post($slug, $controller . '@index')->middleware('user.control')->name($slug . '.index');
        Route::get($slug . '/edit', $controller . '@edit')->middleware('user.control');
        // Route::resource($slug, $controller)->middleware('user.control');
    }

    // try { 
    //     foreach (DB::table('menu_child')->get() as $menumaster) {
    //         $slug = Str::of($menumaster->child_name)->slug('-');
    //         Route::resource($slug, $menumaster->controller);
    //     }
    // }


    Route::group(array('prefix' => 'states'), function()
    {
    Route::get('/', 'StateController@index');
    Route::get('/create', 'StateController@create');
    Route::post('/store', 'StateController@store');
    Route::get('/edit/{id}', 'StateController@edit');
    Route::post('/update', 'StateController@update');
    Route::get('/delete/{id}', 'StateController@destroy');
    Route::get('/export', 'StateController@export');
    });
    Route::group(array('prefix' => 'districts'), function()
    {
    Route::get('/', 'DistrictController@index');
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


});
Route::get('/admin/dashboard', 'HomeController@index')->name('home');


// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
