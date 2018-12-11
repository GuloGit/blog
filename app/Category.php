<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table= "categories";

    protected $guarded= [];

    public static function rules()
    {
        return[
            "name"=>"required|max:255",
            "description"=>"required|max:500",
            "url"=>"required"
         ];

    }
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
