<template>
    <div class="card text-center">
        <div class="card-header">
            Тестовые задания
        </div>
        <div class="card-body" id="question_content">
            <button class="btn btn-primary rem-3"
                    @click="showQuestions = true"
                    v-show="!showQuestions && !status.is_success && !testIsOver">
                Start test
            </button>

            <p v-if="testIsOver" class="rem-3">
                Тест сдан, результаты будут известны в ближайшем будущем :)
            </p>

            <p v-if="testIsClosed" class="rem-3">
                Скорее всего, вы превысили количество попыток, выделенные для вас :(
            </p>

            <question-manager v-show="showQuestions" :question="questions[current_position]"></question-manager>
        </div>
        <div class="card-footer text-muted" v-show="status">
            {{ this.showCountAttempt() }}
        </div>
    </div>
</template>

<script>
    export default {
        name: "module-for-testing",
        props: {
            status:     {type: Object, required: true},
            questions:  {type: Array, required: true}
        },
        data() {
            return {
                showQuestions: false,
                current_position: -1,
                infoText: '',
                testIsOver: false,
                testIsClosed: false,
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
            }
        },
        mounted() {
            this.current_position = this.status.current_position == -1 ? 0 : this.status.current_position;
            this.testIsOver = this.status.is_success;
            this.testIsClosed = this.status.attempt == this.status.max_attempt;

            this.shuffle(this.questions);
            Event.listen('next-question', () => {
                if(this.questions.length - 1 == this.current_position) {
                    this.showQuestions = false;
                    this.testIsOver = true;
                }
                this.current_position++;
            })
        }
    }
</script>

<style scoped>

</style>
