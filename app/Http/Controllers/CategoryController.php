<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function list(Category $category)
    {
        $categories = Category::getcategoryAll();

        return view('categories.list')->with(['posts' => $category->getByCategory($category->id), 'category' => $category->name, 'categories' => $categories]);
    }
}
