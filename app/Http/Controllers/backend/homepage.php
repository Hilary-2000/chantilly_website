<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class homepage extends Controller
{
    //
    function Homepage(){
        // get the homepage data
        $homepage_carrousels = DB::select("SELECT * FROM `homepage_carrousel`;");
        $homepage_curriculum = DB::select("SELECT * FROM `homepage_curriculum`;");
        $homepage_stats = DB::select("SELECT * FROM `homepage_stats`;");

        // set the return statement
        return view("backend/homepage", ["homepage_carrousels" => $homepage_carrousels, "homepage_curriculum" => $homepage_curriculum, "homepage_stats" => $homepage_stats]);
    }
    
    public function saveCaroussel(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'caroussel_title' => 'required|string|max:255',
            'caroussel_img' => 'required|file|mimes:jpg,jpeg,png,gif|max:10240', // Max file size: 2MB
            'caroussel_description' => 'required|string',
        ]);

        try {
            $fileUrl = null;

            // Handle the uploaded image
            if ($request->hasFile('caroussel_img')) {
                $file = $request->file('caroussel_img');

                // Generate a unique filename using the current date and time
                $filename = now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();

                // Define the path for the 'web-data' folder
                $destinationPath = public_path('web-data');

                // Move the file to the 'web-data' folder
                $file->move($destinationPath, $filename);

                // Set the file URL relative to the public folder
                $fileUrl = '/web-data/' . $filename; // Result: /web-data/filename.jpg
            }

            // Insert the data into the database
            DB::table('homepage_carrousel')->insert([
                'carrousel_title' => $request->input('caroussel_title'),
                'carousel_image' => $fileUrl, // Save the file location starting with /web-data
                'carrousel_description' => $request->input('caroussel_description'),
                'display' => "1"
            ]);

            return back()->with('success', 'Carousel saved successfully!');
        } catch (\Exception $e) {
            // Handle exceptions
            return back()->with('error', 'Error saving carousel: ' . $e->getMessage());
        }
    }

    public function deleteCarrousel($carrousel_id){
        $select = DB::select("SELECT * FROM `homepage_carrousel` WHERE `carrousel_id` = ?", [$carrousel_id]);
        if(count($select) > 0){
            $carrousel_data = $select[0];
            $fileUrl = public_path($carrousel_data->carousel_image);

            if (File::exists($fileUrl)) {
                File::delete($fileUrl);

                // Optionally delete the record from the database
                DB::delete("DELETE FROM homepage_carrousel WHERE carrousel_id = ?", [$carrousel_id]);
        
                return redirect()->back()->with('success', 'Caroussel deleted successfully!');
            } else {
                // Optionally delete the record from the database
                DB::delete("DELETE FROM homepage_carrousel WHERE carrousel_id = ?", [$carrousel_id]);
                return redirect()->back()->with('error', 'File not found! But carrousel deleted successfully!');
            }
        }else{
            return back()->with("error", "Invalid carrousel record!");
        }
    }

    public function updateCarrousel(Request $request){
        // Validate the incoming request
        $request->validate([
            'carrousel_title' => 'required|string|max:255',
            'carrousel_image' => 'required|file|mimes:jpg,jpeg,png,gif|max:10240', // Max file size: 2MB
            'carrousel_description' => 'required|string',
            'carrousel_id' => 'required',
        ]);
        
        $carrousel_id = $request->input("carrousel_id");
        $carrousel_title = $request->input("carrousel_title");
        $carrousel_description = $request->input("carrousel_description");

        // first get the old record and delete the old image
        $select = DB::select("SELECT * FROM `homepage_carrousel` WHERE `carrousel_id` = ?", [$carrousel_id]);
        if(count($select) > 0){
            $carrousel_data = $select[0];
            $fileUrl = public_path($carrousel_data->carousel_image);

            if (File::exists($fileUrl)) {
                File::delete($fileUrl);
                $fileUrl = null;
    
                // Handle the uploaded image
                if ($request->hasFile('carrousel_image')) {
                    $file = $request->file('carrousel_image');
    
                    // Generate a unique filename using the current date and time
                    $filename = now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
    
                    // Define the path for the 'web-data' folder
                    $destinationPath = public_path('web-data');
    
                    // Move the file to the 'web-data' folder
                    $file->move($destinationPath, $filename);
    
                    // Set the file URL relative to the public folder
                    $fileUrl = '/web-data/' . $filename; // Result: /web-data/filename.jpg
                }


                // update the carrousel
                $update = DB::update("UPDATE homepage_carrousel SET carrousel_title = ?, carrousel_description = ?, carousel_image = ? WHERE carrousel_id = ?", [$carrousel_title, $carrousel_description, $fileUrl, $carrousel_id]);
        
                // update done successfully!
                return redirect()->back()->with('success', 'Update done successfully!');
            } else {
                // Optionally delete the record from the database
                DB::delete("DELETE FROM homepage_carrousel WHERE carrousel_id = ?", [$carrousel_id]);
                return redirect()->back()->with('error', 'File not found! But carrousel deleted successfully!');
            }
        }else{
            return redirect()->back()->with('error', 'No record found!');
        }
    }

    public function displayCarrousel($carrousel_id){
        $carrousel_data = DB::select("SELECT * FROM `homepage_carrousel` WHERE `carrousel_id` = ?", [$carrousel_id]);
        if(count($carrousel_data) > 0){
            $display = $carrousel_data[0]->display == "0" ? "1" : "0";
            $update = DB::update("UPDATE homepage_carrousel SET display = ? WHERE carrousel_id = ?", [$display, $carrousel_id]);
            return redirect()->back()->with("success", "Display status has been successfully updated!");
        }else {
            return redirect()->back()->with("error", "Can`t find record!");
        }
    }
}
