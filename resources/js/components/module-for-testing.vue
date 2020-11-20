<template>
    <div class="card text-center">
        <div class="card-header" style="font-size: 2rem;">
            Тестовые задания
        </div>

        <div class="card-body" id="question_content">
            <button class="btn btn-primary btn-lg" id="start_test" style="font-size: 1.5rem;"  @click="renderQuestion(getTemplateForQuestion())">Начать тест</button>
        </div>

        <div class="card-footer text-muted" id="question_info" v-show="status" style="font-size: 1.5rem;">
            {{ this.showCountAttempt() }}
        </div>

    </div>
</template>

<script>
    import '../TemplateBuilder';
    import TemplateBuilder from "../TemplateBuilder";

    export default {
        name: "module-for-testing",
        props: {
            status:     {type: Object, required: true},
            answers:    {type: Object, required: true},
            questions:  {type: Object, required: true}
        },
        data() {
            return {
                question_ids: [],
                current_position: 0
            }
        },
        computed: {
            getCurrentPositionQuestionIndex() {
                return this.current_position;
            },
        },
        methods: {
            showCountAttempt() {
                let max_attempt = this.status.hasOwnProperty('max_attempt') ? this.status['max_attempt'] : 0;
                let current_attempt = this.status.hasOwnProperty('attempt') ? this.status['attempt'] : 0;

                let attempt = max_attempt - current_attempt;
                let attempt_case = attempt === 1 ? 'попытка' : attempt === 0 ? 'попыток' : 'попытки';

                return ` У вас осталось ${attempt} ${attempt_case} чтобы пройти этот тест`;
            },
            updateCurrentPosition(value = 0) {
                if(value) {
                    this.current_position = value;
                } else {
                    this.current_position = this.status.current_position === -1 ? 0 : this.status.current_position
                }
            },
            renderQuestion(template) {
                console.log(this.$refs.question_info, template);
                document.querySelector('#question_content').innerHTML = template;
            },
            getTemplateForQuestion() {
                if (this.status) {
                    let template = new TemplateBuilder();

                    let question_ids = this.status.question_ids.split(" ");
                    this.updateCurrentPosition();

                    if(this.status.is_success === 1 || this.status.is_success === true) {
                        template.setTitle('Вы успешно сдали этот тест.');
                        return template.get();
                    }
                    if(this.status.attempt >= this.status.max_attempt) {
                            template.setTitle('Превышено количество попыток сдачи теста.');
                            return template.get();
                    }

                    if (question_ids.length > 0) {

                        let current_question = this.questions.find(question => question.id == question_ids[this.getCurrentPositionQuestionIndex]);
                        if(current_question && (this.status.is_success == 0) && (this.status.attempt < this.status.max_attempt)) {
                            template.setTitle(current_question.text)

                            if(current_question.image_url) {
                                template.setImage(current_question.image_url)
                            }
                            template.setTypeQuestion(current_question.type)

                            this.shuffle(current_question.answers);

                            current_question.answers.forEach(answer => {
                                template.addAnswer(answer);
                            });

                            template.addAnswerButton();
                        }
                    } else {
                        template.setTitle('Для этого урока еще не назначены вопросы')
                    }
                    return template.get();
                }
            },
            shuffle(array) {
                array.sort(() => Math.random() - 0.5);
            }
        },
        mounted() {
            console.log(this.status)
            localStorage.setItem('true_answers', 0);
            this.getTemplateForQuestion();
        }
    }
</script>

<style scoped>

</style>
