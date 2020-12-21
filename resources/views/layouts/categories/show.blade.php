@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('topics', $category))

@section('content')

    <div class="container">
        <div class="card-deck">
            @foreach($category->topics as $topic)
                <div>
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title rem-3">{{ $topic->name }}</h5>
                            <a href="{{ route('topics.show', ['topic' => $topic->id]) }}" class="btn btn-primary rem-2">Список уроков</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
