<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::with('posts')->get();

        foreach ($categories as $category){
           $category->PostCount=$category->posts()->count();
        }
        $posts= Post::with("category")->get();

        return view('home', [
            "categories" => $categories,
            "posts"=>$posts
        ]);
    }

    public function category($url)
    {
       echo "ура!";
    }
}
