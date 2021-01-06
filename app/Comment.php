<?php

namespace App;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $guarded = [''];

    public function user(){
        return $this->belongsTo(User::class);
    }


}
