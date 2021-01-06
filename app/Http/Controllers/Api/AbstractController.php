<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MainProcess;
use Illuminate\Database\Eloquent\Model;

class AbstractController extends Controller
{
    use MainProcess;

    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

}