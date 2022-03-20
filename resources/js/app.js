require('./bootstrap');

import { createApp } from 'vue'
import App from './App.vue';
import { createRouter, createWebHistory } from 'vue-router'
import axios from 'axios';
import Login from './views/Login.vue';
const routes = [
    {
        path: '/',
        name: 'login',
        component: Login,
    },
    {
        path: '/libros',
        name: 'libros',
        component: () => import ('./views/prestatario/Books.vue'),
    },
    {
        path: '/prestamos',
        name: 'prestamos',
        component: () => import ('./views/prestatario/Loans.vue'),
    },
    {
        path: '/admin/libros',
        name: 'admin-libros',
        component: () => import ('./views/admin/Books.vue'),
    },
    {
        path: '/admin/libros/:id',
        name: 'edit-libro',
        component: () => import ('./views/admin/Edit.vue'),
    },
    {
        path: '/admin/prestamos',
        name: 'admin-prestamos',
        component: () => import ('./views/admin/Loans.vue'),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

let token = localStorage.getItem('token');

if(token){
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
}

createApp(App).use(router).mount('#app');