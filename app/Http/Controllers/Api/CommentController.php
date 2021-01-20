<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Repository\Eloquent\PostEloquent;
use App\Http\Requests\AddCommentRequest;
use App\Post;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\AbstractList;

class CommentController extends AbstractController
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    public function store(AddCommentRequest $request)
    {

       return $this->createOrEdit($request);

    }

}
