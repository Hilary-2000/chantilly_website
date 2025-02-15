<?php

use App\Http\Controllers\backend\aboutus;
use App\Http\Controllers\backend\download;
use App\Http\Controllers\backend\events;
use App\Http\Controllers\backend\extracurricular;
use App\Http\Controllers\backend\gallery;
use App\Http\Controllers\backend\homepage;
use App\Http\Controllers\backend\login;
use App\Http\Controllers\backend\school_account;
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
Route::get("/ExtraCurriculum", [website::class, "get_extra_curricular"])->name("get_extra_curricular")->middleware("authUser");

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
Route::post("/Homepage/saveFAQS", [homepage::class, "saveFAQS"])->name("saveFAQS")->middleware("authenticate");
Route::post("/Homepage/updateFAQS", [homepage::class, "updateFAQS"])->name("updateFAQS")->middleware("authenticate");
Route::get("/Homepage/deleteFAQS/{faq_id}", [homepage::class, "deleteFAQS"])->name("deleteFAQS")->middleware("authenticate");
Route::get("/Homepage/statusFAQS/{faq_id}", [homepage::class, "statusFAQS"])->name("statusFAQS")->middleware("authenticate");

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

Route::get("/ExtraCurriculum/Edit", [extracurricular::class,"editExtraCurricular"])->name("editExtraCurricular")->middleware("authenticate");
Route::post("/ExtraCurriculum/Edit/add", [extracurricular::class, "addExtraCurricular"])->name("addExtraCurricular")->middleware("authenticate");
Route::post("/ExtraCurriculum/Edit/update", [extracurricular::class, "updateExtraCurricular"])->name("updateExtraCurricular")->middleware("authenticate");
Route::get("/ExtraCurriculum/Edit/change_status/{extracurriculum_id}", [extracurricular::class, "changeStatus"])->name("changeStatus")->middleware("authenticate");
Route::get("/ExtraCurriculum/Edit/delete/{extracurriculum_id}", [extracurricular::class, "deleteExtraCurricular"])->name("deleteExtraCurricular")->middleware("authenticate");

Route::get("/SchoolAccount/MyProfile", [school_account::class, "myProfile"])->name("myProfile")->middleware("authenticate");
Route::post("/SchoolAccount/MyProfile/Update", [school_account::class, "updateProfile"])->name("updateProfile")->middleware("authenticate");
Route::post("/SchoolAccount/MyProfile/UpdateCredentials", [school_account::class, "UpdateCredentials"])->name("UpdateCredentials")->middleware("authenticate");
Route::get("/SchoolAccount/Admin/", [school_account::class, "manage_admin"])->name("manage_admin")->middleware("authenticate");
Route::get("/SchoolAccount/Admin/View/{admin_id}", [school_account::class, "view_admin"])->name("view_admin")->middleware("authenticate");
Route::post("/SchoolAccount/AdminProfile/Update", [school_account::class, "updateAdminProfile"])->name("updateAdminProfile")->middleware("authenticate");
Route::post("/SchoolAccount/AdminProfile/UpdateCredentials", [school_account::class, "updateAdminCredentials"])->name("updateAdminCredentials")->middleware("authenticate");
Route::get("/SchoolAccount/AdminProfile/delete/{admin_id}", [school_account::class, "delete_admin"])->name("delete_admin")->middleware("authenticate");
Route::get("/SchoolAccount/Edit/", [school_account::class, "edit_school_account"])->name("edit_school_account")->middleware("authenticate");
Route::post("/SchoolAccount/AdminProfile/Add", [school_account::class, "addAdmin"])->name("addAdmin")->middleware("authenticate");
Route::post("/SchoolAccount/SchoolProfile/Update", [school_account::class, "update_school_profile"])->name("update_school_profile")->middleware("authenticate");
Route::post("/SchoolAccount/SchoolProfile/SetupEmail", [school_account::class, "setup_email"])->name("setup_email")->middleware("authenticate");
Route::get("/SchoolAccount/SchoolProfile/resetEmail", [school_account::class, "reset_email"])->name("reset_email")->middleware("authenticate");


// send email
Route::post("/Client/send_inquiry", [school_account::class, "send_inquiry"])->name("send_inquiry")->middleware("authUser");
Route::get("/Chantilly/Terms-and-conditions", function (){
    return view("backend.tnc");
});