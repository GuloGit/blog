<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Search extends Controller
{
    public function index()
    {
        return view("admin.searchform",[
            "categories" => Category::all()
        ]);
    }

    public function result(Request $request)
    {
        $posts=Post::all();
        $category=$request->category_id;
        $status=$request->status;


        if (isset($category)){
             $posts= Post::where("category_id", $category)->get();
            }
        if (isset($status)){
             $posts= Post::where("status", $status)->get();
            }

        if (isset($category)&& isset($status)){
            $posts= Post::where("category_id", $category)->where("status", $status)->get();
            //dd($posts);
        }


        return view("admin.posts",[
            "posts" => $posts
        ]);

    }
}
