@extends('layouts.main')

@section('breadcrumbs', Breadcrumbs::render('topics'))

@section('content')

	<div class="px-4">
        @foreach($topics as $topic)
            <a href="{{ route('topics.show', ['topic' => $topic->id]) }}" class="text-5xl text-center">
                <div class="border border-white p-4 mt-4">
                    <h5>{{ $topic->name }}</h5>
                </div>
            </a>
        @endforeach
	</div>

@endsection
