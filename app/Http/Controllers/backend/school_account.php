<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class school_account extends Controller
{
    // get the user profile
    public function myProfile(){
        // user data
        $user_data = null;
        if (session()->has("user_data")) {
            $user_data = session()->get("user_data");
            $check_authentication_code = DB::select("SELECT * FROM `users` WHERE user_id = ?", [$user_data->user_id]);
            if (count($check_authentication_code) > 0) {
                // reset the user data
                $user_data = $check_authentication_code[0];
                session([
                    'user_data' => $check_authentication_code[0]
                ]);
            }
            return view("backend.profile", ["user_data" => $user_data]);
        }else{
            // get to see if its present
            $authentication_code = Cookie::get("authentication_code");
            $check_authentication_code = DB::select("SELECT * FROM `users` WHERE authentication_code = ?", [$authentication_code]);

            // if invalid return to homepage
            if (count($check_authentication_code) > 0) {
                $user_data = $check_authentication_code[0];
                return view("backend.profile", ["user_data" => $user_data]);
            }else {
                return redirect("/");
            }
        }
    }

    public function updateProfile(Request $request){
        // validate the data
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phonenumber' => 'required|string',
            'email_address' => 'required|string',
            'physical_address' => 'required|string',
            'user_id' => 'required|string',
            // 'profile_picture' => 'required|file|mimes:jpg,jpeg,png,gif|max:10240', // Max file size: 2MB
        ]);

        $user_data = DB::select("SELECT * FROM `users` WHERE user_id = ?", [$request->input("user_id")]);
        if (count($user_data) == 0) {
            return back()->with("error", "Invalid user!");
        }

        if ($request->hasFile("profile_picture")) {
            // validate profile picture
            $request->validate([
                'profile_picture' => 'required|file|mimes:jpg,jpeg,png,gif|max:10240', // Max file size: 2MB
            ]);

            // insert the image
            try {
                // delete the old file
                if (File::exists(public_path($user_data[0]->display_picture ?? ""))) {
                    File::delete(public_path($user_data[0]->display_picture));
                }

                // file url
                $fileUrl = null;

                // Handle the uploaded image
                if ($request->hasFile('profile_picture')) {
                    $file = $request->file('profile_picture');

                    // Generate a unique filename using the current date and time
                    $filename = now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();

                    // Define the path for the 'web-data' folder
                    $destinationPath = public_path('web-data');

                    // Move the file to the 'web-data' folder
                    $file->move($destinationPath, $filename);

                    // Set the file URL relative to the public folder
                    $fileUrl = '/web-data/' . $filename; // Result: /web-data/filename.jpg
                }

                // insert
                $display = "1";
                $update = DB::update("UPDATE users SET fullname = ?, email = ?, phone = ?, physical_address = ?, display_picture = ? WHERE user_id = ?", [
                    $request->input("fullname"),
                    $request->input("email_address"),
                    $request->input("phonenumber"),
                    $request->input("physical_address"),
                    $fileUrl,
                    $request->input("user_id")
                ]);
                
                return redirect("/SchoolAccount/MyProfile")->with('success', 'Your profile has been updated - successfully!');
            } catch (\Exception $e) {
                // Handle exceptions
                return back()->with('error', 'Error saving event: ' . $e->getMessage());
            }
        }else{
            $update = DB::update("UPDATE users SET fullname = ?, email = ?, phone = ?, physical_address = ? WHERE user_id = ?", [
                $request->input("fullname"),
                $request->input("email_address"),
                $request->input("phonenumber"),
                $request->input("physical_address"),
                $request->input("user_id")
            ]);
                
            return redirect("/SchoolAccount/MyProfile")->with('success', 'Your profile has been updated successfully!');
        }
    }
}
