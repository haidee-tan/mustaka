<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function my_requests(){
        return $this->hasMany(FriendRequest::class);
    }
    public function requests_to_me(){
        return $this->hasMany(FriendRequest::class, "requestee_id");
    }
    public function find_request($friend_id) {
        $my_request_filter = $this->my_requests()->get()->where("requestee_id", $friend_id)->pluck("id");
        $requests_to_me_filter =  $this->requests_to_me()->get()->where("user_id", $friend_id)->pluck("id");
        $final_array = [...$my_request_filter, ...$requests_to_me_filter];
        return $final_array[0];
    }
    public function friends() {
        $requestee_array = $this->my_requests()->where("status", "accepted")->get()->pluck("requestee_id");
        $requestor_array = $this->requests_to_me()->where("status", "accepted")->get()->pluck("user_id");
        $final_array = [...$requestee_array, ...$requestor_array];
        return (new static)->whereIn("id", $final_array)->get();
    }
    public function get_posts() {
        $id_array = $this->friends()->pluck("id");
        $id_array = [...$id_array, ...[Auth::id()]];
        return Post::whereIn("user_id", $id_array)->get();
    }
}
