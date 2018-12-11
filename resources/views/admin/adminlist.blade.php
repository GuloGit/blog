@extends("admin.layout")
@section("title")
    Список администраторов
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
    <a class="btn btn-success mb-4 mx-3" href="{{ route("users.create") }}">Добавить администратора</a>
    <table class="table table-bordered table-hover table-striped mx-3 ">
        <colgroup>
            <col width="200">
            <col >
            <col width="250">
        </colgroup>
        <tr>
            <th class="h3">Name</th>
            <th class="h3">email</th>
            <th></th>
        </tr>

        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td style="text-align:right">
                    <a href="{{route("users.edit", $user->id)}}" class="btn btn-outline-primary">Изменить</a>
                    @if($user->id !== $user_id)
                        <form class="d-inline-block" action="{{route("users.destroy", $user->id)}}" method="post">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-outline-danger">Удалить</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
  @endsection