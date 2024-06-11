<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function index(Post $post) //()の左はPostモデルを指していて、$postはPostModelの変数名のこと。
    {
        $category = Category::getcategoryAll();
        //カテゴリのすべてのデータを取得して、$categoryへ格納
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit(), 'categories' => $category]);
        //viewを返す。　post.indexはviewsフォルダ以下のパスを記述。
        //with句でviewにcontroller内で取得した変数を渡す。postsはindex.bladeで使う変数名。=>より右は値。(持ってくるpostデータの制限。)
        //categoriesは$categoryを参照？
    }

    public function create(Category $category)
    {
        return view('posts.create')->with(['categories' => $category->get()]);
    }

    public function store(PostRequest $request, Post $post)
    {
        $id = Auth::id();
        $input = $request['post'];
        $input['user_id'] = $id;
        $post->fill($input)->save();
        return redirect('/');
    }
    public function edit(Post $post)
    {
        $category = Category::getcategoryAll();

        return view('posts.edit')->with(['post' => $post, 'categories' => $category]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();

        //return redirect('/posts/' . $post->id);
        return redirect('/');
    }

    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}
