<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\MyClasses\VerifyToken;
use App\User;
use App\Models\Swaps;
use App\Models\Statuses;
use App\Models\Followers;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function updateImage(Request $req)
    {

        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);

        if (!$user) {
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        } else {

            if (!$req->hasFile('image') || $token == "") {
                return response()->json([
                    'isEmpty' => true,
                    'isError' => true,
                    'isAuthenticated' => true,
                    'message' => 'Either image or arugment is not provided.'
                ]);
            } else {

                $file = $req->file('image');
                $path = "./profile/";
                $file_name = $file->getClientOriginalName();
                $user_id = $user->user_id;
                if ($file->move($path, $file_name)) {
                    $u = User::find($user_id);
                    $u->profile_image = asset("profile/") . "/" . $file_name;

                    if ($u->save()) {

                        return response()->json([
                            'isEmpty' => false,
                            'isError' => false,
                            'isAuthenticated' => true,
                            'isMoved' => true,
                            'isSaved' => true,
                            'user' => $u,
                            'message' => 'Profile Image changed.'
                        ]);
                    } else {

                        return response()->json([
                            'isEmpty' => false,
                            'isError' => false,
                            'isAuthenticated' => true,
                            'isMoved' => true,
                            'isSaved' => false,
                            'message' => 'Error occurred in saving the image. Try again.'
                        ]);
                    }
                } else {
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => true,
                        'isAuthenticated' => true,
                        'isMoved' => false,
                        'isSaved' => false,
                        'message' => 'Error occurred in saving the image. Try again.'
                    ]);
                }
            }
        }
    }

    public function updateDescription(Request $req)
    {
        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        $desc = $req->input('description');

        if (!$user) {
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        } else {
            if ($token == "" || $desc == "") {
                return response()->json([
                    'isEmpty' => true,
                    'isError' => true,
                    'isAuthenticated' => true,
                    'message' => 'Arguments required.'
                ]);
            } else {
                $user->profile_description = $desc;
                if ($user->save()) {
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => false,
                        'isAuthenticated' => true,
                        'isUpdated' => true,
                        'user' => $user,
                        'message' => 'Description updated.'
                    ]);
                } else {
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => true,
                        'isAuthenticated' => true,
                        'isUpdated' => false,
                        'message' => 'Error occurred in updating the description. Try again.'
                    ]);
                }
            }
        }
    }

    public function getProfileStats(Request $req)
    {
        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        if (!$user) {
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        } else {
            if ($token == "") {
                return response()->json([
                    'isEmpty' => true,
                    'isError' => true,
                    'isAuthenticated' => true,
                    'message' => 'Arguments required.'
                ]);
            } else {
                $swaps = Swaps::where(['poster_user_id' => $user->user_id])->count();
                $status = Statuses::where(['user_id' => $user->user_id])->count();
                $followers = Followers::where(['followed_user_id' => $user->user_id])->count();
                // $stats = Swaps::getSwapReviews($user->user_id);

                return response()->json([
                    'isEmpty' => false,
                    'isError' => false,
                    'isFound' => true,
                    'swaps' => $swaps,
                    'statuses' => $status,
                    'followers' => $followers,
                    'isAuthenticated' => true,
                ]);
            }
        }
    }

    public function getprofilesmlinks(Request $req)
    {
        $token = $req->input('token');
        if ($token == "") {
            return response()->json([
                'isEmpty' => true,
                'isError' => true,
                'isAuthenticated' => false,
                'isError' => true,
                'message' => 'Arguments required.'
            ]);
        } else {
            $verify = new VerifyToken();
            $user = $verify->verifyTokenInDb($token);

            if (!$user) {
                return response()->json([
                    'isAuthenticated' => false,
                    'message' => 'Not authenticated'
                ]);
            } else {
                $profile = User::getUserDetailsForProfile($user->user_id);
                if ($profile->count() > 0) {
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => false,
                        'isFound' => true,
                        'profile' => $profile->first(),
                        'isAuthenticated' => true,
                    ]);
                } else {
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => true,
                        'isFound' => false,
                        'isAuthenticated' => true,
                        'message' => 'Profile not found'
                    ]);
                }
            }
        }
    }

    public function getprofiledetailsForReact(Request $req)
    {
        $token = $req->input('token');
        if ($token == "") {
            return response()->json([
                'isEmpty' => true,
                'isError' => true,
                'isAuthenticated' => false,
                'message' => 'Arguments required.'
            ]);
        } else {
            $verify = new VerifyToken();
            $user = $verify->verifyTokenInDb($token);

            if (!$user) {
                return response()->json([
                    'isAuthenticated' => false,
                    'message' => 'Not authenticated'
                ]);
            } else {
                $profile = User::getUserDetailsForProfile($user->user_id);
                if ($profile->count() > 0) {
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => false,
                        'isFound' => true,
                        'profile' => $profile->first(),
                        'isAuthenticated' => true,
                    ]);
                } else {
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => true,
                        'isFound' => false,
                        'isAuthenticated' => true,
                        'message' => 'Profile not found'
                    ]);
                }
            }
        }
    }

    public function getProfileStatsForReact(Request $req)
    {
        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        if (!$user) {
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        } else {
            if ($token == "") {
                return response()->json([
                    'isEmpty' => true,
                    'isError' => true,
                    'isAuthenticated' => true,
                    'message' => 'Arguments required.'
                ]);
            } else {
                $user_s = User::getUserDetailsForProfile($user->user_id);
                $stats = User::getUserAndStatsForProfile($user->user_id);

                $statusObj = new Statuses();
                $statuses =  $statusObj->getStatuses($user->user_id);

                $swaps = new Swaps();
                $s = $swaps->getSwapsTab($user->user_id);

                if ($user_s->count() > 0 || sizeof($stats) > 0)
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => false,
                        'isFound' => true,
                        'stats' => $stats[0],
                        'user' => $user_s->first(),
                        'statuses' => $statuses,
                        'swaps' => $s,
                        'isAuthenticated' => true,
                    ]);
            }
        }
    }

    public function getProfileUserStats(Request $req)
    {
        $user_id = $req->input('id');
        $token = $req->input('token');

        $tuser = "";



        if ($user_id == "") {
            return response()->json([
                'isEmpty' => true,
                'isError' => true,
                'isAuthenticated' => true,
                'message' => 'Arguments required.'
            ]);
        } else {
            // $swaps = Swaps::where(['poster_user_id' => $user_id])->count();
            // $status = Statuses::where(['user_id' => $user_id])->count();
            // $followers = Followers::where(['followed_user_id' => $user_id])->count();
            $stats = User::getUserAndStatsForProfile($user_id);
            $user = User::where(['user_id' => $user_id])->select('profile_image', 'name', 'user_id', 'cover_image')->first();
            $statusObj = new Statuses();
            $statuses =  $statusObj->getStatuses($user_id);

            $swaps = new Swaps();
            $s = $swaps->getSwapsTab($user_id);
            if ($token != "") {
                $verify = new VerifyToken();
                $tuser = $verify->verifyTokenInDb($token);
                if (!$tuser) {
                    return response()->json([
                        'isAuthenticated' => false,
                        'isError' => true,
                        'message' => 'You are not logged in'
                    ]);
                } else {
                    $isfollow = Followers::where(['followed_user_id' => $user_id, 'follower_user_id' => $tuser->user_id])->count();
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => false,
                        'isFound' => true,
                        // 'swaps' => $swaps,
                        // 'statuses' => $status,
                        // 'followers' => $followers,
                        'user' => $user,
                        'isfollow' => $isfollow,
                        'stats' => $stats[0],
                        'statuses' => $statuses,
                        'swaps' => $s,
                        'isAuthenticated' => true,
                    ]);
                }
            } else {
                return response()->json([
                    'isEmpty' => false,
                    'isError' => false,
                    'isFound' => true,
                    // 'swaps' => $swaps,
                    // 'statuses' => $status,
                    // 'followers' => $followers,
                    'user' => $user,
                    'stats' => $stats[0],
                    'statuses' => $statuses,
                    'swaps' => $s,
                    'isAuthenticated' => true,
                ]);
            }
        }
    }
    public function updateProfileDetails(Request $req)
    {
        $token = $req->input('token');
        $name = $req->input('name');
        $username = $req->input('username');
        $email = $req->input('email');

        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        if (!$user) {
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        } else {
            if ($token == "" || $name == "" || $username == "" || $email == "") {
                return response()->json([
                    'isEmpty' => true,
                    'isError' => true,
                    'isAuthenticated' => true,
                    'message' => 'Arguments required.'
                ]);
            } else {
                $user->name = $name;
                $user->username = $username;
                $user->email = $email;
                if ($user->save()) {
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => false,
                        'isAuthenticated' => true,
                        'isUpdated' => true,
                        'user' => $user,
                        'message' => 'Changes made.'
                    ]);
                } else {
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => true,
                        'isAuthenticated' => true,
                        'isUpdated' => false,
                        'message' => 'Error occurred in making the changes. Try again.'
                    ]);
                }
            }
        }
    }


    public function updateProfileDetailsForReact(Request $req)
    {
        $token = $req->input('token');
        $name = $req->input('name');
        $profile_description = $req->input('description');
        $email = $req->input('email');

        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        if (!$user) {
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        } else {
            if ($token == "" || $name == "" || $profile_description == "" || $email == "") {
                return response()->json([
                    'isEmpty' => true,
                    'isError' => true,
                    'isAuthenticated' => true,
                    'message' => 'Arguments required.'
                ]);
            } else {
                $user->name = $name;
                $user->profile_description = $profile_description;

                if ($email != $user->email) {
                    $check_email = User::where(['email' => $email]);
                    if ($check_email->count() > 0) {
                        return response()->json([
                            'isEmpty' => false,
                            'isError' => true,
                            'isAuthenticated' => true,
                            'message' => 'Email is already taken. Please use another one.'
                        ]);
                    } else {
                        $user->email = $email;
                    }
                }

                if ($user->save()) {
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => false,
                        'isAuthenticated' => true,
                        'isUpdated' => true,
                        'user' => $user,
                        'message' => 'Profile updated'
                    ]);
                } else {
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => true,
                        'isAuthenticated' => true,
                        'isUpdated' => false,
                        'message' => 'Error occurred in Updating the profile. Try again.'
                    ]);
                }
            }
        }
    }

    public function changePassword(Request $req)
    {
        $token = $req->input('token');
        $newpass = $req->input('newpass');
        $confirmpass = $req->input('confirmpass');
        $oldpass = $req->input('oldpass');

        if ($token == "" || $newpass == "" || $confirmpass == "" || $oldpass == "") {
            return response()->json([
                'isEmpty' => true,
                'isError' => true,
                'isNotMatched' => false,
                'isAuthenticated' => true,
                'message' => 'Arguments required.'
            ]);
        } else {
            $verify = new VerifyToken();
            $user = $verify->verifyTokenInDb($token);
            if (!$user) {
                return response()->json([
                    'isAuthenticated' => false,
                    'isError' => true,
                    'message' => 'Not authenticated'
                ]);
            } else {
                if ($confirmpass != $newpass) {
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => true,
                        'isNotMatched' => true,
                        'isOldPasswordInCorrect' => false,
                        'isAuthenticated' => true,
                        'message' => 'New and Confirm Password do not match.'
                    ]);
                } else if (strlen($newpass) < 6) {
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => true,
                        'isNotMatched' => false,
                        'isOldPasswordInCorrect' => false,
                        'isAuthenticated' => true,
                        'isLengthError' => true,
                        'message' => 'New Password Length must be at least 6 characters Long.'
                    ]);
                } else if (Hash::check($oldpass, $user->password)) {
                    $user->password = Hash::make($newpass);
                    if ($user->save()) {
                        return response()->json([
                            'isEmpty' => false,
                            'isError' => false,
                            'isNotMatched' => false,
                            'isOldPasswordInCorrect' => false,
                            'isAuthenticated' => true,
                            'isChanged' => true,
                            'message' => 'Password Changed.'
                        ]);
                    } else {
                        return response()->json([
                            'isEmpty' => false,
                            'isError' => true,
                            'isNotMatched' => false,
                            'isOldPasswordInCorrect' => false,
                            'isAuthenticated' => true,
                            'isChanged' => false,
                            'message' => 'Error Occurred in changing the password. Try again.'
                        ]);
                    }
                } else {
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => true,
                        'isNotMatched' => false,
                        'isOldPasswordInCorrect' => true,
                        'isAuthenticated' => true,
                        'message' => 'Current Password is Incorrect.'
                    ]);
                }
            }
        }
    }


    public function uploadCoverImageReactWeb(Request $req)
    {
        $token = $req->input('token');

        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        if (!$user) {
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        } else {
            if ($token == "" || !$req->hasFile('image')) {
                return response()->json([
                    'isEmpty' => true,
                    'isError' => true,
                    'isNotMatched' => false,
                    'isAuthenticated' => true,
                    'message' => 'Arguments required.'
                ]);
            } else {

                $file = $req->file('image');
                $path = "./profile/";
                $file_name = $file->getClientOriginalName();
                $user_id = $user->user_id;
                if ($file->move($path, $file_name)) {
                    $u = User::find($user_id);
                    $u->cover_image = $file_name;

                    if ($u->save()) {

                        return response()->json([
                            'isEmpty' => false,
                            'isError' => false,
                            'isAuthenticated' => true,
                            'isMoved' => true,
                            'isSaved' => true,
                            'user' => $u,
                            'message' => 'Cover image changed.'
                        ]);
                    } else {

                        return response()->json([
                            'isEmpty' => true,
                            'isError' => false,
                            'isAuthenticated' => true,
                            'isMoved' => true,
                            'isSaved' => false,
                            'message' => 'Error occurred in saving the image. Try again.'
                        ]);
                    }
                } else {

                    return response()->json([
                        'isEmpty' => false,
                        'isError' => true,
                        'isAuthenticated' => true,
                        'isMoved' => false,
                        'isSaved' => false,
                        'message' => 'Error occurred in uploading the image. Try again.'
                    ]);
                }
            }
        }
    }


    public function uploadProfileImageReactWeb(Request $req)
    {
        $token = $req->input('token');

        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        if (!$user) {
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        } else {
            if ($token == "" || !$req->hasFile('image')) {
                return response()->json([
                    'isEmpty' => true,
                    'isError' => true,
                    'isNotMatched' => false,
                    'isAuthenticated' => true,
                    'message' => 'Arguments required.'
                ]);
            } else {

                $file = $req->file('image');
                $path = "./profile/";
                $file_name = $file->getClientOriginalName();
                $user_id = $user->user_id;
                if ($file->move($path, $file_name)) {
                    $u = User::find($user_id);
                    $u->profile_image = $file_name;

                    if ($u->save()) {

                        return response()->json([
                            'isEmpty' => false,
                            'isError' => false,
                            'isAuthenticated' => true,
                            'isMoved' => true,
                            'isSaved' => true,
                            'user' => $u,
                            'message' => 'Profile image changed.'
                        ]);
                    } else {

                        return response()->json([
                            'isEmpty' => true,
                            'isError' => false,
                            'isAuthenticated' => true,
                            'isMoved' => true,
                            'isSaved' => false,
                            'message' => 'Error occurred in saving the image. Try again.'
                        ]);
                    }
                } else {

                    return response()->json([
                        'isEmpty' => false,
                        'isError' => true,
                        'isAuthenticated' => true,
                        'isMoved' => false,
                        'isSaved' => false,
                        'message' => 'Error occurred in uploading the image. Try again.'
                    ]);
                }
            }
        }
    }

    public function updateprofilesocialMediaLinks(Request $req)
    {
        $token = $req->input('token');
        $fb = $req->input('fb');
        $tw = $req->input('tw');
        $insta = $req->input('insta');
        $ln = $req->input('ln');
        if ($token == "" || $fb == "" || $tw == "" || $insta == "" || $ln == "") {
            return response()->json([
                'isEmpty' => true,
                'isError' => true,
                'isAuthenticated' => false,
                'message' => 'Arguments required.'
            ]);
        } else {
            $verify = new VerifyToken();
            $user = $verify->verifyTokenInDb($token);
            if (!$user) {
                return response()->json([
                    'isAuthenticated' => false,
                    'isError' => true,
                    'message' => 'Not authenticated'
                ]);
            } else {
                $user->fb_profile_link = $fb;
                $user->twitter_profile_link = $tw;
                $user->insta_profile_link = $insta;
                $user->linkedin_profile_link = $ln;

                if ($user->save()) {
                    return response()->json([
                        'isAuthenticated' => true,
                        'isUpated' => true,
                        'isError' => false,
                        'message' => 'Social Media Links added'
                    ]);
                } else {
                    return response()->json([
                        'isAuthenticated' => true,
                        'isUpated' => false,
                        'isError' => true,
                        'message' => 'Error occurred in updating the profile. Please try again.'
                    ]);
                }
            }
        }
    }
}
