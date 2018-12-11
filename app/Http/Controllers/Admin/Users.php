<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Users extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  dd($request->user());
        //$user_id=Auth::id();
        return view("admin.adminlist",[
            "users"=> User::all(),
            "user_id"=>Auth::id()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Return view("admin.register");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate(User::rules());
        $data = $request->all();
        //User::rules($data);

        $request->session()->flash("message", "Пост успешно сохранен");
        $request->session()->flash("message-type", "success");

        $user = User::create($data);

        return redirect(route("users.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view("admin.register", [
            "user" => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->delete();
        //dd($request);
        $request->validate(User::rules());
        $user->fill($request->all());
        $user->save();

        $request->session()->flash("message", "Изменения успешно сохранены");
        $request->session()->flash("message-type", "success");

        return redirect(route("users.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        Session()->flash("message", "Администратор успешно удален");
        Session()->flash("message-type", "danger");
        return redirect(route("users.index"));
    }
}
