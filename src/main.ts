import Vue from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import './registerServiceWorker';
import VueI18n from 'vue-i18n';
import nl from '@/messages/nl';
import en from '@/messages/en';

Vue.config.productionTip = false;
Vue.use(VueI18n);

const i18n = new VueI18n({
    locale: 'nl',
    messages: {
        nl, en,
    },
});

new Vue({
    router,
    store,
    render: (h) => h(App),
    i18n,
}).$mount('#app');
