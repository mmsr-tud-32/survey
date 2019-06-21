import Vue from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import './registerServiceWorker';
import i18n from './i18n';

import 'bootstrap/scss/bootstrap.scss';

Vue.config.productionTip = false;

new Vue({
    router,
    store,
    render: (h) => h(App),
    i18n,
}).$mount('#app');
