<?php

namespace App\Http\Controllers\Api;

use App\Http\Repository\Eloquent\PostEloquent;
use App\Post;

class PostController extends AbstractController
{
    private $eloquent;
    public function __construct(Post $model, PostEloquent $eloquent)
    {
        parent::__construct($model);
        $this->eloquent = $eloquent;
    }

    public function index(){
        return $this->getAll(['user','comments']);
    }
    public function show(Post $post){
        $post['comments'] = $this->eloquent->getComments($post) ;
        $post['category'] = $this->eloquent->getCategory($post) ;
      return response()->json($post);
    }
    public function search($query){
        $posts = $this->model->where('title','like','%'.$query.'%')->with('user','comments');
        $count = count($posts->get());
        // return all data to  one page
        return response()->json($posts->paginate(intval($count)));
    }
}
