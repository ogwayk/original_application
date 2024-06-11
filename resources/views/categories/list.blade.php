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
        <link rel="stylesheet" href="{{ asset('/css/index.css') }}" >

    </head>

    </x-slot>

    <body class="font-sans antialiased">

    <h1>{{$category}}世界</h1>

    <a href='/categories/1'>category</a>

    <a href='/posts/create'>create</a>

    <div class='posts'>
            @foreach($posts as $post)
                <div class='post'>
                    <h2 class='body'>
                    {{ $post->body }}
                    <a href="/posts/{{ $post->id }}/edit">
                    <span class="material-symbols-outlined">
                    edit
                    </span>
                    </a>
                    
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

    </body>

    </x-app-layout>

</html>
