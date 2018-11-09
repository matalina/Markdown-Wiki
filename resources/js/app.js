import axios from 'axios';

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.baseURL = 'http://192.168.200.181/mdwiki/api/';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import Vue from 'vue';
import Menu from './components/Menu';
import Page from './components/Page';
import List from './components/List';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        {
            path: '/',
            component: Page,
        },
        {
            path: '/menu/:type/:name',
            component: List,
        },
        {
            path: '/page/(.*)',
            component: Page,
        }

    ]
});

Vue.component('cat-tag',Menu);

const app = new Vue({
    el: '#app',
    router,
});
