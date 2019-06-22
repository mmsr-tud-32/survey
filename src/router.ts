import Vue from 'vue';
import Router from 'vue-router';
import Survey from './views/Survey.vue';
import Home from './views/Home.vue';

Vue.use(Router);

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
    },
    {
      path: '/survey/:uuid',
      name: 'home',
      component: Survey,
    },
    {
      path: '/intro',
      name: 'intro',
      component: () => import(/* webpackChunkName: "intro" */ './views/Intro.vue'),
    },
    {
      path: '/question',
      name: 'question',
      component: () => import(/* webpackChunkName: "question" */ './views/Question.vue'),
    },
    {
      path: '/error',
      name: 'error',
      component: () => import(/* webpackChunkName: "error" */ './views/Error.vue'),
    },
  ],
});
