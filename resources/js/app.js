require('./bootstrap');

import { createApp } from 'vue'
import App from './App.vue';
import { createRouter, createWebHistory } from 'vue-router'
import Login from './views/Login.vue';
import Libros from './views/Libros.vue';
import Prestamos from './views/Prestamos.vue';
import axios from 'axios';

const routes = [
    {
        path: '/',
        name: 'login',
        component: Login,
    },
    {
        path: '/libros',
        name: 'libros',
        component: Libros,
    },
    {
        path: '/prestamos',
        name: 'prestamos',
        component: Prestamos,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

var token = localStorage.getItem('token');

if(token){
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
}

createApp(App).use(router).mount('#app');