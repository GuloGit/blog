@extends("admin.layout")
@section("title")
    Категории
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
    <a class="btn btn-success mb-4 mx-3" href="{{ route("categories.create") }}">Создать категорию</a>
    <table class="table table-bordered table-hover table-striped mx-3" style="border-color: #1d643b">
        <colgroup>
            <col width="200">
            <col>
            <col>
        </colgroup>
        <tr>
            <th class="h3">Название</th>
            <th class="h3">Описание категории</th>
            <th></th>
        </tr>

        @foreach($categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                <td>{{$category->description}}</td>
                <td style="text-align:right">
                    <a href="{{route("categories.edit", $category->url)}}" class="btn btn-outline-primary">Изменить</a>
                    <form class="d-inline-block" action="{{route("categories.destroy", $category->url)}}" method="post">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-outline-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection