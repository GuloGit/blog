<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index(Request $request)
    {
       // dd($request->session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'));
        return view("admin.layout");
       // "login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d";
        // login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d

    }

    public function list(Request $request)
    {
      //  dd($request->user());
        $user_id=Auth::id();
        return view("admin.adminlist",[
            "admins"=> User::all(),
            "user_id"=>$user_id
        ]);
    }

    public function update(Request $request)
    {
        $request->user();
    }
    public function del($id)
    {
        User::destroy($id);
       // Session()->flash("message", "Админ удален");
       // Session()->flash("message-type", "danger");
        return redirect(route("AdminList"));
    }
}
