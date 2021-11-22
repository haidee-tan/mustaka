<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use Auth;

class LikeController extends Controller
{
    public function store_like_post(Post $post) {
        $like = new Like();
        $like->user_id = Auth::id();
        $post->likes()->save($like);
        return redirect()->back();
    }
    public function store_like_comment(Comment $comment) {
        $like = new Like();
        $like->user_id = Auth::id();
        $comment->likes()->save($like);
        return redirect()->back();
    }
    public function destroy_like(Like $like) {
        $like->delete();
        return redirect()->back();
    }
}
