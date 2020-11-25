<template>
    <div class="mt-8 text-center">
        <div class="card-header text-5xl">
            Тестовые задания
        </div>

        <div class="card-body" id="question_content">

            <button class="text-5xl bg-indigo-300 border mt-8 rounded-full px-4 py-2" id="start_test"
                    @click="showQuestions = true" v-show="!showQuestions && !status.is_success && ">Start test</button>

            <question-manager v-show="showQuestions" :question="questions[current_position]"></question-manager>
        </div>

        <div class="mt-8 text-5xl" id="question_info" v-show="status">
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
                infoText: ''
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
            this.current_position = this.status.current_position == -1 ? 0 : this.status.current_position
            this.shuffle(this.questions);
            Event.listen('next-question', () => {
                if(this.questions.length - 1 == this.current_position) {
                    this.showQuestions = false;
                }
                this.current_position++;
            })
        }
    }
</script>

<style scoped>

</style>
