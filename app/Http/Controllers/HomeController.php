<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Guest;
use App\Rating;
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
            "posts"=>$posts,
            "paginate"=>true
        ]);
    }

    public function search(Request $request)
    {
        $posts=collect([]);
        $search=$request->search;

        $items= Post::where("status", "1")->get();

        if($search){
            foreach ($items as $item){
                $description=$item->description;
                $title=$item->title;
                $text=$item->text;
            //если есть совпадения в название, описание или тексте, то пост добавляется в массив $posts
                if(stristr($title,"$search")||stristr($description,"$search")||stristr($text,"$search")){
                    $posts->push($item);
                }
            }
        }

        $categories=Category::with('posts')->get();

        foreach ($categories as $category){
            $category->PostCount=$category->posts()->where('status', '1')->count();
        }

        return view('home', [
            "categories" => $categories,
            "posts"=>$posts
        ]);
    }

    public function showCategory(Request $request, $url)
    {
        $categories=Category::with('posts')->get();
        $current_category=Category::with('posts')->where('url', $url)->get();
        $category_id=$current_category->first()->id;


        foreach ($categories as $category){
            $category->PostCount=$category->posts()->where('status', '1')->count();
        }
        $posts= Post::with("category")
            ->where('category_id', $category_id)
            ->where("status", "1")
            ->simplePaginate(3);

        if(!$posts->first()){
            $request->Session()->flash("message", "В этой категории пока нет постов");
         }


        return view('home', [
            "categories" => $categories,
            "posts"=>$posts,
            "current_category"=> $current_category->first()
        ]);
    }

    public function showPost($url)
    {
        $categories=Category::with('posts')->get();

        foreach ($categories as $category){
            $category->PostCount=$category->posts()->where('status', '1')->count();
        }
        $post= Post::with("category")->where('url', $url)->first();
        //dd($post->like);

        return view('post', [
            "categories" => $categories,
            "post"=>$post
        ]);
    }

    public function ratingLike(Request $req)
    {
       $id=$req->input("id");
       $ip= $_SERVER['REMOTE_ADDR'];
       $post=Post::where('id',$id)->first();
       $guest=Guest::where('ip', $ip)->first();

       if(!$guest) {
           $user["ip"] = $ip;
           $guest = Guest::create($user);
       }
       $post_guest=Rating::where('post_id', $id)
           ->where('guest_id', $guest['id'])->first();
       if(!$post_guest) {
           $post->like = $post->like + 1;
           $post->save();
           $data["post_id"] = $id;
           $data["guest_id"] = $guest["id"];
           $data["like"] = 1;
           $data["dislike"] = 0;
           Rating::create($data);
       } elseif($post_guest->dislike){
           $post_guest->like=1;
           $post_guest->dislike=0;
           $post_guest->save();
           $post->like=$post->like+1;
           $post->dislike=$post->dislike-1;
           $post->save();
       }
        return ["dislike"=> $post["dislike"],
            "like"=>$post["like"]
        ];

    }
    public function ratingDislike(Request $req)
    {
        $id=$req->input("id");
        $ip= $_SERVER['REMOTE_ADDR'];
        $post=Post::where('id',$id)->first();
        $guest=Guest::where('ip', $ip)->first();

        if(!$guest) {
            $user["ip"] = $ip;
            $guest = Guest::create($user);
        }
        $post_guest=Rating::where('post_id', $id)
            ->where('guest_id', $guest['id'])->first();
        if(!$post_guest) {
            $post->like = $post->like + 1;
            $post->save();
            $data["post_id"] = $id;
            $data["guest_id"] = $guest["id"];
            $data["like"] = 0;
            $data["dislike"] = 1;
            Rating::create($data);
        } elseif($post_guest->like){
            $post_guest->like=0;
            $post_guest->dislike=1;
            $post_guest->save();
            $post->like=$post->like-1;
            $post->dislike=$post->dislike+1;
            $post->save();
                }
        return ["dislike"=> $post["dislike"],
                "like"=>$post["like"]
            ];

    }
}
