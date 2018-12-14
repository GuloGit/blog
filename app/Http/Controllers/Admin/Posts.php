<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Posts extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /*Так не возможно обращение к category во view, нужно создавать через модель
        * $posts = DB::table('posts')->Paginate(2);
        * Так тоже работает но странно, что просто
            $posts =Post::Paginate(2);
       */
        $posts =Post::with("category")->Paginate(2);
        return view("admin.posts", [
            "posts" => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Return view("admin.postsform", [
            "categories" => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Post::rules());
        $data = $request->all();
        $data["image"]=$request->image->store("public/images");

        $request->session()->flash("message", "Пост успешно сохранен");
        $request->session()->flash("message-type", "success");

        $post = Post::create($data);

        return redirect(route("posts.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $category_name=Category::where('id', $post->category_id)->get()->first()->name;
        return view("admin.postsform", [
            "post" => $post,
            "categories" => Category::all(),
            "category_name"=>$category_name
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(Post::rules($post));
        $post->fill($request->all());

        if($request->has("image")){
            $post->image=$request->image->store("public/images");
        }

        $post->save();

        $request->session()->flash("message", "изменения успешно сохранены");
        $request->session()->flash("message-type", "success");

        return redirect(route("posts.index"));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Responseи
     */
    public function destroy(Post $post)
    {
        $post->delete();
        Session()->flash("message", "Пост успешно удален");
        Session()->flash("message-type", "danger");
        return redirect(route("posts.index"));
    }
}
