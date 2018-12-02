<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield("title")</title>

    @section("style")
    <style>
        html {
            position: relative;
            min-height: 100%;
        }
        body{
            background-image: url("fon.jpg");
            background-color: #e3e3e3;
        }
        h1{
            color:#6c757d;
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 40px;
            }
    </style>
    @show

</head>
<body>
    <div class="container">
        <nav class="navbar navbar-light " style="background-color: #e3e3e3;">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a  href="{{route("categories.index")}}" class="btn btn-outline-primary btn-lg btn-group" >Категории</a>
                <a  href="#" class="btn btn-outline-primary btn-lg btn-group">Посты</a>
                <a  href="#" class="btn btn-outline-primary btn-lg btn-group">Найти пост</a>
            </div>
            <button type="button" class="btn btn-outline-secondary btn-lg">ВЫХОД</button>
        </nav>
        <h1 class="mb-3 my-4 mx-3">@yield("title")</h1>
        @yield("content")
        <footer class=" row-fluid">
            @section("footer")
            &copy; Наша супер админ панель
            @show
        </footer>
    </div>
    @stack("scripts")
</body>
</html>