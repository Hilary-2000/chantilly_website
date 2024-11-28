<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class login extends Controller
{
    // login
    function login(Request $request){
        $username = $request->input("user-name");
        $password = $request->input("user-password");
        $user_data = DB::select("SELECT * FROM users WHERE username = ? AND password = ?", [$username, $password]);

        // valid_user
        $valid_user = false;
        if(count($user_data) > 0){
            // check the username and password cases
            if($user_data[0]->username == $username && $user_data[0]->password == $password){
                $valid_user = true;
        
                // create a cookie to store user data store it for 7 days
                $authentication_code = $this->generateRandomCode(16);
                Cookie::queue(Cookie::make("logged_in","true",7200));
                Cookie::queue(Cookie::make("authentication_code","$authentication_code",7200));
                
                // update the users authentication code
                DB::update("UPDATE users SET authentication_code = ? WHERE user_id = ?", [$authentication_code, $user_data[0]->user_id]);


                // user_data
                session([
                    'user_data' => $user_data[0]
                ]);
            }
        }

        // store a flag to show they are logged in
        if ($valid_user) {
            return redirect("/Homepage/Edit");
        }else{
            return back()->with("error", "Invalid username and password!");
        }
    }

    function logout(){
        $authentication_code = Cookie::get("authentication_code");
        DB::update("UPDATE users SET authentication_code = NULL WHERE authentication_code = ?", [$authentication_code]);
        // destroy all cookies stored
        Cookie::queue(Cookie::forget("logged_in"));
        Cookie::queue(Cookie::forget("authentication_code"));
        session()->forget("user_data");

        // redirect to the homepage
        return redirect("/");
    }
}
