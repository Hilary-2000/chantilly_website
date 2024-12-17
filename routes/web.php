<?php

use App\Http\Controllers\backend\aboutus;
use App\Http\Controllers\backend\download;
use App\Http\Controllers\backend\events;
use App\Http\Controllers\backend\gallery;
use App\Http\Controllers\backend\homepage;
use App\Http\Controllers\backend\login;
use App\Http\Controllers\backend\Vacancies;
use App\Http\Controllers\frontend\vacancy;
use App\Http\Controllers\frontend\website;
use App\Http\Controllers\frontend\website_homepage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [website::class, "getHomepage"])->name("getHomepage")->middleware("authUser");
Route::get("/AboutUs", [website::class, "getAboutsUs"])->name("getAboutsUs")->middleware("authUser");
Route::get("/Events", [website::class, "getEvents"])->name("getEvents")->middleware("authUser");
Route::get("/Gallery", [website::class, "get_gallery"])->name("get_gallery")->middleware("authUser");
Route::get("/Vacancies", [vacancy::class, "get_vacancies"])->name("Vacancies")->middleware("authUser");
Route::get("/Vacancies/Apply/{vacancy_id}", [vacancy::class, "apply_vacancies"])->middleware("authUser");
Route::post("/Vacancies/apply", [vacancy::class, "apply"])->name("apply")->middleware("authUser");
Route::get("/Downloads", [website::class, "get_downloads"])->name("get_downloads")->middleware("authUser");
Route::get("/ContactUs", function () {return view('website.contactus');})->middleware("authUser");

Route::post("/Login", [login::class, "login"])->name("login");
Route::get("/Logout", [login::class, "logout"])->name("logout");
Route::get("/Homepage/Edit", [homepage::class, "Homepage"])->name("EditHomepage")->middleware("authenticate");
Route::post("/Homepage/saveCarousel", [homepage::class, "saveCaroussel"])->name("saveCaroussel")->middleware("authenticate");
Route::get("/Homepage/deleteCarousel/{carrousel_id}", [homepage::class, "deleteCarrousel"])->name("deleteCarrousel")->middleware("authenticate");
Route::post("/Homepage/updateCarousel", [homepage::class, "updateCarrousel"])->name("updateCarrousel")->middleware("authenticate");
Route::get("/Homepage/displayCarousel/{carrousel_id}", [homepage::class, "displayCarrousel"])->name("displayCarrousel")->middleware("authenticate");
Route::post("/Homepage/saveCurricullum", [homepage::class, "saveCurricullum"])->name("saveCurricullum")->middleware("authenticate");
Route::post("/Homepage/updateCurricullum", [homepage::class, "updateCurricullum"])->name("updateCurricullum")->middleware("authenticate");
Route::get("/Homepage/deleteCurricullum/{curriculum_id}", [homepage::class, "deleteCurricullum"])->name("deleteCurricullum")->middleware("authenticate");
Route::get("/Homepage/displayCurricullum/{curriculum_id}", [homepage::class, "displayCurricullum"])->name("displayCurricullum")->middleware("authenticate");
Route::post("/Homepage/updateStats/", [homepage::class, "updateStats"])->name("updateStats")->middleware("authenticate");

Route::get("/AboutUs/Edit", [aboutus::class, "editAboutUs"])->name("editAboutUs")->middleware("authenticate");
Route::post("/AboutUs/Edit/manage", [aboutus::class, "manageAboutsUs"])->name("manageAboutsUs")->middleware("authenticate");
Route::post("/AboutUs/Edit/uploadImage", [aboutus::class, "upload_image"])->name("upload_image")->middleware("authenticate");
Route::post("/AboutUs/Edit/addAward", [aboutus::class, "add_award"])->name("add_award")->middleware("authenticate");
Route::post("/AboutUs/Edit/editAward", [aboutus::class, "edit_award"])->name("edit_award")->middleware("authenticate");
Route::get("/AboutUs/Edit/deleteAward/{award_id}", [aboutus::class, "delete_award"])->name("delete_award")->middleware("authenticate");
Route::get("/AboutUs/Edit/changeDisplay/{award_id}", [aboutus::class, "change_display"])->name("change_display")->middleware("authenticate");

