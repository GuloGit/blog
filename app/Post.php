<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Post extends Model
{
    public $table= "posts";

    protected $guarded= [];

    public static function rules($post)
    {
        return[
            "title"=>"required|max:255",
            "text"=>"required",
            "description"=>"required|max:500",
            "url"=>['required', 'max:30', Rule::unique('posts')->ignore($post->id)],
            "status"=>"required|boolean" ,
            "image" => "required|mimes:jpeg,png"
        ];

    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
