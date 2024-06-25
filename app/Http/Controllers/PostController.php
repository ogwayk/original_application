<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;


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

    public function like(Request $request)
    {
        $user_id = Auth::user()->id; //1.ログインユーザーのid取得
        $post_id = $request->post_id; //2.投稿idの取得
        $already_liked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first(); //3.

        if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
            $like = new Like; //4.Likeクラスのインスタンスを作成
            $like->post_id = $post_id; //Likeインスタンスにreview_id,user_idをセット
            $like->user_id = $user_id;
            $like->save();
        } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
            Like::where('post_id', $post_id)->where('user_id', $user_id)->delete();
        }
        //5.この投稿の最新の総いいね数を取得
        $post_likes_count = Post::withCount('likes')->findOrFail($post_id)->likes_count;
        $param = [
            'post_likes_count' => $post_likes_count,
        ];
        return response()->json($param); //6.JSONデータをjQueryに返す
    }
}
