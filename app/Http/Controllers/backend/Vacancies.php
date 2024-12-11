<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Vacancies extends Controller
{
    // process vacancies
    function editVacancies(){
        $vacancies = DB::select("SELECT * FROM `vacancies`");
        return view("backend.vacancies", ["vacancies" => $vacancies]);
    }

    public function addVacancy(Request $request){
        // check errors
        $request->validate([
            'vacancy_title' => 'required|string|max:255',
            'vacancy_deadline' => 'required|string|max:255',
            'nature_n_scope' => 'required|string',
            'qualifications' => 'required|string',
            'vacancy_status' => 'required|string'
        ]);

        // insert data
        $insert = DB::insert("INSERT INTO vacancies (vacancy_title, vacancy_qualifications, deadline, nature_scope, display) VALUES (?,?,?,?,?)", [
            $request->input("vacancy_title"),
            $request->input("qualifications"),
            $request->input("vacancy_deadline"),
            $request->input("nature_n_scope"),
            $request->input("vacancy_status"),
        ]);

        return back()->with("success", "Vacancy created successfully!");
    }

    public function updateVacancy(Request $request){
        // check errors
        $request->validate([
            'edit_vacancy_title' => 'required|string|max:255',
            'edit_vacancy_deadline' => 'required|string|max:255',
            'edit_nature_n_scope' => 'required|string',
            'edit_qualifications' => 'required|string',
            'edit_vacancy_status' => 'required|string',
            'edit_vacancy_id' => 'required|string'
        ]);

        $update = DB::update("UPDATE vacancies SET vacancy_title = ?, vacancy_qualifications = ?, deadline = ?, nature_scope = ?, display = ? WHERE `vacancy_id` = ?", [
            $request->input("edit_vacancy_title"),
            $request->input("edit_qualifications"),
            $request->input("edit_vacancy_deadline"),
            $request->input("edit_nature_n_scope"),
            $request->input("edit_vacancy_status"),
            $request->input("edit_vacancy_id"),
        ]);

        return back()->with("success", "Update has been done successfully!");
    }

    public function deleteVacancy($vacancy_id){
        // delete_vacancy
        $delete_vacancy = DB::delete("DELETE FROM vacancies WHERE vacancy_id = ?", [$vacancy_id]);

        // add also the vacancy applications later with their files
        return back()->with("success", "Vacancy deleted successfully!");
    }

    public function changeStatus($vacancy_id){
        $select = DB::select("SELECT * FROM vacancies WHERE vacancy_id = ?", [$vacancy_id]);
        if (count($select) > 0) {
            $display = $select[0]->display == "1" ? "0" : "1";
            $update = DB::update("UPDATE vacancies SET display = ? WHERE vacancy_id = ?", [$display, $vacancy_id]);
            
            return back()->with("success", "Vacancy status updated successfully!");
        }else{
            return back()->with("success", "Invalid vacancy!");
        }
    }

    public function view_applications($vacancy_id){
        // vacancy application
        $vacancy_application = DB::select("SELECT * FROM `vacancy_applications` WHERE vacancy_id = ?", [$vacancy_id]);
        return view("backend.vacancy_application", ["vacancy_application" => $vacancy_application]);
    }
}
