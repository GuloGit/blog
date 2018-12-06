<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $table= "posts";

    protected $guarded= [];

    public static function rules()
    {
        return[
            "title"=>"required|max:255",
            "text"=>"required",
            "description"=>"required|max:500",
            "url"=>"required|max:30",
            "status"=>"required|boolean" ,
            "image" => "required|mimes:jpeg,png"
        ];

    }
}
