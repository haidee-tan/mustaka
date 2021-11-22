<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FriendRequest;
use App\Models\Friend;
use App\Models\User;
use Auth;

class FriendRequestController extends Controller
{
    public function search() {
        $friend_list = FriendRequest::where("user_id", Auth::id())
            ->orWhere("requestee_id", Auth::id())->get();
        $requestor_array = $friend_list->pluck("user_id");
        $requestee_array = $friend_list->pluck("requestee_id");
        // $final_array = $requestor_array->concat($requestee_array)->concat([Auth::id()]);
        $final_array = [...$requestor_array, ...$requestee_array, ...[Auth::id()]];
        $accounts = User::whereNotIn("id", $final_array)
            ->get();
        return view("search", compact("accounts"));
    }
    public function add_friend($requestee) {
        $friend_request = new FriendRequest();
        $friend_request->user_id = Auth::id();
        $friend_request->requestee_id = $requestee;
        $friend_request->save();
        return redirect()->back();
    }
    public function get_friendrequests() {
        $friend_requests = FriendRequest::where("status", "pending")
            ->where("requestee_id", Auth::id())
            ->get();
        return view("friendrequests", compact("friend_requests"));
    }
    public function accept_request(FriendRequest $friend_request) {
        $friend_request->status = "accepted";
        $friend_request->save();
        return redirect()->back();
    }
    public function decline_request(FriendRequest $friend_request) {
        $friend_request->delete();
        return redirect()->back();
    }
    public function display_friends() {
        $friends = Auth::user()->friends();
        return view("friendlist", compact("friends"));
    }
    public function unfriend($friend) {
        $request_id = Auth::user()->find_request($friend);
        $friend_request = FriendRequest::where("id", $request_id)->first();
        $friend_request->delete();
        return redirect()->back();
    }
}
