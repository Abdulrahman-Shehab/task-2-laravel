<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Route::get("/" , function(){return view('welcome');});
// Route::resource('posts', PostController::class);
Route::get("/", [PostController::class,"index"])->name("posts.index");

Route::get("/add", [PostController::class,"create"])->name("posts.create");

Route::post("/" , [PostController::class , "store"])->name("posts.store");

Route::get("/{post}" , [PostController::class , "show"])->name("posts.show");

Route::get("/edit/{post}" , [PostController::class , "edit"])->name("posts.edit") ;

Route::put("/edit/{post}" , [PostController::class , "update"])->name("posts.update") ;

Route::delete("/{post}" , [PostController::class , "destroy"])->name("posts.destroy");
