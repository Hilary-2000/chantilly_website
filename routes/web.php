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

Route::get('/', function () {
    return view('website.homepage');
});
Route::get("/AboutUs", function () {
    return view('website.aboutus');
});
Route::get("/Events", function () {
    return view('website.events');
});
Route::get("/Gallery", function () {
    return view('website.gallery');
});
Route::get("/Vacancies", function () {
    return view('website.vacancies');
});
Route::get("/Vacancies/Apply", function () {
    return view('website.apply_vacancy');
});
Route::get("/Downloads", function () {
    return view('website.downloads');
});
Route::get("/ContactUs", function () {
    return view('website.contactus');
});

Route::post("/Login", [login::class, "login"])->name("login");
Route::get("/Logout", [login::class, "logout"])->name("logout");
Route::get("/Homepage/Edit", [homepage::class, "Homepage"])->name("EditHomepage")->middleware("authenticate");
Route::post("/Homepage/saveCarousel", [homepage::class, "saveCaroussel"])->name("saveCaroussel")->middleware("authenticate");
Route::get("/Homepage/deleteCarousel/{carrousel_id}", [homepage::class, "deleteCarrousel"])->name("deleteCarrousel")->middleware("authenticate");
Route::post("/Homepage/updateCarousel", [homepage::class, "updateCarrousel"])->name("updateCarrousel")->middleware("authenticate");
Route::get("/Homepage/displayCarousel/{carrousel_id}", [homepage::class, "displayCarrousel"])->name("displayCarrousel")->middleware("authenticate");