// events
Route::get("/Events/Edit", [events::class, "editEvents"])->name("editEvents")->middleware("authenticate");
Route::post("/Events/Edit/add", [events::class, "addEvents"])->name("addEvents")->middleware("authenticate");
Route::post("/Events/Edit/update", [events::class, "updateEvent"])->name("updateEvent")->middleware("authenticate");
Route::get("/Events/Edit/Delete/{event_id}", [events::class, "deleteEvent"])->name("deleteEvent")->middleware("authenticate");
Route::get("/Events/Edit/Display/{event_id}", [events::class, "changeDisplay"])->name("changeDisplay")->middleware("authenticate");

// gallery
Route::get("/Gallery/Edit", [gallery::class, "editGallery"])->name("editGallery")->middleware("authenticate");
Route::post("/Gallery/Edit/addGroupName", [gallery::class, "addGroupName"])->name("addGroupName")->middleware("authenticate");
Route::post("/Gallery/Edit/updateGroupName", [gallery::class, "updateGroupName"])->name("updateGroupName")->middleware("authenticate");
Route::get("/Gallery/Edit/deleteGroupName/{group_id}", [gallery::class, "deleteGroupName"])->name("deleteGroupName")->middleware("authenticate");
Route::post("/Gallery/Edit/addPhoto", [gallery::class, "savePhoto"])->name("savePhoto")->middleware("authenticate");
Route::post("/Gallery/Edit/updatePhoto", [gallery::class, "updatePhoto"])->name("updatePhoto")->middleware("authenticate");
Route::get("/Gallery/Edit/deletePhoto/{gallery_photo}", [gallery::class, "deletePhoto"])->name("deletePhoto")->middleware("authenticate");
Route::get("/Gallery/Edit/changeDisplay/{gallery_photo}", [gallery::class, "changeDisplay"])->name("changeDisplay")->middleware("authenticate");

Route::get("/Vacancies/Edit/", [Vacancies::class, "editVacancies"])->name("editVacancies")->middleware("authenticate");
Route::post("/Vacancies/Edit/addVacancy", [Vacancies::class, "addVacancy"])->name("addVacancy")->middleware("authenticate");
Route::post("/Vacancies/Edit/updateVacancy", [Vacancies::class, "updateVacancy"])->name("updateVacancy")->middleware("authenticate");
Route::post("/Vacancies/Edit/deleteVacancy/{vacancy_id}", [Vacancies::class, "deleteVacancy"])->name("deleteVacancy")->middleware("authenticate");
Route::get("/Vacancies/Edit/changeStatus/{vacancy_id}", [Vacancies::class, "changeStatus"])->name("changeStatus")->middleware("authenticate");
Route::get("/Vacancies/View/{vacancy_id}/Applications", [Vacancies::class, "view_applications"])->name("view_applications")->middleware("authenticate");
Route::get("/Vacancies/View/{vacancy_id}/Applications/{application_id}", [Vacancies::class, "view_application"])->name("view_application")->middleware("authenticate");
Route::get("/Vacancies/Delete/Applicant/{application_id}", [Vacancies::class, "delete_application"])->name("delete_application")->middleware("authenticate");

// downloads
Route::get("/Downloads/Edit", [download::class, "get_downloads"])->name("get_downloads")->middleware("authenticate");
Route::post("/Download/Edit/add", [download::class, "addDownloads"])->name("addDownloads")->middleware("authenticate");
Route::post("/Download/Edit/edit", [download::class, "editDownloads"])->name("editDownloads")->middleware("authenticate");
Route::get("/Download/Edit/delete/{download_id}", [download::class, "deleteDownloads"])->name("deleteDownloads")->middleware("authenticate");
Route::get("/Download/Edit/status/{download_id}", [download::class, "changeStatus"])->name("changeStatus")->middleware("authenticate");


Route::post("/Homepage/saveServices", [homepage::class, "saveServices"])->name("saveServices")->middleware("authenticate");
Route::post("/Homepage/updateService", [homepage::class, "updateService"])->name("updateService")->middleware("authenticate");
Route::get("/Homepage/Services/delete/{service_id}", [homepage::class, "deleteService"])->name("deleteService")->middleware("authenticate");
Route::get("/Homepage/Services/changeStatus/{service_id}", [homepage::class, "changeStatus"])->name("changeStatus")->middleware("authenticate");