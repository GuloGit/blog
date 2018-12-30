<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


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
           $category->PostCount=$category->posts()->where('status', '1')->count();
        }
        $posts= Post::with("category")->where("status", "1")->Paginate(3);

        return view('home', [
            "categories" => $categories,
            "posts"=>$posts
        ]);
    }

    public function showCategory($url)
    {
        $categories=Category::with('posts')->get();
        $category=Category::with('posts')->where('url', $url)->get();
        //dd($category->first()->id);
        $category_id=$category->first()->id;

        foreach ($categories as $category){
            $category->PostCount=$category->posts()->where('status', '1')->count();
        }
        $posts= Post::with("category")
            ->where('category_id', $category_id)
            ->where("status", "1")
            ->simplePaginate(3);

        return view('home', [
            "categories" => $categories,
            "posts"=>$posts
        ]);
    }

    public function showPost($url)
    {
        $categories=Category::with('posts')->get();

        foreach ($categories as $category){
            $category->PostCount=$category->posts()->where('status', '1')->count();
        }
        $post= Post::with("category")->where('url', $url)->first();
        //dd($post);

        return view('post', [
            "categories" => $categories,
            "post"=>$post
        ]);
    }
}
