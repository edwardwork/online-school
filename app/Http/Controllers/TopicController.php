<?php

namespace App\Http\Controllers;

use App\Models\Topic;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::all();

        return view('layouts.topics.index', compact('topics'));
    }

    public function show(Topic $topic)
    {
        return view('layouts.lessons.index', compact('topic'));
    }
}