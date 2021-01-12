@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('categories'))

@section('content')

    <div class="container">
        <div class="card-deck">
            @foreach($categories as $category)
                <div>
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title rem-3">{{ $category->title }}</h5>
                            <a href="{{ route('category.show', ['category' => $category->id]) }}" class="btn btn-primary rem-2">Topics</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
