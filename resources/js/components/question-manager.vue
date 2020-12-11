<template>
    <div>
        <p class="rem-3">{{ question.text }}</p>
        <img v-if="question.image_url" :src="'/storage/'+question.image_url" alt="" class="w-100">
        <div class="text-left">
            <div v-for="(answer, index) in question.answers">
                <input :id="index + '_'" type='checkbox' @click="handleCheckbox" class="mt-4 mr-2" :value='answer.id'>
                <label :for="index + '_'" class="answer-text">{{answer.text}}</label>
            </div>
        </div>

        <div v-if="question.type == 3">
            <p>Ваш ответ будет принят, как:</p>
            <ol>
                <li v-for="item in userAnswer">{{ item }}</li>
            </ol>
        </div>

        <button class="btn btn-success rem-3 mt-4"
                @click="sendAnswer">Next</button>
    </div>
</template>

<script>
export default {
    name: "question-manager",
    data() {
        return {
            userAnswer: new Set()
        }
    },
    props: {
        question:  {type: Object, required: true}
    },
    methods: {
        handleCheckbox(e) {
            if(this.question.type == 1) {
                document.querySelectorAll("input[type='checkbox']").forEach(item => {
                    item.checked = false;
                })
                e.target.checked = true;
                this.userAnswer = new Set(e.target.value);
            }
            if(this.question.type == 2) {
                if(e.target.checked == true) {
                    this.userAnswer.add(e.target.value);
                }
            }
            if(this.question.type == 3) {
                if(e.target.checked == true) {
                    this.userAnswer.add(e.target.value);
                }
                if(e.target.checked == false) {
                    this.userAnswer.delete(e.target.value);
                }
            }
        },
        sendAnswer() {
            if(this.userAnswer.size > 0) {
                document.querySelectorAll("input[type='checkbox']").forEach(item => {
                    item.checked = false;
                })
                let isCorrectAnswer = false;
                let trueAnswers = this.question.answers.filter(x => x.is_true);
                if(this.userAnswer.size == trueAnswers.length) {
                    let flag = true;
                    trueAnswers.map(x => {
                        if(!this.userAnswer.has(String(x.id))) {
                            flag=false;
                        }
                    })
                    isCorrectAnswer = flag;
                }
                Event.fire('next-question', {isCorrectAnswer: isCorrectAnswer});

                this.userAnswer = new Set();
            }
        }
    }
}
</script>

<style scoped>

</style>
