<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class extracurricular extends Controller
{
    // get the extracurrilum
    public function editExtraCurricular(){
        $curricullum = DB::select("SELECT * FROM extra_curriculum");
        return view("backend.extracurricular", ["curricullum" => $curricullum]);
    }

    public function updateExtraCurricular(Request $request){
        // validate the data
        $request->validate([
            'edit_extra_curricullum_id' => 'required|string|max:255',
            'edit_extra_curricullum_title' => 'required|string',
            'edit_extra_curriculum_description' => 'required|string',
            // 'edit_extra_curriculum_image' => 'required|file|mimes:jpg,jpeg,png,gif|max:10240', // Max file size: 2MB
        ]);

        // extracurriculum data
        $extracurriculum_data = DB::select("SELECT * FROM `extra_curriculum` WHERE `extra_curriculum_id` = ?", [$request->input("edit_extra_curricullum_id")]);
        
        if (count($extracurriculum_data) > 0) {
            if ($request->hasFile("edit_extra_curriculum_image")) {
                // public_file
                $public_file = public_path($extracurriculum_data[0]->extra_curriculum_image);
                
                // insert the image
                try {
                    // delete the old file
                    if (File::exists($public_file)) {
                        File::delete($public_file);
                    }

                    $fileUrl = null;
                    // Handle the uploaded image
                    if ($request->hasFile('edit_extra_curriculum_image')) {
                        $file = $request->file('edit_extra_curriculum_image');
        
                        // Generate a unique filename using the current date and time
                        $filename = now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
        
                        // Define the path for the 'web-data' folder
                        $destinationPath = public_path('web-data');
        
                        // Move the file to the 'web-data' folder
                        $file->move($destinationPath, $filename);
        
                        // Set the file URL relative to the public folder
                        $fileUrl = '/web-data/' . $filename; // Result: /web-data/filename.jpg
                    }
        
                    // update
                    $update = DB::update("UPDATE extra_curriculum SET extra_curriculum_image = ?, extra_curriculum_title = ?, extra_curriculum_description = ? WHERE extra_curriculum_id = ?",[
                        $fileUrl,
                        $request->input("edit_extra_curricullum_title"),
                        $request->input("edit_extra_curriculum_description"),
                        $request->input("edit_extra_curricullum_id")
                    ]);
                    
                    return redirect("/ExtraCurriculum/Edit")->with('success', 'Extra-curricular updated successfully!');
                } catch (\Exception $e) {
                    // Handle exceptions
                    return back()->with('error', 'Error saving event: ' . $e->getMessage());
                }
            }else {
                // update
                $update = DB::update("UPDATE extra_curriculum SET extra_curriculum_title = ?, extra_curriculum_description = ? WHERE extra_curriculum_id = ?",[
                    $request->input("edit_extra_curricullum_title"),
                    $request->input("edit_extra_curriculum_description"),
                    $request->input("edit_extra_curricullum_id")
                ]);
                
                return redirect("/ExtraCurriculum/Edit")->with('success', 'Extra-curricular updated successfully!');
            }
        }else{
            return redirect("/ExtraCurriculum/Edit")->with('error', 'Invalid Extra-Curricular!!');
        }
    }

    public function addExtraCurricular(Request $request){
        // validate the data
        $request->validate([
            'extra_curricullum_title' => 'required|string|max:255',
            'extra_curriculum_description' => 'required|string',
            'extra_curriculum_image' => 'required|file|mimes:jpg,jpeg,png,gif|max:10240', // Max file size: 2MB
        ]);
        
        // insert the image
        try {
            $fileUrl = null;

            // Handle the uploaded image
            if ($request->hasFile('extra_curriculum_image')) {
                $file = $request->file('extra_curriculum_image');

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
            $insert = DB::insert("INSERT INTO extra_curriculum (extra_curriculum_title, extra_curriculum_description, extra_curriculum_image, display) VALUES (?,?,?,?)",[
                $request->input("extra_curricullum_title"),
                $request->input("extra_curriculum_description"),
                $fileUrl,
                $display
            ]);
            
            return redirect("/ExtraCurriculum/Edit")->with('success', 'Extra-curricular added successfully!');
        } catch (\Exception $e) {
            // Handle exceptions
            return back()->with('error', 'Error saving event: ' . $e->getMessage());
        }
    }

    public function changeStatus($extracurriculum_id){
        $extracurriculum_data = DB::select("SELECT * FROM extra_curriculum WHERE extra_curriculum_id = ?",[$extracurriculum_id]);
        if (count($extracurriculum_data) > 0) {
            $display = $extracurriculum_data[0]->display == "1" ? "0" : "1";
            $update = DB::update("UPDATE extra_curriculum SET display = ? WHERE extra_curriculum_id = ?", [$display, $extracurriculum_id]);
            return back()->with("success", "Update done successfully!");
        }else {
            // Handle exceptions
            return back()->with('error', 'Invalid extra-curricullum data!');
        }
    }

    public function deleteExtraCurricular($extracurriculum_id){
        $extracurriculum_data = DB::select("SELECT * FROM extra_curriculum WHERE extra_curriculum_id = ?",[$extracurriculum_id]);
        if (count($extracurriculum_data) > 0) {
            $filepath = public_path($extracurriculum_data[0]->extra_curriculum_image);
            if (File::exists($filepath)) {
                File::delete($filepath);
            }

            // delete the file
            DB::delete("DELETE FROM extra_curriculum WHERE extra_curriculum_id = ?", [$extracurriculum_id]);
            return back()->with("success", "Extra-curricular deleted successfully!");
        }else{
            return back()->with("error", "Invalid Extra-curricular!");
        }
    }
}
