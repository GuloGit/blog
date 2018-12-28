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
                    <img src="{{asset('img/logo.png')}}" alt="">
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
                <a href="{{route("home")}}" class="btn aside__categories btn--stacked">Категории</a>
                @foreach($categories as $category)
                    <li class="aside__item">
                        <a class="btn aside__btn" href="{{route("show-category", $category->url)}}">
                            <span>{{$category->name}}</span>
                            <span>{!!"(".$category->PostCount.")"!!}</span>
                        </a>
                    </li>
                @endforeach
            </div>
            @yield("content")
        </div>
    </div><!-- container-->
</body>
</html>
