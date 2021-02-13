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
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('home');
    }

    /**
     * @return Renderable
     */
    public function showCategories(): Renderable
    {
        $categories =  Category::all();
        return view('layouts.categories.index', compact('categories'));
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return Renderable
     */
    public function showCategory(Request $request, Category $category): Renderable
    {
        $category->load('topics');
        return view('layouts.categories.show', compact('category'));
    }
}
