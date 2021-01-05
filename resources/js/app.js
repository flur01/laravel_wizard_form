require('./bootstrap');

window.Vue = require('vue');

import VueTheMask from 'vue-the-mask'

Vue.use(VueTheMask)
Vue.component('wizard-form', require('./components/WizardFormComponent.vue').default);
Vue.component('all-members', require('./components/AllmembersComponent.vue').default);


const app = new Vue({
    el: '#app',
});
