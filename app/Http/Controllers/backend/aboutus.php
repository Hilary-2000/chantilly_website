<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class aboutus extends Controller
{
    // get the about us details
    public function editAboutUs(){
        $history = DB::select("SELECT * FROM `aboutus_history`");
        $final_history = count($history) > 0 ? $history[0]->history_details : "";

        // history image
        $history_image = DB::select("SELECT * FROM `history_image`");
        $history_image = count($history_image) > 0 ? $history_image[0]->image_location : null;

        $awards = DB::select("SELECT * FROM aboutus_awards");
        for ($index=0; $index < count($awards); $index++) {
            $awards[$index]->award_date = date("Y-m-d", strtotime($awards[$index]->award_date));
        }

        // return the data
        return view("backend.aboutus", ["history" => $final_history, "history_image" => $history_image, "awards" => $awards]);
    }

    public function manageAboutsUs(Request $request){
        $content = $request->input("content");
        $insert = DB::insert("INSERT INTO aboutus_history (history_details, history_display) VALUES (?,'1')", [$content]);

        // redirect to the about us
        return redirect("/AboutUs/Edit")->with("success", "The history data has been saved successfully!");
    }

    public function upload_image(Request $request){
        // Validate the incoming request
        $request->validate([
            'historyImageValue' => 'required|file|mimes:jpg,jpeg,png,gif|max:10240', // Max file size: 2MB
        ]);

        try {
            $fileUrl = null;

            // Handle the uploaded image
            if ($request->hasFile('historyImageValue')) {
                $file = $request->file('historyImageValue');

                // Generate a unique filename using the current date and time
                $filename = now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();

                // Define the path for the 'web-data' folder
                $destinationPath = public_path('web-data');

                // Move the file to the 'web-data' folder
                $file->move($destinationPath, $filename);

                // Set the file URL relative to the public folder
                $fileUrl = '/web-data/' . $filename; // Result: /web-data/filename.jpg
            }
            
            // check if the record is present!
            $history_image = DB::select("SELECT * FROM history_image");
            if(count($history_image) > 0){
                // delete the existing image
                $deleteFileUrl = public_path($history_image[0]->image_location);

                // file url
                if (File::exists($deleteFileUrl)) {
                    File::delete($deleteFileUrl);
                }

                // update image
                $update = DB::update("UPDATE history_image SET image_location = ? WHERE image_id = ?", [$fileUrl, $history_image[0]->image_id]);
            }else{
                // insert the data
                $insert = DB::insert("INSERT INTO history_image (image_location) VALUES (?)", [$fileUrl]);
            }
            
            return back()->with('success', 'History image saved successfully!');
        } catch (\Exception $e) {
            // Handle exceptions
            return back()->with('error', 'Error saving carousel: ' . $e->getMessage());
        }
    }

    function add_award(Request $request){
        $request->validate([
            'award_title' => 'required|string|max:255',
            'date_of_award' => 'required|string|max:255',
            'award_image' => 'required|file|mimes:jpg,jpeg,png,gif|max:10240', // Max file size: 2MB
            'award_description' => 'required|string',
        ]);

        try {
            $fileUrl = null;

            // Handle the uploaded image
            if ($request->hasFile('award_image')) {
                $file = $request->file('award_image');

                // Generate a unique filename using the current date and time
                $filename = now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();

                // Define the path for the 'web-data' folder
                $destinationPath = public_path('web-data');

                // Move the file to the 'web-data' folder
                $file->move($destinationPath, $filename);

                // Set the file URL relative to the public folder
                $fileUrl = '/web-data/' . $filename; // Result: /web-data/filename.jpg
            }

            // save the data to the database
            $insert = DB::insert("INSERT INTO aboutus_awards (award_title, award_date, award_image, award_description, award_display) VALUES (?,?,?,?,'1')", [$request->input("award_title"), date("YmdHis", strtotime($request->input("date_of_award"))), $fileUrl, $request->input("award_description")]);
            
            return redirect("/AboutUs/Edit#our_awards")->with('success', 'Awards added successfully!');
        } catch (\Exception $e) {
            // Handle exceptions
            return back()->with('error', 'Error saving carousel: ' . $e->getMessage());
        }
    }

    public function edit_award(Request $request){
        $request->validate([
            'edit_award_id' => 'required|string|max:255',
            'edit_award_title' => 'required|string|max:255',
            'edit_date_of_award' => 'required|string|max:255',
            // 'edit_award_image' => 'required|file|mimes:jpg,jpeg,png,gif|max:10240', // Max file size: 2MB
            'edit_award_description' => 'required|string',
        ]);

        // check if the id is valid
        $award = DB::select("SELECT * FROM aboutus_awards WHERE award_id = ?", [$request->input("edit_award_id")]);
        if (count($award)) {
            if ($request->hasFile("edit_award_image")) {
                $request->validate([
                    'edit_award_image' => 'required|file|mimes:jpg,jpeg,png,gif|max:10240'
                ]);

                try {
                    // delete the old file
                    $fileLoc = public_path($award[0]->award_image);
                    if(File::exists($fileLoc)){
                        File::delete($fileLoc);
                    }
    
                    // file url
                    $fileUrl = null;
        
                    // Handle the uploaded image
                    if ($request->hasFile('edit_award_image')) {
                        $file = $request->file('edit_award_image');
        
                        // Generate a unique filename using the current date and time
                        $filename = now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
        
                        // Define the path for the 'web-data' folder
                        $destinationPath = public_path('web-data');
        
                        // Move the file to the 'web-data' folder
                        $file->move($destinationPath, $filename);
        
                        // Set the file URL relative to the public folder
                        $fileUrl = '/web-data/' . $filename; // Result: /web-data/filename.jpg
                    }
                    
                    // check if the record is present!
                    $update = DB::update("UPDATE aboutus_awards SET award_title = ?, award_date = ?, award_image = ?, award_description = ? WHERE award_id = ?",[
                        $request->input("edit_award_title"),
                        date("YmdHis", strtotime($request->input("edit_date_of_award"))),
                        $fileUrl,
                        $request->input("edit_award_description"),
                        $request->input("edit_award_id")
                    ]);
                    
                    // award image
                    return redirect("/AboutUs/Edit#our_awards")->with('success', 'Award data has been updated successfully!');
                } catch (\Exception $e) {
                    // Handle exceptions
                    return back()->with('error', 'Error saving carousel: ' . $e->getMessage());
                }
            }else{
                    
                // check if the record is present!
                $update = DB::update("UPDATE aboutus_awards SET award_title = ?, award_date = ?, award_description = ? WHERE award_id = ?",[
                    $request->input("edit_award_title"),
                    date("YmdHis", strtotime($request->input("edit_date_of_award"))),
                    $request->input("edit_award_description"),
                    $request->input("edit_award_id")
                ]);
                return redirect("/AboutUs/Edit#our_awards")->with('success', 'Award data has been updated successfully!');
            }
        }else{
            return back()->with("error", "Invalid award!");
        }
    }

    public function delete_award($award_id){
        $award = DB::select("SELECT * FROM aboutus_awards WHERE award_id = ?", [$award_id]);
        if (count($award)) {
            try {
                // delete the old file
                $fileLoc = public_path($award[0]->award_image);
                if(File::exists($fileLoc)){
                    File::delete($fileLoc);
                }

                // delete the awards
                $delete = DB::delete("DELETE FROM aboutus_awards WHERE award_id = ?", [$award_id]);

                return redirect("/AboutUs/Edit#our_awards")->with("success", "Award has been deleted successfully!");
            }catch (\Exception $e){
                // Handle exceptions
                return back()->with('error', 'Error saving carousel: ' . $e->getMessage());
            }
        }else{
            return back()->with("error", "Can`t find the award record!");
        }
    }

    public function change_display($award_id){
        $select = DB::select("SELECT * FROM `aboutus_awards` WHERE award_id = ?", [$award_id]);
        if (count($select)) {
            $display = $select[0]->award_display == "1" ? "0" : "1";
            $update_display = DB::update("UPDATE aboutus_awards SET award_display = ? WHERE award_id = ?", [$display, $award_id]);
            if ($update_display) {
                return redirect("/AboutUs/Edit#our_awards")->with("success", "Display status has been updated successfully!");
            }else{
                return back()->with("error", "An error has occured, try again later!");
            }
        }else{
            return back()->with("error", "An error has occured, try again later!");
        }
    }
}
