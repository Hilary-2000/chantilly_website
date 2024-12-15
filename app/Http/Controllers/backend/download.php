<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class download extends Controller
{
    // downloads
    public function get_downloads(){
        $downloads = DB::select("SELECT * FROM downloads");
        return view("backend.download", ["downloads" => $downloads]);
    }

    public function addDownloads(Request $request){
        // validate the data
        $request->validate([
            'document_title' => 'required|string|max:255',
            'document_status' => 'required|string',
            'document_file' => 'required|file|mimes:pdf,docx,doc|max:10240' // Max file size: 4MB
        ]);

        // insert the file
        try {
            $fileUrl = null;

            // Handle the uploaded file
            if ($request->hasFile('document_file')) {
                $file = $request->file('document_file');

                // Generate a unique filename using the current date and time
                $filename = now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();

                // Define the path for the 'web-data' folder
                $destinationPath = public_path('web-data/downloads');

                // Move the file to the 'web-data' folder
                $file->move($destinationPath, $filename);

                // Set the file URL relative to the public folder
                $fileUrl = '/web-data/downloads/' . $filename;
            }else{
                session()->flash("error", "no file uploaded!");
            }
            
            // insert the data
            $insert = DB::insert("INSERT INTO downloads (download_title, download_file, display) VALUES (?,?,?)", [
                $request->input("document_title"),
                $fileUrl,
                $request->input("document_status")
            ]);

            // returned successfully
            return back()->with('success', 'Document saved successfully!');
        } catch (\Exception $e) {
            // Handle exceptions
            return back()->with('error', 'Error saving document: ' . $e->getMessage());
        }
    }

    function editDownloads(Request $request){
        // validate the data
        $request->validate([
            'edit_document_title' => 'required|string|max:255',
            'edit_document_status' => 'required|string',
            'edit_document_id' => 'required|string',
            'edit_document_file' => 'required|file|mimes:pdf,docx,doc|max:10240' // Max file size: 4MB
        ]);

        // get the document
        $select = DB::select("SELECT * FROM downloads WHERE download_id = ?", [$request->input("edit_document_id")]);
        
        if (count($select) > 0) {
            try {
                // delete the old file
                $old_file = public_path($select[0]->download_file);
                if (File::exists($old_file)) {
                    File::delete($old_file);
                }

                // insert the new file
                $fileUrl = null;
    
                // Handle the uploaded file
                if ($request->hasFile('edit_document_file')) {
                    $file = $request->file('edit_document_file');
    
                    // Generate a unique filename using the current date and time
                    $filename = now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
    
                    // Define the path for the 'web-data' folder
                    $destinationPath = public_path('web-data/downloads');
    
                    // Move the file to the 'web-data' folder
                    $file->move($destinationPath, $filename);
    
                    // Set the file URL relative to the public folder
                    $fileUrl = '/web-data/downloads/' . $filename;
                }else{
                    session()->flash("error", "no file uploaded!");
                }
                
                // insert the data
                $update = DB::update("UPDATE downloads SET download_title = ?, download_file = ?, display = ? WHERE download_id = ?", [
                    $request->input("edit_document_title"),
                    $fileUrl,
                    $request->input("edit_document_status"),
                    $request->input("edit_document_id")
                ]);
    
                // returned successfully
                return back()->with('success', 'Document updated successfully!');
            } catch (\Exception $e) {
                // Handle exceptions
                return back()->with('error', 'Error saving document: ' . $e->getMessage());
            }
        }else{
            return back()->with('error', 'Invalid document!');
        }
    }

    function deleteDownloads($download_id){
        $download = DB::select("SELECT * FROM downloads WHERE download_id = ?", [$download_id]);
        if (count($download)) {
            $file_loc = public_path($download[0]->download_file);
            try{
                if (File::exists($file_loc)) {
                    File::delete($file_loc);
                }

                // delete document data
                DB::delete("DELETE FROM downloads WHERE download_id = ?",[$download_id]);
                
                return back()->with("success", "Document deleted successfully!");
            }catch(\Exception $e){
                return back()->with('error', 'Error deleting document: ' . $e->getMessage());
            }
        }else{

        }
    }

    function changeStatus($download_id){
        $download = DB::select("SELECT * FROM downloads WHERE download_id = ?", [$download_id]);
        if (count($download) > 0) {
            $display = $download[0]->display == "1" ? "0" : "1";
            $update = DB::update("UPDATE downloads SET display = ? WHERE download_id = ?", [$display, $download_id]);
            return back()->with("success", "Download status changed successfully!");
        }else {
            return back()->with("error", "Invalid download document!");
        }
    }
}
