require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import { BootstrapVue, IconsPlugin} from 'bootstrap-vue';
Vue.use(BootstrapVue, IconsPlugin);

import DataTable from 'laravel-vue-datatable';
Vue.use(DataTable);

import VueAxios from 'vue-axios';
import axios from 'axios';

import App from './App.vue';
Vue.use(VueAxios, axios);

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import IndexComponent from './components/posts/Index.vue';
import CreateComponent from './components/posts/Create.vue';
import EditComponent from './components/posts/Edit.vue';

const routes = [
  {
    name : 'posts',
    path : '/',
    component : IndexComponent
  },
  {
    name : 'create',
    path : '/create',
    component : CreateComponent
  },
  {
    name : 'edit',
    path : '/edit',
    component : EditComponent
  },
];

const router = new VueRouter({
    mode : 'history',
    routes : routes
});

const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');
