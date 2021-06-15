<template>
    <div class="card text-center">
        <div class="card-header">
            Тестовые задания
        </div>
        <div class="card-body" id="question_content">
            <button class="btn btn-primary rem-3"
                    @click="startTest"
                    v-show="!showQuestions && !testIsOver && !testIsClosed">
                Start test
            </button>

            <p v-if="testIsOver" class="rem-3">
                Test is over, thank you.
                <br>
                You use {{ currentAttempt }} of {{ maxAttempt }} available attempts
                <br>
                Your result:
                <k-progress :percent="percentTrueAnswers"></k-progress>
                <br>
            </p>

            <p v-else-if="testIsClosed" class="rem-3">
                Скорее всего, вы превысили количество попыток, выделенные для вас :(
            </p>

            <question-manager v-else-if="showQuestions" :question="questions[current_position]"></question-manager>
        </div>
        <div class="card-footer text-muted" v-show="status && !testIsOver">
            {{ this.showCountAttempt() }}
        </div>
    </div>
</template>

<script>
    import KProgress from 'k-progress';
    Vue.component('k-progress', KProgress);

    export default {
        name: "module-for-testing",
        props: {
            status:     {type: Object, required: true},
            questions:  {type: Array, required: true}
        },
        data() {
            return {
                showQuestions: false,
                current_position: 0,
                infoText: '',
                testIsOver: false,
                testIsClosed: false,
                percentTrueAnswers: 0,
                currentAttempt: 1,
                maxAttempt: 3
            }
        },
        methods: {
            showCountAttempt() {
                let max_attempt = this.status.hasOwnProperty('max_attempt') ? this.status['max_attempt'] : 0;
                let current_attempt = this.status.hasOwnProperty('attempt') ? this.status['attempt'] : 0;

                let attempt = max_attempt - current_attempt;
                let attempt_case = attempt === 1 ? 'попытка' : attempt === 0 ? 'попыток' : 'попытки';

                return ` У вас осталось ${attempt} ${attempt_case} чтобы пройти этот тест`;
            },
            shuffle(array) {
                array.sort(() => Math.random() - 0.5);
            },
            startTest() {
                this.showQuestions = true;
                axios.post('/userStatus/update', {
                    'lesson_id': this.questions[0].lesson_id,
                    'count_true_answers': 0,
                    'needIncreaseAttempt': false
                })
            }
        },
        mounted() {
            localStorage.setItem('true_answers', this.status.count_true_answers ? 0 : this.status.count_true_answers);
            this.testIsOver = this.status.is_success;
            this.percentTrueAnswers = this.status.count_true_answers / this.status.lesson.question_count * 100;
            this.testIsClosed = this.status.attempt >= this.status.max_attempt;

            this.shuffle(this.questions);

            Event.listen('next-question', (obj) => {

                if(obj.isCorrectAnswer) {
                    localStorage.setItem('true_answers', Number(localStorage.getItem('true_answers')) + 1);
                }

                if(this.questions.length - 1 == this.current_position) {
                    this.showQuestions = false;
                    this.testIsOver = true;
                }
                if(this.current_position == this.questions.length - 1) {
                    axios.post('/userStatus/update', {
                        'lesson_id': this.questions[0].lesson_id,
                        'count_true_answers': Number(localStorage.getItem('true_answers')),
                    }).then(response => {
                        this.percentTrueAnswers = (response.data.data.count_true_answers / response.data.data.lesson.question_count * 100)
                        this.currentAttempt = response.data.data.attempt;
                        this.maxAttempt = response.data.data.max_attempt;
                    });
                }
                this.current_position++;
            })
        }
    }
</script>

<style scoped>

</style>
