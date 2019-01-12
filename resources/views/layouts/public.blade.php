<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.flipbox.css') }}" rel="stylesheet">
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
         

    <script src="{{ asset('js/jquery.flipbox.js') }}"></script>
    <script>

    $(function(){

        $('#advertising').flipbox({
            autoplay: true,
            autoplayReverse: false,
            autoplayWaitDuration: 3000,
            autoplayPauseOnHover: true
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".btn__rating--right").click(function () {
                var id = $(".post__rating").data("id");
                console.log(id);
                $.ajax({
                url: "/ratingLike" ,
                type:"get",
                data: {id:id} ,
                dataType:"json",
                success: function (response) {

                $(".post__like").text(response.like);
                $(".post__dislike").text(response.dislike);

                }

                })
            });
        $(".btn__rating--left").click(function () {
            var id = $(".post__rating").data("id");
            console.log(id);
            $.ajax({
                url: "/ratingDislike" ,
                type:"get",
                data: {id:id} ,
                dataType:"json",
                success: function (response) {

                    $(".post__like").text(response.like);
                    $(".post__dislike").text(response.dislike);

                }

            })
        });
    })
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header__container ">
                <div class="header__logo">
                    <img src="{{asset('img/logo.png')}}" alt="">
                </div>
                <div class="header__label">Поиск постов</div>

                <form class="header__form" action="{{route("SearchPost")}}" method="post">
                    @csrf
                    <div class="header__search">
                        <label for="search" class="hidden"></label>
                        <input name="search" class="header__input " placeholder="введите слово..." id="search" type="text">
                    </div>
                    <div class="header__button">
                        <button class="btn header__btn btn--stacked"></button>
                    </div>
                </form>
                <div class="header__descriptor">
                    Добро пожаловать в мой суперблог
                </div>
            </div>
        </div><!-- header-->
        <div class="main">
            <div class="aside">
                <div class="aside__main">
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

                <div class="aside__advertising box" id="advertising">
                    <div class="side side1 box__side box__side-1">Здесь может быть ваша реклама</div>

                    <div class="side side2 box__side box__side-2">2</div>

                    <div class="side side3 box__side box__side-3">3</div>
                </div>
            </div><!-- aside-->
            @yield("content")

        </div>
    </div><!-- container-->
</body>
</html>
