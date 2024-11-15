<?php

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
