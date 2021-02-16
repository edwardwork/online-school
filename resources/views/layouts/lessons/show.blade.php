@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('lesson', $lesson))

@section('content')
	<div id="application">
		<div class="container">
			<div class="text-center">

				@if(!empty($status) && !is_null($lesson->video_id))
					@if ($status->canWatchVideo())
                        <vimeo-video-iframe id={{ $lesson->video_id }}></vimeo-video-iframe>
					@else
						<h1>Просмотр даного видео не доступен :(</h1>
					@endif
				@endif

                @if($lesson->manuals(\Auth::user())->get()->isNotEmpty())
                    <div>
                        <a href="{{ asset('storage/'.$lesson->manuals(\Auth::user())->first()->file_path) }}" target="_blank" class="alert-link rem-2">
                            <div class="alert alert-primary" role="alert">
                                Открыть методичку
                            </div>
                        </a>
                    </div>
                @endif

			</div>

			<module-for-testing
					:status="{{ $status }}"
					:questions="{{ $questions }}"
					:answers="{{ $answers }}">

			</module-for-testing>

		</div>
	</div>
@endsection

@push('scripts')
	<script src="https://player.vimeo.com/api/player.js"></script>
@endpush

@push('script')
	<script src="{{ asset('js/lesson.js') }}"></script>
@endpush

<style>
	.img-question{
		width: 500px;
		height: auto;
	}

	input[type="checkbox"]{
		width: 50px;
		height: 50px;
	}
</style>
