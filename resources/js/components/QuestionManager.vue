<template>
    <div>
        <p class="text-7xl">{{ question.text }}</p>
        <div v-for="answer in question.answers">
            <input type='checkbox' @click="handleCheckbox" :value='answer.id'><span class="answer-text">{{answer.text}}</span>
        </div>
        <button class="text-5xl bg-indigo-300 border mt-8 rounded-full px-4 py-2" id="start_test"
                @click="sendAnswer">Next</button>
    </div>
</template>

<script>
export default {
    name: "QuestionManager",
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
            document.querySelectorAll("input[type='checkbox']").forEach(item => {
                item.checked = false;
            })
            this.userAnswer = new Set();
            Event.fire('next-question');
        }
    }
}
</script>

<style scoped>

</style>
