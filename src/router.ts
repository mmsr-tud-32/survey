import Vue from 'vue';
import Router from 'vue-router';
import Home from './views/Home.vue';

Vue.use(Router);

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/survey/:uuid',
      name: 'home',
      component: Home,
    },
    {
      path: '/intro/:submissionUuid',
      name: 'intro',
      component: () => import(/* webpackChunkName: "intro" */ './views/Intro.vue'),
    },
    {
      path: '/question/:submissionUuid/:imageUuid',
      name: 'question',
      component: () => import(/* webpackChunkName: "question" */ './views/Question.vue'),
    },
  ],
});
