<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Categories extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  $categories=Category::all();
        // dd($categories);
        return view("admin.category", [
            "categories" => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Return view("admin.categoriesform");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Category::rules());
        $data = $request->all();
        $request->session()->flash("message", "Категория успешно добавлена");
        $request->session()->flash("message-type", "success");

        $category = Category::create($data);

        return redirect(route("categories.index"));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view("admin.categoriesform", [
            "category" => $category
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate(Category::rules());
        $category->fill($request->all());
        $category->save();

        $request->session()->flash("message", "Изменения успешно сохранены");
        $request->session()->flash("message-type", "success");
        return redirect(route("categories.index"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Session()->flash("message", "Категория успешно удалена");
        Session()->flash("message-type", "danger");
        return redirect(route("categories.index"));
    }
}