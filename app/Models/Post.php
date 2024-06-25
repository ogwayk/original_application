<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $fillable = [
        'body',
        'user_id',
        'category_id',
    ];

    function getPaginateByLimit(int $limit_count = 5)
    {
        return $this::with('category')->withCount('likes')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //リレーション：他のほうに記載するやつ

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //後でViewで使う、いいねされているかを判定するメソッド。
    public function isLikedBy($user): bool
    {
        return Like::where('user_id', $user->id)->where('post_id', $this->id)->first() !== null;
    }
}
