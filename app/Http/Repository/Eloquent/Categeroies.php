<?php


namespace App\Http\Repository\Eloquent;


use App\Category;
use App\Post;

class Categeroies extends PostEloquent
{
    public function getPostsCategory($slug)
    {
        $category = Category::whereSlug($slug)->first();
        $post = Post::whereCategoryId($category->id)->with(['user','comments'])->get();
        return response()->json($post);
    }

}