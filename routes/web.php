<?php

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