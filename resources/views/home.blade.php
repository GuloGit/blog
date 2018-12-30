@extends("layouts.public")
@section("content")
    <div class="content">
        <div class="content__posts">
            @foreach($posts as $post)
                @if($post->status==="1")
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
                @endif
            @endforeach
        </div>
        <div class="content__pagination">{{$posts->links()}}</div>
    </div>
@endsection
