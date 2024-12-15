<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class vacancy extends Controller
{
    // vacancies
    public function get_vacancies(){
        $vacancies = DB::select("SELECT * FROM vacancies WHERE display = '1'");
        return view("website.vacancies", ["vacancies" => $vacancies]);
    }

    // get vacancies
    public function apply_vacancies($vacancy_id){
        $vacancy_data = DB::select("SELECT * FROM vacancies WHERE vacancy_id = ?", [$vacancy_id]);
        if (count($vacancy_data) > 0) {
            return view("website.apply_vacancy", ["vacancy_data" => $vacancy_data]);
        }else{
            return back()->with("error", "In-valid vacancy post!");
        }
    }
    // do apply
    public function apply(Request $request){
        // validate the data
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string',
            'your_cv' => 'required|file|mimes:pdf,docx,doc|max:5120', // Max file size: 4MB
            'phonenumber' => 'required|string',
            'marital_status' => 'required|string',
            'date_of_birth' => 'required|string',
            'vacancy_id' => 'required|string',
            'about_yourself' => 'required|string',
        ]);

        // insert data
        try {
            $fileUrl = null;

            // Handle the uploaded file
            if ($request->hasFile('your_cv')) {
                $file = $request->file('your_cv');

                // Generate a unique filename using the current date and time
                $filename = now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();

                // Define the path for the 'web-data' folder
                $destinationPath = public_path('web-data/application_docs');

                // Move the file to the 'web-data' folder
                $file->move($destinationPath, $filename);

                // Set the file URL relative to the public folder
                $fileUrl = '/web-data/application_docs/' . $filename;
            }else{
                session()->flash("error", "no file uploaded!");
            }
            
            // insert the data
            $insert_data = DB::insert("INSERT INTO vacancy_applications (vacancy_id, fullname, email, phone, marital_status, DOB, DOA, summary_about_you, cv_location) VALUES (?,?,?,?,?,?,?,?,?)", [
                $request->input("vacancy_id"),
                $request->input("fullname"),
                $request->input("email"),
                $request->input("phonenumber"),
                $request->input("marital_status"),
                $request->input("date_of_birth"),
                date("Y-m-d"),
                $request->input("about_yourself"),
                $fileUrl
            ]);
            return back()->with('success', 'Application done successfully! Do not apply twice!');
        } catch (\Exception $e) {
            // Handle exceptions
            return back()->with('error', 'Error saving application: ' . $e->getMessage());
        }
    }
}
