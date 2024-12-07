<?php

use App\Http\Controllers\backend\aboutus;
use App\Http\Controllers\backend\events;
use App\Http\Controllers\backend\gallery;
use App\Http\Controllers\backend\homepage;
use App\Http\Controllers\backend\login;
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

Route::get('/', function () {return view('website.homepage');})->middleware("authUser");
Route::get("/AboutUs", function () {return view('website.aboutus');})->middleware("authUser");
Route::get("/Events", function () {return view('website.events');})->middleware("authUser");
Route::get("/Gallery", function () {return view('website.gallery');})->middleware("authUser");
Route::get("/Vacancies", function () {return view('website.vacancies');})->middleware("authUser");
Route::get("/Vacancies/Apply", function () {return view('website.apply_vacancy');})->middleware("authUser");
Route::get("/Downloads", function () {return view('website.downloads');})->middleware("authUser");
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