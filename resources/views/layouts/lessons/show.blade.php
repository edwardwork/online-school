@extends('layouts.main')

@section('breadcrumbs', Breadcrumbs::render('lesson', $lesson))

@section('content')
	<div>
        <div class="text-center mt-8">

            @if(!empty($status))
                @if ($status->canWatchVideo())
                    <vimeo-video-iframe id={{ $lesson->video_id }}></vimeo-video-iframe>
                @else
                    <h1 class="text-center text-5xl">Просмотр даного видео не доступен :(</h1>
                @endif
            @endif

            <div class="border-b border-white pb-4 mt-8 text-5xl">
                <a href="{{ asset('storage/'.$lesson->pdf_url) }}" target="_blank" class="alert-link">
                    <div class="text-5xl bg-indigo-300 border rounded-full px-4 py-2" role="alert">
                        Открыть методичку
                    </div>
                </a>
            </div>

        </div>

        <module-for-testing
                :status="{{ $status }}"
                :questions="{{ $questions }}"
                :answers="{{ $answers }}">

        </module-for-testing>
	</div>
@endsection

@push('scripts')
	<script src="https://player.vimeo.com/api/player.js"></script>
@endpush

@push('scripts')
	<script>

        // function shuffle(array) {
        //     array.sort(() => Math.random() - 0.5);
        // }
		//
        // function renderQuestion(questions, array_id_of_questions, current_position, response){
		//
        //     let template;
        //     let current_question;
		//
        //     if(array_id_of_questions.length > 0) {
		//
        //         current_question = questions.find(x => x.id === array_id_of_questions[current_position]);
		//
        //         if(current_question !== null && current_question !== undefined && (response['is_success'] === 0) && (response['attempt'] < response['max_attempt']) ) {
		//
        //             template = ``;
		//
        //             template =`<p>${current_question.text}</p>`;
		//
        //             if(current_question.image_url) {
        //                 template = `<img src="/storage/${current_question.image_url}" class="img-question">`;
        //             }
        //             template += `<div id="type_${current_question.type}" class="answers">`;
		//
        //             shuffle(current_question.answers);
        //             current_question.answers.forEach(answer => {
        //                 template += `<div class="answer-block">`
        //                 if(answer.text !== null) {
        //                     template += `<input class="type_${current_question.type}" type='checkbox' name="answer" value='${answer.text}'><span class="answer-text"> ${answer.text}</span>`;
        //                 }
        //                 if(answer.image_url){
        //                     template += `<br>`;
        //                     template += `<img class="img-answer" width="250px" src="/storage/${answer.image_url}">`;
        //                 }
        //                 template += `</div>`;
        //             });
		//
        //             template += `</div><br><button class="btn btn-success btn-lg" id="get_next">Ответить и перейти дальше</button>`;
		//
        //             if(Number(current_question["type"]) === 3) {
        //                 template += `<div id="example_answer"><p>Ваш ответ будет принят, как: </p></div>`;
        //             }
		//
        //         }
		//
        //         else {
		//
        //             if(response['is_success'] === 1 || response['is_success'] === true) {
		//
        //                 template = ``;
		//
        //                 template += `<p>Вы успешно сдали этот тест.</p>`;
        //             }
		//
        //             else {
		//
        //                 if(response['attempt'] >= response['max_attempt']) {
		//
        //                     template = ``;
		//
        //                     template += `<p>Превышено количество попыток сдачи теста.</p>`;
        //                 }
        //                 else {
		//
        //                     template = ``;
		//
        //                     template += `<p>Тест не сдан!</p>`;
        //                 }
		//
        //             }
		//
        //         }
        //     } else {
		//
        //         template = ``;
		//
        //         template += `<p>Для этого урока еще не создали вопросов</p>`;
        //     }
		//
        //     $('#question_content').html(template);
        // }

        {{--$(document).ready(function () {--}}

        {{--    // Для того чтобы не делать после каждого ответа пользователя на вопрос запрос к серверу и не нагружать БД,--}}
        {{--    // будем сохранять состояние теста в localStorage--}}
        {{--    localStorage.removeItem('true_answers');--}}
        {{--    localStorage.setItem('true_answers', 0);--}}

        {{--    // В этом блоке узнаем, lesson_id из URL--}}
        {{--    let url = window.location.href;--}}
        {{--    let parts_url = url.split('/');--}}
        {{--    let lesson_id = parts_url[parts_url.length-1];--}}

        {{--    // Обьявление переменных для работы--}}
        {{--    let response;--}}
        {{--    let questions = null;--}}
        {{--    let current_position = -1;--}}
        {{--    let array_id_of_questions = [];--}}
        {{--    let ordered_selected_answers = [];--}}


        {{--    --}}{{--$.ajax({--}}
        {{--    --}}{{--    url: "{{ url('/userStatus') }}",--}}
        {{--    --}}{{--    type: "POST",--}}
        {{--    --}}{{--    data: {"lesson_id" : lesson_id},--}}
        {{--    --}}{{--    success: function (data) {--}}
        {{--    --}}{{--        console.log(data, '12');--}}
        {{--    --}}{{--        array_id_of_questions = data["data"].question_ids.split(' ').map(x => parseInt(x));--}}

        {{--    --}}{{--        response = data["data"];--}}

        {{--    --}}{{--        current_position = data["data"].current_position === -1 ? 0 : data["data"].current_position;--}}

        {{--    --}}{{--        $.ajax({--}}
        {{--    --}}{{--            url: "{{ url('/lessons/getQuestionsAndAnswers') }}",--}}
        {{--    --}}{{--            type: "POST",--}}
        {{--    --}}{{--            data: {"lesson_id" : lesson_id},--}}
        {{--    --}}{{--            success: function (data) {--}}
        {{--    --}}{{--                console.log(data)--}}
        {{--    --}}{{--                questions = data["data"].questions;--}}
        {{--    --}}{{--            }--}}
        {{--    --}}{{--        })--}}

        {{--    --}}{{--    }--}}
        {{--    --}}{{--});--}}

        {{--    // По клику на "Приступить к тесту" вызываем функцию renderQuestion--}}
        {{--    // $('#start_test').click(function () {--}}
        {{--    //     renderQuestion(questions, array_id_of_questions, current_position, response);--}}
        {{--    // });--}}


        {{--    $(document).click(function (e) {--}}

        {{--        // Если у нас вопрос первого типа, то делаем возможным выбор только 1 елемента--}}
        {{--        if(e.target.className === 'type_1')--}}
        {{--        {--}}
        {{--            $('#type_1 input:checkbox').each(function () {--}}
        {{--                $(this).prop('checked', false);--}}
        {{--            });--}}
        {{--            e.target.checked = true;--}}
        {{--        }--}}
        {{--        if(e.target.className === 'type_3')--}}
        {{--        {--}}
        {{--            if(e.target.checked) {--}}
        {{--                ordered_selected_answers.push(e.target.value);--}}
        {{--            } else{--}}
        {{--                ordered_selected_answers.splice(ordered_selected_answers.findIndex(x => x === e.target.value), 1);--}}
        {{--            }--}}

        {{--            $("#example_answer").html(`<p>Ваш ответ будет принят, как: </p>`);--}}
        {{--            $("#example_answer").append(ordered_selected_answers.map((el, index) => {if(index != 2) return el+=' => '; else {return el} }));--}}
        {{--        }--}}
        {{--        // Если мы нажали, следующий вопрос--}}
        {{--        if(e.target.id === 'get_next') {--}}

        {{--            localStorage.setItem('true_answers', 0);--}}

        {{--            let current_question = questions.find(x => x.id === array_id_of_questions[current_position]);--}}
        {{--            let array_true_answers = current_question.answers.filter(x => x.is_true === 1);--}}
        {{--            let count_true_answers = array_true_answers.length;--}}
        {{--            let count_selected_answers = $(".answers input:checkbox:checked").length;--}}
        {{--            let selected_answers = [];--}}

        {{--            // Сохраняем в массив, все выбранные нами значения--}}
        {{--            for (let i = 0;i < $(".answers input:checkbox:checked").length;i++)--}}
        {{--            {--}}
        {{--                selected_answers.push($(".answers input:checkbox:checked")[i].value);--}}
        {{--            }--}}

        {{--            // Если кол-во правильных и отмеченных ответов совпадает + все правильные присутствуют в ответе--}}
        {{--            if(array_true_answers.every(x => selected_answers.indexOf(x.text) > -1)--}}
        {{--                && (count_true_answers === count_selected_answers)) {--}}

        {{--                if(current_question.type === 3) {--}}
        {{--                    if(array_true_answers.every(el => Number(el.order_number) === Number(ordered_selected_answers[el.order_number-1]))) {--}}
        {{--                        localStorage.setItem('true_answers', Number(localStorage.getItem('true_answers')) + 1);--}}
        {{--                    }--}}
        {{--                } else {--}}
        {{--                    localStorage.setItem('true_answers', Number(localStorage.getItem('true_answers')) + 1);--}}
        {{--                }--}}
        {{--            }--}}
        {{--            current_position+=1;--}}

        {{--            $.ajax({--}}
        {{--                url: "{{ url('/userStatus/update') }}",--}}
        {{--                type: "POST",--}}
        {{--                data: {"lesson_id" : lesson_id,--}}
        {{--                    "count_true_answers" : Number(localStorage.getItem('true_answers')),--}}
        {{--                    "current_position" : current_position,--}}
        {{--                    "array_positions" : ordered_selected_answers--}}
        {{--                },--}}
        {{--                success: function (data) {--}}
        {{--                    response = data["data"];--}}

        {{--                    renderQuestion(questions, array_id_of_questions, current_position, response);--}}
        {{--                }--}}
        {{--            });--}}

        {{--        }--}}
        {{--    });--}}
        {{--});--}}

	</script>
@endpush

@push('scripts')
	<script src="{{ mix('js/app.js') }}"></script>
@endpush

<style>
	.img-question{
		width: 500px;
		height: auto;
	}

	/*.img-answer{*/
	/*    width: 150px;*/
	/*    height: 150px;*/
	/*}*/

	.answer-text{
		font-size: 3rem;
	}

	.error{
		font-size: 24px;
		color: red;
	}

	input[type="checkbox"]{
		width: 25px;
		height: 25px;
		margin-top: 10px;
	}

	.answer-block {
		text-align: left;
		margin-left: 10%;
	}

	#question_content p {
		font-size: 24px;
	}
	.card-header {
		font-size: 24px;
	}
	/* Extra small devices (portrait phones, less than 576px)*/
	@media (max-width: 575.98px) {
		input[type="checkbox"]{
			width: 50px;
			height: 50px;
			margin-top: 10px;
		}
	}

	/* Small devices (landscape phones, 576px and up)*/
	@media (min-width: 576px) and (max-width: 767.98px) {
		input[type="checkbox"]{
			width: 50px;
			height: 50px;
			margin-top: 10px;
		}
	}
</style>
