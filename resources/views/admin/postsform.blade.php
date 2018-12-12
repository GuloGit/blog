@extends("admin.layout")

@section("title")
    @if(isset($post))
        Редактирование поста
    @else
        Добавление поста
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

    <form action="{{isset($post) ? route("posts.update", $post->id) : route("posts.store")}}" method="post" enctype="multipart/form-data" class="mx-3">
        @csrf
        @isset($post)
            @method("PUT")
        @endisset

        <div class="form-group">
            <label for="title">Название</label>
            <input id="title"
                   name="title"
                   type="text"
                   class="form-control"
                   value="{{old("name",isset($post)?$post->title:"")}}">
        </div>
        <div class="form-group">
            <label for="category">Выберите категорию</label>
            <select class="form-control custom-select-lg mb-3 " id="category" name="category_id">
                @foreach($categories as $category)
                    <option value="{{$category->id}}" {{$category->name===$category_name?"selected":""}}>
                        {{$category->name}}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="content">Адрес(url):</label>
            <input id="content" name="url" type="text" class="form-control" value="{{old("url",isset($post)?$post->url:"")}}"/>
        </div>

        <div class="form-group">
            <label for="decription">Краткое описание:</label>
            <textarea id="description" name="description" type="text" class="form-control" >{{old("text",isset($post)?$post->text:"")}}</textarea>
        </div>
        <div class="form-group">
            <label for="text">Текст:</label>
            <textarea id="description" name="text" type="text" class="form-control" >{{old("description",isset($post)?$post->description:"")}}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Изображение</label>
            <input id="image"
                   name="image"
                   type="file">
        </div>

        @isset($post)
            <div class="mb-4">
                <img class="img-fluid" src="{{ Storage::url($post->image)}}" alt="">
            </div>
        @endisset

        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline1" name="status" class="custom-control-input" value="0" checked>
            <label class="custom-control-label" for="customRadioInline1">Черновик</label>
        </div>

        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline2" name="status" class="custom-control-input" value="1">
            <label class="custom-control-label" for="customRadioInline2">Опубликовать</label>
        </div>

        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
@endsection