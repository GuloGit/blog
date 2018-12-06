<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Search extends Controller
{
    public function Index()
    {
        return view("admin.searchform",[
            "categories" => Category::all()
        ]);
    }
}
