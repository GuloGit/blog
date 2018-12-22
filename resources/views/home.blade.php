<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

</head>
    <body>
    <div class="container">
        <div class="header">
            <div class="header__container ">
                <div class="header__logo">
                    <img src="img/logo.png" alt="">
                </div>
                <div class="header__label">Поиск постов</div>

                <form class="header__form" action="#" method="post">
                    @csrf
                    <div class="header__search">
                        <label for="search" class="hidden"></label>
                        <input class="header__input " placeholder="введите поисковое слово..." id="search" type="text">
                    </div>
                    <div class="header__button">
                        <button class="btn header__btn btn--stacked"></button>
                    </div>
                </form>
                <div class="header__descriptor">
                    Добро пожадовать в мой суперблог
                </div>
            </div>
        </div><!-- header-->
        <div class="main">
            <div class="aside">
                @foreach($categories as $category)
                    <li class="aside__item">
                        <a class="btn aside__btn" href="{{route("show-category", $category->url)}}">
                            <span>{{$category->name}}</span>
                            <span>{!!"(".$category->PostCount.")"!!}</span>
                        </a>
                    </li>
                @endforeach
            </div>
            <div class="content">
                @foreach($posts as $post)
                    <div class="post  content__post">
                        <div class="post__imgage">
                            <img class="post__img" src="{{Storage::url($post->image)}}" width="190"/>
                        </div>
                        <div class="post__content">
                            <div class="post__title">{{$post->title}}</div>
                                <span class="post__category">{{$post->category->name}}</span>
                                <span class="post__date">{{$post->updated_at}}</span>
                            <div class="post__description">{{$post->description}}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div><!-- container-->
   </body>
</html>
