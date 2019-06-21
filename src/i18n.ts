import Vue from 'vue';
import VueI18n from 'vue-i18n';
import nl from '@/messages/nl';
import en from '@/messages/en';

Vue.use(VueI18n);

export default new VueI18n({
    locale: 'nl',
    messages: {
        nl, en,
    },
});
