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

        $posts=collect([]);
        $category=$request->category_id;
        $status=$request->status;
        $title=$request->title;

        if (isset($category) && is_null($status) && is_null($title)){
             $posts= Post::where("category_id", $category)->get();
         }

        if (isset($status) && is_null($category) && is_null($title)){
             $posts= Post::where("status", $status)->get();
             }

        if (isset($title)&& is_null($category) && is_null($status)){
            foreach (Post::all() as $post){
               if(str_contains($post->title, $title)){
                    $posts->push($post);
               };
            }
        }

        if (isset($category)&& isset($status) && is_null($title)){
            $posts= Post::where("category_id", $category)->where("status", $status)->get();
         }

        if (isset($category)&& isset($title)&& is_null($status)){
            $items= Post::where("category_id", $category)->get();
            foreach ($items as $post){
                if(str_contains($post->title, $title)){
                    $posts->push($post);
                }
            };
        }

        if (isset($status)&& isset($title)&& is_null($category)){
            $items= Post::where("status", $status)->get();
            foreach ($items as $post){
                if(str_contains($post->title, $title)){
                    $posts->push($post);
                }
            };
        }

        if (isset($status) && isset($title)&& isset($category)){
            $items=Post::where("category_id", $category)->where("status", $status)->get();
            foreach ($items as $post){
                if(str_contains($post->title, $title)){
                    $posts->push($post);
                }
            };
        }

        return view("admin.posts",[
            "posts" => $posts
        ]);
    }
}
