<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MustaKa</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div id="main">
        <header>
            <div class="banner">
                <div class="logo-div">
                    <img src="imgs/wave.png" alt="logo" />
                </div>
                <div>
                    <h1>MustaKa, <span class="username">{{ Auth::user()->name }}</span>?</h1>
                    <form action="/" method="get">
                        <button>Kubo</button>
                    </form>
                    <form action="/friends" method="get">
                        <button>Friend List</button>
                    </form>
                    <form action="/friendrequests" method="get">
                        <button>Friend Requests</button>
                    </form>
                    <form action="/search" method="get">
                        <button>Search</button>
                    </form>
                    <form action="/logout" method="post">
                        @csrf
                        <button>Logout</button>
                    </form>
                </div>
            </div>
            <div id="post-section">
                <form action="/posts" method="post" class="create-post">
                    @csrf
                    <textarea name="text"></textarea>
                    <button>Post</button>
                </form>
            </div>
        </header>

        <div id="posts-list">

            @foreach ($posts as $post)
                <div class="post-box">

                    <div class="post-header">
                        <div>
                            <img src="imgs/users-pic/{{ $post->user->name }}.png" alt="profile" />
                        </div>
                        <div>
                            <p>{{ $post->user->name }}</p>
                            <p class="timestamp">{{ $post->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    {{-- Post --}}
                    <form action="/posts/{{ $post->id }}" method="post" class="post-mainbox">
                        @csrf
                        @method("PUT")
                        <textarea name="text" disabled="true">{{ $post->text }}</textarea>
                        <button class="updateBtn">Update post</button>
                    </form>
                    <div class="post-footer">
                        @if ($post->likes->count() > 1)
                            <div>{{ $post->likes->count() }} likes</div>
                        @elseif ($post->likes->count() === 1)
                            <div>{{ $post->likes->first()->user->name }} liked this.</div>
                        @else
                            <div></div>
                        @endif
                        <div class="post-btns-div">
                            @if ($post->user->id === Auth::id())
                                <button class="editBtn">Edit</button>
                                <form action="/posts/{{ $post->id }}" method="post" class="delete-form">
                                    @csrf
                                    @method("DELETE")
                                    <button class="deleteBtn">Delete</button>
                                </form>
                            @endif
                            {{-- Like --}}
                            @if (!$post->likes()->where('user_id', Auth::id())->first())
                                <form action="/posts/{{ $post->id }}/like" method="post" class="like-post-form">
                                    @csrf
                                    @method("PUT")
                                    <button>Like</button>
                                </form>
                            @else
                                <form action="like/{{ $post->hasLiked()->id }}" method="post" class="like-post-form">
                                    @csrf
                                    @method("DELETE")
                                    <button>Dislike</button>
                                </form>
                            @endif
                        </div>
                    </div>

                    {{-- Comments --}}
                    <div class="comment-list">
                        @foreach ($post->comments as $comment)
                            <div class="comment-box">
                                <div class="comment-header">
                                    <div>
                                        <img src="imgs/users-pic/{{ $comment->user->name }}.png" alt="profile" />
                                    </div>
                                    <div>
                                        <p>{{ $comment->user->name }}</p>
                                        <p class="timestamp">{{ $comment->updated_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <form action="/comments/{{ $comment->id }}" method="post" class="comment">
                                    @csrf
                                    @method("PUT")
                                    <textarea name="text" disabled="true">{{ $comment->text }}</textarea>
                                    <button class="updCommentBtn">Resubmit comment</button>
                                </form>
                                <div class="comment-footer">
                                    @if ($comment->likes->count() > 1)
                                        <div>{{ $comment->likes->count() }} likes</div>
                                    @elseif ($comment->likes->count() === 1)
                                        <div>{{ $comment->likes->first()->user->name }} liked this.</div>
                                    @else
                                        <div></div>
                                    @endif
                                    <div class="comment-btns-div">
                                        @if ($comment->user->id === Auth::user()->id)
                                            <button class="editCommentBtn">Edit</button>
                                            <form action="/comments/{{ $comment->id }}" method="post"
                                                class="del-comment-form">
                                                @csrf
                                                @method("DELETE")
                                                <button class="delCommentBtn">Delete</button>
                                            </form>
                                        @endif
                                        {{-- Like --}}
                                        @if (!$comment->likes()->where('user_id', Auth::id())->first())
                                            <form action="/comments/{{ $comment->id }}/like" method="post"
                                                class="like-comment-form">
                                                @csrf
                                                @method("PUT")
                                                <button>Like</button>
                                            </form>
                                        @else
                                            <form action="like/{{ $comment->hasLiked()->id }}" method="post"
                                                class="like-post-form">
                                                @csrf
                                                @method("DELETE")
                                                <button>Dislike</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Create comment --}}
                    <form action="/posts/{{ $post->id }}/comments/" method="post" class="comment-textbox">
                        @csrf
                        <textarea name="text"></textarea>
                        <button>Post comment</button>
                    </form>
                </div>
            @endforeach

        </div>

    </div>

    <script src="js/script.js"></script>

</body>

</html>
