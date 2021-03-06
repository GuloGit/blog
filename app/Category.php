<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    public $table= "categories";

    protected $guarded= [];

    public static function rules($category=null)
    {
        if($category){
            return[
                "name"=>"required|max:255",
                "description"=>"required|max:500",
                "url"=>['required', 'max:30', Rule::unique('categories')->ignore($category->id)]
            ];

        } else{
            return[
                "name"=>"required|max:255",
                "description"=>"required|max:500",
                "url"=>'required', 'max:30'
            ];

        }


    }
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
