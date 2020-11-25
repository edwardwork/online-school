@extends('layouts.main')

@section('breadcrumbs', Breadcrumbs::render('lessons', $topic))

@section('content')

        <div class="px-4">
            @foreach($topic->lessons as $lesson)
                <a href="{{ route('lessons.show', ['lesson_id' => $lesson->id]) }}" class="text-5xl text-center">
                    <div class="border border-white p-4 mt-4">
                        <h5>{{ $lesson->name }}</h5>
                    </div>
                </a>
            @endforeach
        </div>

@endsection
