<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    //リレーション：1のほうに記載する方

    public function getByCategory(int $category_id, int $limit_count = 5)
    {
        return Post::where('category_id', '=', $category_id)->paginate($limit_count);
        //  return $this->posts()->with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
        //  $targetpost = Post::where('category_id', '=', '1')->get();
    }

    public static function getCategoryAll()
    {
        $categories = Category::get();
        return $categories;
    }
}
