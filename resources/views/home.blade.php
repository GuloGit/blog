@extends("layouts.public")
@section("content")
     <div class="content">
         @if(isset($current_category))
             <div class="content__category">
                 <div class="content__title">
                     {{$current_category->name}}
                 </div>
                 {{$current_category->description}}
             </div>
         @endif
         <div class="content__posts">
            @foreach($posts as $post)
                     <div class="post  content__post">
                        <div class="post__image"  style="background:url({{Storage::url($post->image)}}) center/cover">
                        </div>
                        <div class="post__content">
                            <div class="post__title">{{$post->title}}</div>
                            <span class="post__category">{{$post->category->name}}</span>
                            <span class="post__date">{{$post->updated_at}}</span>
                            <div class="post__description">{{$post->description}}</div>
                            <a href="{{route("show-post", $post->url)}}" class="btn post__btn">Подробнее</a>
                        </div>
                    </div>
              @endforeach
          </div>
             @if(Session::has("message"))
                 <div class="content__category content__category-alert">
                     {{Session::get("message"), Session()->flush()}}
                 </div>
             @endif
        @if(isset($paginate))
            <div class="content__pagination">{{$posts->links()}}</div>
        @endif
    </div>
@endsection
