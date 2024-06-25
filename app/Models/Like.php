<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    public function user()
    {   //usersテーブルとのリレーションを定義するuserメソッド
        return $this->belongsTo(User::class);
    }

    public function post()
    {   //reviewsテーブルとのリレーションを定義するpostメソッド
        return $this->belongsTo(Post::class);
    }

    // belongsToの中身User::class。::はスコープ定義演算子。static、定数、オーバーライドされたクラスのプロパティやメソッドにアクセスできる。
    // ::classはclassキーワードと呼ばれ、クラスの完全修飾名を文字列で取得できる。つまり'App\Model名'が返ってくる。
    // つまり'App\Model名'をパラメータにするのと同じことです。（むしろそれが今は標準？）

}
