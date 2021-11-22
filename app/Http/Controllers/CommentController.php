<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{
    public function create_comment(Request $request, $post_id) {
        $comment = new Comment();
        $comment->text = $request->text;
        $comment->post_id = $post_id;
        $comment->user_id = Auth::id();
        $comment->save();
        return redirect()->back();
    }
    public function update_comment(Comment $comment, Request $request) {
        $comment->text = $request->text;
        $comment->save();
        return redirect()->back();
    }
    public function destroy_comment(Comment $comment) {
        $comment->delete();
        return redirect()->back();
    }
}
