<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GradingController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PoductController;
use App\Http\Controllers\SocialsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WhyChooseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post("login", [UserController::class, "login"]);
Route::post("register", [UserController::class, "store"]);

Route::group(['middleware' => ["auth:sanctum"]], function () {
    Route::resource("user", UserController::class);
    Route::resource("whychoose", WhyChooseController::class);
    Route::resource("social", SocialsController::class);
    Route::resource("product", PoductController::class);
    Route::resource("menu", MenuController::class);
    Route::resource("grading", GradingController::class);
    Route::resource("comment", CommentController::class);
    Route::resource("booking", BookingController::class);
    Route::resource("about", AboutController::class);
});

Route::get("public-user", [UserController::class, "index"]);
Route::get("public-whychoose", [WhyChooseController::class, "index"]);
Route::get("public-social", [SocialsController::class, "index"]);
Route::get("public-product", [PoductController::class, "index"]);
Route::get("public-menu", [MenuController::class, "index"]);
Route::get("public-grading", [GradingController::class, "index"]);
Route::get("public-comment", [CommentController::class, "index"]);
Route::get("public-about", [AboutController::class, "getData"]);
Route::post("public-booking", [BookingController::class, "store"]);