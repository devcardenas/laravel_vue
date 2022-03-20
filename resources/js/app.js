require('./bootstrap');
import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import App from './App.vue';
import axios from 'axios';
import routes from './routes';

let token = localStorage.getItem('token');

if(token){
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
}

const router = createRouter({
    history: createWebHistory(),
    routes,
});

createApp(App).use(router).mount('#app');