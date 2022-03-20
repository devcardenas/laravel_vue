import Login from '../views/Login.vue';

const routes = [
    {
        path: '/',
        name: 'login',
        component: Login,
        beforeEnter: (to, from, next) => {
            if (localStorage.getItem('authenticated') && localStorage.getItem('role') === 'prestatario') {
                next("/libros");
            } else if (localStorage.getItem('authenticated') && localStorage.getItem('role') === 'administrativo') {
                next("/admin/libros");
            }
            else {
                next();
            }
        }
    },
    {
        path: '/libros',
        name: 'libros',
        component: () => import('../views/prestatario/Books.vue'),
        beforeEnter: (to, from, next) => {
            if (localStorage.getItem('authenticated') && localStorage.getItem('role') === 'prestatario') {
                next();
            }
            else {
                next('/');
            }
        }
    },
    {
        path: '/prestamos',
        name: 'prestamos',
        component: () => import('../views/prestatario/Loans.vue'),
        beforeEnter: (to, from, next) => {
            if (localStorage.getItem('authenticated') && localStorage.getItem('role') === 'prestatario') {
                next();
            }
            else {
                next('/');
            }
        }
    },
    {
        path: '/admin/libros',
        name: 'admin-libros',
        component: () => import('../views/admin/Books.vue'),
        beforeEnter: (to, from, next) => {
            if (localStorage.getItem('authenticated') && localStorage.getItem('role') === 'administrativo') {
                next();
            }
            else {
                next('/');
            }
        }
    },
    {
        path: '/admin/libros/:id',
        name: 'editar-libro',
        component: () => import('../views/admin/Edit.vue'),
        beforeEnter: (to, from, next) => {
            if (localStorage.getItem('authenticated') && localStorage.getItem('role') === 'administrativo') {
                next();
            }
            else {
                next('/');
            }
        }
    },
    {
        path: '/admin/libros/crear',
        name: 'crear-libro',
        component: () => import('../views/admin/Create.vue'),
        beforeEnter: (to, from, next) => {
            if (localStorage.getItem('authenticated') && localStorage.getItem('role') === 'administrativo') {
                next();
            }
            else {
                next('/');
            }
        }
    },
    {
        path: '/admin/prestamos',
        name: 'admin-prestamos',
        component: () => import('../views/admin/Loans.vue'),
        beforeEnter: (to, from, next) => {
            if (localStorage.getItem('authenticated') && localStorage.getItem('role') === 'administrativo') {
                next();
            }
            else {
                next('/');
            }
        }
    },
];

export default routes;