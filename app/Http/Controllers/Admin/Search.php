<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

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


        //проверяю если заполнена только одна категория, тогда выбираю все посты с такой категорией

        if (isset($category) && is_null($status) && is_null($title)){
             $posts= Post::where("category_id", $category)->get();
             }
    //здесь прверяю если заполнен только один статус, то есть если выбрана радио кнопка  с value  0 или 1
        if (isset($status) && is_null($category) && is_null($title)){
             $posts= Post::with("category")->where("status", $status)->get();
             }
// это условие сработает, если заполнено только поле с названием, а остальные пустые
        // :with я добавляла что бы можно было обратиться к методу модели Post->category, в котором belongTo - во view posts
        //но потом заметила, что и с where, все работает, и with не обязателен
        //я поняла из твоих ответов, что поиск внутри текста лучше по другому сделать, да и надо как то результат подкрасить
        if (isset($title)&& is_null($category) && is_null($status)){
            $posts=Post::with("category")->where('title', 'like', '%'.$title.'%')->get();
            /*foreach ($items as $post){
               if(str_contains($post->title, $title)){
                    $posts->push($post);
                };
             }
            */
            }
       //здесь поиск по статусу и категории без названия поста(оно не заполнено)
        if (isset($category)&& isset($status) && is_null($title)){
            $posts= Post::where("category_id", $category)
                ->where("status", $status)
                ->get();
         }
//здесь поиск по категории и названию, без статуса, то есть статус не выбран
        if (isset($category)&& isset($title)&& is_null($status)){
            $posts= Post::where("category_id", $category)
                ->where('title', 'like', '%'.$title.'%')
                ->get();
            }
//это условие сработает, если выбраны статус и название, категорий не указана
        if (isset($status)&& isset($title)&& is_null($category)){
            $posts= Post::where("status", $status)
                ->where('title', 'like', '%'.$title.'%')
                ->get();

        }
//А это условие если выбраны все параметры
        if (isset($status) && isset($title)&& isset($category)){
            $posts=Post::where("category_id", $category)
                ->where("status", $status)
                ->where('title', 'like', '%'.$title.'%')
                ->get();

        }
/* если ни одно из условий не сработает или ничего не найдено, то collection, то есть перемення $posts пустой,
 и должно выводиться сообщение, что ничего не найдено
но проверка на "пустоту' в нем дает false,
Collection {#566 ▼
  #items: []
}
  может потому что там есть пустой items, поэтому я использую метод first*/
 if ($posts->first()===null){
            Session()->flash("message", "Нет постов, отвечающих критериям поиска");
            Session()->flash("message-type", "primary");
        }


        /*пока в результатах поиска навигации нет, но скоро будет
        Paginate- работает  с моделью      $posts =Post::Paginate(2);
        или DB -   $posts = DB::table('posts')->Paginate(2);

        а с результатом поиска не работает, пишет:Method Illuminate\Support\Collection::Paginate does not exist
        нет такого метода у Collection,
        а у меня один view для вывода всех постов и вывода результатов поиска, и там есть вывод пагинации {{$posts->links()}}
        и все ломается если её не делать в поиске, и пока я не придумала как её здесь сделать, создала доп. переменную, для проеврки
        которую передаю во view
        Вот куда здесь Paginate прилепить?, я думаю нужно в ручную его создавать и все параметры считать как-то
        */
        $paginate=true;

        return view("admin.posts",[
            "posts" => $posts,
            "paginate"=>$paginate,
            "title"=>$title

        ]);
    }
}
