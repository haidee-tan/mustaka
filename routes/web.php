<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\FriendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get("/", [PostController::class, "index"]);
// Route::get("/", function() {
//     return view("layouts.my_layout");
// });

Route::post("/posts", [PostController::class, "create_post"]);
Route::delete("/posts/{id}", [PostController::class, "destroy_post"]);
// Route::delete("/posts/{id}", [PostController::class, "destroy_post"])->middleware(["is_admin"]);
Route::put("/posts/{post}", [PostController::class, "update_post"]);

Route::post("/posts/{post_id}/comments", [CommentController::class, "create_comment"]);
Route::put("/comments/{comment}", [CommentController::class, "update_comment"]);
Route::delete("/comments/{comment}", [CommentController::class, "destroy_comment"]);

Route::put("/posts/{post}/like", [LikeController::class, "store_like_post"]);
Route::put("/comments/{comment}/like", [LikeController::class, "store_like_comment"]);
Route::delete("/like/{like}", [LikeController::class, "destroy_like"]);

Route::get("/search", [FriendRequestController::class, "search"]);
Route::get("/friendrequests", [FriendRequestController::class, "get_friendrequests"]);
Route::post("/friendrequests/{requestee_id}", [FriendRequestController::class, "add_friend"]);
Route::put("/friendrequests/{friend_request}/accept", [FriendRequestController::class, "accept_request"]);
Route::delete("/friendrequests/{friend_request}/decline", [FriendRequestController::class, "decline_request"]);

Route::get("/friends", [FriendRequestController::class, "display_friends"]);
Route::delete("/friends/{friend}/unfriend", [FriendRequestController::class, "unfriend"]);