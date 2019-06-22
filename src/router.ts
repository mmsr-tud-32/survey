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
      path: '/intro-practise',
      name: 'intro-practise',
      component: () => import(/* webpackChunkName: "intro-practise" */ './views/IntroPractise.vue'),
    },
    {
      path: '/intro-short',
      name: 'intro-short',
      component: () => import(/* webpackChunkName: "intro-short" */ './views/IntroShort.vue'),
    },
    {
      path: '/intro-long',
      name: 'intro-long',
      component: () => import(/* webpackChunkName: "intro-long" */ './views/IntroLong.vue'),
    },
    {
      path: '/submit',
      name: 'submit',
      component: () => import(/* webpackChunkName: "submit" */ './views/Submit.vue'),
    },
    {
      path: '/end',
      name: 'end',
      component: () => import(/* webpackChunkName: "end" */ './views/End.vue'),
    },
    {
      path: '/error',
      name: 'error',
      component: () => import(/* webpackChunkName: "error" */ './views/Error.vue'),
    },
    {
      path: '/practise',
      name: 'practise',
      component: () => import(/* webpackChunkName: "practise" */ './views/QuestionPractise.vue'),
    },
    {
      path: '/short',
      name: 'short',
      component: () => import(/* webpackChunkName: "short" */ './views/QuestionShort.vue'),
    },
    {
      path: '/long',
      name: 'long',
      component: () => import(/* webpackChunkName: "long" */ './views/QuestionLong.vue'),
    },
  ],
});
