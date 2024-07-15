<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-app-layout>
    <x-slot name="header">

        <head>
            <meta charset="utf-8">

            <title>〇〇せかい</title>

            <!-- Fonts -->
            <link rel="preconnect" href="https://fonts.bunny.net">
            <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
            <link rel="stylesheet"
                href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script src="{{ asset('/js/like.js') }}"></script>
            <script src="{{ asset('/js/category.js') }}"></script>
            <script src="{{ asset('/js/index.js') }}"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
                crossorigin="anonymous">
            <link rel="stylesheet" href="{{ asset('/css/index.css') }}">

        </head>

    </x-slot>

    <body class="font-sans antialiased">

        <div class="stars">

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
            </script>

            <div class="contents">
                <div class="parent">カテゴリを選択</div>

                <!-- ここのcategoryは１個の値だがindexで定義している？-->

                <div class="child">
                    <ul>
                        @foreach ($categories as $category)
                            <a href='/categories/{{ $category->id }}'>{{ $category->name }}せかい</a>
                        @endforeach
                    </ul>
                </div>

                <!-- Button trigger modal -->
                <p class="manner">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        投稿のしかた
                    </button>
                </p>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">投稿のしかた</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ol>
                                    <li>1,新規投稿を作成ボタンをクリック</li>
                                    <li>2,投稿するカテゴリを選択</li>
                                    <li>3,投稿内容を入力</li>
                                    <li>4,投稿ボタンをクリック</li>
                                    <li>5,投稿完了！</li>
                                </ol>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>



                <!-- <button type="button" class="btn btn-primary newpost"><a href='/posts/create'>新規投稿を作成</a></button> -->
                <button type=“button” class="btn btn-primary" onclick="location.href='/posts/create'">新規投稿を作成</button>

                <div class='posts'>
                    @foreach ($posts as $post)
                        <div class='post'>
                            <h2 class='body'>
                                <img id="preview"
                                    src="{{ isset($post->user->profile_photo_path) ? asset($post->user->profile_photo_path) : asset('images/user_icon.png') }}"
                                    alt="" class="w-16 h-16 rounded-full object-cover border-none bg-gray-200">
                                {{ $post->body }}

                                <!-- 参考：$postにはpostControllerから渡した投稿のレコード$postsをforeachで展開してます -->
                                @auth
                                    <!-- ログインの判別 -->
                                    <!-- post.phpに作ったisLikedByメソッドをここで使用 -->
                                    @if (!$post->isLikedBy(Auth::user()))
                                        <span class="likes">
                                            <span class="material-symbols-outlined like-toggle"
                                                data-post-id="{{ $post->id }}">favorite</span>
                                            <span class="like-counter">{{ $post->likes_count }}</span>
                                        </span><!-- /.likes -->
                                    @else
                                        <span class="likes">
                                            <span class="material-symbols-outlined like-toggle liked"
                                                data-post-id="{{ $post->id }}">favorite</span>
                                            <span class="like-counter">{{ $post->likes_count }}</span>
                                        </span><!-- /.likes -->
                                    @endif
                                @endauth
                                @guest
                                    <span class="likes">
                                        <span class="material-symbols-outlined">favorite</span>
                                        <span class="like-counter">{{ $post->likes_count }}</span>
                                    </span><!-- /.likes -->
                                @endguest

                                @auth
                                    @if (Auth::user()->id == $post->user_id)
                                        <a class="link-underline link-underline-opacity-0"
                                            href="/posts/{{ $post->id }}/edit">
                                            <span
                                                class="material-symbols-outlined link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                                edit
                                            </span>
                                        </a>

                                        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="deletePost({{ $post->id }})">
                                                <span class="material-symbols-outlined">
                                                    delete
                                                </span>
                                            </button>
                                        </form>
                                    @endif
                                @endauth

                            </h2>
                        </div>
                    @endforeach
                </div>

                <div class='paginate'>
                    {{ $posts->links() }}
                </div>

                @auth
                    <footer>
                        <p>ログインユーザ：{{ Auth::user()->name }}</p>
                    </footer>
                @endauth

                <script>
                    function deletePost(id) {
                        'use strict'

                        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                            document.getElementById(`form_${id}`).submit();
                        }
                    }
                </script>


            </div>


        </div>

    </body>

</x-app-layout>


</html>
