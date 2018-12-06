@extends("admin.layout")

@section("title")
  Поиск по параметрам
@endsection
@section("content")
    <form action="{{route("search")}}" method="post" enctype="multipart/form-data" class="mx-3" >
       @csrf
        <div class="form-group row">
            <label for="category" class="col-sm-2 col-form-label">Категории</label>
            <div class="col-sm-10">
                <select class="form-control custom-select mr-sm-2" id="category" name="category_id">
                    <option selected></option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Название</label>
            <div class="col-sm-10">
                <input id="title" name="title" type="text"  class="form-control" name="name">
            </div>
        </div>
        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2">Radios</legend>
                <div class="col-sm-10">
                    <div class="custom-control custom-radio custom-control">
                        <input type="radio" id="customRadioInline1" name="status" class="custom-control-input" value="0">
                        <label class="custom-control-label" for="customRadioInline1">Черновики</label>
                    </div>
                    <div class="custom-control custom-radio custom-control">
                        <input type="radio" id="customRadioInline2" name="status" class="custom-control-input" value="1">
                        <label class="custom-control-label" for="customRadioInline2">Опубликованные</label>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Oтправить</button>
                <button type="reset" class="btn btn-secondary">Очистить</button>
            </div>
        </div>
    </form>
    @endsection