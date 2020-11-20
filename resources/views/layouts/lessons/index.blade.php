@extends('layouts.app')

@section('content')

	<div class="container">

		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-size: 1.5rem;">
				<li class="breadcrumb-item"><a href="/">Главная</a></li>
				<li class="breadcrumb-item"><a href="{{ route('list_topics') }}">Темы</a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ $topic->name }}</li>
			</ol>
		</nav>

		<div class="card-deck">

			@foreach($topic->lessons as $lesson)
				<div>
					<div class="card" style="width: 18rem;">
						<div class="card-body">
							<h5 class="card-title" style="font-size: 2rem;">{{ $lesson->name }}</h5>
							<a href="{{ route('show_lesson', ['lesson_id' => $lesson->id]) }}" style="font-size: 1.5rem;" class="btn btn-primary">Перейти к уроку</a>
						</div>
					</div>
				</div>
			@endforeach

		</div>
	</div>

@endsection
