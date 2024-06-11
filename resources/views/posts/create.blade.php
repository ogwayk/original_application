<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>新規投稿作成</title>
</head>

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

        <input type="submit" value="保存" />
    </form>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</body>

</html>