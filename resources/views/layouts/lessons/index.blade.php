@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('lessons', $topic))

@section('content')

	<div class="container">

		<div class="card-deck text-center">
            <a href="{{ route('category.list') }}" class="btn btn-primary rem-2 mb-4">К списку тем</a>

			@foreach($topic->lessons as $lesson)
				<div>
					<div class="card text-center">
						<div class="card-body">
							<h5 class="card-title rem-3">{{ $lesson->name }}</h5>
                            @if(\App\Helpers\CheckAccessToLesson::check(\Auth::user(), $lesson))
                                <a href="{{ route('lesson.show', ['lesson_id' => $lesson->id]) }}" class="btn btn-primary rem-2">
                                    Go to lesson
                                </a>
                            @else
                            <a href="#" class="btn btn-secondary rem-2">
                                Not access
                            </a>
                            @endif
						</div>
					</div>
				</div>
			@endforeach

		</div>
	</div>

@endsection
