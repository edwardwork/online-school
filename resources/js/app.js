require('./bootstrap');

window.Vue = require('vue');

Vue.component('vimeo-video-iframe', require('./components/vimeo-video-iframe').default);
Vue.component('module-for-testing', require('./components/module-for-testing').default);

const app = new Vue({
    el: '#application',
});
