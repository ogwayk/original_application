<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        
        <title>〇〇せかい</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <h1>categoriesな世界</h1>
    <div class='posts'>
            @foreach($posts as $post)
                <div class='post'>
                    <p class='body'>{{ $post->body }}</p>
                </div>
            @endforeach
        </div>
    </body>
</html>
