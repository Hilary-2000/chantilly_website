<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class GetUserData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check for the user`s credentials
        if(Cookie::has('authentication_code')){
            // get to see if its present
            $authentication_code = Cookie::get("authentication_code");
            $check_authentication_code = DB::select("SELECT * FROM `users` WHERE authentication_code = ?", [$authentication_code]);

            if(count($check_authentication_code) == 0){
                Cookie::queue(Cookie::forget("logged_in"));
                Cookie::queue(Cookie::forget("authentication_code"));
                session()->forget("user_data");
            }else{
                if(!session()->has("user_data")){
                    session([
                        "user_data" => $check_authentication_code[0]
                    ]);
                }
            }
        }
        
        return $next($request);
    }
}
