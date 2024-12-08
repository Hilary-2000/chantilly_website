<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class events extends Controller
{
    //
    public function editEvents(){
        $events = ['live', 'happened', 'upcoming'];
        $event_data = [];
        foreach ($events as $event) {
            $event_type = DB::select("SELECT * FROM events WHERE event_type = ?", [$event]);
            foreach ($event_type as $key => $value) {
                $event_type[$key]->fulldate = date("Y-m-d", strtotime($value->event_start_date));
            }
            $event_data[$event] = $event_type;
        }

        return view("backend.events", ["event_data" => $event_data]);
    }

    public function addEvents(Request $request){
        // validate the data
        $request->validate([
            'event_title' => 'required|string|max:255',
            'event_description' => 'required|string',
            'event_image' => 'required|file|mimes:jpg,jpeg,png,gif|max:10240', // Max file size: 2MB
            // 'event_youtube_link' => 'required|string',
            'start_date' => 'required|string',
            // 'end_date' => 'required|string',
            'event_type' => 'required|string',
        ]);

        // save the image

        try {
            $fileUrl = null;

            // Handle the uploaded image
            if ($request->hasFile('event_image')) {
                $file = $request->file('event_image');

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
            $insert = DB::insert("INSERT INTO events (event_title, event_description, event_image, event_video_link, event_start_date, event_end_date, event_type) VALUES (?,?,?,?,?,?,?)", [
                $request->input("event_title"),
                $request->input("event_description"),
                $fileUrl,
                $request->input("event_youtube_link"),
                date("YmdHis", strtotime($request->input("start_date"))),
                date("YmdHis", strtotime($request->input("start_date"))),
                $request->input("event_type")
            ]);
            
            return redirect("/Events/Edit")->with('success', 'Event added successfully!');
        } catch (\Exception $e) {
            // Handle exceptions
            return back()->with('error', 'Error saving event: ' . $e->getMessage());
        }
    }

    public function updateEvent(Request $request){
        // validate the data
        $request->validate([
            'edit_event_title' => 'required|string|max:255',
            'edit_event_description' => 'required|string',
            'edit_event_image' => 'required|file|mimes:jpg,jpeg,png,gif|max:10240', // Max file size: 2MB
            // 'edit_event_youtube_link' => 'required|string',
            'edit_start_date' => 'required|string',
            'edit_event_id' => 'required|string',
            'edit_event_type' => 'required|string',
        ]);

        // get the event data 
        $event_data = DB::select("SELECT * FROM events WHERE event_id = ?", [$request->input("edit_event_id")]);
        if (count($event_data) > 0) {
            // proceed and save the new file
            try {
                // delete the old file
                $old_file_loc = public_path($event_data[0]->event_image);
                if (File::exists($old_file_loc)) {
                    File::delete($old_file_loc);
                }

                $fileUrl = null;
    
                // Handle the uploaded image
                if ($request->hasFile('edit_event_image')) {
                    $file = $request->file('edit_event_image');
    
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
                $insert = DB::insert("UPDATE events SET event_title = ?, event_description = ?, event_image = ?, event_video_link = ?, event_start_date = ?, event_end_date = ?, event_type = ? WHERE event_id = ?", [
                    $request->input("edit_event_title"),
                    $request->input("edit_event_description"),
                    $fileUrl,
                    $request->input("edit_event_youtube_link"),
                    date("YmdHis", strtotime($request->input("edit_start_date"))),
                    date("YmdHis", strtotime($request->input("edit_start_date"))),
                    $request->input("edit_event_type"),
                    $request->input("edit_event_id")
                ]);
                
                return redirect("/Events/Edit")->with('success', 'Event updated successfully!');
            } catch (\Exception $e) {
                // Handle exceptions
                return back()->with('error', 'Error saving event: ' . $e->getMessage());
            }
        }else {
            return back()->with('error', 'Invalid event');
        }
    }

    public function deleteEvent($event_id){
        $event_data = DB::select("SELECT * FROM events WHERE event_id = ?", [$event_id]);
        if (count($event_data) > 0) {
            $old_file_loc = public_path($event_data[0]->event_image);
            if (File::exists($old_file_loc)) {
                File::delete($old_file_loc);
            }

            // delete the event record
            DB::delete("DELETE FROM events WHERE event_id = ?",[$event_id]);
            return back()->with("success", "Event has been deleted successfully!");
        }else{
            return back()->with("error", "Invalid event!");
        }
    }

    public function changeDisplay($event_id){
        $event_data = DB::select("SELECT * FROM events WHERE event_id = ?", [$event_id]);
        if (count($event_data) > 0) {
            $display = $event_data[0]->display == "1" ? "0" : "1";
            $update = DB::update("UPDATE events SET display = ? WHERE event_id = ?", [$display, $event_id]);
            return back()->with("success", "Event display status has been changed successfully!");
        }else{
            return back()->with("error", "Invalid event!");
        }
    }
}
