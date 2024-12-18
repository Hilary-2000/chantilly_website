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

    public function updateAdminProfile(Request $request){
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
                
                return redirect("/SchoolAccount/Admin/View/".$request->input("user_id"))->with('success', 'Admin profile has been updated - successfully!');
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
                
            return redirect("/SchoolAccount/Admin/View/".$request->input("user_id"))->with('success', 'Admin profile has been updated successfully!');
        }
    }

    public function UpdateCredentials(Request $request){
        // get the user data
        $user_data = DB::select("SELECT * FROM users WHERE user_id = ?",[$request->input("user_id")]);
        if (count($user_data) > 0) {
            // check old username to see if matches
            if ($request->input("current_username") !== $user_data[0]->username && 
            $request->input("old_password") !== $user_data[0]->password) {
                return back()->with("error", "Invalid credentials, Try again!");
            }

            // check to see if its updating username or password
            $changed = false;
            $username = $request->input("current_username");
            if ($request->has("new_username") && $request->input("new_username") != null) {
                // validate the data
                $request->validate([
                    'new_username' => 'required|string|min:8',
                ]);
                $username = $request->input("new_username");
                $changed = true;
            }

            // check to see if its updating username or password
            $password = $request->input("old_password");
            if ($request->has("new_password") && $request->input("new_password") != null) {
                // validate the data
                $request->validate([
                    'new_password' => 'required|string|min:8',
                ]);
                $password = $request->input("new_password");
                $changed = true;
            }

            // update the username
            DB::update("UPDATE users SET username = ?, password = ? WHERE user_id = ?", [$username, $password, $request->input("user_id")]);

            if ($changed) {
                return back()->with("success", "Credentials updated successfully!");
            }else{
                return back()->with("success", "No changes made!");
            }
        }else{
            return back()->with("error", "Invalid user!");
        }
    }

    public function manage_admin(){
        $admins = DB::select("SELECT * FROM users");
        return view("backend.manage_admin", ["admins" => $admins]);
    }

    public function view_admin($admin_id){
        $admin_data = DB::select("SELECT * FROM users WHERE user_id = ?", [$admin_id]);
        if (count($admin_data) > 0) {
            return view("backend.edit_admin", ["user_data" => $admin_data[0]]);
        }else{
            return back()->with("error", "Invalid administrator!");
        }
    }

    public function updateAdminCredentials(Request $request){
        // get the user data
        $user_data = DB::select("SELECT * FROM users WHERE user_id = ?",[$request->input("user_id")]);
        if (count($user_data) > 0) {
            // check to see if its updating username or password
            $changed = false;
            $username = $user_data[0]->username;
            if ($request->has("new_username") && $request->input("new_username") != null) {
                // validate the data
                $request->validate([
                    'new_username' => 'required|string|min:8',
                ]);
                $username = $request->input("new_username");
                $changed = true;
            }

            // check to see if its updating username or password
            $password = $user_data[0]->password;
            if ($request->has("new_password") && $request->input("new_password") != null) {
                // validate the data
                $request->validate([
                    'new_password' => 'required|string|min:4',
                ]);
                $password = $request->input("new_password");
                $changed = true;
            }

            // update the username
            DB::update("UPDATE users SET username = ?, password = ? WHERE user_id = ?", [$username, $password, $request->input("user_id")]);

            if ($changed) {
                return back()->with("success", "Credentials updated successfully!");
            }else{
                return back()->with("success", "No changes made!");
            }
        }else{
            return back()->with("error", "Invalid user!");
        }
    }

    public function delete_admin($admin_id){
        // check to see if its own admin
        $admin_data = session()->get("user_data");
        if ($admin_data->user_id == $admin_id) {
            return back()->with("error", "You cannot delete your own account!");
        }
        // get the user data
        $user_data = DB::select("SELECT * FROM users WHERE user_id = ?",[$admin_id]);
        if (count($user_data) > 0) {
            // update the data
            $display_picture = $user_data[0]->display_picture;
            if (File::exists(public_path($display_picture))) {
                File::delete(public_path($display_picture));
            }

            // delete the user data
            $delete = DB::delete("DELETE FROM users WHERE user_id = ?",[$admin_id]);
            return redirect("/SchoolAccount/Admin")->with("success", "Administrator deleted successfully!");
        }else{
            return back()->with("error", "Invalid administrator!");
        }
    }

    public function addAdmin(Request $request){
        // validate the data
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phonenumber' => 'required|string',
            'email_address' => 'required|string',
            'physical_address' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string'
        ]);
        
        // get the username
        $select = DB::select("SELECT * FROM users WHERE username = ?", [$request->input("username")]);
        if (count($select) > 0) {
            return back()->with("error", "Credentials are used by another administrator, Try again!");
        }

        // insert admin
        $staff_role = "Admin";
        $insert = DB::insert("INSERT INTO users (fullname, username, password, staff_role, email, phone, physical_address, date_registered) VALUES (?,?,?,?,?,?,?,?)", [
            $request->input("fullname"),
            $request->input("username"),
            $request->input("password"),
            $staff_role,
            $request->input("email_address"),
            $request->input("phonenumber"),
            $request->input("physical_address"),
            date("YmdHis")
        ]);
        
        return back()->with("success", "Administrator added successfully!");
    }

    public function edit_school_account(){
        $school_data = DB::select("SELECT * FROM school_details;");
        if (count($school_data) > 0) {
            return view("", ["school_data" => $school_data]);
        }else {
            
        }
    }
}
