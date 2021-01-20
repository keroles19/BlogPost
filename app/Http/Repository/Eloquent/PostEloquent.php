<?php


namespace App\Http\Repository\Eloquent;


use App\Category;
use App\Http\Repository\Interfaces\PostInterface;
use App\Post;

class PostEloquent implements PostInterface
{

    public function getPostBySlug($slug)
    {
        // TODO: Implement getPostBySlug() method.
    }

    public function getComments($post)
    {
        $new_comment = [];
        foreach ($post->comments as $comment){
            array_push($new_comment,[
                'id'=>$comment->id,
                'body'=>$comment->body,
                'user'=>$comment->user,
                'added_at'=>$comment->created_at->diffForHumans()
            ]);
            return $new_comment;
        }
    }

    public function getCategory($post)
    {
        return $post->category;
    }
    public function getPostsCategory($slug){
        $category = Category::whereSlug($slug)->first();
        $post = Post::whereCategoryId($category->id)->with('user')->get();
        $post['comments'] = $this->getComments($post);
        return response()->json($post);
    }

}