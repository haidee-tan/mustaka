<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Friend;
use Auth;

class PostController extends Controller
{
    public function index() {
        // $posts = Post::all()->sortByDesc("created_at");

        // $friend_list = FriendRequest::where("user_id", Auth::id())
        //     ->where("status", "accepted")
        //     ->orWhere("requestee_id", Auth::id())
        //     ->get();
        // $requestor_array = $friend_list->pluck("user_id");
        // $requestee_array = $friend_list->pluck("requestee_id");
        // $final_array = [...$requestor_array, ...$requestee_array, ...[Auth::id()]];
        // $posts = Post::whereIn("user_id", $final_array)
        //     ->get()
        //     ->sortByDesc("created_at");
        // return view("homepage", compact("posts"));

        // dd(Auth::user()->friends());

        if (!Auth::user()) {
            return view("/welcome");
        }
        else {
            $posts = Auth::user()->get_posts()->sortByDesc("updated_at");
            return view("homepage", compact("posts"));
        }
    }
    public function create_post(Request $request) {
        $post = new Post();
        $post->text = $request->text;
        $post->user_id = Auth::id();
        $post->save();
        return redirect("/");
    }
    public function destroy_post($id) {
        $post = Post::find($id);
        $post->delete();
        return redirect()->back();
    }
    public function update_post(Post $post, Request $request) {
        $post->text = $request->text;
        $post->save();
        return redirect()->back();
    }
}
