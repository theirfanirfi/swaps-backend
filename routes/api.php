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
Route::get('/getUserStatuses','StatusController@getUserStatuses');
Route::get('/rateStatus','StatusController@rateStatus');
Route::get('/deleteStatus','StatusController@deleteStatus');
});


Route::group(['prefix' => 'followers'],function(){
Route::get('/','FollowerController@getFollowers');
Route::get('/swapStatus','FollowerController@swapStatus');
Route::get('/deSwapStatus','FollowerController@deSwapStatus');
Route::get('/isfollow','FollowerController@isfollow');
Route::get('/follow','FollowerController@follow');
Route::get('/unfollow','FollowerController@unfollow');
Route::get('/users','FollowerController@getUsers');

});

Route::group(['prefix' => 'swaps'],function(){
Route::get('/','SwapsController@getSwaps');
Route::get('/user','SwapsController@getUserSwaps');
Route::get('/unswap','SwapsController@unswap');
Route::get('/getSwap','SwapsController@getSwap');
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
Route::get('/updateDescription','ProfileController@updateDescription');
Route::get('/getProfileStats','ProfileController@getProfileStats');
Route::get('/getProfileUserStats','ProfileController@getProfileUserStats');
Route::get('/updateProfileDetails','ProfileController@updateProfileDetails');
Route::get('/changePassword','ProfileController@changePassword');

});

Route::group(['prefix' => 'notifications'],function(){
Route::get('/getNotifications','NotificationController@getNotifications');
Route::get('/getNotificationsCount','NotificationController@getNotificationsCount');
Route::get('/approveSwap','NotificationController@approveSwap');
Route::get('/clear','NotificationController@clear');
});

Route::group(['prefix' => 'participants'],function(){
Route::get('/','ParticipantsController@getParticipants');
});

Route::group(['prefix' => 'msg'],function(){

Route::get('/','MessageController@getMessages');
Route::get('/send','MessageController@sendMessage');

});

//upload status attachments

Route::group(['prefix' => 'attachments'],function(){
Route::post('send','AttachmentController@send');
});

Route::get('/check','StatusController@check');