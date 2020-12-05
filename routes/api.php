<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// 'cors', 'json.response', 
Route::group(['prefix' => '{arogyasakhi_id}', 'middleware' => ['cors', 'json.response']], function(){
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register','Auth\ApiAuthController@register')->name('register.api');
});

Route::group(['namespace' => 'API', 'prefix' => '{arogyasakhi_id}', 'middleware' => [ 'cors', 'json.response', 'auth:api']], function(){
    
    Route::post('/logout', '\App\Http\Controllers\Auth\ApiAuthController@logout')->name('logout.api');

    // Route::middleware('auth:api');
    Route::get('state/{state_id}/districts', 'DistrictController@DistrictsInState');
    Route::get('district/{district_id}/block', 'BlocksController@BlocksInDistrict');
    Route::get('block/{block_id}/phc', 'PHCController@PHCInBlock');
    Route::get('block/{block_id}/village', 'VillageController@VillagesInBlock');
    Route::apiResources([
        'answer_type' => 'AnswerTypeController',
        'beneficiary' => 'BeneficiaryController',
        'beneficiary_status' => 'BeneficiaryStatusController',
        'beneficiary_type' => 'BeneficiaryTypeController',
        'block' => 'BlocksController',	
        'district' => 'DistrictController',	
        'education_master' => 'EducationMasterController',	
        'faq' => 'FAQController',
        'faq_question' => 'FAQQuestionController',
        'faq_answer' => 'FAQAnswerController',
        'language' => 'LanguageController',	
        'phc' => 'PHCController',	
        'question' => 'QuestionController',
        'question_language' => 'QuestionLanguageController',
        'question_option' => 'QuestionOptionController',
        'question_option_language' => 'QuestionOptionLanguageController',
        'registration' => 'RegistrationTypeController',	
        'religion' => 'ReligionController',	
        'state' => 'StateController',	
        'subcentre' => 'SubCentresController',	
        'village' => 'VillageController',
        'visit_master' => 'VisitMasterController',
        'visit_question' => 'VisitQuestionController',
    ]);
    // Route::get('menu/{type}', 'MenuController@index');
    // Route::get('listing/{slug?}', 'ListingController@index');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
