<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>投稿編集</title>
</head>

<body>
    <h1>投稿内容編集</h1>

    <form action="/posts/{{$post->id}}" method="POST">
        @csrf
        @method('PUT')

        <div class="category">
            <p>投稿するカテゴリを選択</p>
            <select name="post[category_id]">
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

        </div>
        <div class="body">
            <p>フォーム</p>
            <textarea name="post[body]" placeholder="投稿する内容を入力">{{$post->body}}</textarea>
            <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
        </div>

        <input type="submit" value="保存" />
    </form>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</body>

</html>