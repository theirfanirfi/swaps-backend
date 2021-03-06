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

Route::group(['prefix' => 'user', 'middleware' => 'UserWare'], function () {
    Route::get('/', 'UserController@getUser');
});

Route::group(['prefix' => 'status', 'middleware' => 'cors'], function () {
    Route::post('compose', 'StatusController@composeStatusPost');

    Route::post('composetag', 'StatusController@composeStatusTagPost');

    Route::get('/getStatuses', 'StatusController@getStatuses');

    Route::get('/discoverStatuses', 'StatusController@discoverStatuses');

    Route::get('/getUserStatuses', 'StatusController@getUserStatuses');
    Route::get('/rateStatus', 'StatusController@rateStatus');
    Route::get('/deleteStatus', 'StatusController@deleteStatus');
    Route::get('/attachments', 'StatusController@getStatusAttachments');
    Route::get('/get', 'StatusController@getStatus');
    Route::get('/getr', 'StatusController@getStatusForReact');
});


Route::group(['prefix' => 'followers', 'middleware' => 'cors'], function () {
    Route::get('/', 'FollowerController@getFollowers');
    Route::get('/swapStatus', 'FollowerController@swapStatus');
    Route::get('/deSwapStatus', 'FollowerController@deSwapStatus');
    Route::get('/isfollow', 'FollowerController@isfollow');
    Route::get('/follow', 'FollowerController@follow');
    Route::get('/unfollow', 'FollowerController@unfollow');
    Route::get('/users', 'FollowerController@getUsers');
    Route::get('/startFollowing', 'FollowerController@getUsersAtNacentRegisteration');
    Route::get('/check', 'FollowerController@getF');
    Route::get('/followed', 'FollowerController@followed');
    Route::get('/invites', 'UserController@updateInvitesCount');
    Route::get('/getUserFollowers', 'FollowerController@getUserFollowers');
    Route::get('getfollowedusers', 'FollowerController@getFollowedUsersForSwap');
});

Route::group(['prefix' => 'swaps', 'middleware' => 'cors'], function () {
    Route::get('/', 'SwapsController@getSwaps');
    Route::get('/user', 'SwapsController@getUserSwaps');
    Route::get('/unswap', 'SwapsController@unswap');
    Route::get('/getSwap', 'SwapsController@getSwap');
    Route::get('/getSwapsrev', 'SwapsController@getSwapsForReviewIfNotReviewed');
    Route::get('/rvswap', 'SwapsController@reviewSwapByUpdatingTheRow');
    Route::get('/requestmodification', 'SwapsController@requestmodification');
});

Route::group(['prefix' => 'auth', 'middleware' => 'cors'], function () {
    Route::get('/', 'LoginController@checktoken');
    Route::get('/login/{data}', 'LoginController@login')->name('login');
    Route::get('/loginr', 'LoginController@loginReact');
    Route::get('register/{data}', 'LoginController@register');
    Route::get('registerr', 'LoginController@registerReact');
    Route::get('slogin', 'LoginController@slogin')->name('slogin');
});

Route::group(['prefix' => 'rating'], function () {
    Route::get('/getStatusRatings', 'RatingController@getStatusRatings');
    Route::get('/getStatusRaters', 'RatingController@getStatusRaters');
});


Route::group(['prefix' => 'profile', 'middleware' => 'cors'], function () {
    Route::post('/updateImage', 'ProfileController@updateImage');
    Route::get('/updateDescription', 'ProfileController@updateDescription');
    Route::get('/getProfileStats', 'ProfileController@getProfileStats');
    Route::get('/getProfileStatsr', 'ProfileController@getProfileStatsForReact');
    Route::get('/getProfileUserStats', 'ProfileController@getProfileUserStats');
    Route::get('/updateProfileDetails', 'ProfileController@updateProfileDetails');
    Route::get('/updateprofile', 'ProfileController@updateProfileDetailsForReact');
    Route::get('/changepassword', 'ProfileController@changePassword');
    Route::get('/swapreviews', 'SwapsController@getSwapReviewsForUserProfile');
    Route::post('/uploadcover', 'ProfileController@uploadCoverImageReactWeb');
    Route::post('/uploadprofile', 'ProfileController@uploadProfileImageReactWeb');
    Route::get('/getprofiledetails', 'ProfileController@getprofiledetailsForReact');
    Route::get('/getprofilesmlinks', 'ProfileController@getprofilesmlinks');
    Route::get('/updatesml', 'ProfileController@updateprofilesocialMediaLinks');
});

