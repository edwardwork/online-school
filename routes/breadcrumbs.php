<?php

// Topics
Breadcrumbs::for('topics', function ($trail) {
    $trail->push('Home', route('home'));
    $trail->push('Lessons', route('topics.list'));
});

// Lessons
Breadcrumbs::for('lessons', function ($trail, \App\Models\Topic $topic) {
    $trail->push('Home', route('home'));
    $trail->push('Lessons', route('topics.list'));
    $trail->push($topic->name);
});

// Lesson
Breadcrumbs::for('lesson', function ($trail, \App\Models\Lesson $lesson) {
    $trail->push('Home', route('home'));
    $trail->push('Lessons', route('topics.list'));
    $trail->push($lesson->topic->name, route('topics.show', ['topic' => $lesson->topic->id]));
    $trail->push($lesson->name);
});
