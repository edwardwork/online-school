export default class TemplateBuilder {
    constructor() {
        this.template = ``;
    }

    setTitle(title = ``) {
        this.template += `<p>${title}</p>`;
    }

    setImage(url = ``) {
        this.template += `<img src="/storage/${url}" class="img-question">`;
    }

    setTypeQuestion(type = 1) {
        this.template += `<div id="type_${type}" class="answers">`;
        this.type = type;
    }

    addCloseTag(tag = `<div/>`) {
        this.template += tag;
    }

    addAnswer(answer) {
        this.template += `<div class="answer-block">`;
        if(answer.text !== null) {
            this.template += `<input class="type_${this.type}" type='checkbox' name="answer" value='${answer.text}'><span class="answer-text"> ${answer.text}</span>`;
        }
        if(answer.image_url){
            this.template += `<br>`;
            this.template += `<img class="img-answer" width="250px" src="/storage/${answer.image_url}">`;
        }
        this.addCloseTag(`</div>`);
    }

    addAnswerButton() {
        this.template += `</div><br><button class="btn btn-success btn-lg" id="get_next">Ответить и перейти дальше</button>`;
        if(Number(this.type) === 3) {
            this.template += `<div id="example_answer"><p>Ваш ответ будет принят, как: </p></div>`;
        }
    }

    clear() {
        this.template = ``;
    }

    get() {
        return this.template;
    }
}