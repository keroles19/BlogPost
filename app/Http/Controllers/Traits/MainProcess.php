<?php


namespace App\Http\Controllers\Traits;


trait MainProcess
{
    public function getAll($with = [], $paginate = 20)
    {
        $items = $this->model->with($with)->latest()->paginate($paginate);
        return response()->json($items);
    }

    public function getItems($model, $data=[]){

    }
    public function getIfExistValue($with = [])
    {
        $items =  $this->model->has($with)->get();
        return response()->json($items);
    }
    public function createOrEdit($data = [], $item = null){
        if($item == null){
           $items =  $this->model->create($data);
           return response()->json($items);
        }
    }





}