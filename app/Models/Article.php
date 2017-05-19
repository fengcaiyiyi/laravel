<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table = 'article';
    public $timestamps = false;
    public function test(){
        $data=Article::all();
        $data=$data->toArray();
        var_dump($data);
    }
}
