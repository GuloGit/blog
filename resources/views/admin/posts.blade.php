@extends("admin.layout")
@section("title")
   Список постов
@endsection
@section("style")
    @parent
    <style>
        .table{
            border:#6c757d ;
        }
    </style>
@endsection
@section("content")
    <a class="btn btn-success mb-4 mx-3" href="{{ route("posts.create") }}">Создать пост</a>
    <table class="table table-bordered table-hover table-striped mx-3">
        <colgroup>
            <col width="200">
            <col>
            <col width="50">
            <col>
        </colgroup>
        <tr>
            <th class="h3">Заголовок</th>
            <th class="h3">Краткое описание</th>
            <th class="h3">Статус</th>
            <th></th>
        </tr>

        @foreach($posts as $post)
            <tr>
                <td>{{$post->title}}</td>
                <td>{{$post->description}}</td>
                <td>
                    @if($post->status==="on")
                        {{"Опубликован"}}
                    @else
                        {{"Черновик"}}
                    @endif
                </td>
                <td style="text-align:right">
                    <a href="{{route("posts.edit", $post->id)}}" class="btn btn-outline-primary">Изменить</a>
                    <form class="d-inline-block" action="{{route("posts.destroy", $post->id)}}" method="post">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-outline-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection