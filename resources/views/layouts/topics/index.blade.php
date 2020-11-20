@extends('layouts.app')

@section('content')

	<div class="container">

		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-size: 1.5rem;">
				<li class="breadcrumb-item"><a href="/">Главная</a></li>
				<li class="breadcrumb-item active" aria-current="page">Темы</li>
			</ol>
		</nav>

		<div class="card-deck">

			@foreach($topics as $topic)
				<div>
					<div class="card " style="width: 18rem;">
						<div class="card-body">
							<h5 class="card-title" style="font-size: 3rem;">{{ $topic->name }}</h5>
							<a href="/topics/{{ $topic->id }}" style="font-size: 1.8rem;" class="btn btn-primary">Список уроков</a>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>

@endsection
