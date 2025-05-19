<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        // check for the user`s credentials
        if(!Cookie::has('authentication_code')){
            // get to see if its present
            $authentication_code = Cookie::get("authentication_code");
            $check_authentication_code = DB::select("SELECT * FROM `users` WHERE authentication_code = ?", [$authentication_code]);

            if(count($check_authentication_code) == 0){
                return redirect("/");
            }else{
                if(!session()->has("user_data")){
                    session([
                        "user_data" => $check_authentication_code[0]
                    ]);
                }
            }
        }

        // get the school details and store the data in sessions
        $school_details = DB::select("SELECT * FROM school_details;");
        $school_name = count($school_details) > 0 ? $school_details[0]->school_name : null;
        $school_logo = count($school_details) > 0 ? $school_details[0]->school_logo : null;
        $school_facebook = count($school_details) > 0 ? $school_details[0]->school_facebook : null;
        $school_address = count($school_details) > 0 ? $school_details[0]->school_address : null;
        $school_email = count($school_details) > 0 ? $school_details[0]->school_email : null;
        $school_phone = count($school_details) > 0 ? $school_details[0]->school_phone : null;
        $school_whatapp = count($school_details) > 0 ? $school_details[0]->school_whatapp : null;
        $school_instagram = count($school_details) > 0 ? $school_details[0]->school_instagram : null;
        $school_pin_location = count($school_details) > 0 ? $school_details[0]->school_pin_location : null;

        session([
            "school_name" => $school_name,
            "school_logo" => $school_logo,
            "school_email" => $school_email,
            "school_address" => $school_address,
            "school_phone" => $school_phone,
            "school_whatapp" => $school_whatapp,
            "school_facebook" => $school_facebook,
            "school_instagram" => $school_instagram,
            "school_pin_location" => $school_pin_location
        ]);

        // move to the next page
        return $next($request);
    }
}
