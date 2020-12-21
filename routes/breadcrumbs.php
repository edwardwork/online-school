<?php

// Categories
Breadcrumbs::for('categories', function ($trail) {
    $trail->push('Home', route('home'));
});

// Topics
Breadcrumbs::for('topics', function ($trail, \App\Models\Category $category) {
    $trail->push('Home', route('home'));
    $trail->push('Categories', route('category.list'));
    $trail->push($category->title);
});

// Lessons
Breadcrumbs::for('lessons', function ($trail, \App\Models\Topic $topic) {
    $trail->push('Home', route('home'));
    $trail->push($topic->category->title, route('category.show', ['category' => $topic->category->id]));
    $trail->push('Lessons', route('topics.list'));
    $trail->push($topic->name);
});

// Lesson
Breadcrumbs::for('lesson', function ($trail, \App\Models\Lesson $lesson) {
    $trail->push('Home', route('home'));
    $trail->push($lesson->topic->category->title, route('category.show', ['category' => $lesson->topic->category->id]));
    $trail->push('Lessons', route('topics.list'));
    $trail->push($lesson->topic->name, route('topics.show', ['topic' => $lesson->topic->id]));
    $trail->push($lesson->name);
});
