<?php


namespace App\Http\Controllers\Traits;


trait MainProcess
{
    public function getAll($with = [])
    {
        $items = $this->model->with($with)->latest()->get();
        return response()->json($items);
    }

    public function getItems($model, $data=[]){

    }




}