Route::group(['prefix' => 'notifications', 'middleware' => 'cors'], function () {
    Route::get('/getNotifications', 'NotificationController@getNotifications');
    Route::get('/getNotificationsrw', 'NotificationController@getNotificationsForReactWeb');
    Route::get('/getSwapRequestNotifications', 'NotificationController@getSwapRequestNotifications');
    Route::get('/getSwapRequestNotificationsr', 'NotificationController@getSwapRequestNotificationsForReactWeb');
    Route::get('/getSwapRequestNotificationsb', 'NotificationController@getSwapRequestNotificationsForBackground');
    Route::get('/getNotificationsCount', 'NotificationController@getNotificationsCount');
    Route::get('/getSwapNotificationsCount', 'NotificationController@getSwapNotificationsCount');
    Route::get('/approveSwap', 'NotificationController@approveSwap');
    Route::get('/declineSwap', 'NotificationController@declineSwap');
    Route::get('/clear', 'NotificationController@clear');
});

Route::group(['prefix' => 'participants', 'middleware' => 'cors'], function () {
    Route::get('/', 'ParticipantsController@getParticipants');
    Route::get('/initiate', 'ParticipantsController@createParticipants');
});

Route::group(['prefix' => 'msg', 'middleware' => 'cors'], function () {

    Route::get('/', 'MessageController@getMessages');
    Route::get('/get', 'MessageController@getMessagesForReact');
    Route::get('/send', 'MessageController@sendMessage');
    Route::post('/aud', 'AttachmentController@sendAudio');
    Route::post('/gaud', 'AttachmentController@sendGroupAudio');
    Route::get('/getUnReadAndLast', 'MessageController@getUnReadMessageAndCount');
    Route::get('getmessage', 'MessageController@getMessageForReact');

    //group messages
    Route::get('/gc', 'GroupMessagesController@getGroupMessages');
    Route::get('/gs', 'GroupMessagesController@sentMessageToGroup');
    //forward
    Route::get('/fr', 'GroupMessagesController@forwardMessageFromGroup');
    //invite to group
    Route::get('/inv', 'GroupsController@inviteToGroup');
});

//upload status attachments

Route::group(['prefix' => 'attachments'], function () {
    Route::post('send', 'AttachmentController@send');
});

//search

Route::group(['prefix' => 'search', 'middleware' => 'cors'], function () {
    Route::get('/status', 'SearchController@searchStatuses');
    Route::get('/statusr', 'SearchController@searchStatusesForReactTab');
    Route::get('/users', 'SearchController@searchUsers');
    Route::get('/usersr', 'SearchController@searchUsersForReactTab');
});


//groups

Route::group(['prefix' => 'group'], function () {
    Route::get('/create', 'GroupsController@createGroup');
    Route::get('/users', 'SearchController@searchUsers');
});



//Like and dislike

Route::post('like', 'LikeController@like');
Route::get('likes', 'LikeController@like')->middleware('cors');
Route::get('shares', 'ShareController@share')->middleware('cors');
Route::get('ushares', 'ShareController@unshare')->middleware('cors');
Route::post('share', 'ShareController@share');

//comment
Route::post('comment', 'CommentController@comment');
Route::get('commentons', 'CommentController@comment')->middleware('cors');
Route::post('comments', 'CommentController@getComments');
Route::get('getcomments', 'CommentController@getComments')->middleware('cors');


//tag users
Route::group(['prefix' => 'tag'], function () {
    Route::get('getusertotag', 'TagUserController@getUserForTaging');
    Route::get('user', 'TagUserController@getUser');
});


//Route::get('/check','StatusController@check');

Route::get('/check', function () {
    //$arr = '["http:\/\/192.168.10.5\/swap\/public\/statuses\/videos\/Irfan Ullah31545909822"]';
    // $arr[] = "http://192.168.10.5/swap/public/statuses/videos/Irfan Ullah31545909822";
    // $arr[] = "http://192.168.10.5/swap/public/statuses/videos/Irfan Ullah31545909822";
    // $arr[] = "http://192.168.10.5/swap/public/statuses/videos/Irfan Ullah31545909822";
    //$arr = '{"res":"http:\\\/\\\/192.168.10.5\\\/swap\\\/public\\\/statuses\\\/videos\\\/Irfan Ullah31545909822","type":2}';
    //$arr = json_decode($arr);


    $an['res'] = 'http:\/\/192.168.10.5\/swap\/public\/statuses\/videos\/Irfan Ullah31545909822';
    $an['type'] = 1;
    $and[] = $an;
    echo json_encode($and);

    // echo json_encode($arr);
    echo "<br/>";

    $b['res'] = "some value";
    $b['type'] = 2;
    $and[] = $b;
    echo json_encode($and);
    echo "<br/>";
    echo "<br/>";

    $encoded = '[{"res":"http:\\\/\\\/192.168.10.5\\\/swap\\\/public\\\/statuses\\\/videos\\\/Irfan Ullah31545909822","type":1},{"res":"some value","type":2}]';
    $band = json_decode($encoded);
    $b['res'] = "some another value";
    $b['type'] = 3;

    $band[] = $b;
    echo json_encode($band);
    // $a = array();
    // $a = json_decode($arr);
    // echo $a;
    //echo $arr;

});
Route::get('im', 'MessageController@getMessageForReact');
