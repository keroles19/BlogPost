<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Repository\Eloquent\Categeroies;
use Illuminate\Http\Request;

class CategoryController extends AbstractController
{
    private $categeryEloquent;
    public function __construct(Category $model, Categeroies $categeryEloquent)
    {
        parent::__construct($model);
        $this->categeryEloquent = $categeryEloquent;
    }

    public function index()
    {
        return $this->getIfExistValue('posts');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function postsCategory($slug)
    {
        return $this->categeryEloquent->getPostsCategory($slug);

    }
}
