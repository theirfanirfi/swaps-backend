<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'user', 'middleware'=>'UserWare'],function(){
    Route::get('/','UserController@getUser');

});

Route::group(['prefix' => 'status/'],function(){
Route::post('/compose','StatusController@composeStatusPost');
Route::get('/getStatuses','StatusController@getStatuses');
Route::get('/rateStatus','StatusController@rateStatus');
Route::get('/deleteStatus','StatusController@deleteStatus');
});


Route::group(['prefix' => 'followers'],function(){
Route::get('/','FollowerController@getFollowers');
Route::get('/swapStatus','FollowerController@swapStatus');
Route::get('/deSwapStatus','FollowerController@deSwapStatus');

});

Route::group(['prefix' => 'swaps'],function(){
Route::get('/','SwapsController@getSwaps');
Route::get('/unswap','SwapsController@unswap');
});

Route::group(['prefix' => 'auth/'],function(){
Route::get('/login/{data}','LoginController@login')->name('login');
Route::get('/register/{data}','LoginController@register');
});

Route::group(['prefix' => 'rating'],function(){
Route::get('/getStatusRatings','RatingController@getStatusRatings');
});


Route::group(['prefix' => 'profile'],function(){
Route::post('/updateImage','ProfileController@updateImage');
});

Route::get('/check','StatusController@check');