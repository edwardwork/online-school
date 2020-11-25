require('./bootstrap');

window.Vue = require('vue');

Vue.component('vimeo-video-iframe', require('./components/vimeo-video-iframe').default);
Vue.component('module-for-testing', require('./components/module-for-testing').default);
Vue.component('question-manager', require('./components/question-manager').default);

const app = new Vue({
    el: '#app',
    created() {
        window.Event = new class {
            constructor() {
                this.vue = new Vue();
            }

            fire(event, data = null) {
                this.vue.$emit(event, data);
            }

            listen(event, callback) {
                this.vue.$on(event, callback);
            }
        };
    }
});
