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
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
            <link rel="stylesheet" href="{{ asset('/css/index.css') }}">

        </head>

    </x-slot>

    <body class="font-sans antialiased">

        @foreach($categories as $category)
        <a href='/categories/{{$category->id}}'>{{$category->name}}せかい</a>
        @endforeach

        <p>★投稿のしかた★</p>
        <p><a href='/posts/create'>新規投稿を作成</a></p>


        <div class='posts'>
            @foreach($posts as $post)
            <div class='post'>
                <h2 class='body'>
                    <img id="preview" src="{{ isset($post->user->profile_photo_path) ? asset('storage/' . $post->user->profile_photo_path) : asset('images/user_icon.png') }}" alt="" class="w-16 h-16 rounded-full object-cover border-none bg-gray-200">
                    {{ $post->body }}

                    <span class="material-symbols-outlined">
                        favorite
                    </span>

                    @if (Auth::user()->id == $post->user_id)

                    <a href="/posts/{{ $post->id }}/edit">
                        <span class="material-symbols-outlined">
                            edit
                        </span>
                    </a>

                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">
                            <span class="material-symbols-outlined">
                                delete
                            </span>
                        </button>
                    </form>

                    @endif

                </h2>
            </div>
            @endforeach
        </div>

        <div class='paginate'>
            {{ $posts->links() }}
        </div>


        <footer>
            <p>ログインユーザ：{{ Auth::user()->name }}</p>
        </footer>

        <script>
            function deletePost(id) {
                'use strict'

                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>

    </body>

</x-app-layout>

</html>