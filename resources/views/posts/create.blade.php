<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-app-layout>
    <x-slot name="header">

        <head>
            <meta charset="utf-8">
            <title>新規投稿作成</title>

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

        </head>
    </x-slot>

    <body>
        <h1>新規投稿作成</h1>

        <form action="/posts" method="POST">
            @csrf

            <div class="category">
                <p>投稿するカテゴリを選択</p>
                <select name="post[category_id]">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="body">
                <p>投稿フォーム</p>
                <textarea name="post[body]" placeholder="投稿する内容を入力">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>

            <button><input type="submit" value="投稿" /></button>
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</x-app-layout>

</html>