@extends("admin.layout")

@section("title")
    @if(isset($category))
        Редактирование категории
    @else
        Добавление категории
    @endif
@endsection

@section("content")
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{isset($category) ? route("categories.update", $category->id) : route("categories.store")}}" method="post" enctype="multipart/form-data" class="mx-3 mb-2">
        @csrf
        @isset($category)
            @method("PUT")
        @endisset

        <div class="form-group">
            <label for="name">Название</label>
            <input id="name"
                   name="name"
                   type="text"
                   class="form-control"
                   value="{{old("name",isset($category)?$category->name:"")}}">
        </div>

        <div class="form-group">
            <label for="content">Адрес(url):</label>
            <input id="content" name="url" type="text" class="form-control" value="{{old("url",isset($category)?$category->url:"")}}"/>
        </div>

        <div class="form-group">
            <label for="decription">Описание категори:</label>
            <textarea id="description" name="description" type="text" class="form-control" >{{old("description",isset($category)?$category->description:"")}}</textarea>
        </div>

        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
@endsection