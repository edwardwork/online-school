<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function showCategories()
    {
        $categories =  Category::all();
        return view('layouts.categories.index', compact('categories'));
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @param Category $category
     * @return Renderable
     */
    public function showCategory(Request $request, Category $category)
    {
        $category->load('topics');
        return view('layouts.categories.show', compact('category'));
    }
}
