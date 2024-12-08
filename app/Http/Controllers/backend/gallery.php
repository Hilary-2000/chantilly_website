<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class gallery extends Controller
{
    //
    public function editGallery(){
        $gallery = DB::select("SELECT * FROM gallery LEFT JOIN gallery_groups ON gallery_groups.group_id = gallery.gallery_group_id");
        $gallery_group = DB::select("SELECT * FROM `gallery_groups`");
        return view("backend.gallery", ["gallery_group" => $gallery_group, "gallery" => $gallery]);
    }

    public function addGroupName(Request $request){
        // validate the data
        $request->validate([
            'gallery_group_name' => 'required|string|max:255'
        ]);

        $group_name = $request->input("gallery_group_name");
        DB::insert("INSERT INTO gallery_groups (group_name) VALUES (?)", [$group_name]);
        return back()->with("success", "Group name added successfully!");
    }

    public function updateGroupName(Request $request){
        // validate the data
        $request->validate([
            'edit_gallery_group_name' => 'required|string',
            'edit_group_id' => 'required|string'
        ]);

        // update the groupname
        $update = DB::update("UPDATE gallery_groups SET group_name = ? WHERE group_id = ?", [$request->input("edit_gallery_group_name"), $request->input("edit_group_id")]);

        return back()->with("success", "Group data successfully updated");
    }

    public function deleteGroupName($group_id){
        $select = DB::select("SELECT * FROM gallery_groups WHERE group_id = ?", [$group_id]);
        if (count($select) > 0) {
            DB::delete("DELETE FROM gallery_groups WHERE group_id = ?", [$group_id]);
            return back()->with("success", "Gallery group deleted successfully!");
        }else{
            return back()->with("error", "Gallery group is invalid!");
        }
    }

    function savePhoto(Request $request){
        // validate the data
        $request->validate([
            'photo_gallery_group' => 'required|string|max:255',
            'photo_name' => 'required|file|mimes:jpg,jpeg,png,gif|max:10240'
        ]);


        // save the file and get the location
        try {
            $fileUrl = null;

            // Handle the uploaded image
            if ($request->hasFile('photo_name')) {
                $file = $request->file('photo_name');

                // Generate a unique filename using the current date and time
                $filename = now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();

                // Define the path for the 'web-data' folder
                $destinationPath = public_path('web-data');

                // Move the file to the 'web-data' folder
                $file->move($destinationPath, $filename);

                // Set the file URL relative to the public folder
                $fileUrl = '/web-data/' . $filename; // Result: /web-data/filename.jpg
            }

            $insert = DB::insert("INSERT INTO gallery (gallery_group_id, image_path, image_status) VALUES (?,?,?)", [$request->input("photo_gallery_group"), $fileUrl, "1"]);
            
            return redirect("/Gallery/Edit")->with('success', 'Photo added successfully!');
        } catch (\Exception $e) {
            // Handle exceptions
            return back()->with('error', 'Error saving photo: ' . $e->getMessage());
        }
    }

    public function updatePhoto(Request $request){
        // validate the data
        $request->validate([
            'edit_photo_gallery_group' => 'required|string|max:255',
            'edit_photo_name' => 'required|file|mimes:jpg,jpeg,png,gif|max:10240',
            'gallery_photo_id' => 'required',
        ]);

        $select = DB::select("SELECT * FROM gallery WHERE img_id = ?", [$request->input("gallery_photo_id")]);
        if (count($select) > 0) {
            // save the file and get the location
            try {
                // delete old file
                $old_file = public_path($select[0]->image_path);
                if (File::exists($old_file)) {
                    File::delete($old_file);
                }

                // new file
                $fileUrl = null;
    
                // Handle the uploaded image
                if ($request->hasFile('edit_photo_name')) {
                    $file = $request->file('edit_photo_name');
    
                    // Generate a unique filename using the current date and time
                    $filename = now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
    
                    // Define the path for the 'web-data' folder
                    $destinationPath = public_path('web-data');
    
                    // Move the file to the 'web-data' folder
                    $file->move($destinationPath, $filename);
    
                    // Set the file URL relative to the public folder
                    $fileUrl = '/web-data/' . $filename; // Result: /web-data/filename.jpg
                }
                
                $update = DB::update("UPDATE gallery SET gallery_group_id = ?, image_path = ? WHERE img_id = ?", [
                    $request->input("edit_photo_gallery_group"),
                    $fileUrl,
                    $request->input("gallery_photo_id"),
                ]);
                
                return redirect("/Gallery/Edit")->with('success', 'Photo updated successfully!');
            } catch (\Exception $e) {
                // Handle exceptions
                return back()->with('error', 'Error saving photo: ' . $e->getMessage());
            }
        }else{
            // Handle exceptions
            return back()->with('error', 'Invalid photo');
        }
    }

    public function deletePhoto($photo_id){
        $select = DB::select("SELECT * FROM gallery WHERE img_id = ?", [$photo_id]);
        if (count($select) > 0) {
            $old_file = public_path($select[0]->image_path);
            if (File::exists($old_file)) {
                File::delete($old_file);
            }

            // delete the record
            DB::delete("DELETE FROM gallery WHERE img_id = ?",[$photo_id]);
            return back()->with("success", "Photo in gallery deleted successfully!");
        }else{
            return back()->with("error", "Invalid photo in gallery!");
        }
    }

    public function changeDisplay($photo_id){
        $select = DB::select("SELECT * FROM `gallery` WHERE img_id = ?", [$photo_id]);
        if (count($select) > 0) {
            $image_status = $select[0]->image_status == "1" ? "0" : "1";
            $update = DB::update("UPDATE gallery SET image_status = ? WHERE img_id = ?", [$image_status, $photo_id]);

            return back()->with("success", "Image status changed successfully!");
        }else{
            return back()->with("error", "Invalid image in gallery!");
        }
    }
}
